<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HomeSlider;
use App\Models\Banner;
use App\Models\Testimonial;
use App\Models\ContactUs;
use App\Models\ShopContact;
use App\Models\PhotoGallery;
use App\Models\Video;
use App\Models\Faq;
use App\Models\Policy;
use App\Models\Audio;
use App\Models\Policies;
use App\Models\Services;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->hasRole('Admin')) {
            $page_title = 'Dashboard';

            $slidersTotal = HomeSlider::count(); 
            $faqTotal = Faq::count();
            $policyTotal = Policies::count(); 
            $servicesTotal = Services::count();

            $bannersTotal = Banner::count(); 

            $testimonialsTotal = Testimonial::count(); 

            $contactUsTotal = ContactUs::count(); 

            $shopContactTotal = ShopContact::count(); 

            $galleryTotal = PhotoGallery::count(); 

            $videoTotal = Video::count(); 

            $audioTotal = Audio::count(); 

            return view('admin.dashboard.dashboard', compact(
                'page_title',
                'slidersTotal', 
                'faqTotal',
                'policyTotal',
                'servicesTotal',
                'bannersTotal', 
                'testimonialsTotal', 
                'contactUsTotal', 
                'shopContactTotal', 
                'galleryTotal', 
                'videoTotal', 
                'audioTotal', 
            ));
        }

        return redirect()->route('admin.login');
    }
}


