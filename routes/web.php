<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DeptCategoryController;
use App\Http\Controllers\Admin\DeptMembRegController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DeviceTokenController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\EventCategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\EventRegController;
use App\Http\Controllers\Admin\FoodBankCategoryController;
use App\Http\Controllers\Admin\FoodBankController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\LiveCountDownController;
use App\Http\Controllers\Admin\NewsCategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PodcastCategoryController;
use App\Http\Controllers\Admin\PodcastController;
use App\Http\Controllers\Admin\PrayerController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ResourceCategoryController;
use App\Http\Controllers\Admin\SermonCategoryController;
use App\Http\Controllers\Admin\SermonController;
use App\Http\Controllers\Admin\VolCategoryController;
use App\Http\Controllers\Admin\VolFormController;
use App\Http\Controllers\Admin\VolunteerController;
use App\Http\Controllers\Admin\DonationCategoryController;
use App\Http\Controllers\Admin\GivingCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ZipCodeController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Admin\DepartmentGalleryController;
use App\Http\Controllers\Admin\EventGalleryController;
use App\Http\Controllers\Admin\FoodBankGalleryController;
use App\Http\Controllers\Admin\MembRegController;
use App\Http\Controllers\Admin\GivingController;
use App\Http\Controllers\Admin\DeptGalleryController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\DelAccController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('notfound');
});

//Route::prefix('/admin')->group(function(){
    Route::match(['get','post'],'/admin/login',[AdminController::class, 'login']);

    Route::group(['middleware'=>['admin']], function() {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
        Route::match(['get','post'],'/admin/update-password', [AdminController::class,'updatePassword']);
        Route::post('/admin/check-current-password', [AdminController::class,'checkCurrentPassword']);
        Route::match(['get','post'],'/admin/update-admin-details', [AdminController::class,'updateAdminDetails']);
        Route::get('/admin/logout', [AdminController::class,'logout']);

        // Display CMS Pages ( CRUD - READ)
        /*Route::get('/admin/cms-pages', [CmsController::class,'index']);
        Route::post('/admin/update-cms-page-status', [CmsController::class,'updatePageStatus']);
        Route::match(['get','post'],'/admin/add-edit-cms-page/{id?}', [CmsController::class,'edit']);
        Route::match(['get'],'/admin/delete-cms-page/{id?}', [CmsController::class,'destroy']);*/

        // Banner
        Route::get('/admin/banner', [BannerController::class,'index']);
        Route::get('/admin/banner-add', [BannerController::class,'create']);
        Route::post('/admin/banner-add', [BannerController::class,'store']);
        Route::get('/admin/banner-edit/{id?}', [BannerController::class,'edit']);
        Route::post('/admin/banner-edit/{id?}', [BannerController::class,'update']);
        Route::post('/admin/banner-file-edit/{id?}', [BannerController::class,'updateBannerFile']);
        Route::get('/admin/delete-banner/{id?}', [BannerController::class,'destroy']);

        // Event Categories
        Route::get('/admin/eventcategory/{id?}', [EventCategoryController::class,'index']);
        //Route::get('/admin/eventcategory-add', [EventCategoryController::class,'create']);
        Route::post('/admin/eventcategory', [EventCategoryController::class,'store']);
        //Route::get('/admin/eventcategory/{id?}', [EventCategoryController::class,'edit']);
        Route::post('/admin/eventcategory/{id?}', [EventCategoryController::class,'update']);
        Route::get('/admin/delete-eventcategory/{id?}', [EventCategoryController::class,'destroy']);

        // Sermon Categories
        Route::get('/admin/sermoncategory/{id?}', [SermonCategoryController::class,'index']);
        //Route::get('/admin/sermoncategory-add', [SermonCategoryController::class,'create']);
        Route::post('/admin/sermoncategory', [SermonCategoryController::class,'store']);
        //Route::get('/admin/sermoncategory-edit/{id?}', [SermonCategoryController::class,'edit']);
        Route::post('/admin/sermoncategory/{id?}', [SermonCategoryController::class,'update']);
        Route::get('/admin/delete-sermoncategory/{id?}', [SermonCategoryController::class,'destroy']);


        // Podscast Categories
        Route::get('/admin/podcastcategory/{id?}', [PodcastCategoryController::class,'index']);
        //Route::get('/admin/podcastcategory-add', [PodcastCategoryController::class,'create']);
        Route::post('/admin/podcastcategory', [PodcastCategoryController::class,'store']);
        //Route::get('/admin/podcastcategory-edit/{id?}', [PodcastCategoryController::class,'edit']);
        Route::post('/admin/podcastcategory/{id?}', [PodcastCategoryController::class,'update']);
        Route::get('/admin/delete-podcastcategory/{id?}', [PodcastCategoryController::class,'destroy']);

        // News Categories
        Route::get('/admin/newscategory/{id?}', [NewsCategoryController::class,'index']);
        //Route::get('/admin/newscategory-add', [NewsCategoryController::class,'create']);
        Route::post('/admin/newscategory', [NewsCategoryController::class,'store']);
        //Route::get('/admin/newscategory-edit/{id?}', [NewsCategoryController::class,'edit']);
        Route::post('/admin/newscategory/{id?}', [NewsCategoryController::class,'update']);
        Route::get('/admin/delete-newscategory/{id?}', [NewsCategoryController::class,'destroy']);


        // Gallery Categories
        Route::get('/admin/gallerycategory/{id?}', [GalleryCategoryController::class,'index']);
        //Route::get('/admin/gallerycategory-add', [GalleryCategoryController::class,'create']);
        Route::post('/admin/gallerycategory', [GalleryCategoryController::class,'store']);
        //Route::get('/admin/gallerycategory-edit/{id?}', [GalleryCategoryController::class,'edit']);
        Route::post('/admin/gallerycategory/{id?}', [GalleryCategoryController::class,'update']);
        Route::get('/admin/delete-gallerycategory/{id?}', [GalleryCategoryController::class,'destroy']);

        // Volunteer Form Categories
        Route::get('/admin/volcategory/{id?}', [VolCategoryController::class,'index']);
        //Route::get('/admin/volcategory-add', [VolCategoryController::class,'create']);
        Route::post('/admin/volcategory', [VolCategoryController::class,'store']);
        //Route::get('/admin/volcategory-edit/{id?}', [VolCategoryController::class,'edit']);
        Route::post('/admin/volcategory/{id?}', [VolCategoryController::class,'update']);
        Route::get('/admin/delete-volcategory/{id?}', [VolCategoryController::class,'destroy']);



        // FoodBank Categories
        Route::get('/admin/foodbankcategory/{id?}', [FoodBankCategoryController::class,'index']);
        //Route::get('/admin/foodbankcategory-add', [FoodBankCategoryController::class,'create']);
        Route::post('/admin/foodbankcategory', [FoodBankCategoryController::class,'store']);
        //Route::get('/admin/foodbankcategory-edit/{id?}', [FoodBankCategoryController::class,'edit']);
        Route::post('/admin/foodbankcategory/{id?}', [FoodBankCategoryController::class,'update']);
        Route::get('/admin/delete-foodbankcategory/{id?}', [FoodBankCategoryController::class,'destroy']);


        // Department Categories
        Route::get('/admin/deptcategory/{id?}', [DeptCategoryController::class,'index']);
        //Route::get('/admin/deptcategory-add', [DeptCategoryController::class,'create']);
        Route::post('/admin/deptcategory', [DeptCategoryController::class,'store']);
        //Route::get('/admin/deptcategory-edit/{id?}', [DeptCategoryController::class,'edit']);
        Route::post('/admin/deptcategory/{id?}', [DeptCategoryController::class,'update']);
        Route::get('/admin/delete-deptcategory/{id?}', [DeptCategoryController::class,'destroy']);

        // Resources Categories
        Route::get('/admin/resourcecategory/{id?}', [ResourceCategoryController::class,'index']);
        //Route::get('/admin/resourcecategory-add', [ResourceCategoryController::class,'create']);
        Route::post('/admin/resourcecategory', [ResourceCategoryController::class,'store']);
        //Route::get('/admin/resourcecategory-edit/{id?}', [ResourceCategoryController::class,'edit']);
        Route::post('/admin/resourcecategory/{id?}', [ResourceCategoryController::class,'update']);
        Route::get('/admin/delete-resourcecategory/{id?}', [ResourceCategoryController::class,'destroy']);

        // Product Categories
        Route::get('/admin/productcategory/{id?}', [ProductCategoryController::class,'index']);
        //Route::get('/admin/productcategory-add', [ProductCategoryController::class,'create']);
        Route::post('/admin/productcategory', [ProductCategoryController::class,'store']);
        //Route::get('/admin/productcategory-edit/{id?}', [ProductCategoryController::class,'edit']);
        Route::post('/admin/productcategory/{id?}', [ProductCategoryController::class,'update']);
        Route::get('/admin/delete-productcategory/{id?}', [ProductCategoryController::class,'destroy']);


        // Donation Categories
        Route::get('/admin/donationcategory/{id?}', [DonationCategoryController::class,'index']);
        //Route::get('/admin/donationcategory-add', [DonationCategoryController::class,'create']);
        Route::post('/admin/donationcategory', [DonationCategoryController::class,'store']);
        //Route::get('/admin/donationcategorycategory-edit/{id?}', [DonationCategoryController::class,'edit']);
        Route::post('/admin/donationcategory/{id?}', [DonationCategoryController::class,'update']);
        Route::get('/admin/delete-donationcategory/{id?}', [DonationCategoryController::class,'destroy']);

        // Giving Categories
        Route::get('/admin/givingcategory/{id?}', [GivingCategoryController::class,'index']);
        //Route::get('/admin/givingccategory-add', [GivingCategoryController::class,'create']);
        Route::post('/admin/givingcategory', [GivingCategoryController::class,'store']);
        //Route::get('/admin/givingccategorycategory-edit/{id?}', [GivingCategoryController::class,'edit']);
        Route::post('/admin/givingcategory/{id?}', [GivingCategoryController::class,'update']);
        Route::get('/admin/delete-givingcategory/{id?}', [GivingCategoryController::class,'destroy']);

        // Events
        Route::get('/admin/event/{id?}', [EventController::class,'index']);
        //Route::get('/admin/event-add', [EventController::class,'create']);
        Route::post('/admin/event', [EventController::class,'store']);
        //Route::get('/admin/event-edit/{id?}', [EventController::class,'edit']);
        Route::post('/admin/event/{id?}', [EventController::class,'update']);
        Route::post('/admin/event-file-edit/{id?}', [EventController::class,'updateEventFile']);
        Route::get('/admin/delete-event/{id?}', [EventController::class,'destroy']);

         // Event Gallery
         Route::get('/admin/eventgallery/{id?}/{idd?}', [EventGalleryController::class,'index']);
         //Route::get('/admin/eventgallery-add{id?}', [EventGalleryController::class,'create']);
         Route::post('/admin/eventgallery/{id?}', [EventGalleryController::class,'store']);
         //Route::get('/admin/eventgallery-edit/{id?}/{idd?}', [EventController::class,'edit']);
         Route::post('/admin/eventgallery/{id?}/{idd?}', [EventGalleryController::class,'update']);
         Route::get('/admin/delete-eventgallery/{id?}/{idd?}', [EventGalleryController::class,'destroy']);

        // Department Gallery
        Route::get('/admin/departmentgallery/{id?}/{idd?}', [DeptGalleryController::class,'index']);
        //Route::get('/admin/departmentgallery-add{id?}', [DeptmentGalleryController::class,'create']);
        Route::post('/admin/departmentgallery/{id?}', [DeptGalleryController::class,'store']);
        //Route::get('/admin/departmentgallery-edit/{id?}/{idd?}', [DeptmentGalleryController::class,'edit']);
        Route::post('/admin/departmentgallery/{id?}/{idd?}', [DeptGalleryController::class,'update']);
        Route::get('/admin/delete-departmentgallery/{id?}/{idd?}', [DeptGalleryController::class,'destroy']);

        // FoodBank Gallery
        Route::get('/admin/foodbankgallery/{id?}/{idd?}', [FoodBankGalleryController::class,'index']);
        //Route::get('/admin/foodbankgallery-add{id?}', [FoodBankGalleryController::class,'create']);
        Route::post('/admin/foodbankgallery/{id?}', [FoodBankGalleryController::class,'store']);
        //Route::get('/admin/foodbankgallery-edit/{id?}/{idd?}', [FoodBankGalleryController::class,'edit']);
        Route::post('/admin/foodbankgallery/{id?}/{idd?}', [FoodBankGalleryController::class,'update']);
        Route::get('/admin/delete-foodbankgallery/{id?}/{idd?}', [FoodBankGalleryController::class,'destroy']);


        // Sermons
        Route::get('/admin/sermon/{id?}', [SermonController::class,'index']);
        //Route::get('/admin/sermon-add', [SermonController::class,'create']);
        Route::post('/admin/sermon', [SermonController::class,'store']);
        //Route::get('/admin/sermon-edit/{id?}', [SermonController::class,'edit']);
        Route::post('/admin/sermon/{id?}', [SermonController::class,'update']);
        //Route::post('/admin/sermon/{id?}', [SermonController::class,'updateSermonFile']);
        Route::get('/admin/delete-sermon/{id?}', [SermonController::class,'destroy']);


        // Podcasts
        Route::get('/admin/podcast/{id?}', [PodcastController::class,'index']);
        //Route::get('/admin/podcast-add', [PodcastController::class,'create']);
        Route::post('/admin/podcast', [PodcastController::class,'store']);
        //Route::get('/admin/podcast-edit/{id?}', [PodcastController::class,'edit']);
        Route::post('/admin/podcast', [PodcastController::class,'update']);
        Route::post('/admin/podcast/{id?}', [PodcastController::class,'updatePodcastFile']);
        Route::get('/admin/delete-podcast/{id?}', [PodcastController::class,'destroy']);



        // Department
       // Route::get('/admin/dept{id?}', [DepartmentController::class,'index']);
        //Route::get('/admin/dept-add', [DepartmentController::class,'create']);
       // Route::post('/admin/dept', [DepartmentController::class,'store']);
        //Route::get('/admin/dept-edit/{id?}', [DepartmentController::class,'edit']);
       // Route::post('/admin/dept/{id?}', [DepartmentController::class,'update']);
        //Route::post('/admin/dept/{id?}', [DepartmentController::class,'updateDeptFile']);
        //Route::get('/admin/delete-dept/{id?}', [DepartmentController::class,'destroy']);  


        // Department Member Registration
        Route::get('/admin/deptmembreg/{id?}', [DeptMembRegController::class,'index']);
        //Route::get('/admin/deptmembreg-add', [DeptMembRegController::class,'create']);
        //Route::post('/admin/deptmembreg-add', [DeptMembRegController::class,'store']);
        //Route::get('/admin/deptmembreg-edit/{id?}', [DeptMembRegController::class,'edit']);
        //Route::post('/admin/deptmembreg-edit/{id?}', [DeptMembRegController::class,'update']);
        //Route::post('/admin/deptmembreg-file-edit/{id?}', [DeptMembRegController::class,'updateDeptMembFile']);
        Route::get('/admin/delete-deptmembreg/{id?}/{idd?}', [DeptMembRegController::class,'destroy']);


        // Member Registration
        Route::get('/admin/membreg', [MembRegController::class,'index']);
        //Route::get('/admin/membreg-add', [MembRegController::class,'create']);
        //Route::post('/admin/membreg-add', [MembRegController::class,'store']);
        //Route::get('/admin/membreg-edit/{id?}', [MembRegController::class,'edit']);
        //Route::post('/admin/membreg-edit/{id?}', [MembRegController::class,'update']);
        //Route::post('/admin/membreg-file-edit/{id?}', [MembRegController::class,'updateDeptMembFile']);
        Route::get('/admin/delete-membreg/{id?}', [MembRegController::class,'destroy']);

        // Volunteer Registration
        Route::get('/admin/volunteer', [VolunteerController::class,'index']);
        //Route::get('/admin/volunteer-add', [VolunteerController::class,'create']);
        //Route::post('/admin/volunteer-add', [VolunteerController::class,'store']);
        //Route::get('/admin/volunteer-edit/{id?}', [VolunteerController::class,'edit']);
        //Route::post('/admin/volunteer-edit/{id?}', [VolunteerController::class,'update']);
        //Route::post('/admin/volunteer-file-edit/{id?}', [VolunteerController::class,'updateDeptMembFile']);
        Route::get('/admin/delete-volunteer/{id?}', [VolunteerController::class,'destroy']);

    

        // Giving
        Route::get('/admin/giving', [GivingController::class,'index']);
        Route::get('/admin/delete-giving/{id?}', [GivingController::class,'destroy']);


        // Device Token Registration
        Route::get('/admin/devicetoken', [DeviceTokenController::class,'index']);
        //Route::get('/admin/devicetoken-add', [DeviceTokenController::class,'create']);
        //Route::post('/admin/devicetoken-add', [DeviceTokenController::class,'store']);
        //Route::get('/admin/devicetoken-edit/{id?}', [DeviceTokenController::class,'edit']);
        //Route::post('/admin/devicetoken-edit/{id?}', [DeviceTokenController::class,'update']);
        Route::get('/admin/delete-devicetoken/{id?}', [DeviceTokenController::class,'destroy']);


        // Donation
        Route::get('/admin/donation', [DonationController::class,'index']);
       // Route::get('/admin/donation-add', [DonationController::class,'create']);
        //Route::post('/admin/donation-add', [DonationController::class,'store']);
        //Route::get('/admin/donation-edit/{id?}', [DonationController::class,'edit']);
        //Route::post('/admin/donation-edit/{id?}', [DonationController::class,'update']);
        Route::get('/admin/delete-donation/{id?}', [DonationController::class,'destroy']);



        // Event Member Reg
        Route::get('/admin/eventreg/{id?}', [EventRegController::class,'index']);
        //Route::get('/admin/eventreg-add', [EventRegController::class,'create']);
        //Route::post('/admin/eventreg-add', [EventRegController::class,'store']);
        //Route::get('/admin/eventreg-edit/{id?}', [EventRegController::class,'edit']);
        //Route::post('/admin/eventreg-edit/{id?}', [EventRegController::class,'update']);
        Route::get('/admin/delete-eventreg/{id?}/{idd?}', [EventRegController::class,'destroy']);


        // Food Bank
        Route::get('/admin/foodbank/{id?}', [FoodBankController::class,'index']);
        Route::get('/admin/foodbank', [FoodBankController::class,'store']);
        //Route::get('/admin/foodbank-add', [FoodBankController::class,'create']);
        Route::post('/admin/foodbank/{id?}', [FoodBankController::class,'update']);
        //Route::get('/admin/foodbank-edit/{id?}', [FoodBankController::class,'edit']);
        //Route::post('/admin/foodbank-edit/{id?}', [FoodBankController::class,'update']);
        Route::get('/admin/delete-foodbank/{id?}', [FoodBankController::class,'destroy']);


        // Galleries
        Route::get('/admin/gallery/{id?}', [GalleryController::class,'index']);
        //Route::get('/admin/gallery-add', [GalleryController::class,'create']);
        Route::post('/admin/gallery', [GalleryController::class,'store']);
        //Route::get('/admin/gallery-edit/{id?}', [GalleryController::class,'edit']);
        Route::post('/admin/gallery/{id?}', [GalleryController::class,'update']);
        //Route::post('/admin/gallery/{id?}', [GalleryController::class,'updateGalleryFile']);
        Route::get('/admin/delete-gallery/{id?}', [GalleryController::class,'destroy']);



        // Live CountDown
        Route::get('/admin/livecountdown/{id?}', [LiveCountDownController::class,'index']);
        //Route::get('/admin/livecountdown-add', [LiveCountDownController::class,'create']);
        Route::post('/admin/livecountdown', [LiveCountDownController::class,'store']);
        //Route::get('/admin/livecountdown-edit/{id?}', [LiveCountDownController::class,'edit']);
        Route::post('/admin/livecountdown/{id?}', [LiveCountDownController::class,'update']);
        Route::get('/admin/delete-livecountdown/{id?}', [LiveCountDownController::class,'destroy']);


        // News
        Route::get('/admin/news/{id?}', [NewsController::class,'index']);
        //Route::get('/admin/news-add', [NewsController::class,'create']);
        Route::post('/admin/news', [NewsController::class,'store']);
        //Route::get('/admin/news-edit/{id?}', [NewsController::class,'edit']);
        Route::post('/admin/news/{id?}', [NewsController::class,'update']);
        //Route::post('/admin/news/{id?}', [NewsController::class,'updateNewsFile']);
        Route::get('/admin/delete-news/{id?}', [NewsController::class,'destroy']);


        // Prayer
        Route::get('/admin/prayer', [PrayerController::class,'index']);
        //Route::get('/admin/prayer-add', [PrayerController::class,'create']);
        //Route::post('/admin/prayer-add', [PrayerController::class,'store']);
        //Route::get('/admin/prayer-edit/{id?}', [PrayerController::class,'edit']);
        //Route::post('/admin/prayer-edit/{id?}', [PrayerController::class,'update']);
        Route::get('/admin/delete-prayer/{id?}', [PrayerController::class,'destroy']);


        // Volunteer Forms
        Route::get('/admin/volform/{id?}/{idd?}', [VolFormController::class,'index']);
        //Route::get('/admin/volform-add', [VolFormController::class,'create']);
        Route::post('/admin/volform/{id?}', [VolFormController::class,'store']);
        //Route::get('/admin/volform-edit/{id?}', [VolFormController::class,'edit']);
        Route::post('/admin/volform/{id?}/{idd?}', [VolFormController::class,'update']);
        Route::get('/admin/delete-volform/{id?}/{idd?}', [VolFormController::class,'destroy']);



        // Volunteers
        Route::get('/admin/vol', [VolunteerController::class,'index']);
        //Route::get('/admin/vol-add', [VolunteerController::class,'create']);
        //Route::post('/admin/vol-add', [VolunteerController::class,'store']);
        //Route::get('/admin/vol-edit/{id?}', [VolunteerController::class,'edit']);
        //Route::post('/admin/vol-edit/{id?}', [VolunteerController::class,'update']);
        Route::get('/admin/delete-vol/{id?}', [VolunteerController::class,'destroy']);


        // Product
        Route::get('/admin/product/{id?}', [ProductController::class,'index']);
        //Route::get('/admin/product-add', [ProductController::class,'create']);
        Route::post('/admin/product', [ProductController::class,'store']);
        //Route::get('/admin/event-edit/{id?}', [ProductController::class,'edit']);
        Route::post('/admin/product/{id?}', [ProductController::class,'update']);
        Route::post('/admin/product-file-edit/{id?}', [ProductController::class,'updateEventFile']);
        Route::get('/admin/delete-product/{id?}', [ProductController::class,'destroy']);

        // Zip Code
        Route::get('/admin/zipcode/{id?}', [ZipCodeController::class,'index']);
        //Route::get('/admin/zipcode-add', [ZipCodeController::class,'create']);
        Route::post('/admin/zipcode', [ZipCodeController::class,'store']);
        //Route::get('/admin/zipcode-edit/{id?}', [ZipCodeController::class,'edit']);
        Route::post('/admin/zipcode/{id?}', [ZipCodeController::class,'update']);
        Route::post('/admin/zipcode-file-edit/{id?}', [ZipCodeController::class,'updateEventFile']);
        Route::get('/admin/delete-zipcode/{id?}', [ZipCodeController::class,'destroy']);

        // Resources
        Route::get('/admin/resource/{id?}', [ResourceController::class,'index']);
        //Route::get('/admin/resource-add', [ResourceController::class,'create']);
        Route::post('/admin/resource', [ResourceController::class,'store']);
        //Route::get('/admin/resourcecategory-edit/{id?}', [ResourceController::class,'edit']);
        Route::post('/admin/resource/{id?}', [ResourceController::class,'update']);
        Route::get('/admin/delete-resource/{id?}', [ResourceController::class,'destroy']);

        // Department
        Route::get('/admin/department/{id?}', [DepartmentController::class,'index']);
        //Route::get('/admin/department-add{id?}', [DepartmentController::class,'create']);
        Route::post('/admin/department', [DepartmentController::class,'store']);
        //Route::get('/admin/department-edit/{id?}/{idd?}', [DepartmentController::class,'edit']);
        Route::post('/admin/department/{id?}', [DepartmentController::class,'update']);
        Route::post('/admin/department-file-edit/{id?}', [DepartmentController::class,'updateDepartmentFile']);
        Route::get('/admin/delete-department/{id?}', [DepartmentController::class,'destroy']);

        // Review
        Route::get('/admin/review/{id?}', [ReviewController::class,'index']);
        Route::post('/admin/review', [ReviewController::class,'store']);
        Route::post('/admin/review/{id?}', [ReviewController::class,'update']);
        Route::get('/admin/delete-review/{id?}', [ReviewController::class,'destroy']);
        
     
    });

    Route::get('/mobiledonation', [DonationController::class,'mobileindex']);
    Route::post('/donation-paypal', [DonationController::class,'paypal']);
    Route::get('/donation-success', [DonationController::class,'success'])->name('donation-success');
    Route::get('/donation-cancel', [DonationController::class,'cancel'])->name('donation-cancel');

    Route::get('/delacc', [DelAccController::class,'mobileindex']);
    Route::post('/delacc', [DelAccController::class,'store']);

//});
