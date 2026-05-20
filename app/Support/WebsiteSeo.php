<?php

namespace App\Support;

use Illuminate\Support\Str;

class WebsiteSeo
{
    public static function siteName(): string
    {
        return (string) config('seo.site_name');
    }

    public static function canonicalUrl(?string $override = null): string
    {
        $override = trim((string) $override);
        if ($override !== '') {
            return $override;
        }

        return url()->current();
    }

    public static function pageTitle(?string $yieldedTitle = null): string
    {
        $title = trim((string) $yieldedTitle);

        return $title !== '' ? $title : self::siteName();
    }

    public static function metaDescription(?string $yieldedDescription = null): string
    {
        $desc = trim((string) $yieldedDescription);
        if ($desc === '') {
            $desc = (string) config('seo.default_description');
        }

        return Str::limit($desc, 160, '');
    }

    public static function robotsDirective(?string $yieldedRobots = null): string
    {
        $yielded = trim((string) $yieldedRobots);
        if ($yielded !== '') {
            return $yielded;
        }

        if (! app()->environment('production')) {
            return 'noindex, nofollow';
        }

        return 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
    }

    public static function isIndexable(): bool
    {
        return str_starts_with(self::robotsDirective(), 'index');
    }

    public static function ogImageUrl(array $homePageData = []): string
    {
        $configured = trim((string) config('seo.default_og_image'));
        if ($configured !== '') {
            return asset($configured);
        }

        $ogFromAdmin = trim((string) ($homePageData['seo_og_image'] ?? ''));
        if ($ogFromAdmin !== '') {
            return asset('admin/assets/images/page/' . $ogFromAdmin);
        }

        $logo = trim((string) ($homePageData['header_logo'] ?? ''));
        if ($logo !== '') {
            return asset('admin/assets/images/page/' . $logo);
        }

        return asset('assets/website/favicon-la.svg');
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public static function organizationJsonLd(array $homePageData = []): array
    {
        $business = config('seo.business', []);
        $siteUrl = rtrim((string) config('app.url'), '/');

        $address = trim((string) ($homePageData['contact_address'] ?? $homePageData['footer_address'] ?? ''));
        $payload = [
            '@context' => 'https://schema.org',
            '@type' => $business['type'] ?? 'MedicalBusiness',
            '@id' => $siteUrl . '/#organization',
            'name' => self::siteName(),
            'url' => $siteUrl,
            'description' => (string) config('seo.default_description'),
            'telephone' => $business['phone'] ?? null,
            'email' => $business['email'] ?? null,
            'areaServed' => $business['area_served'] ?? null,
            'sameAs' => array_values(array_filter([
                $business['instagram'] ?? null,
            ])),
        ];

        if ($address !== '') {
            $lines = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $address))));
            $payload['address'] = [
                '@type' => 'PostalAddress',
                'streetAddress' => $lines[0] ?? $address,
                'addressLocality' => $lines[1] ?? ($business['area_served'] ?? 'Los Angeles'),
                'addressRegion' => 'CA',
                'addressCountry' => 'US',
            ];
        }

        return array_filter($payload, fn ($value) => $value !== null && $value !== [] && $value !== '');
    }

    /**
     * @return array<string, mixed>
     */
    public static function websiteJsonLd(): array
    {
        $siteUrl = rtrim((string) config('app.url'), '/');

        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => $siteUrl . '/#website',
            'url' => $siteUrl,
            'name' => self::siteName(),
            'publisher' => ['@id' => $siteUrl . '/#organization'],
            'inLanguage' => 'en-US',
        ];
    }

    /**
     * @param  iterable<int, object{question: string, answer: string}>  $faqs
     * @return array<string, mixed>|null
     */
    public static function faqPageJsonLd(iterable $faqs): ?array
    {
        $entities = [];
        foreach ($faqs as $faq) {
            $question = trim((string) ($faq->question ?? ''));
            $answer = trim(strip_tags((string) ($faq->answer ?? '')));
            if ($question === '' || $answer === '') {
                continue;
            }
            $entities[] = [
                '@type' => 'Question',
                'name' => $question,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $answer,
                ],
            ];
        }

        if ($entities === []) {
            return null;
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $entities,
        ];
    }
}
