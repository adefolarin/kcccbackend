<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndApi\BannerController;
use App\Http\Controllers\FrontEndApi\EventController;
use App\Http\Controllers\FrontEndApi\EventRegController;
use App\Http\Controllers\FrontEndApi\DepartmentController;
use App\Http\Controllers\FrontEndApi\DeptMembRegController;
use App\Http\Controllers\FrontEndApi\ContactController;
use App\Http\Controllers\FrontEndApi\PrayerController;
use App\Http\Controllers\FrontEndApi\DeviceTokenController;
use App\Http\Controllers\FrontEndApi\MembRegController;
use App\Http\Controllers\FrontEndApi\FoodBankController;
use App\Http\Controllers\FrontEndApi\GivingCategoryController;
use App\Http\Controllers\FrontEndApi\DonationCategoryController;
use App\Http\Controllers\FrontEndApi\LiveCountDownController;
use App\Http\Controllers\FrontEndApi\ResourceController;
use App\Http\Controllers\FrontEndApi\NewsController;
use App\Http\Controllers\FrontEndApi\SermonController;
use App\Http\Controllers\FrontEndApi\DonationController;
use App\Http\Controllers\FrontEndApi\GivingController;
use App\Http\Controllers\FrontEndApi\NewsLetterController;
use App\Http\Controllers\FrontEndApi\VolunteerController;
use App\Http\Controllers\FrontEndApi\ReviewController;
use App\Http\Controllers\FrontEndApi\PodcastController;
use App\Http\Controllers\FrontEndApi\VolFormController;
use App\Http\Controllers\FrontEndApi\AamUserController;
use App\Http\Controllers\FrontEndApi\StoreUserController;
use App\Http\Controllers\FrontEndApi\RatingController;
use App\Http\Controllers\FrontEndApi\ProductController;
use App\Http\Controllers\FrontEndApi\ProductCategoryController;
use App\Http\Controllers\FrontEndApi\ZipCodeController;
use App\Http\Controllers\FrontEndApi\StoreOrderController;
use App\Http\Controllers\FrontEndApi\StorePaymentController;
use App\Http\Controllers\FrontEndApi\VolCategoryController;
use App\Http\Controllers\FrontEndApi\KcileController;
use App\Http\Controllers\FrontEndApi\VersionController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// BANNERS

Route::get('/banner', [BannerController::class,'index']);

/// EVENTS
Route::get('/event/{id?}', [EventController::class,'index']);
Route::get('/eventall', [EventController::class,'getAllEvent']);
Route::get('/nextevent', [EventController::class,'getNextEvent']);

Route::get('/eventcat', [EventController::class,'getEventCat']);

Route::get('/eventlocation', [EventController::class,'getEventLocation']);
Route::get('/eventpreacher', [EventController::class,'getEventPreacher']);

Route::post('/eventreg', [EventRegController::class,'store']);


// DEPARTMENTS
Route::get('/department/{id?}', [DepartmentController::class,'index']);

Route::get('/departmentall', [DepartmentController::class,'getAllDepartment']);

Route::post('/deptmembreg', [DeptMembRegController::class,'store']);


// CONTACT
Route::get('/contact/{id?}', [ContactController::class,'index']);

Route::post('/contact', [ContactController::class,'store']);

// PRAYER
Route::get('/prayer/{id?}', [PrayerController::class,'index']);

Route::post('/prayer', [PrayerController::class,'store']);

// DEVICE TOKEN
Route::post('/devicetoken', [DeviceTokenController::class,'store']);


// MEMBER REGISTRATION
Route::post('/membreg', [MembRegController::class,'store']);

// FOOD BANK
Route::get('/foodbank/{id?}', [FoodBankController::class,'index']);

// GIVING CATEGORY
Route::get('/givingcategory', [GivingCategoryController::class,'index']);

// DONATION CATEGORY
Route::get('/donationcategory', [DonationCategoryController::class,'index']);

// Volunteer CATEGORY
Route::get('/volcategory', [VolCategoryController::class,'index']);

// LIVE COUNT DOWN
Route::get('/livecountdown', [LiveCountDownController::class,'index']);

// MOBILE LIVE COUNT DOWN
Route::get('/mobilelivecountdown', [LiveCountDownController::class,'mobileindex']);

// VERSION
Route::get('/version', [VersionController::class,'index']);


// RESOURCES
Route::get('/resource', [ResourceController::class,'index']);

// News
Route::get('/news/{id?}', [NewsController::class,'index']);


// Sermons
Route::get('/sermon', [SermonController::class,'index']);

Route::get('/sermonall', [SermonController::class,'getAllSermons']);

Route::post('/sermonquicksearch', [SermonController::class,'sermonQuickSearch']);

Route::post('/sermondeepsearch', [SermonController::class,'sermonSearch']);

Route::post('/sermonlikes', [SermonController::class,'sermonLikes']);

Route::get('/sermontitle', [SermonController::class,'getSermonTitles']);

Route::get('/sermonpreacher', [SermonController::class,'getSermonPreachers']);

// Donations
Route::post('/donation', [DonationController::class,'store']);

// Giving
Route::post('/giving', [GivingController::class,'store']);

// News Letter
Route::post('/newsletter', [NewsLetterController::class,'store']);

// Volunteers
Route::post('/volunteer', [VolunteerController::class,'store']);

// Mobile Volunteers
Route::post('/mobilevolunteer', [VolunteerController::class,'mobilestore']);

// KCILE REG MODULW
Route::post('/mobileregmodule', [KcileController::class,'mobileregmodulestore']);

// KCILE
Route::post('/mobilekcile', [KcileController::class,'mobilestore']);

// Review
Route::post('/reviewsearch', [ReviewController::class,'reviewSearch']);

// Podcasts
Route::get('/podcast', [PodcastController::class,'podcastSearch']);

// volforms
Route::get('/volform', [VolFormController::class,'index']);

// mobilevolforms
Route::get('/mobilevolform/{id?}', [VolFormController::class,'mobileindex']);


//AAM USERS

Route::match(['post'],'/aamregister',[AamUserController::class, 'store']);
Route::match(['post'],'/aamlogin',[AamUserController::class, 'login']);

Route::match(['get'],'/aamusers/{id?}',[AamUserController::class, 'index']);

//Route::group(['middleware'=>['aamuser']], function() {
   
    Route::match(['post'],'/aamupdatepassword', [AamUserController::class,'updatePassword']);
    Route::match(['post'],'/aamupdateemail', [AamUserController::class,'updateEmail']);
    Route::match(['post'],'/aamupdatepnum', [AamUserController::class,'updatePnum']);
    Route::post('/aamcheckcurrentpassword', [AamUserController::class,'checkCurrentPassword']);
    Route::match(['post'],'/aamupdateuser', [AamUserController::class,'updateAamUser']);
    Route::match(['post'],'/passwordcode', [AamUserController::class,'sendPasswordCode']);
    Route::match(['post'],'/resetpassword', [AamUserController::class,'resetPassword']);
    Route::get('/aamlogout', [AamuserController::class,'logout']);

//});

// STORE USERS

Route::match(['post'],'/storeregister',[StoreUserController::class, 'store']);
Route::match(['post'],'/storelogin',[StoreUserController::class, 'login']);

Route::get('/storeuser/{id?}', [StoreUserController::class,'index']);

//Route::group(['middleware'=>['aamuser']], function() {
   
    Route::match(['post'],'/storeupdatepassword', [StoreUserController::class,'updatePassword']);
    Route::post('/storecheckcurrentpassword', [StoreUserController::class,'checkCurrentPassword']);
    Route::post('/updatestoreuser', [StoreUserController::class,'updateStoreUserDetails']);
    Route::get('/storeuser/logout', [StoreUserController::class,'logout']);

    // Ratings
    Route::get('/rating/{id?}', [RatingController::class,'index']);
    Route::post('/rating', [RatingController::class,'store']);

    // Product Category
    Route::get('/productcategory/{id?}', [ProductCategoryController::class,'index']);

    // Product
    Route::get('/product/{id?}', [ProductController::class,'index']);
    Route::get('/productbycat/{id?}', [ProductController::class,'getProductByCat']);
    Route::post('/productlikes', [ProductController::class,'productLikes']);

    // Zip Code
    Route::get('/zipcode', [ZipCodeController::class,'index']);

    // Store Order
    Route::get('/storeorder/{id?}', [StoreOrderController::class,'index']);
    Route::post('/storeorder/{id?}', [StoreOrderController::class,'store']);

     // Store Payment
    Route::get('/storepayment/{id?}', [StorePaymentController::class,'index']);
    Route::post('/storepayment', [StorePaymentController::class,'store']);

//});
