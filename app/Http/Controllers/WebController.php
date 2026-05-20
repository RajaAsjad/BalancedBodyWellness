<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Faq;
use App\Models\Policies;
use App\Models\Services;
use Illuminate\Support\Str;

class WebController extends Controller
{
    public function Index()
    {
        $page_title = 'Balanced Body IV Wellness';
        $page_meta_description = 'Balanced Body IV Wellness in Los Angeles — IV hydration, peptides, and vitamin injections with medical oversight in a calming, spa-inspired studio. Book your visit.';
         
        
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
        $service = Services::query()
            ->whereIn('status', [1, '1'])
            ->get()
            ->first(fn ($item) => Str::slug($item->heading) === $slug);

        $page_title = $service
            ? $service->heading . ' | Balanced Body IV Wellness'
            : 'IV Wellness Service | Balanced Body IV Wellness';

        $page_meta_description = $service && trim((string) $service->description) !== ''
            ? Str::limit(strip_tags($service->description), 160)
            : 'Explore this IV wellness service — benefits, process, and personalized care at Balanced Body IV Wellness in Los Angeles.';

        return view('website.service-detail', compact('page_title', 'page_meta_description', 'service', 'slug'));
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

    public function Contact()
    {
        $page_title = 'Contact Us | Balanced Body IV Wellness';
        $page_meta_description = "Send us a request and we'll confirm your appointment, share intake forms, and walk you through medical clearance.";
        return view('website.contact', compact('page_title', 'page_meta_description'));
    }
    public function Locations()
    {
        $page_title = 'Locations | Balanced Body IV Wellness';
        $page_meta_description = 'Visit our Los Angeles location for IV therapy, peptide therapy, and vitamin injections — a calming, spa-inspired studio with medical oversight.';
        return view('website.locations', compact('page_title', 'page_meta_description'));
    }
}
