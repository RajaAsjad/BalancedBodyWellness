<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ContactImageCaptcha
{
    private const CHARSET = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

    private const TOKEN_LENGTH = 40;

    private const TTL_MINUTES = 15;

    /** @deprecated Session keys kept for backward compatibility */
    private const SESSION_HASH_KEY = 'contact_captcha_hash';

    private const SESSION_CODE_KEY = 'contact_captcha_code_enc';

    /**
     * @return array{token: string, code: string}
     */
    public function issueChallenge(?string $token = null): array
    {
        $token = $this->normalizeToken($token) ?? $this->generateToken();
        $code = $this->generateCode();

        $this->storeChallenge($token, $code);

        return ['token' => $token, 'code' => $code];
    }

    public function primeChallenge(): void
    {
        if (! $this->hasSessionChallenge()) {
            $this->issueSessionChallenge();
        }
    }

    public function hasSessionChallenge(): bool
    {
        return session()->has(self::SESSION_HASH_KEY)
            && session()->has(self::SESSION_CODE_KEY);
    }

    /**
     * @return array{token: string, code: string}
     */
    public function createTokenChallenge(): array
    {
        return $this->issueChallenge();
    }

    public function getChallengeCodeForImage(bool $refresh, ?string $token = null): string
    {
        $token = $this->normalizeToken($token);

        if ($token !== null) {
            if ($refresh || ! $this->hasTokenChallenge($token)) {
                return $this->issueChallenge($token)['code'];
            }

            return $this->getStoredCode($token) ?? $this->issueChallenge($token)['code'];
        }

        if ($refresh || ! $this->hasSessionChallenge()) {
            return $this->issueSessionChallenge();
        }

        try {
            return decrypt(session(self::SESSION_CODE_KEY));
        } catch (\Throwable) {
            return $this->issueSessionChallenge();
        }
    }

    public function verify(?string $input, ?string $token = null): bool
    {
        $normalized = $this->normalizeInput($input);

        if ($normalized === null) {
            return false;
        }

        $token = $this->normalizeToken($token);

        if ($token !== null) {
            $expected = Cache::get($this->cacheKey($token));

            if (is_array($expected) && isset($expected['hash']) && hash_equals($expected['hash'], $this->hashCode($normalized))) {
                Cache::forget($this->cacheKey($token));

                return true;
            }
        }

        return $this->verifySession($normalized);
    }

    public function clear(?string $token = null): void
    {
        $token = $this->normalizeToken($token);

        if ($token !== null) {
            Cache::forget($this->cacheKey($token));
        }

        session()->forget([self::SESSION_HASH_KEY, self::SESSION_CODE_KEY]);
    }

    public function renderPng(string $code): string
    {
        $width = 200;
        $height = 60;

        $image = imagecreatetruecolor($width, $height);
        if ($image === false) {
            abort(500, 'Captcha image could not be generated.');
        }

        $bg = imagecolorallocate($image, 238, 246, 244);
        $textColor = imagecolorallocate($image, 26, 63, 60);
        $noiseColor = imagecolorallocate($image, 45, 106, 98);

        imagefilledrectangle($image, 0, 0, $width, $height, $bg);

        for ($i = 0; $i < 6; $i++) {
            imageline(
                $image,
                random_int(0, $width),
                random_int(0, $height),
                random_int(0, $width),
                random_int(0, $height),
                $noiseColor
            );
        }

        for ($i = 0; $i < 40; $i++) {
            imagesetpixel($image, random_int(0, $width - 1), random_int(0, $height - 1), $noiseColor);
        }

        $length = strlen($code);
        $slotWidth = (int) floor($width / ($length + 1));

        for ($i = 0; $i < $length; $i++) {
            $char = $code[$i];
            $x = $slotWidth * ($i + 1) - 8;
            $y = random_int(14, 22);
            imagestring($image, 5, $x, $y, $char, $textColor);
        }

        ob_start();
        imagepng($image);
        imagedestroy($image);

        return (string) ob_get_clean();
    }

    protected function storeChallenge(string $token, string $code): void
    {
        Cache::put($this->cacheKey($token), [
            'hash' => $this->hashCode($code),
            'code' => encrypt($code),
        ], now()->addMinutes(self::TTL_MINUTES));
    }

    protected function hasTokenChallenge(string $token): bool
    {
        return Cache::has($this->cacheKey($token));
    }

    protected function getStoredCode(string $token): ?string
    {
        $payload = Cache::get($this->cacheKey($token));

        if (! is_array($payload) || empty($payload['code'])) {
            return null;
        }

        try {
            return decrypt($payload['code']);
        } catch (\Throwable) {
            return null;
        }
    }

    protected function issueSessionChallenge(): string
    {
        $code = $this->generateCode();

        session([
            self::SESSION_HASH_KEY => $this->hashCode($code),
            self::SESSION_CODE_KEY => encrypt($code),
        ]);

        session()->save();

        return $code;
    }

    protected function verifySession(string $normalized): bool
    {
        $expected = session(self::SESSION_HASH_KEY);

        if (! is_string($expected) || $expected === '') {
            return false;
        }

        return hash_equals($expected, $this->hashCode($normalized));
    }

    protected function normalizeInput(?string $input): ?string
    {
        if ($input === null || $input === '') {
            return null;
        }

        $normalized = strtoupper(preg_replace('/\s+/', '', $input) ?? '');

        return strlen($normalized) === 5 ? $normalized : null;
    }

    protected function normalizeToken(?string $token): ?string
    {
        if ($token === null) {
            return null;
        }

        $token = trim($token);

        if ($token === '' || strlen($token) !== self::TOKEN_LENGTH || ! preg_match('/^[a-zA-Z0-9]+$/', $token)) {
            return null;
        }

        return $token;
    }

    protected function generateToken(): string
    {
        return Str::random(self::TOKEN_LENGTH);
    }

    protected function cacheKey(string $token): string
    {
        return 'contact_captcha:'.$token;
    }

    protected function generateCode(int $length = 5): string
    {
        $max = strlen(self::CHARSET) - 1;
        $code = '';

        for ($i = 0; $i < $length; $i++) {
            $code .= self::CHARSET[random_int(0, $max)];
        }

        return $code;
    }

    protected function hashCode(string $code): string
    {
        return hash_hmac('sha256', strtoupper($code), (string) config('app.key'));
    }
}
