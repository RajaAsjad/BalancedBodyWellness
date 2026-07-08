<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Faq;
use App\Models\Policies;
use App\Models\Services;
use App\Models\ServicePage;
use App\Services\ContactImageCaptcha;
use App\Support\LocationPageRegistry;
use App\Support\ServicePageRegistry;
use Illuminate\Support\Str;

class WebController extends Controller
{
    public function Index()
    {
        $page_title = 'IV Therapy NYC | Wellness Solutions | Balanced Body IV Wellness';
        $page_meta_description = 'Experience advanced IV therapy and wellness solutions in NYC. Offering NAD+ therapy, IV infusions, peptide therapy, and medical weight loss treatments. Book your consultation with Balanced Body IV Wellness today.';
         
        return view('website.index', compact('page_title', 'page_meta_description'));
    }

    public function Services()
    {
        $page_title = 'Services | Balanced Body IV Wellness';
        $services = Services::query()
            ->whereIn('status', [1, '1'])
            ->orderBy('id')
            ->get();
        $page_meta_description = 'Explore IV drips, peptide therapy, and vitamin injections at Balanced Body IV Wellness — benefits, descriptions, and who each service is right for.';
        return view('website.services', compact('page_title', 'page_meta_description', 'services'));
    }
    public function ServiceDetail($slug)
    {
        $page = ServicePage::findPublishedPageBySlug($slug);

        if ($page) {
            $page_title = $page['meta_title'] ?? (($page['name'] ?? 'Service') . ' | Balanced Body IV Wellness');
            $page_meta_description = $page['meta_description'] ?? 'Explore this IV wellness service at Balanced Body IV Wellness in Los Angeles.';

            return view('website.service-page', compact('page_title', 'page_meta_description', 'slug', 'page'));
        }

        $service = Services::query()
            ->whereIn('status', [1, '1'])
            ->get()
            ->first(fn ($item) => Str::slug($item->heading) === $slug);

        $navItem = null;
        $servicePage = ServicePage::findBySlug($slug);
        if ($servicePage) {
            $navItem = [
                'slug' => $servicePage->slug,
                'label' => $servicePage->nav_label ?: $servicePage->name,
            ];
        }
        $placeholder = $navItem;

        if ($service) {
            $page_title = $service->heading . ' | Balanced Body IV Wellness';
            $page_meta_description = trim((string) $service->description) !== ''
                ? Str::limit(strip_tags($service->description), 160)
                : 'Explore this IV wellness service — benefits, process, and personalized care at Balanced Body IV Wellness in Los Angeles.';
        } elseif ($navItem) {
            $page_title = $navItem['label'] . ' | Balanced Body IV Wellness';
            $page_meta_description = 'Explore ' . $navItem['label'] . ' — benefits, process, and personalized IV wellness care at Balanced Body IV Wellness in Los Angeles.';
        } else {
            $page_title = 'IV Wellness Service | Balanced Body IV Wellness';
            $page_meta_description = 'Explore this IV wellness service — benefits, process, and personalized care at Balanced Body IV Wellness in Los Angeles.';
        }

        return view('website.service-detail', compact('page_title', 'page_meta_description', 'service', 'slug', 'placeholder'));
    }

    public function PublicSlugPage(string $slug)
    {
        if (in_array($slug, ServicePageRegistry::publishedSlugs(), true)) {
            return $this->ServiceDetail($slug);
        }

        if (in_array($slug, LocationPageRegistry::publishedSlugs(), true)) {
            return $this->LocationPage($slug);
        }

        abort(404);
    }
    public function AboutUs()
    {
        $page_title = 'About Us | Balanced Body IV Wellness';
        $page_meta_description = 'Meet Carmen, Critical Care RN and founder of Balanced Body IV & Wellness — 15+ years in ICU care, personalized IV therapy, and long-term wellness in Los Angeles.';
        return view('website.about', compact('page_title', 'page_meta_description'));
    }
    public function Faqs()
    {
        $page_title = 'FAQs | Balanced Body IV Wellness';
        $page_meta_description = 'FAQ about IV therapy, peptides, appointments, pricing, and what to expect at Balanced Body IV Wellness in Los Angeles.';
        $faqGroups = Faq::groupedForPublicIndex();

        return view('website.faqs', compact('page_title', 'page_meta_description', 'faqGroups'));
    }
     
    public function Policies()
    {
        $page_title = 'Policies | Balanced Body IV Wellness';
        $page_meta_description = 'Read Balanced Body IV Wellness policies — safety, appointments, cancellations, and guidelines for a comfortable IV wellness visit.';
        $policies = Policies::query()->where('status', '1')->orderBy('id')->get();
        return view('website.policies', compact('page_title', 'page_meta_description', 'policies'));
    }

    public function Contact(ContactImageCaptcha $captcha)
    {
        $page_title = 'Contact Us | Balanced Body IV Wellness';
        $services = Services::query()
            ->whereIn('status', [1, '1'])
            ->orderBy('heading')
            ->get();
        $servicePages = Faq::serviceLandingPagesForPicker();
        $captchaToken = $captcha->createTokenChallenge()['token'];
        $page_meta_description = "Send us a request and we'll confirm your appointment, share intake forms, and walk you through medical clearance.";
        return view('website.contact', compact('page_title', 'page_meta_description', 'services', 'servicePages', 'captchaToken'));
    }
    public function Locations()
    {
        $page_title = 'Locations | Balanced Body IV Wellness';
        $page_meta_description = 'IV therapy across Rockland County, Westchester, Putnam, Dutchess, and Jefferson Valley — medically guided drips and wellness injections at Balanced Body IV & Wellness.';
        $locations = \App\Models\Location::pagesForPublicIndex();

        return view('website.locations', compact('page_title', 'page_meta_description', 'locations'));
    }

    public function LocationPage(string $slug)
    {
        $page = \App\Models\Location::findPublishedPageBySlug($slug);

        if (! $page) {
            abort(404);
        }

        $page_title = $page['meta_title'] ?? (($page['name'] ?? 'Location') . ' | Balanced Body IV Wellness');
        $page_meta_description = $page['meta_description'] ?? 'Visit Balanced Body IV & Wellness for IV therapy, peptide therapy, and vitamin injections in a calm, spa-inspired studio with medical oversight.';

        return view('website.location-page', compact('page_title', 'page_meta_description', 'slug', 'page'));
    }

    public function LocationDetail($slug)
    {
        if (\App\Models\Location::findPublishedPageBySlug($slug)) {
            return redirect('/' . $slug, 301);
        }

        abort(404);
    }
}
