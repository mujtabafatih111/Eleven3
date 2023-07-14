<?php

use App\Http\Controllers\Api\AppointmentController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API as APIControllers;
use App\Http\Controllers\API\UserController as AdminUser;
use App\Http\Controllers\API\ChatController;
use App\Http\Controllers\API\CommonController as Common;
use App\Http\Controllers\API\Auth as AuthApiController;
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

//===========================AUTH CONTROLLER=======================//
Route::post('/register', [AuthApiController\AuthController::class, 'createUser']);
Route::post('/login', [AuthApiController\AuthController::class, 'loginUser']);


Route::post('/store', [APIControllers\StoreContoller::class, 'add']);
Route::get('/delete_new/{id}', [APIControllers\StoreContoller::class, 'delete.new']);
Route::post('/create', [APIControllers\CreateController::class, 'create']);
Route::get('/destroy/{id}', [APIControllers\CreateController::class, 'destroy']);
Route::get('/index', [APIControllers\ShowController::class, 'index']);
Route::get('/create', [APIControllers\ReadController::class, 'create']);
Route::get('/delete/{id}', [APIControllers\DeleteController::class, 'delete']);
Route::post('/createRecord', [APIControllers\FakeController::class, 'create']);

//====================SEARCH CONTROLLER=====================//
Route::get('/holistic-practitioner', [APIControllers\SearchController::class, 'holisticPractitionerSearch']);
Route::get('/categories-list', [APIControllers\SearchController::class, 'categoryList']);
Route::get('/search-practitioner', [APIControllers\SearchController::class, 'searchPractitioner']);


//====================PRACTITIONER CONTROLLER=====================//
Route::get('/all-practitioner', [APIControllers\PractitionerController::class, 'allPractitioner']);


//====================REVIEW CONTROLLER =====  PRACTITIONER REVIEW ROUTES====================//
Route::get('/practitioner-review', [APIControllers\ReviewController::class, 'practitionerReview']);
Route::get('/practitioner-rating', [APIControllers\ReviewController::class, 'practitionerRating']);
Route::get('/practitioner-sub-category-rating', [APIControllers\ReviewController::class, 'practitionerSubCategoryRating']);



//====================CONTACT-US CONTROLLER=====================//
Route::post('/conatc-us-email', [APIControllers\ContactUsController::class, 'contactUs']);


Route::middleware('auth:sanctum')->group(function () {
    //=========== common route api for client , practitioner ========== //
    Route::get('/verify-email/{id}', [AuthApiController\AuthController::class, 'emailVerify']);
    Route::post('/logout', [AuthApiController\AuthController::class, 'logoutUser']);
    Route::post('/update-profile',[Common::class,'updateProfile']);
    Route::post('/update-profile-photo',[Common::class,'updateProfilePhoto']);

    //   only for practitioner api
    Route::middleware('role:practitioner')->prefix('practitioner/')->group(function()
    {
        // ======================Step form of practitioner ===========================//
        Route::post('info',[APIControllers\PractitionerController::class,'storeInfo']);
        Route::post('location',[APIControllers\PractitionerController::class,'storeLocation']);
        Route::post('phoneNumber',[APIControllers\PractitionerController::class,'phoneNumber']);
        Route::post('phoneVerifyCode',[APIControllers\PractitionerController::class,'phoneVerifyCode']);

        // ===============   practitioner appointment route ============//
        Route::controller(AppointmentController::class)->prefix('appointments/')->group(function()
        {
                Route::get('get-by-status','status');
        });
    });

    //====================CATEGORY CONTROLLER=====================//
    Route::resource('categories', APIControllers\CategoryController::class)->except(['show']);

    //====================REVIEW CONTROLLER=====================//
    Route::post('/add-review', [APIControllers\ReviewController::class, 'store']);
    Route::get('/update-review', [APIControllers\ReviewController::class, 'updateReview']);

    //====================REVIEW CONTROLLER =====  Patient REVIEW ROUTES====================//
    Route::get('/patient-review', [APIControllers\ReviewController::class, 'patientReview']);
    Route::get('/patient-rating', [APIControllers\ReviewController::class, 'patientRating']);

    //====================PRACTITIONER CONTROLLER=====================//

    Route::post('/add-practitioner-service', [APIControllers\PractitionerController::class, 'manageProviderService']);
    Route::get('/get-practitioner-service', [APIControllers\PractitionerController::class, 'getService']);
    Route::post('/update-practitioner-service', [APIControllers\PractitionerController::class, 'updateProviderService']);

    Route::post('/add-availability-hours', [APIControllers\PractitionerController::class, 'addAvailabilityHours']);
    Route::post('/update-availability-hours', [APIControllers\PractitionerController::class, 'updateAvailabilityHours']);
    Route::get('/get-working-hours', [APIControllers\PractitionerController::class, 'getWorkingHourData']);
    Route::get('/practitioner-working-hours', [APIControllers\PractitionerController::class, 'practitionerWorkingHours']);

    //====================APPOINTMENT CONTROLLER=====================//
    Route::post('/add-appointment', [APIControllers\AppointmentController::class, 'storeAppointment']);
    Route::post('/cancel-appointment', [APIControllers\AppointmentController::class, 'cancelAppointment']);

    // ============================ Chat Route =================================//
    Route::post('message',[ChatController::class,'chat']);
    Route::get('message',[ChatController::class,'getMessage']);

    // ============================ Testimonial  Route =================================//
    Route::post('add-testimonial',[Common::class,'store']);
    Route::get('get/testimonials',[Common::class,'getTestimonial']);

});


// ===========================Admin =================================//
Route::middleware('auth:sanctum', 'role:super_admin')->prefix('admin/')
    ->group(function () {
        // gneranic route for both patient and practitioner , admin get both patient(all_patient) and practitioner(all_practitioner)
        Route::get('{slug}', [AdminUser::class, 'allUser']);
        Route::get('{slug}/pause', [AdminUser::class, 'userPause']);
    });
