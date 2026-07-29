<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\ContactCaptchaController;
use App\Http\Controllers\FaviconController;
use App\Support\LocationPageRegistry;
use App\Support\ServicePageRegistry;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\HomeSliderController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\ContactUsController;
use App\Http\Controllers\admin\VideoController;
use App\Http\Controllers\admin\AudioController;
use App\Http\Controllers\admin\PhotoGalleryController;
use App\Http\Controllers\admin\ShopContactController;
use App\Http\Controllers\admin\ServicesController;
use App\Http\Controllers\admin\LocationController;
use App\Http\Controllers\admin\ServicePageController;
use App\Http\Controllers\admin\BlogCategoryController;
use App\Http\Controllers\admin\BlogController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/route-clear', function () {
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    $cache = 'Route cache cleared <br /> View cache cleared <br /> Cache cleared <br /> Config cleared <br /> Config cache cleared';
    return $cache;
});

Route::get('admin/login', 'admin\AdminController@login')->name('admin.login');
Route::post('admin/authenticate', 'admin\AdminController@authenticate')->name('admin.authenticate');


Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/admin/profile/edit', 'admin\AdminController@editProfile')->name('admin.profile.edit');
Route::post('/admin/profile/update', 'admin\AdminController@updateProfile')->name('admin.profile.update');
Route::post('admin/logout', 'admin\AdminController@logOut')->name('admin.logout');


Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/favicon.ico', [FaviconController::class, 'ico'])->name('favicon.ico');
Route::get('/favicon.png', [FaviconController::class, 'png'])->name('favicon.png');

// Frontend — Balanced Body IV Wellness
Route::get('/', [WebController::class, 'Index'])->name('index'); 
Route::get('services', [WebController::class, 'Services'])->name('services');
Route::redirect('services/methylene-blue', '/methylene-blue-iv-therapy-nyc', 301);
Route::redirect('services/nad', '/nad-therapy-nyc', 301);
Route::redirect('services/peptide-therapy', '/peptide-therapy-nyc', 301);
Route::redirect('services/iv-vitamin-therapy', '/iv-vitamin-therapy-nyc', 301);
Route::redirect('services/medical-weight-loss', '/medical-weight-loss-nyc', 301);
Route::redirect('services/iron-infusion', '/iron-infusion-therapy-nyc', 301);

Route::get('about-us', [WebController::class, 'AboutUs'])->name('about-us');
Route::get('faqs', [WebController::class, 'Faqs'])->name('faqs');
Route::get('policies', [WebController::class, 'Policies'])->name('policies');
Route::get('contact', [WebController::class, 'Contact'])->name('contact');
Route::get('contact/captcha-image', [ContactCaptchaController::class, 'image'])->name('contact.captcha.image');
Route::get('locations', [WebController::class, 'Locations'])->name('locations');
Route::redirect('iv-therapy-jefferson-valley', '/iv-therapy-jefferson-valley-ny', 301);
Route::redirect('iv-therapy-westchester', '/iv-therapy-westchester-county', 301);
Route::get('locations/{slug}', [WebController::class, 'LocationDetail'])->name('location.detail');

// Blogs
Route::get('blogs', [WebController::class, 'Blogs'])->name('blogs'); 
Route::get('blog-detail/{slug}', [WebController::class, 'BlogDetail'])->name('blog-detail'); 


$servicePageSlugs = ServicePageRegistry::publishedSlugs();
$locationPageSlugs = LocationPageRegistry::publishedSlugs();
$publicSlugs = array_values(array_unique(array_merge($servicePageSlugs, $locationPageSlugs)));

if ($publicSlugs !== []) {
    $publicSlugPattern = ServicePageRegistry::routePattern($publicSlugs);

    if ($servicePageSlugs !== []) {
        Route::get('services/{slug}', fn (string $slug) => redirect('/'.$slug, 301))
            ->where('slug', ServicePageRegistry::routePattern($servicePageSlugs));
    }

    Route::get('{slug}', [WebController::class, 'PublicSlugPage'])
        ->where('slug', $publicSlugPattern)
        ->name('service.detail');
}


// Redirect /login to admin login (session expired or user types /login in URL)
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//ContactUs
Route::resource('contactus', ContactUsController::class);
Route::resource('shopcontact', ShopContactController::class);
Route::group(['middleware' => ['auth']], function () {

    //Roles
    Route::resource('role', 'admin\RoleController');

    //permissions
    Route::resource('permission', 'admin\PermissionController');

    //Setting
    Route::resource('page', 'admin\SettingController');

    //pages settings
    Route::resource('page', 'admin\PageController');
    Route::resource('page_setting', 'admin\PageSettingController');

    //Banner
    Route::resource('banner', BannerController::class);
    
    //Home Slider
    Route::resource('homeslider', HomeSliderController::class);

    //testimonial
    Route::resource('testimonial', TestimonialController::class);

    //Faqs
    Route::resource('faq', 'admin\FaqController');

    //Policies
    Route::resource('policy', 'admin\PoliciesController');

    //Video
    Route::resource('video', VideoController::class);
    
    //Audios
    Route::resource('audio', AudioController::class);
    
    //Services
    Route::resource('service', ServicesController::class);

    //Photo Gallery
    Route::resource('photogallery', PhotoGalleryController::class);
    //Locations
    Route::resource('location', LocationController::class);

    //Service landing pages (NYC + dynamic)
    Route::resource('servicePage', ServicePageController::class);
     
    //Blog Categories
    Route::resource('blogcategory', BlogCategoryController::class);

    //Blog
    Route::resource('blog', BlogController::class);
});
