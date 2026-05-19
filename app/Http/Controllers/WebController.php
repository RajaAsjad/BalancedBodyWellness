<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Faq;
use App\Models\Policies;
use App\Models\Services;
class WebController extends Controller
{
    public function Index()
    {
        $page_title = 'Balanced Body IV Wellness';
        $page_meta_description = 'Holistic IV wellness — thoughtfully formulated IV drips, peptides, and vitamin injections with medical care in a calming, spa-inspired setting.';
         
        
        return view('website.index', compact('page_title', 'page_meta_description'));
    }

    public function Services()
    {
        $page_title = 'Services | Balanced Body IV Wellness';
        $services = Services::query()
            ->whereIn('status', [1, '1'])
            ->orderBy('id')
            ->get();
        $page_meta_description = 'Thoughtfully formulated IV drips, peptides, and vitamin injections — delivered with medical care in a calming, spa-inspired setting.';
        return view('website.services', compact('page_title', 'page_meta_description', 'services'));
    }
    public function AboutUs()
    {
        $page_title = 'About Us | Balanced Body IV Wellness';
        $page_meta_description = 'Thoughtfully formulated IV drips, peptides, and vitamin injections — delivered with medical care in a calming, spa-inspired setting.';
        return view('website.about', compact('page_title', 'page_meta_description'));
    }
    public function Faqs()
    {
        $page_title = 'FAQs | Balanced Body IV Wellness';
        $page_meta_description = 'Answers to common questions about IV therapy, pricing, and more.';
        $faqs = Faq::query()->where('status', '1')->orderBy('id')->get();
        return view('website.faqs', compact('page_title', 'page_meta_description', 'faqs'));
    }
     
    public function Policies()
    {
        $page_title = 'Policies | Balanced Body IV Wellness';
        $page_meta_description = 'Our policies and procedures to ensure a safe and comfortable experience.';
        $policies = Policies::query()->where('status', '1')->orderBy('id')->get();
        return view('website.policies', compact('page_title', 'page_meta_description', 'policies'));
    }

    public function Contact()
    {
        $page_title = 'Contact Us | Balanced Body IV Wellness';
        $page_meta_description = "Send us a request and we'll confirm your appointment, share intake forms, and walk you through medical clearance.";
        return view('website.contact', compact('page_title', 'page_meta_description'));
    }
}
