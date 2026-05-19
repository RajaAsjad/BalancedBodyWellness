<?php 
use App\Models\PageSetting;
use App\Models\Course;
use App\Models\Testimonial;

function globalData()
{
    $page_settings = PageSetting::get(['parent_slug', 'key', 'value']);
    $home_page_data = [];
    foreach ($page_settings as $key => $page_setting) {
        $home_page_data[$page_setting->key] = $page_setting->value;
    }
    return $home_page_data;
}

function courses($degree)
{
    return $courses = Course::where('degree_slug', $degree)->get(['degree_slug', 'title', 'slug']);
}

function testimonials()
{
    return $testimonials = Testimonial::where('status' ,'=', 1)->get();
}