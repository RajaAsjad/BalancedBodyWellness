<?php 
use App\Models\PageSetting;
use App\Models\Course;
use App\Models\Testimonial;

function globalData()
{
    $page_settings = PageSetting::get(['parent_slug', 'key', 'value']);
    $home_page_data = [];
    $skipKeys = ['_token', 'parent_slug', 'form_blog', 'form_header', 'form_footer'];

    foreach ($page_settings as $page_setting) {
        $key = $page_setting->key;
        $value = $page_setting->value;

        if (in_array($key, $skipKeys, true)) {
            continue;
        }

        $ownedBy = match (true) {
            str_starts_with($key, 'footer_') => 'footer',
            str_starts_with($key, 'header_') => 'header',
            default => null,
        };

        if ($ownedBy !== null && $page_setting->parent_slug === $ownedBy) {
            $home_page_data[$key] = $value;
            continue;
        }

        if (! array_key_exists($key, $home_page_data)) {
            $home_page_data[$key] = $value;
            continue;
        }

        if (empty($home_page_data[$key]) && ! empty($value)) {
            $home_page_data[$key] = $value;
        }
    }

    return $home_page_data;
}



function testimonials()
{
    return $testimonials = Testimonial::where('status' ,'=', 1)->get();
}