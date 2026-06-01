<?php

namespace App\Support;

use Illuminate\Support\Str;

class WebsiteSeo
{
    public static function siteName(): string
    {
        return (string) config('seo.site_name');
    }

    public static function siteUrl(): string
    {
        return rtrim((string) config('app.url'), '/');
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

        return self::logoUrl($homePageData);
    }

    public static function logoUrl(array $homePageData = []): string
    {
        $adminLogo = trim((string) ($homePageData['header_logo'] ?? ''));
        if ($adminLogo !== '') {
            return asset('admin/assets/images/page/' . $adminLogo);
        }

        $configured = trim((string) config('seo.default_logo'));
        if ($configured !== '') {
            return asset($configured);
        }

        return asset('assets/website/favicon-la.svg');
    }

    /**
     * @return array<string, mixed>
     */
    public static function websiteJsonLd(): array
    {
        $siteUrl = self::siteUrl();

        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => $siteUrl . '/#website',
            'name' => self::siteName(),
            'url' => $siteUrl . '/',
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => $siteUrl . '/?s={search_term_string}',
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function organizationJsonLd(array $homePageData = []): array
    {
        $business = config('seo.business', []);
        $siteUrl = self::siteUrl();

        return array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            '@id' => $siteUrl . '/#organization',
            'name' => self::siteName(),
            'alternateName' => $business['alternate_name'] ?? null,
            'url' => $siteUrl . '/',
            'logo' => self::logoUrl($homePageData),
            'sameAs' => array_values(array_filter([
                $business['instagram'] ?? null,
            ])),
        ], fn ($value) => $value !== null && $value !== [] && $value !== '');
    }

    /**
     * @return array<string, mixed>
     */
    public static function localBusinessJsonLd(array $homePageData = []): array
    {
        $business = config('seo.business', []);
        $siteUrl = self::siteUrl();

        return array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            '@id' => $siteUrl . '/#localbusiness',
            'name' => self::siteName(),
            'image' => self::ogImageUrl($homePageData),
            'url' => $siteUrl . '/',
            'telephone' => $business['phone'] ?? null,
            'email' => $business['email'] ?? null,
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $business['street_address'] ?? null,
                'addressLocality' => $business['address_locality'] ?? null,
                'addressRegion' => $business['address_region'] ?? null,
                'postalCode' => $business['postal_code'] ?? null,
                'addressCountry' => $business['address_country'] ?? 'US',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => $business['latitude'] ?? null,
                'longitude' => $business['longitude'] ?? null,
            ],
            'sameAs' => array_values(array_filter([
                $business['instagram'] ?? null,
            ])),
        ], fn ($value) => $value !== null && $value !== [] && $value !== '');
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
