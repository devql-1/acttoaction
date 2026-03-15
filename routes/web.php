<?php

use App\Http\Controllers\admin\AboutCategoryController;
use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AdminProfileController;
use App\Http\Controllers\admin\BlogCategoryController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\ContactInfoController;
use App\Http\Controllers\admin\EnquiryController;
use App\Http\Controllers\admin\IndustryController;
use App\Http\Controllers\admin\IndustryFaqController;
use App\Http\Controllers\admin\IndustryFeatureController;
use App\Http\Controllers\admin\IndustryServiceController;
use App\Http\Controllers\admin\ServiceBenefitController;
use App\Http\Controllers\admin\ServiceCategoryController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\ServiceEssentialController;
use App\Http\Controllers\admin\ServiceFaqController;
use App\Http\Controllers\admin\ServiceFeatureController;
use App\Http\Controllers\admin\ServiceSubCategoryController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\TeamMemberController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\VideoGalleryController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\BecomePartnerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FranchiseController;
use App\Http\Controllers\FrontendContactusController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\oldHomeController;
use App\Http\Controllers\IconController;
use App\Http\Controllers\LoginController;
use App\Models\BecomePartner;
use App\Models\ServiceSubcategory;
use Illuminate\Support\Facades\Route;
use PHPUnit\Architecture\Services\ServiceContainer;
use App\Http\Controllers\admin\YoutubeVideoController;
use App\Http\Controllers\admin\YoutubeCategoryController;
use App\Http\Controllers\frontend\indexController;
use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\StateController;
use App\Http\Controllers\admin\CenterController;
use App\Http\Controllers\admin\EventController;
use App\Http\Controllers\admin\SubEventController;
use App\Http\Controllers\admin\CourseCategoryController;
use App\Http\Controllers\Admin\QuizTestController;
use App\Http\Controllers\Admin\QuizCategoryController;
use App\Http\Controllers\Admin\QuizQuestionController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\TestGraphConfigController;
use App\Http\Controllers\Admin\TestResultRangeController;
use App\Http\Controllers\Admin\BlogAuthorController;
use App\Http\Controllers\Admin\VolunteerController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/admission-form', function () {
//     return view('frontend.admission');
// });

Route::post('/admin/volunteer-submit', [VolunteerController::class, 'store'])->name('volunteer.store');
Route::get('/blog', [HomeController::class, 'index'])->name('frontend.blog.index');
Route::get('/blog/category/{slug}', [HomeController::class, 'blog_category'])->name('frontend.blog.category');
Route::get('/blog/{slug}', [HomeController::class, 'blog_details'])->name('frontend.blog.details');

Route::get('/enrollment/{id}', [EnrollmentController::class, 'enroll'])->name('enrollment.enroll');
Route::post('/enrollment/store', [EnrollmentController::class, 'store'])->name('enrollment.store');
Route::post('/verify-payment', [EnrollmentController::class, 'verifyPayment']);
// routes/web.php
Route::post('/test/{id}/submit', [HomeController::class, 'submit'])->name('test.submit');
Route::get('/test/{id}/result', [HomeController::class, 'result'])->name('test.result');
// frontend routes

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/aboutus', [HomeController::class, 'about'])->name('aboutus');
Route::get('/volunteer', [HomeController::class, 'volunteer'])->name('volunteer');
Route::get('/course', [HomeController::class, 'course'])->name('index.course');
Route::get('/cat_course/{id}', [HomeController::class, 'cat_course'])->name('course.show');
Route::get('/course/{id}', [HomeController::class, 'course_details'])->name('course.details');

Route::get('/event', [HomeController::class, 'event'])->name('event');
Route::get('/events/{id}', [HomeController::class, 'subevent'])->name('frontend.events.subevent');
Route::get('/tests', [HomeController::class, 'quicktest'])->name('frontend.tests');
Route::get('/tests/{id}', [HomeController::class, 'quicktestshow'])->name('frontend.tests.show');

// routes/web.php

Route::get('/tests/{id}', [HomeController::class, 'show'])->name('frontend.tests.show');
Route::get('/take-test/{id}', [HomeController::class, 'take'])->name('quicktest.take');

// Quiz-taking page (all questions with scale)

//ENROLLMENT FORM
// routes/web.php

// Public

// Admin (wrap in auth + admin middleware as needed)
Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
        Route::get('/enrollments/{id}', [EnrollmentController::class, 'show'])->name('enrollments.show');
        Route::patch('/enrollments/{id}/status', [EnrollmentController::class, 'updateStatus'])->name('enrollments.updateStatus');
        Route::delete('/enrollments/{id}', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');
    });

Route::get('/servicedetails/{slug}', [HomeController::class, 'servicedetails'])->name('servicedetails');
Route::get('/service', [HomeController::class, 'service'])->name('service');
Route::get('/project', [HomeController::class, 'project'])->name('project');
Route::get('/projectdetails', [HomeController::class, 'projectdetails'])->name('projectdetails');
Route::get('blog', [HomeController::class, 'blog'])->name('blog');
Route::get('blogs/filter/{id}', [HomeController::class, 'blog_filter'])->name('home.blogs_filter');
Route::get('blogs/search', [HomeController::class, 'blog_search'])->name('home.blogs_search');
Route::get('/blogdetails/{slug}', [HomeController::class, 'blogdetails'])->name('blogdetails');

Route::get('/team', [HomeController::class, 'team'])->name('team');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/contactus', [HomeController::class, 'contactus'])->name('contactus');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::post('/contactus/listing', [FrontendContactusController::class, 'contactus_store'])->name('home.contactus.store');

// for the user
Route::group(['prefix' => 'account'], function () {
    // Guest middleware for user
    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', [LoginController::class, 'index'])->name('account.login');
        Route::get('register', [LoginController::class, 'register'])->name('account.register');
        Route::post('authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
        Route::post('process-register', [LoginController::class, 'process_register'])->name('account.processRegister');
    });

    // Authenticated middleware for user
    Route::group(['middleware' => 'auth'], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('account.dashboard');
        Route::get('logout', [LoginController::class, 'logout'])->name('account.logout');
    });
});

// for the admin
Route::group(['prefix' => 'admin'], function () {
    // Guest middleware for user
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    // Authenticated middleware for admin
    Route::group(['middleware' => 'admin.auth'], function () {
        // Route::get('dashboard',[AdminDashboardController::class,'index'])->name('admin.dashboard');
        Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        Route::get('settings', [SettingController::class, 'index'])->name('admin.settings.index');
        Route::post('settings', [SettingController::class, 'update'])->name('admin.settings.update');

        // Enquiry Routes from websites
        Route::get('/enquiries', [EnquiryController::class, 'index'])->name('admin.enquiries');
        Route::get('/enquiries/count', [EnquiryController::class, 'enquiryCount'])->name('admin.enquiries.count');
        Route::post('/enquiries/mark-read', [EnquiryController::class, 'markAllRead']);
        Route::get('/enquiries/latest', [EnquiryController::class, 'latest']);
        Route::get('/enquiry-destroy/{id}', [EnquiryController::class, 'destroy'])->name('admin.enquiries-destroy');

        // Admin Contact Info Routes
        Route::get('/contact-info', [ContactInfoController::class, 'edit'])->name('admin.contact-info.edit');
        Route::post('/contact-info', [ContactInfoController::class, 'update'])->name('admin.contact-info.update');

        // Admin Routes
        Route::get('/', [AdminController::class, 'index'])->name('admin');

        // Admin Profile Routes
        Route::get('profile', [AdminProfileController::class, 'profile'])->name('admin.profile');
        Route::post('profile/update', [AdminProfileController::class, 'profile_update'])->name('admin.profile.update');

        // Admin Slider Routes
        Route::get('slider', [SliderController::class, 'index'])->name('admin.slider');
        Route::post('slider-add', [SliderController::class, 'store'])->name('admin.slider-store');
        Route::post('slider-edit', [SliderController::class, 'update'])->name('admin.slider-update');
        Route::get('slider-destroy/{id}', [SliderController::class, 'destroy'])->name('admin.slider-destroy');
        Route::post('slider/toggle-status', [SliderController::class, 'slider_toggleStatus'])->name('admin.slider-status');

        // Admin About Routes
        Route::get('about-us', [AboutController::class, 'index'])->name('admin.about');
        Route::get('about/create', [AboutController::class, 'create'])->name('admin.about-create');
        Route::get('about/{id}/edit', [AboutController::class, 'edit'])->name('admin.about-edit');
        Route::post('about/store', [AboutController::class, 'store'])->name('admin.about-store');
        Route::post('about/{id}/update', [AboutController::class, 'update'])->name('admin.about-update');
        Route::get('about/{id}/destroy', [AboutController::class, 'destroy'])->name('admin.about-destroy');
        Route::post('about/toggle-status', [AboutController::class, 'about_toggleStatus'])->name('admin.about-status');

        //Admin About Category Routes
        Route::get('about-category', [AboutCategoryController::class, 'index'])->name('admin.about-category');
        Route::post('about-category/store', [AboutCategoryController::class, 'store'])->name('admin.about-category-store');
        Route::get('about-category/{id}/edit', [AboutCategoryController::class, 'edit'])->name('admin.about-category-edit');
        Route::post('about-category/{id}/update', [AboutCategoryController::class, 'update'])->name('admin.about-category-update');
        Route::get('about-category/{id}/destroy', [AboutCategoryController::class, 'destroy'])->name('admin.about-category-destroy');
        Route::post('about-category/toggle-status', [AboutCategoryController::class, 'aboutCategory_toggleStatus'])->name('admin.about-category-status');

        // Admin Service Routes
        Route::get('service', [ServiceController::class, 'index'])->name('admin.service');
        Route::get('service/subcategories', [ServiceController::class, 'serviceSubcategories'])->name('admin.getservice-subcategories');
        Route::get('service/create', [ServiceController::class, 'create'])->name('admin.service-create');
        Route::get('service/{id}/edit', [ServiceController::class, 'edit'])->name('admin.service-edit');
        Route::post('service/store', [ServiceController::class, 'store'])->name('admin.service-store');
        Route::post('service/{id}/update', [ServiceController::class, 'update'])->name('admin.service-update');
        Route::get('service/{id}/destroy', [ServiceController::class, 'destroy'])->name('admin.service-destroy');
        Route::post('service/toggle-status', [ServiceController::class, 'service_toggleStatus'])->name('admin.service-status');

        // Admin Service Category Routes
        Route::get('service-category', [ServiceCategoryController::class, 'index'])->name('admin.service-category');
        Route::post('service-category/store', [ServiceCategoryController::class, 'store'])->name('admin.service-category-store');
        Route::get('service-category/{id}/edit', [ServiceCategoryController::class, 'edit'])->name('admin.service-category-edit');
        Route::post('service-category/{id}/update', [ServiceCategoryController::class, 'update'])->name('admin.service-category-update');
        Route::get('service-category/{id}/destroy', [ServiceCategoryController::class, 'destroy'])->name('admin.service-category-destroy');
        Route::post('service-category/toggle-status', [ServiceCategoryController::class, 'serviceCategory_toggleStatus'])->name('admin.service-category-status');

        // Admin Service Sub Category Routes
        Route::get('service-subcategory', [ServiceSubCategoryController::class, 'index'])->name('admin.service-subcategory');
        Route::post('service-subcategory/store', [ServiceSubCategoryController::class, 'store'])->name('admin.service-subcategory-store');
        Route::get('service-subcategory/{id}/edit', [ServiceSubCategoryController::class, 'edit'])->name('admin.service-subcategory-edit');
        Route::post('service-subcategory/{id}/update', [ServiceSubCategoryController::class, 'update'])->name('admin.service-subcategory-update');
        Route::get('service-subcategory/{id}/destroy', [ServiceSubCategoryController::class, 'destroy'])->name('admin.service-subcategory-destroy');
        Route::post('service-subcategory/toggle-status', [ServiceSubCategoryController::class, 'serviceSubCategory_toggleStatus'])->name('admin.service-subcategory-status');

        // Admin Service Faq Routes
        Route::get('service/faq', [ServiceFaqController::class, 'index'])->name('admin.service-faq');
        Route::get('service-faq/create', [ServiceFaqController::class, 'create'])->name('admin.service-faq-create');
        Route::post('service-faq/store', [ServiceFaqController::class, 'store'])->name('admin.service-faq-store');
        Route::get('service-faq/{id}/edit', [ServiceFaqController::class, 'edit'])->name('admin.service-faq-edit');
        Route::post('service-faq/{id}/update', [ServiceFaqController::class, 'update'])->name('admin.service-faq-update');
        Route::get('service-faq/{id}/destroy', [ServiceFaqController::class, 'destroy'])->name('admin.service-faq-destroy');
        Route::post('service-faq/toggle-status', [ServiceFaqController::class, 'serviceFaq_toggleStatus'])->name('admin.service-faq-status');

        // Admin Service Benefits Routes
        Route::get('service/benefits', [ServiceBenefitController::class, 'index'])->name('admin.service-benefits');
        Route::get('service-benefits/create', [ServiceBenefitController::class, 'create'])->name('admin.service-benefits-create');
        Route::post('service-benefits/store', [ServiceBenefitController::class, 'store'])->name('admin.service-benefits-store');
        Route::get('service-benefits/{id}/edit', [ServiceBenefitController::class, 'edit'])->name('admin.service-benefits-edit');
        Route::post('service-benefits/{id}/update', [ServiceBenefitController::class, 'update'])->name('admin.service-benefits-update');
        Route::get('service-benefits/{id}/destroy', [ServiceBenefitController::class, 'destroy'])->name('admin.service-benefits-destroy');
        Route::post('service-benefits/toggle-status', [ServiceBenefitController::class, 'serviceBenefits_toggleStatus'])->name('admin.service-benefits-status');

        // Admin Service Features Routes
        Route::get('service/features', [ServiceFeatureController::class, 'index'])->name('admin.service-features');
        Route::get('service-features/create', [ServiceFeatureController::class, 'create'])->name('admin.service-features-create');
        Route::post('service-features/store', [ServiceFeatureController::class, 'store'])->name('admin.service-features-store');
        Route::get('service-features/{id}/edit', [ServiceFeatureController::class, 'edit'])->name('admin.service-features-edit');
        Route::post('service-features/{id}/update', [ServiceFeatureController::class, 'update'])->name('admin.service-features-update');
        Route::get('service-features/{id}/destroy', [ServiceFeatureController::class, 'destroy'])->name('admin.service-features-destroy');
        Route::post('service-features/toggle-status', [ServiceFeatureController::class, 'serviceFeatures_toggleStatus'])->name('admin.service-features-status');

        // Admin Service Essentials Routes
        Route::get('service/essentials', [ServiceEssentialController::class, 'index'])->name('admin.service-essentials');
        Route::get('service-essentials/create', [ServiceEssentialController::class, 'create'])->name('admin.service-essentials-create');
        Route::post('service-essentials/store', [ServiceEssentialController::class, 'store'])->name('admin.service-essentials-store');
        Route::get('service-essentials/{id}/edit', [ServiceEssentialController::class, 'edit'])->name('admin.service-essentials-edit');
        Route::post('service-essentials/{id}/update', [ServiceEssentialController::class, 'update'])->name('admin.service-essentials-update');
        Route::get('service-essentials/{id}/destroy', [ServiceEssentialController::class, 'destroy'])->name('admin.service-essentials-destroy');
        Route::post('service-essentials/toggle-status', [ServiceEssentialController::class, 'serviceEssentials_toggleStatus'])->name('admin.service-essentials-status');

        // Admin Blog Routes
        Route::get('blogs', [BlogController::class, 'index'])->name('admin.blog');
        Route::get('blogs/create', [BlogController::class, 'create'])->name('admin.blog-create');
        Route::post('blogs/store', [BlogController::class, 'store'])->name('admin.blog-store');
        Route::get('blogs/{id}/edit', [BlogController::class, 'edit'])->name('admin.blog-edit');
        Route::post('blogs/{id}/update', [BlogController::class, 'update'])->name('admin.blog-update');
        Route::delete('blogs/{id}/destroy', [BlogController::class, 'destroy'])->name('admin.blog-destroy');
        Route::post('blogs/toggle-status', [BlogController::class, 'blog_toggleStatus'])->name('admin.blog-status');

        // Admin Blog Category Routes
        Route::get('blogs-category', [BlogCategoryController::class, 'index'])->name('admin.blog-category');
        Route::post('blogs-category/store', [BlogCategoryController::class, 'store'])->name('admin.blog-category-store');
        Route::get('blogs-category/{id}/edit', [BlogCategoryController::class, 'edit'])->name('admin.blog-category-edit');
        Route::post('blogs-category/{id}/update', [BlogCategoryController::class, 'update'])->name('admin.blog-category-update');
        Route::delete('blogs-category/{id}/destroy', [BlogCategoryController::class, 'destroy'])->name('admin.blog-category-destroy');
        Route::post('blogs-category/toggle-status', [BlogCategoryController::class, 'blogCategory_toggleStatus'])->name('admin.blog-category-status');

        // Admin Brands Routes
        Route::get('brands', [BrandController::class, 'index'])->name('admin.brands');
        Route::post('brands/store', [BrandController::class, 'store'])->name('admin.brands-store');
        Route::get('brands/{id}/edit', [BrandController::class, 'edit'])->name('admin.brands-edit');
        Route::post('brands/{id}/update', [BrandController::class, 'update'])->name('admin.brands-update');
        Route::get('brands/{id}/destroy', [BrandController::class, 'destroy'])->name('admin.brands-destroy');
        Route::post('brands/toggle-status', [BrandController::class, 'brands_toggleStatus'])->name('admin.brands-status');

        // Admin Video Gallery Routes
        Route::get('video-gallery', [VideoGalleryController::class, 'index'])->name('admin.video_gallery');
        Route::post('video/gallery/store', [VideoGalleryController::class, 'store'])->name('admin.video_gallery-store');
        Route::get('video/gallery/{id}/edit', [VideoGalleryController::class, 'edit'])->name('admin.video_gallery-edit');
        Route::post('video/gallery/{id}/update', [VideoGalleryController::class, 'update'])->name('admin.video_gallery-update');
        Route::get('video/gallery/{id}/destroy', [VideoGalleryController::class, 'destroy'])->name('admin.video_gallery-destroy');
        Route::post('video/gallery/toggle-status', [VideoGalleryController::class, 'video_gallery_toggleStatus'])->name('admin.video_gallery-status');

        // Admin Testimonial Routes
        Route::get('testimonial', [TestimonialController::class, 'index'])->name('admin.testimonial');
        Route::get('testimonial/create', [TestimonialController::class, 'create'])->name('admin.testimonial-create');
        Route::get('testimonial/{id}/edit', [TestimonialController::class, 'edit'])->name('admin.testimonial-edit');
        Route::post('testimonial/store', [TestimonialController::class, 'store'])->name('admin.testimonial-store');
        Route::post('testimonial/{id}/update', [TestimonialController::class, 'update'])->name('admin.testimonial-update');
        Route::get('testimonial/{id}/destroy', [TestimonialController::class, 'destroy'])->name('admin.testimonial-destroy');
        Route::post('testimonial/toggle-status', [TestimonialController::class, 'testimonial_toggleStatus'])->name('admin.testimonial-status');

        // Admin TeamMembers Routes
        Route::get('team_members', [TeamMemberController::class, 'index'])->name('admin.team_members');
        Route::get('team_members/create', [TeamMemberController::class, 'create'])->name('admin.team_members-create');
        Route::get('team_members/{id}/edit', [TeamMemberController::class, 'edit'])->name('admin.team_members-edit');
        Route::post('team_members/store', [TeamMemberController::class, 'store'])->name('admin.team_members-store');
        Route::post('team_members/{id}/update', [TeamMemberController::class, 'update'])->name('admin.team_members-update');
        Route::get('team_members/{id}/destroy', [TeamMemberController::class, 'destroy'])->name('admin.team_members-destroy');
        Route::post('team_members/toggle-status', [TeamMemberController::class, 'teammembers_toggleStatus'])->name('admin.team_members-status');

        // Admin Industry Routes
        Route::get('industry', [IndustryController::class, 'index'])->name('admin.industry');
        Route::get('industry/create', [IndustryController::class, 'create'])->name('admin.industry-create');
        Route::get('industry/{id}/edit', [IndustryController::class, 'edit'])->name('admin.industry-edit');
        Route::post('industry/store', [IndustryController::class, 'store'])->name('admin.industry-store');
        Route::post('industry/{id}/update', [IndustryController::class, 'update'])->name('admin.industry-update');
        Route::get('industry/{id}/destroy', [IndustryController::class, 'destroy'])->name('admin.industry-destroy');
        Route::post('industry/toggle-status', [IndustryController::class, 'Industry_toggleStatus'])->name('admin.industry-status');

        // Admin Industry Service Routes
        Route::get('industry/service', [IndustryServiceController::class, 'index'])->name('admin.industry-service');
        Route::get('industry-service/create', [IndustryServiceController::class, 'create'])->name('admin.industry-service-create');
        Route::post('industry-service/store', [IndustryServiceController::class, 'store'])->name('admin.industry-service-store');
        Route::get('industry-service/{id}/edit', [IndustryServiceController::class, 'edit'])->name('admin.industry-service-edit');
        Route::post('industry-service/{id}/update', [IndustryServiceController::class, 'update'])->name('admin.industry-service-update');
        Route::get('industry-service/{id}/destroy', [IndustryServiceController::class, 'destroy'])->name('admin.industry-service-destroy');
        Route::post('industry-service/toggle-status', [IndustryServiceController::class, 'industryService_toggleStatus'])->name('admin.industry-service-status');

        // Admin Industry Faq Routes
        Route::get('industry/faq', [IndustryFaqController::class, 'index'])->name('admin.industry-faq');
        Route::get('industry-faq/create', [IndustryFaqController::class, 'create'])->name('admin.industry-faq-create');
        Route::post('industry-faq/store', [IndustryFaqController::class, 'store'])->name('admin.industry-faq-store');
        Route::get('industry-faq/{id}/edit', [IndustryFaqController::class, 'edit'])->name('admin.industry-faq-edit');
        Route::post('industry-faq/{id}/update', [IndustryFaqController::class, 'update'])->name('admin.industry-faq-update');
        Route::get('industry-faq/{id}/destroy', [IndustryFaqController::class, 'destroy'])->name('admin.industry-faq-destroy');
        Route::post('industry-faq/toggle-status', [IndustryFaqController::class, 'industryFaq_toggleStatus'])->name('admin.industry-faq-status');

        // Admin Short Form Routes
        Route::get('/admission/short-form/listing', [AdmissionController::class, 'admission_short_form_listing'])->name('admin.admission_short_form');
        Route::get('/admission/short-form/enquiry-destroy/{id}', [AdmissionController::class, 'admission_short_form_destroy'])->name('admin.admission_short_form-destroy');

        // ContactUs Enquiry Routes
        Route::get('contactus/listing', [FrontendContactusController::class, 'contactus_enquiry'])->name('admin.contactus_enquiry');
        Route::get('/contactus/enquiry-destroy/{id}', [FrontendContactusController::class, 'contactus_destroy'])->name('admin.contactus-destroy');

        // Admin Icon Route
        Route::post('/icons/add', [IconController::class, 'add'])->name('icons.add');

        /* =========================
           Youtube Category Routes
        ========================= */

        // List Categories
        Route::get('/youtube-categories', [YoutubeCategoryController::class, 'index'])->name('youtubeCategory.index');

        // Create Form
        Route::get('/youtube-categories/create', [YoutubeCategoryController::class, 'create'])->name('youtubeCategory.create');

        // Store Category
        Route::post('/youtube-categories/store', [YoutubeCategoryController::class, 'store'])->name('youtubeCategory.store');
        Route::get('/youtube-categories/edit/{id}', [YoutubeCategoryController::class, 'edit'])->name('youtubeCategory.edit');
        Route::delete('/youtube-categories/delete/{id}', [YoutubeCategoryController::class, 'destroy'])->name('youtubeCategory.destroy');
        Route::post('/youtube-categories/update/{id}', [YoutubeCategoryController::class, 'update'])->name('youtubeCategory.update');

        /* =========================
           Youtube Video Routes
        ========================= */

        Route::get('/youtube-videos/create', [YoutubeVideoController::class, 'create'])->name('youtubeVideo.create');
        Route::post('/youtube-videos/store', [YoutubeVideoController::class, 'store'])->name('youtubeVideo.store');
        Route::get('/youtube-category/{id}/videos', [YoutubeVideoController::class, 'showByCategory'])->name('youtubeVideo.byCategory');
        Route::get('youtube-videos', [YoutubeVideoController::class, 'index'])->name('youtubeVideos.index');
        Route::get('youtube-videos/edit/{id}', [YoutubeVideoController::class, 'edit'])->name('youtubeVideos.edit');
        Route::post('youtube-videos/update/{id}', [YoutubeVideoController::class, 'update'])->name('youtubeVideos.update');
        Route::delete('youtube-videos/delete/{id}', [YoutubeVideoController::class, 'destroy'])->name('youtubeVideos.destroy');

        Route::get('courses', [CourseController::class, 'index'])->name('courses');
        Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('courses/store', [CourseController::class, 'store'])->name('courses.store');
        Route::get('courses/{id}', [CourseController::class, 'show'])->name('courses.show');
        Route::delete('courses/{id}', [CourseController::class, 'destroy'])->name('courses.delete');
        Route::get('courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::get('status-update/{id}', [CourseController::class, 'status_update'])->name('courses.status-update');
        Route::put('courses/{id}', [CourseController::class, 'update'])->name('courses.update');
        // ── States ─────────────────────────────────────────

        Route::get('states', [StateController::class, 'index'])->name('states-index');
        Route::post('states', [StateController::class, 'store'])->name('states-store');
        Route::get('states/create', [StateController::class, 'create'])->name('states-create');
        Route::put('states/{id}', [StateController::class, 'update'])->name('states-update');
        Route::delete('states/{id}', [StateController::class, 'destroy'])->name('states-destroy');
        Route::post('states/status', [StateController::class, 'status'])->name('states-status');
        Route::get('states/{id}/edit', [StateController::class, 'edit'])->name('states-edit');

        // ── Centers ─────────────────────────────────────────
        Route::get('centers', [CenterController::class, 'index'])->name('centers-index');
        Route::post('centers', [CenterController::class, 'store'])->name('centers-store');
        Route::put('centers/{id}', [CenterController::class, 'update'])->name('centers-update');
        Route::delete('centers/{id}', [CenterController::class, 'destroy'])->name('centers-destroy');
        Route::post('centers/status', [CenterController::class, 'status'])->name('centers-status');
        Route::get('centers/by-state', [CenterController::class, 'getByState'])->name('centers-by-state');
        Route::get('centers/{id}/edit', [CenterController::class, 'edit'])->name('centers-edit');
        Route::get('centers/create', [CenterController::class, 'create'])->name('centers-create');

        //events ───────────────────────────────────────────────
        Route::get('events', [EventController::class, 'index'])->name('events-index');
        Route::get('events/create', [EventController::class, 'create'])->name('events-create');
        Route::post('events', [EventController::class, 'store'])->name('events-store');
        Route::post('events/status', [EventController::class, 'status'])->name('events-status');
        Route::get('events/{id}', [EventController::class, 'show'])->name('events-show');
        Route::get('events/{id}/edit', [EventController::class, 'edit'])->name('events-edit');
        Route::put('events/{id}', [EventController::class, 'update'])->name('events-update');
        Route::delete('events/{id}', [EventController::class, 'destroy'])->name('events-destroy');

        // ── Sub Events ───────────────────────────────────────────────
        Route::get('events/{event_id}/sub-events/create', [SubEventController::class, 'create'])->name('sub-events-create');
        Route::post('events/{event_id}/sub-events', [SubEventController::class, 'store'])->name('sub-events-store');
        Route::post('sub-events/status', [SubEventController::class, 'status'])->name('sub-events-status');
        Route::get('sub-events/{id}/edit', [SubEventController::class, 'edit'])->name('sub-events-edit');
        Route::put('sub-events/{id}', [SubEventController::class, 'update'])->name('sub-events-update');
        Route::delete('sub-events/{id}', [SubEventController::class, 'destroy'])->name('sub-events-destroy');
        Route::get('events/{event_id}/sub-events', [SubEventController::class, 'index'])->name('sub-events-index');

        Route::get('course-categories', [CourseCategoryController::class, 'index'])->name('course-categories-index');
        Route::get('course-categories/create', [CourseCategoryController::class, 'create'])->name('course-categories-create');
        Route::post('course-categories', [CourseCategoryController::class, 'store'])->name('course-categories-store');
        Route::post('course-categories/status', [CourseCategoryController::class, 'status'])->name('course-categories-status');
        Route::get('course-categories/{id}/edit', [CourseCategoryController::class, 'edit'])->name('course-categories-edit');
        Route::put('course-categories/{id}', [CourseCategoryController::class, 'update'])->name('course-categories-update');
        Route::delete('course-categories/{id}', [CourseCategoryController::class, 'destroy'])->name('course-categories-destroy');

        Route::get('quiz-tests', [QuizTestController::class, 'index'])->name('quiz-tests.index');
        Route::get('quiz-tests/create', [QuizTestController::class, 'create'])->name('quiz-tests.create');
        Route::post('quiz-tests', [QuizTestController::class, 'store'])->name('quiz-tests.store');
        Route::get('quiz-tests/{id}', [QuizTestController::class, 'show'])->name('quiz-tests.show');
        Route::get('quiz-tests/{id}/edit', [QuizTestController::class, 'edit'])->name('quiz-tests.edit');
        Route::put('quiz-tests/{id}', [QuizTestController::class, 'update'])->name('quiz-tests.update');
        Route::delete('quiz-tests/{id}', [QuizTestController::class, 'destroy'])->name('quiz-tests.destroy');

        // CATEGORIES (nested under test)
        Route::get('quiz-tests/{testId}/categories', [QuizCategoryController::class, 'index'])->name('quiz-categories.index');
        Route::get('quiz-tests/{testId}/categories/create', [QuizCategoryController::class, 'create'])->name('quiz-categories.create');
        Route::post('quiz-tests/{testId}/categories', [QuizCategoryController::class, 'store'])->name('quiz-categories.store');
        Route::get('quiz-tests/{testId}/categories/{id}/edit', [QuizCategoryController::class, 'edit'])->name('quiz-categories.edit');
        Route::put('quiz-tests/{testId}/categories/{id}', [QuizCategoryController::class, 'update'])->name('quiz-categories.update');
        Route::delete('quiz-tests/{testId}/categories/{id}', [QuizCategoryController::class, 'destroy'])->name('quiz-categories.destroy');

        // QUESTIONS — Bulk create (no categoryId in URL)

        Route::get('quiz-tests/{testId}/questions/create', [QuizQuestionController::class, 'create'])->name('quiz-questions.create');
        Route::post('quiz-tests/{testId}/questions', [QuizQuestionController::class, 'store'])->name('quiz-questions.store');

        // QUESTIONS — Per-category list, edit, delete
        Route::get('quiz-tests/{testId}/categories/{categoryId}/questions', [QuizQuestionController::class, 'index'])->name('quiz-questions.index');
        Route::get('quiz-tests/{testId}/categories/{categoryId}/questions/{id}/edit', [QuizQuestionController::class, 'edit'])->name('quiz-questions.edit');
        Route::put('quiz-tests/{testId}/categories/{categoryId}/questions/{id}', [QuizQuestionController::class, 'update'])->name('quiz-questions.update');
        Route::delete('quiz-tests/{testId}/categories/{categoryId}/questions/{id}', [QuizQuestionController::class, 'destroy'])->name('quiz-questions.destroy');

        Route::resource('test-graph-configs', TestGraphConfigController::class);

        Route::get('test-result-ranges', [TestResultRangeController::class, 'tests'])->name('test-result-ranges.tests');
        Route::get('test-result-ranges/{id}', [TestResultRangeController::class, 'index'])->name('test-result-ranges.index');
        Route::get('test-result-ranges/create/{testId}', [TestResultRangeController::class, 'create'])->name('test-result-ranges.create');
        Route::post('test-result-ranges/{testId}', [TestResultRangeController::class, 'store'])->name('test-result-ranges.store');
        Route::any('test-result-ranges/{testId}/edit/{id}', [TestResultRangeController::class, 'edit'])->name('test-result-ranges.edit');
        Route::any('test-result-ranges/{testId}/update/{id}', [TestResultRangeController::class, 'update'])->name('test-result-ranges.update');
        Route::delete('test-result-ranges/{testId}/{id}', [TestResultRangeController::class, 'destroy'])->name('test-result-ranges.destroy');

        Route::get('/blog-authors', [BlogAuthorController::class, 'index'])->name('admin.blog-author.index');
        Route::get('/blog-authors/create', [BlogAuthorController::class, 'create'])->name('admin.blog-author.create');
        Route::post('/blog-authors/store', [BlogAuthorController::class, 'store'])->name('admin.blog-author.store');
        Route::get('/blog-authors/edit/{id}', [BlogAuthorController::class, 'edit'])->name('admin.blog-author.edit');
        Route::post('/blog-authors/update/{id}', [BlogAuthorController::class, 'update'])->name('admin.blog-author.update');
        Route::delete('/blog-authors/destroy/{id}', [BlogAuthorController::class, 'destroy'])->name('admin.blog-author.destroy');
        Route::post('/blog-authors/toggle-status', [BlogAuthorController::class, 'toggleStatus'])->name('admin.blog-author.toggle-status');
    });
});

Route::get('indexx', [indexController::class, 'index'])->name('index');
