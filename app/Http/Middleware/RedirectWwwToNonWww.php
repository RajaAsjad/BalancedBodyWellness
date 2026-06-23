<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectWwwToNonWww
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = strtolower($request->getHost());

        if (! str_starts_with($host, 'www.')) {
            return $next($request);
        }

        $canonicalUrl = config('seo.canonical_url', config('app.url'));
        $canonicalHost = strtolower((string) parse_url($canonicalUrl, PHP_URL_HOST));

        if ($canonicalHost === '' || str_starts_with($canonicalHost, 'www.')) {
            return $next($request);
        }

        if ($host !== 'www.'.$canonicalHost) {
            return $next($request);
        }

        $scheme = parse_url($canonicalUrl, PHP_URL_SCHEME)
            ?: ($request->isSecure() ? 'https' : 'http');

        $url = $scheme.'://'.$canonicalHost.$request->getRequestUri();

        return redirect()->away($url, 301);
    }
}
