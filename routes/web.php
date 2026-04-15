<?php

use Illuminate\Support\Facades\Route;

// ╔════════════════════════════════════════════════════════════════════════════╗
// ║                           CONTROLLER IMPORTS                              ║
// ╚════════════════════════════════════════════════════════════════════════════╝

// Admin Controllers
use App\Http\Controllers\admin\AboutCategoryController;
use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AdminProfileController;
use App\Http\Controllers\admin\BlogAuthorController;
use App\Http\Controllers\admin\BlogCategoryController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\BlogTagController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CenterController;
use App\Http\Controllers\admin\ContactInfoController;
use App\Http\Controllers\admin\CourseCategoryController;
use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\EmailLogController;
use App\Http\Controllers\admin\EmailTemplateController;
use App\Http\Controllers\admin\EnquiryController;
use App\Http\Controllers\admin\EnrollmentController;
use App\Http\Controllers\admin\EventController;
use App\Http\Controllers\admin\EventRegistrationController;
use App\Http\Controllers\admin\HeroBannerController;
use App\Http\Controllers\admin\IndustryController;
use App\Http\Controllers\admin\IndustryFaqController;
use App\Http\Controllers\admin\IndustryFeatureController;
use App\Http\Controllers\admin\IndustryServiceController;
use App\Http\Controllers\admin\QuizCategoryController;
use App\Http\Controllers\admin\QuizQuestionController;
use App\Http\Controllers\admin\QuizTestController;
use App\Http\Controllers\admin\ServiceBenefitController;
use App\Http\Controllers\admin\ServiceCategoryController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\ServiceEssentialController;
use App\Http\Controllers\admin\ServiceFaqController;
use App\Http\Controllers\admin\ServiceFeatureController;
use App\Http\Controllers\admin\ServiceSubCategoryController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\StateController;
use App\Http\Controllers\admin\SubEventController;
use App\Http\Controllers\admin\TeamMemberController;
use App\Http\Controllers\admin\TestGraphConfigController;
use App\Http\Controllers\admin\TestResultRangeController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\TestimonialVideoController;
use App\Http\Controllers\admin\NotificationBannerController;
use App\Http\Controllers\admin\VideoGalleryController;
use App\Http\Controllers\admin\VolunteerController;
use App\Http\Controllers\admin\YoutubeVideoController;
use App\Http\Controllers\admin\YoutubeCategoryController;

// Summer Camp Admin Controllers
use App\Http\Controllers\admin\Summercamp\AboutSectionController;
use App\Http\Controllers\admin\Summercamp\GalleryCategoryController;
use App\Http\Controllers\admin\Summercamp\GalleryImageController;
use App\Http\Controllers\admin\Summercamp\PersonController;
use App\Http\Controllers\admin\Summercamp\StatController;
use App\Http\Controllers\admin\Summercamp\SummerEventController;
use App\Http\Controllers\admin\Summercamp\SummerSubEventController;
use App\Http\Controllers\admin\Summercamp\ThemeController;
use App\Http\Controllers\admin\Summercamp\WorkshopController as SummerWorkshopController;
use App\Http\Controllers\admin\Summercamp\PartnerController as SummerPartnerController;
use App\Http\Controllers\admin\Summercamp\PartnerCategoryController as SummerPartnerCategoryController;
use App\Http\Controllers\admin\Summercamp\SchoolPartnerController;
use App\Http\Controllers\admin\Summercamp\SchoolPartnerCategoryController;
use App\Http\Controllers\admin\Summercamp\SchoolSectionController;
use App\Http\Controllers\admin\WorkshopAgeGroupController;
use App\Http\Controllers\admin\WorkshopCityController;
use App\Http\Controllers\admin\WorkshopSchoolController;
use App\Http\Controllers\admin\WorkshopRegistrationAdminController;
use App\Http\Controllers\admin\ActionItemController;
use App\Http\Controllers\admin\MerchandiseController;
use App\Http\Controllers\admin\AnnouncementBarController;
use App\Http\Controllers\admin\ChatbotFaqController;
use App\Http\Controllers\admin\ChatbotSupportTicketController;
use App\Http\Controllers\admin\NewsletterController as AdminNewsletterController;

// Frontend Controllers
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\BecomePartnerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FranchiseController;
use App\Http\Controllers\FrontendContactusController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IconController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SummerController;
use App\Http\Controllers\WorkshopRegistrationController;
use App\Http\Controllers\frontend\indexController;
use App\Http\Controllers\ChatbotController;

// ╔════════════════════════════════════════════════════════════════════════════╗
// ║                         PUBLIC FRONTEND ROUTES                            ║
// ╚════════════════════════════════════════════════════════════════════════════╝

// ── Chatbot Public API ──────────────────────────────────────────────────────
Route::get('/chatbot/faqs', [ChatbotController::class, 'faqs'])->name('chatbot.faqs');
Route::post('/chatbot/support', [ChatbotController::class, 'submitTicket'])->name('chatbot.support');

// Home & Main Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/aboutus', [HomeController::class, 'about'])->name('aboutus');
Route::get('/team', [HomeController::class, 'team'])->name('team');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/refund', [HomeController::class, 'refund'])->name('refund');

// Services
Route::get('/service', [HomeController::class, 'service'])->name('service');
Route::get('/servicedetails/{slug}', [HomeController::class, 'servicedetails'])->name('servicedetails');

// Projects
Route::get('/project', [HomeController::class, 'project'])->name('project');
Route::get('/projectdetails', [HomeController::class, 'projectdetails'])->name('projectdetails');

// Blog
Route::get('/blogs', [HomeController::class, 'blog'])->name('frontend.blog.index');
Route::get('/blog/category/{slug}', [HomeController::class, 'blog_category'])->name('frontend.blog.category');
Route::get('/blog/{slug}', [HomeController::class, 'blog_details'])->name('frontend.blog.details');
Route::get('blogs/filter/{id}', [HomeController::class, 'blog_filter'])->name('home.blogs_filter');
Route::get('blogs/search', [HomeController::class, 'blog_search'])->name('home.blogs_search');

// Volunteer
Route::get('/volunteer', [HomeController::class, 'volunteer'])->name('volunteer');
Route::post('/admin/volunteer-submit', [VolunteerController::class, 'store'])->name('volunteer.store');

// Contact
Route::get('/contactus', [HomeController::class, 'contactus'])->name('contactus');
Route::post('/contactus/listing', [FrontendContactusController::class, 'contactus_store'])->name('home.contactus.store');

// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->middleware('throttle:10,1')->name('newsletter.subscribe');

// ╔════════════════════════════════════════════════════════════════════════════╗
// ║                           COURSES ROUTES                                  ║
// ╚════════════════════════════════════════════════════════════════════════════╝

Route::get('/course', [HomeController::class, 'course'])->name('index.course');
Route::get('/cat_course/{courseCategory:slug}', [HomeController::class, 'cat_course'])->name('course.show');
Route::get('/course/{course:slug}', [HomeController::class, 'course_details'])->name('course.details');

// ╔════════════════════════════════════════════════════════════════════════════╗
// ║                           EVENTS ROUTES                                   ║
// ╚════════════════════════════════════════════════════════════════════════════╝

Route::get('/event', [HomeController::class, 'event'])->name('event');
Route::get('/events/{event:slug}', [HomeController::class, 'subevent'])->name('frontend.events.subevent');

// Event Registration (success must be before {subEvent:slug} to avoid slug collision)
Route::get('/events/register/success/{id}', [EventRegistrationController::class, 'success'])->name('frontend.events.register.success');
Route::get('/events/register/{subEvent:slug}', [EventRegistrationController::class, 'show'])->name('frontend.events.register');
Route::post('/events/register/{subEvent:slug}', [EventRegistrationController::class, 'store'])->name('frontend.events.register.store');
Route::post('/events/register/{subEvent:slug}/create-order', [EventRegistrationController::class, 'createOrder'])->name('frontend.events.register.create-order');
Route::post('/events/register/{registration_id}/verify-payment', [EventRegistrationController::class, 'verifyPayment'])->name('frontend.events.register.verify-payment');
Route::get('/sub-event/{subEvent:slug}/details', [EventRegistrationController::class, 'subEventDetails'])->name('subevent.details');
Route::get('/register/success/{id}', [EventRegistrationController::class, 'success'])->name('register.success');

// ╔════════════════════════════════════════════════════════════════════════════╗
// ║                           QUIZ/TESTS ROUTES                               ║
// ╚════════════════════════════════════════════════════════════════════════════╝

Route::get('/skill-assessment', [HomeController::class, 'quicktest'])->name('quiz-test');
Route::get('/tests/{psychTest:slug}', [HomeController::class, 'show'])->name('frontend.tests.show');
Route::get('/take-test/{psychTest:slug}', [HomeController::class, 'take'])->name('quicktest.take');
Route::post('/test/{psychTest:slug}/submit', [HomeController::class, 'submit'])->name('test.submit');
Route::get('/test/{psychTest:slug}/result', [HomeController::class, 'result'])->name('test.result');
Route::get('/test/{psychTest:slug}/download-pdf', [HomeController::class, 'downloadPdf'])->name('test.pdf');

// ╔════════════════════════════════════════════════════════════════════════════╗
// ║                           ENROLLMENT ROUTES                               ║
// ╚════════════════════════════════════════════════════════════════════════════╝

Route::get('/enrollment/{course:slug}', [EnrollmentController::class, 'enroll'])->name('enrollment.enroll');
Route::post('/enrollment/store', [EnrollmentController::class, 'store'])->middleware('throttle:20,1')->name('enrollment.store');
Route::post('/verify-payment', [EnrollmentController::class, 'verifyPayment'])->middleware('throttle:10,1')->name('enrollment.verify');
Route::post('/enrollment/validate', [EnrollmentController::class, 'validateField'])->middleware('throttle:30,1')->name('enrollment.validate');
Route::get('/enrollment/payment/callback', [EnrollmentController::class, 'paymentCallback'])->name('enrollment.payment.callback');
Route::get('/enrollment/payment/confirmed', [EnrollmentController::class, 'paymentConfirmed'])->name('enrollment.payment.confirmed');

// ╔════════════════════════════════════════════════════════════════════════════╗
// ║                           SUMMER CAMP ROUTES                              ║
// ╚════════════════════════════════════════════════════════════════════════════╝

Route::get('/summer-camp', [SummerController::class, 'index'])->name('summercamp');
Route::get('/summer-camp/partners', [SummerController::class, 'partners'])->name('summercamp.partners');
Route::get('/summer-camp/events', [SummerController::class, 'event'])->name('event.summercamp');
Route::get('summercamp/events/sub/{subEvent:slug}', [SummerController::class, 'subEventDetail'])->name('frontend.events.subevent-detail');
Route::get('summercamp/events/{event:slug}', [SummerController::class, 'subevent'])->name('summercamp.event');

// Workshops
Route::get('/workshops', [SummerWorkshopController::class, 'index'])->name('workshops');
Route::get('/workshops/{school}', [SummerWorkshopController::class, 'workshopdetails'])->name('workshops.show');
Route::get('/workshops/{school}/register', [SummerWorkshopController::class, 'registerPage'])->name('workshops.register');
Route::post('/workshops/{school}/register', [WorkshopRegistrationController::class, 'register'])->middleware('throttle:10,1')->name('frontend.summercamp.register.submit');
Route::post('/register/{registration}/verify', [WorkshopRegistrationController::class, 'verifyPayment'])->middleware('throttle:10,1')->name('frontend.summercamp.register.verify');

Route::get('/curriculum', [SummerController::class, 'curriculum'])->name('curriculum');

// Frontend Index
Route::get('indexx', [indexController::class, 'index'])->name('index');

// ╔════════════════════════════════════════════════════════════════════════════╗
// ║                           USER ACCOUNT ROUTES                             ║
// ╚════════════════════════════════════════════════════════════════════════════╝

Route::group(['prefix' => 'account'], function () {
    // Guest Routes (Unauthenticated Users)
    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', [LoginController::class, 'index'])->name('account.login');
        Route::get('register', [LoginController::class, 'register'])->name('account.register');
        Route::post('authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
        Route::post('process-register', [LoginController::class, 'process_register'])->name('account.processRegister');
    });

    // Protected Routes (Authenticated Users)
    Route::group(['middleware' => 'auth'], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('account.dashboard');
        Route::get('logout', [LoginController::class, 'logout'])->name('account.logout');
    });
});

// ╔════════════════════════════════════════════════════════════════════════════╗
// ║                           ADMIN ROUTES                                    ║
// ╚════════════════════════════════════════════════════════════════════════════╝

Route::group(['prefix' => 'admin'], function () {
    // ────────────────────────────────────────────────────────────────────────────
    // Auth Routes (Guests Only)
    // ────────────────────────────────────────────────────────────────────────────
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    // ────────────────────────────────────────────────────────────────────────────
    // Protected Admin Routes
    // ────────────────────────────────────────────────────────────────────────────
    Route::group(['middleware' => 'admin.auth'], function () {
        // Dashboard & Settings
        Route::get('/', [AdminController::class, 'index'])->name('admin');
        Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        Route::get('profile', [AdminProfileController::class, 'profile'])->name('admin.profile');
        Route::post('profile/update', [AdminProfileController::class, 'profile_update'])->name('admin.profile.update');

        // Settings
        Route::get('settings', [SettingController::class, 'index'])->name('admin.settings.index');
        Route::post('settings', [SettingController::class, 'update'])->name('admin.settings.update');

        // ════════════════════════════════════════════════════════════════════════════
        // ENQUIRY & CONTACT MANAGEMENT
        // ════════════════════════════════════════════════════════════════════════════

        // Website Enquiries
        Route::get('/enquiries', [EnquiryController::class, 'index'])->name('admin.enquiries');
        Route::get('/enquiries/count', [EnquiryController::class, 'enquiryCount'])->name('admin.enquiries.count');
        Route::post('/enquiries/mark-read', [EnquiryController::class, 'markAllRead']);
        Route::get('/enquiries/latest', [EnquiryController::class, 'latest']);
        Route::get('/enquiry-destroy/{id}', [EnquiryController::class, 'destroy'])->name('admin.enquiries-destroy');

        // Contact Info
        Route::get('/contact-info', [ContactInfoController::class, 'edit'])->name('admin.contact-info.edit');
        Route::post('/contact-info', [ContactInfoController::class, 'update'])->name('admin.contact-info.update');

        // Contact Us Enquiries
        Route::get('contactus/listing', [FrontendContactusController::class, 'contactus_enquiry'])->name('admin.contactus_enquiry');
        Route::get('/contactus/enquiry-destroy/{id}', [FrontendContactusController::class, 'contactus_destroy'])->name('admin.contactus-destroy');

        // Volunteer Applications
        Route::get('/volunteers', [VolunteerController::class, 'index'])->name('admin.volunteers.index');
        Route::post('/volunteers/{id}/status', [VolunteerController::class, 'updateStatus'])->name('admin.volunteers.status');
        Route::get('/volunteers/destroy/{id}', [VolunteerController::class, 'destroy'])->name('admin.volunteers.destroy');

        // Admission Short Form
        Route::get('/admission/short-form/listing', [AdmissionController::class, 'admission_short_form_listing'])->name('admin.admission_short_form');
        Route::get('/admission/short-form/enquiry-destroy/{id}', [AdmissionController::class, 'admission_short_form_destroy'])->name('admin.admission_short_form-destroy');

        // Newsletter Subscribers
        Route::get('/newsletters', [AdminNewsletterController::class, 'index'])->name('admin.newsletters.index');
        Route::get('/newsletters/export', [AdminNewsletterController::class, 'exportCsv'])->name('admin.newsletters.export');
        Route::delete('/newsletters/{id}', [AdminNewsletterController::class, 'destroy'])->name('admin.newsletters.destroy');

        // ════════════════════════════════════════════════════════════════════════════
        // SLIDER MANAGEMENT
        // ════════════════════════════════════════════════════════════════════════════

        Route::get('slider', [SliderController::class, 'index'])->name('admin.slider');
        Route::post('slider-add', [SliderController::class, 'store'])->name('admin.slider-store');
        Route::post('slider-edit', [SliderController::class, 'update'])->name('admin.slider-update');
        Route::get('slider-destroy/{id}', [SliderController::class, 'destroy'])->name('admin.slider-destroy');
        Route::post('slider/toggle-status', [SliderController::class, 'slider_toggleStatus'])->name('admin.slider-status');

        // Announcement Bar (top strip shown on every frontend page)
        Route::get('announcement-bar', [AnnouncementBarController::class, 'index'])->name('admin.announcement-bar.index');
        Route::post('announcement-bar', [AnnouncementBarController::class, 'store'])->name('admin.announcement-bar.store');
        Route::post('announcement-bar/toggle-status', [AnnouncementBarController::class, 'toggleStatus'])->name('admin.announcement-bar.toggle');
        Route::post('announcement-bar/{id}', [AnnouncementBarController::class, 'update'])->name('admin.announcement-bar.update');
        Route::delete('announcement-bar/{id}', [AnnouncementBarController::class, 'destroy'])->name('admin.announcement-bar.destroy');

        // Notification Banners (Bell popup)
        Route::get('notification-banners', [NotificationBannerController::class, 'index'])->name('admin.notification-banners.index');
        Route::post('notification-banners', [NotificationBannerController::class, 'store'])->name('admin.notification-banners.store');
        Route::post('notification-banners/{id}', [NotificationBannerController::class, 'update'])->name('admin.notification-banners.update');
        Route::post('notification-banners/toggle-status', [NotificationBannerController::class, 'toggleStatus'])->name('admin.notification-banners.toggle');
        Route::delete('notification-banners/{id}', [NotificationBannerController::class, 'destroy'])->name('admin.notification-banners.destroy');

        // ════════════════════════════════════════════════════════════════════════════
        // HERO BANNER MANAGEMENT
        // ════════════════════════════════════════════════════════════════════════════
        Route::resource('hero-banner', HeroBannerController::class)
            ->parameters(['hero-banner' => 'heroBanner'])
            ->names([
                'index' => 'hero-banner.index',
                'create' => 'hero-banner.create',
                'store' => 'hero-banner.store',
                'show' => 'hero-banner.show',
                'edit' => 'hero-banner.edit',
                'update' => 'hero-banner.update',
                'destroy' => 'hero-banner.destroy',
            ]);

        // Custom route to activate a hero banner
        Route::post('hero-banner/{heroBanner}/activate', [HeroBannerController::class, 'activate'])->name('hero-banner.activate');
        // ════════════════════════════════════════════════════════════════════════════
        // ABOUT MANAGEMENT
        // ════════════════════════════════════════════════════════════════════════════

        Route::get('about-us', [AboutController::class, 'index'])->name('admin.about');
        Route::get('about/create', [AboutController::class, 'create'])->name('admin.about-create');
        Route::get('about/{id}/edit', [AboutController::class, 'edit'])->name('admin.about-edit');
        Route::post('about/store', [AboutController::class, 'store'])->name('admin.about-store');
        Route::post('about/{id}/update', [AboutController::class, 'update'])->name('admin.about-update');
        Route::get('about/{id}/destroy', [AboutController::class, 'destroy'])->name('admin.about-destroy');
        Route::post('about/toggle-status', [AboutController::class, 'about_toggleStatus'])->name('admin.about-status');

        // About Categories
        Route::get('about-category', [AboutCategoryController::class, 'index'])->name('admin.about-category');
        Route::post('about-category/store', [AboutCategoryController::class, 'store'])->name('admin.about-category-store');
        Route::get('about-category/{id}/edit', [AboutCategoryController::class, 'edit'])->name('admin.about-category-edit');
        Route::post('about-category/{id}/update', [AboutCategoryController::class, 'update'])->name('admin.about-category-update');
        Route::get('about-category/{id}/destroy', [AboutCategoryController::class, 'destroy'])->name('admin.about-category-destroy');
        Route::post('about-category/toggle-status', [AboutCategoryController::class, 'aboutCategory_toggleStatus'])->name('admin.about-category-status');

        // ════════════════════════════════════════════════════════════════════════════
        // SERVICE MANAGEMENT
        // ════════════════════════════════════════════════════════════════════════════

        // Services
        Route::get('service', [ServiceController::class, 'index'])->name('admin.service');
        Route::get('service/create', [ServiceController::class, 'create'])->name('admin.service-create');
        Route::get('service/{id}/edit', [ServiceController::class, 'edit'])->name('admin.service-edit');
        Route::post('service/store', [ServiceController::class, 'store'])->name('admin.service-store');
        Route::post('service/{id}/update', [ServiceController::class, 'update'])->name('admin.service-update');
        Route::get('service/{id}/destroy', [ServiceController::class, 'destroy'])->name('admin.service-destroy');
        Route::post('service/toggle-status', [ServiceController::class, 'service_toggleStatus'])->name('admin.service-status');
        Route::get('service/subcategories', [ServiceController::class, 'serviceSubcategories'])->name('admin.getservice-subcategories');

        // Service Categories
        Route::get('service-category', [ServiceCategoryController::class, 'index'])->name('admin.service-category');
        Route::post('service-category/store', [ServiceCategoryController::class, 'store'])->name('admin.service-category-store');
        Route::get('service-category/{id}/edit', [ServiceCategoryController::class, 'edit'])->name('admin.service-category-edit');
        Route::post('service-category/{id}/update', [ServiceCategoryController::class, 'update'])->name('admin.service-category-update');
        Route::get('service-category/{id}/destroy', [ServiceCategoryController::class, 'destroy'])->name('admin.service-category-destroy');
        Route::post('service-category/toggle-status', [ServiceCategoryController::class, 'serviceCategory_toggleStatus'])->name('admin.service-category-status');

        // Service Sub Categories
        Route::get('service-subcategory', [ServiceSubCategoryController::class, 'index'])->name('admin.service-subcategory');
        Route::post('service-subcategory/store', [ServiceSubCategoryController::class, 'store'])->name('admin.service-subcategory-store');
        Route::get('service-subcategory/{id}/edit', [ServiceSubCategoryController::class, 'edit'])->name('admin.service-subcategory-edit');
        Route::post('service-subcategory/{id}/update', [ServiceSubCategoryController::class, 'update'])->name('admin.service-subcategory-update');
        Route::get('service-subcategory/{id}/destroy', [ServiceSubCategoryController::class, 'destroy'])->name('admin.service-subcategory-destroy');
        Route::post('service-subcategory/toggle-status', [ServiceSubCategoryController::class, 'serviceSubCategory_toggleStatus'])->name('admin.service-subcategory-status');

        // Service FAQs
        Route::get('service/faq', [ServiceFaqController::class, 'index'])->name('admin.service-faq');
        Route::get('service-faq/create', [ServiceFaqController::class, 'create'])->name('admin.service-faq-create');
        Route::post('service-faq/store', [ServiceFaqController::class, 'store'])->name('admin.service-faq-store');
        Route::get('service-faq/{id}/edit', [ServiceFaqController::class, 'edit'])->name('admin.service-faq-edit');
        Route::post('service-faq/{id}/update', [ServiceFaqController::class, 'update'])->name('admin.service-faq-update');
        Route::get('service-faq/{id}/destroy', [ServiceFaqController::class, 'destroy'])->name('admin.service-faq-destroy');
        Route::post('service-faq/toggle-status', [ServiceFaqController::class, 'serviceFaq_toggleStatus'])->name('admin.service-faq-status');

        // Service Benefits
        Route::get('service/benefits', [ServiceBenefitController::class, 'index'])->name('admin.service-benefits');
        Route::get('service-benefits/create', [ServiceBenefitController::class, 'create'])->name('admin.service-benefits-create');
        Route::post('service-benefits/store', [ServiceBenefitController::class, 'store'])->name('admin.service-benefits-store');
        Route::get('service-benefits/{id}/edit', [ServiceBenefitController::class, 'edit'])->name('admin.service-benefits-edit');
        Route::post('service-benefits/{id}/update', [ServiceBenefitController::class, 'update'])->name('admin.service-benefits-update');
        Route::get('service-benefits/{id}/destroy', [ServiceBenefitController::class, 'destroy'])->name('admin.service-benefits-destroy');
        Route::post('service-benefits/toggle-status', [ServiceBenefitController::class, 'serviceBenefits_toggleStatus'])->name('admin.service-benefits-status');

        // Service Features
        Route::get('service/features', [ServiceFeatureController::class, 'index'])->name('admin.service-features');
        Route::get('service-features/create', [ServiceFeatureController::class, 'create'])->name('admin.service-features-create');
        Route::post('service-features/store', [ServiceFeatureController::class, 'store'])->name('admin.service-features-store');
        Route::get('service-features/{id}/edit', [ServiceFeatureController::class, 'edit'])->name('admin.service-features-edit');
        Route::post('service-features/{id}/update', [ServiceFeatureController::class, 'update'])->name('admin.service-features-update');
        Route::get('service-features/{id}/destroy', [ServiceFeatureController::class, 'destroy'])->name('admin.service-features-destroy');
        Route::post('service-features/toggle-status', [ServiceFeatureController::class, 'serviceFeatures_toggleStatus'])->name('admin.service-features-status');

        // Service Essentials
        Route::get('service/essentials', [ServiceEssentialController::class, 'index'])->name('admin.service-essentials');
        Route::get('service-essentials/create', [ServiceEssentialController::class, 'create'])->name('admin.service-essentials-create');
        Route::post('service-essentials/store', [ServiceEssentialController::class, 'store'])->name('admin.service-essentials-store');
        Route::get('service-essentials/{id}/edit', [ServiceEssentialController::class, 'edit'])->name('admin.service-essentials-edit');
        Route::post('service-essentials/{id}/update', [ServiceEssentialController::class, 'update'])->name('admin.service-essentials-update');
        Route::get('service-essentials/{id}/destroy', [ServiceEssentialController::class, 'destroy'])->name('admin.service-essentials-destroy');
        Route::post('service-essentials/toggle-status', [ServiceEssentialController::class, 'serviceEssentials_toggleStatus'])->name('admin.service-essentials-status');

        // ════════════════════════════════════════════════════════════════════════════
        // BLOG MANAGEMENT
        // ════════════════════════════════════════════════════════════════════════════

        // Blogs
        Route::get('blogs', [BlogController::class, 'index'])->name('admin.blog');
        Route::get('blogs/create', [BlogController::class, 'create'])->name('admin.blog-create');
        Route::post('blogs/store', [BlogController::class, 'store'])->name('admin.blog-store');
        Route::get('blogs/{id}/edit', [BlogController::class, 'edit'])->name('admin.blog-edit');
        Route::post('blogs/{id}/update', [BlogController::class, 'update'])->name('admin.blog-update');
        Route::delete('blogs/{id}/destroy', [BlogController::class, 'destroy'])->name('admin.blog-destroy');
        Route::post('blogs/toggle-status', [BlogController::class, 'blog_toggleStatus'])->name('admin.blog-status');

        // Blog Categories
        Route::get('blogs-category', [BlogCategoryController::class, 'index'])->name('admin.blog-category');
        Route::post('blogs-category/store', [BlogCategoryController::class, 'store'])->name('admin.blog-category-store');
        Route::get('blogs-category/{id}/edit', [BlogCategoryController::class, 'edit'])->name('admin.blog-category-edit');
        Route::post('blogs-category/{id}/update', [BlogCategoryController::class, 'update'])->name('admin.blog-category-update');
        Route::delete('blogs-category/{id}/destroy', [BlogCategoryController::class, 'destroy'])->name('admin.blog-category-destroy');
        Route::post('blogs-category/toggle-status', [BlogCategoryController::class, 'blogCategory_toggleStatus'])->name('admin.blog-category-status');

        // Blog Authors
        Route::get('/blog-authors', [BlogAuthorController::class, 'index'])->name('admin.blog-author.index');
        Route::get('/blog-authors/create', [BlogAuthorController::class, 'create'])->name('admin.blog-author.create');
        Route::post('/blog-authors/store', [BlogAuthorController::class, 'store'])->name('admin.blog-author.store');
        Route::get('/blog-authors/edit/{id}', [BlogAuthorController::class, 'edit'])->name('admin.blog-author.edit');
        Route::post('/blog-authors/update/{id}', [BlogAuthorController::class, 'update'])->name('admin.blog-author.update');
        Route::delete('/blog-authors/destroy/{id}', [BlogAuthorController::class, 'destroy'])->name('admin.blog-author.destroy');
        Route::post('/blog-authors/toggle-status', [BlogAuthorController::class, 'toggleStatus'])->name('admin.blog-author.toggle-status');

        // Blog Tags
        Route::get('blog-tags', [BlogTagController::class, 'index'])->name('admin.blog-tags.index');
        Route::post('blog-tags', [BlogTagController::class, 'store'])->name('admin.blog-tags.store');
        Route::put('blog-tags/{blogTag}', [BlogTagController::class, 'update'])->name('admin.blog-tags.update');
        Route::delete('blog-tags/{blogTag}', [BlogTagController::class, 'destroy'])->name('admin.blog-tags.destroy');

        // ════════════════════════════════════════════════════════════════════════════
        // GALLERY & MEDIA MANAGEMENT
        // ════════════════════════════════════════════════════════════════════════════

        // Video Gallery
        Route::get('video-gallery', [VideoGalleryController::class, 'index'])->name('admin.video_gallery');
        Route::post('video/gallery/store', [VideoGalleryController::class, 'store'])->name('admin.video_gallery-store');
        Route::get('video/gallery/{id}/edit', [VideoGalleryController::class, 'edit'])->name('admin.video_gallery-edit');
        Route::post('video/gallery/{id}/update', [VideoGalleryController::class, 'update'])->name('admin.video_gallery-update');
        Route::get('video/gallery/{id}/destroy', [VideoGalleryController::class, 'destroy'])->name('admin.video_gallery-destroy');
        Route::post('video/gallery/toggle-status', [VideoGalleryController::class, 'video_gallery_toggleStatus'])->name('admin.video_gallery-status');

        // Brands
        Route::get('brands', [BrandController::class, 'index'])->name('admin.brands');
        Route::post('brands/store', [BrandController::class, 'store'])->name('admin.brands-store');
        Route::get('brands/{id}/edit', [BrandController::class, 'edit'])->name('admin.brands-edit');
        Route::post('brands/{id}/update', [BrandController::class, 'update'])->name('admin.brands-update');
        Route::get('brands/{id}/destroy', [BrandController::class, 'destroy'])->name('admin.brands-destroy');
        Route::post('brands/toggle-status', [BrandController::class, 'brands_toggleStatus'])->name('admin.brands-status');

        // Icons
        Route::post('/icons/add', [IconController::class, 'add'])->name('icons.add');

        // ════════════════════════════════════════════════════════════════════════════
        // YOUTUBE MANAGEMENT
        // ════════════════════════════════════════════════════════════════════════════

        // YouTube Categories
        Route::get('/youtube-categories', [YoutubeCategoryController::class, 'index'])->name('youtubeCategory.index');
        Route::get('/youtube-categories/create', [YoutubeCategoryController::class, 'create'])->name('youtubeCategory.create');
        Route::post('/youtube-categories/store', [YoutubeCategoryController::class, 'store'])->name('youtubeCategory.store');
        Route::get('/youtube-categories/edit/{id}', [YoutubeCategoryController::class, 'edit'])->name('youtubeCategory.edit');
        Route::delete('/youtube-categories/delete/{id}', [YoutubeCategoryController::class, 'destroy'])->name('youtubeCategory.destroy');
        Route::post('/youtube-categories/update/{id}', [YoutubeCategoryController::class, 'update'])->name('youtubeCategory.update');

        // YouTube Videos
        Route::get('youtube-videos', [YoutubeVideoController::class, 'index'])->name('youtubeVideos.index');
        Route::get('/youtube-videos/create', [YoutubeVideoController::class, 'create'])->name('youtubeVideo.create');
        Route::post('/youtube-videos/store', [YoutubeVideoController::class, 'store'])->name('youtubeVideo.store');
        Route::get('/youtube-category/{id}/videos', [YoutubeVideoController::class, 'showByCategory'])->name('youtubeVideo.byCategory');
        Route::get('youtube-videos/edit/{id}', [YoutubeVideoController::class, 'edit'])->name('youtubeVideos.edit');
        Route::post('youtube-videos/update/{id}', [YoutubeVideoController::class, 'update'])->name('youtubeVideos.update');
        Route::delete('youtube-videos/delete/{id}', [YoutubeVideoController::class, 'destroy'])->name('youtubeVideos.destroy');

        // ════════════════════════════════════════════════════════════════════════════
        // TESTIMONIALS
        // ════════════════════════════════════════════════════════════════════════════

        // Testimonials
        Route::get('testimonial', [TestimonialController::class, 'index'])->name('admin.testimonial');
        Route::get('testimonial/create', [TestimonialController::class, 'create'])->name('admin.testimonial-create');
        Route::get('testimonial/{id}/edit', [TestimonialController::class, 'edit'])->name('admin.testimonial-edit');
        Route::post('testimonial/store', [TestimonialController::class, 'store'])->name('admin.testimonial-store');
        Route::post('testimonial/{id}/update', [TestimonialController::class, 'update'])->name('admin.testimonial-update');
        Route::get('testimonial/{id}/destroy', [TestimonialController::class, 'destroy'])->name('admin.testimonial-destroy');
        Route::post('testimonial/toggle-status', [TestimonialController::class, 'testimonial_toggleStatus'])->name('admin.testimonial-status');

        // Testimonial Videos
        Route::get('/testimonial-videos', [TestimonialVideoController::class, 'index'])->name('admin.testimonials.index');
        Route::get('/testimonial-videos/create', [TestimonialVideoController::class, 'create'])->name('admin.testimonials.create');
        Route::post('/testimonial-videos', [TestimonialVideoController::class, 'store'])->name('admin.testimonials.store');
        Route::get('/testimonial-videos/{testimonialVideo}/edit', [TestimonialVideoController::class, 'edit'])->name('admin.testimonials.edit');
        Route::put('/testimonial-videos/{testimonialVideo}', [TestimonialVideoController::class, 'update'])->name('admin.testimonials.update');
        Route::delete('/testimonial-videos/{testimonialVideo}', [TestimonialVideoController::class, 'destroy'])->name('admin.testimonials.destroy');
        Route::patch('/testimonial-videos/{testimonialVideo}/toggle', [TestimonialVideoController::class, 'toggle'])->name('admin.testimonials.toggle');
        Route::patch('/testimonial-videos/reorder', [TestimonialVideoController::class, 'reorder'])->name('admin.testimonials.reorder');
        Route::get('/testimonial-videos/categories', [TestimonialVideoController::class, 'categories'])->name('admin.testimonials.categories');
        Route::post('/testimonial-videos/categories', [TestimonialVideoController::class, 'storeCategory'])->name('admin.testimonials.categories.store');
        Route::put('/testimonial-videos/categories/{pageCategory}', [TestimonialVideoController::class, 'updateCategory'])->name('admin.testimonials.categories.update');
        Route::delete('/testimonial-videos/categories/{pageCategory}', [TestimonialVideoController::class, 'destroyCategory'])->name('admin.testimonials.categories.destroy');

        // ════════════════════════════════════════════════════════════════════════════
        // TEAM MANAGEMENT
        // ════════════════════════════════════════════════════════════════════════════

        Route::get('team_members', [TeamMemberController::class, 'index'])->name('admin.team_members');
        Route::get('team_members/create', [TeamMemberController::class, 'create'])->name('admin.team_members-create');
        Route::get('team_members/{id}/edit', [TeamMemberController::class, 'edit'])->name('admin.team_members-edit');
        Route::post('team_members/store', [TeamMemberController::class, 'store'])->name('admin.team_members-store');
        Route::post('team_members/{id}/update', [TeamMemberController::class, 'update'])->name('admin.team_members-update');
        Route::get('team_members/{id}/destroy', [TeamMemberController::class, 'destroy'])->name('admin.team_members-destroy');
        Route::post('team_members/toggle-status', [TeamMemberController::class, 'teammembers_toggleStatus'])->name('admin.team_members-status');

        // ════════════════════════════════════════════════════════════════════════════
        // INDUSTRY MANAGEMENT
        // ════════════════════════════════════════════════════════════════════════════

        // Industries
        Route::get('industry', [IndustryController::class, 'index'])->name('admin.industry');
        Route::get('industry/create', [IndustryController::class, 'create'])->name('admin.industry-create');
        Route::get('industry/{id}/edit', [IndustryController::class, 'edit'])->name('admin.industry-edit');
        Route::post('industry/store', [IndustryController::class, 'store'])->name('admin.industry-store');
        Route::post('industry/{id}/update', [IndustryController::class, 'update'])->name('admin.industry-update');
        Route::get('industry/{id}/destroy', [IndustryController::class, 'destroy'])->name('admin.industry-destroy');
        Route::post('industry/toggle-status', [IndustryController::class, 'Industry_toggleStatus'])->name('admin.industry-status');

        // Industry Services
        Route::get('industry/service', [IndustryServiceController::class, 'index'])->name('admin.industry-service');
        Route::get('industry-service/create', [IndustryServiceController::class, 'create'])->name('admin.industry-service-create');
        Route::post('industry-service/store', [IndustryServiceController::class, 'store'])->name('admin.industry-service-store');
        Route::get('industry-service/{id}/edit', [IndustryServiceController::class, 'edit'])->name('admin.industry-service-edit');
        Route::post('industry-service/{id}/update', [IndustryServiceController::class, 'update'])->name('admin.industry-service-update');
        Route::get('industry-service/{id}/destroy', [IndustryServiceController::class, 'destroy'])->name('admin.industry-service-destroy');
        Route::post('industry-service/toggle-status', [IndustryServiceController::class, 'industryService_toggleStatus'])->name('admin.industry-service-status');

        // Industry FAQs
        Route::get('industry/faq', [IndustryFaqController::class, 'index'])->name('admin.industry-faq');
        Route::get('industry-faq/create', [IndustryFaqController::class, 'create'])->name('admin.industry-faq-create');
        Route::post('industry-faq/store', [IndustryFaqController::class, 'store'])->name('admin.industry-faq-store');
        Route::get('industry-faq/{id}/edit', [IndustryFaqController::class, 'edit'])->name('admin.industry-faq-edit');
        Route::post('industry-faq/{id}/update', [IndustryFaqController::class, 'update'])->name('admin.industry-faq-update');
        Route::get('industry-faq/{id}/destroy', [IndustryFaqController::class, 'destroy'])->name('admin.industry-faq-destroy');
        Route::post('industry-faq/toggle-status', [IndustryFaqController::class, 'industryFaq_toggleStatus'])->name('admin.industry-faq-status');

        // ════════════════════════════════════════════════════════════════════════════
        // COURSES MANAGEMENT
        // ════════════════════════════════════════════════════════════════════════════

        // Courses
        Route::get('courses', [CourseController::class, 'index'])->name('courses');
        Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('courses/store', [CourseController::class, 'store'])->name('courses.store');
        Route::get('courses/{id}', [CourseController::class, 'show'])->name('courses.show');
        Route::delete('courses/{id}', [CourseController::class, 'destroy'])->name('courses.delete');
        Route::get('courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::get('status-update/{id}', [CourseController::class, 'status_update'])->name('courses.status-update');
        Route::put('courses/{id}', [CourseController::class, 'update'])->name('courses.update');

        // Course Categories
        Route::get('course-categories', [CourseCategoryController::class, 'index'])->name('course-categories-index');
        Route::get('course-categories/create', [CourseCategoryController::class, 'create'])->name('course-categories-create');
        Route::post('course-categories', [CourseCategoryController::class, 'store'])->name('course-categories-store');
        Route::post('course-categories/status', [CourseCategoryController::class, 'status'])->name('course-categories-status');
        Route::get('course-categories/{id}/edit', [CourseCategoryController::class, 'edit'])->name('course-categories-edit');
        Route::put('course-categories/{id}', [CourseCategoryController::class, 'update'])->name('course-categories-update');
        Route::delete('course-categories/{id}', [CourseCategoryController::class, 'destroy'])->name('course-categories-destroy');

        // ════════════════════════════════════════════════════════════════════════════
        // STATES & CENTERS MANAGEMENT
        // ════════════════════════════════════════════════════════════════════════════

        // States
        Route::get('states', [StateController::class, 'index'])->name('states-index');
        Route::post('states', [StateController::class, 'store'])->name('states-store');
        Route::get('states/create', [StateController::class, 'create'])->name('states-create');
        Route::put('states/{id}', [StateController::class, 'update'])->name('states-update');
        Route::delete('states/{id}', [StateController::class, 'destroy'])->name('states-destroy');
        Route::post('states/status', [StateController::class, 'status'])->name('states-status');
        Route::get('states/{id}/edit', [StateController::class, 'edit'])->name('states-edit');

        // Centers
        Route::get('centers', [CenterController::class, 'index'])->name('centers-index');
        Route::post('centers', [CenterController::class, 'store'])->name('centers-store');
        Route::put('centers/{id}', [CenterController::class, 'update'])->name('centers-update');
        Route::delete('centers/{id}', [CenterController::class, 'destroy'])->name('centers-destroy');
        Route::post('centers/status', [CenterController::class, 'status'])->name('centers-status');
        Route::get('centers/by-state', [CenterController::class, 'getByState'])->name('centers-by-state');
        Route::get('centers/{id}/edit', [CenterController::class, 'edit'])->name('centers-edit');
        Route::get('centers/create', [CenterController::class, 'create'])->name('centers-create');

        // ════════════════════════════════════════════════════════════════════════════
        // EVENTS & SUB EVENTS MANAGEMENT
        // ════════════════════════════════════════════════════════════════════════════

        // Events
        Route::get('events', [EventController::class, 'index'])->name('events-index');
        Route::get('events/create', [EventController::class, 'create'])->name('events-create');
        Route::post('events', [EventController::class, 'store'])->name('events-store');
        Route::post('events/status', [EventController::class, 'status'])->name('events-status');
        Route::get('events/{id}', [EventController::class, 'show'])->name('events-show');
        Route::get('events/{id}/edit', [EventController::class, 'edit'])->name('events-edit');
        Route::put('events/{id}', [EventController::class, 'update'])->name('events-update');
        Route::delete('events/{id}', [EventController::class, 'destroy'])->name('events-destroy');

        // Sub Events
        Route::get('events/{event_id}/sub-events/create', [SubEventController::class, 'create'])->name('sub-events-create');
        Route::post('events/{event_id}/sub-events', [SubEventController::class, 'store'])->name('sub-events-store');
        Route::post('sub-events/status', [SubEventController::class, 'status'])->name('sub-events-status');
        Route::get('sub-events/{id}/edit', [SubEventController::class, 'edit'])->name('sub-events-edit');
        Route::put('sub-events/{id}', [SubEventController::class, 'update'])->name('sub-events-update');
        Route::delete('sub-events/{id}', [SubEventController::class, 'destroy'])->name('sub-events-destroy');
        Route::get('events/{event_id}/sub-events', [SubEventController::class, 'index'])->name('sub-events-index');

        // Event Registrations
        Route::get('/event-registrations', [EventRegistrationController::class, 'adminIndex'])->name('event-registrations.index');
        Route::get('/event-registrations/export', [EventRegistrationController::class, 'export'])->name('event-registrations.export');
        Route::get('/event-registrations/{id}', [EventRegistrationController::class, 'adminShow'])->name('event-registrations.show');
        Route::patch('/event-registrations/{id}/status', [EventRegistrationController::class, 'adminUpdateStatus'])->name('event-registrations.status');

        // ════════════════════════════════════════════════════════════════════════════
        // QUIZ & TESTS MANAGEMENT
        // ════════════════════════════════════════════════════════════════════════════

        // Quiz Tests
        Route::get('quiz-tests', [QuizTestController::class, 'index'])->name('quiz-tests.index');
        Route::get('quiz-tests/create', [QuizTestController::class, 'create'])->name('quiz-tests.create');
        Route::post('quiz-tests', [QuizTestController::class, 'store'])->name('quiz-tests.store');
        Route::get('quiz-tests/{id}', [QuizTestController::class, 'show'])->name('quiz-tests.show');
        Route::get('quiz-tests/{id}/edit', [QuizTestController::class, 'edit'])->name('quiz-tests.edit');
        Route::put('quiz-tests/{id}', [QuizTestController::class, 'update'])->name('quiz-tests.update');
        Route::delete('quiz-tests/{id}', [QuizTestController::class, 'destroy'])->name('quiz-tests.destroy');

        // Quiz Categories
        Route::get('quiz-tests/{testId}/categories', [QuizCategoryController::class, 'index'])->name('quiz-categories.index');
        Route::get('quiz-tests/{testId}/categories/create', [QuizCategoryController::class, 'create'])->name('quiz-categories.create');
        Route::post('quiz-tests/{testId}/categories', [QuizCategoryController::class, 'store'])->name('quiz-categories.store');
        Route::get('quiz-tests/{testId}/categories/{id}/edit', [QuizCategoryController::class, 'edit'])->name('quiz-categories.edit');
        Route::put('quiz-tests/{testId}/categories/{id}', [QuizCategoryController::class, 'update'])->name('quiz-categories.update');
        Route::delete('quiz-tests/{testId}/categories/{id}', [QuizCategoryController::class, 'destroy'])->name('quiz-categories.destroy');

        // Quiz Questions
        Route::get('quiz-tests/{testId}/questions/create', [QuizQuestionController::class, 'create'])->name('quiz-questions.create');
        Route::post('quiz-tests/{testId}/questions', [QuizQuestionController::class, 'store'])->name('quiz-questions.store');
        Route::get('quiz-tests/{testId}/categories/{categoryId}/questions', [QuizQuestionController::class, 'index'])->name('quiz-questions.index');
        Route::get('quiz-tests/{testId}/categories/{categoryId}/questions/{id}/edit', [QuizQuestionController::class, 'edit'])->name('quiz-questions.edit');
        Route::put('quiz-tests/{testId}/categories/{categoryId}/questions/{id}', [QuizQuestionController::class, 'update'])->name('quiz-questions.update');
        Route::delete('quiz-tests/{testId}/categories/{categoryId}/questions/{id}', [QuizQuestionController::class, 'destroy'])->name('quiz-questions.destroy');

        // Test Graph Configs
        Route::resource('test-graph-configs', TestGraphConfigController::class);

        // Test Result Ranges
        Route::get('test-result-ranges', [TestResultRangeController::class, 'tests'])->name('test-result-ranges.tests');
        Route::get('test-result-ranges/{id}', [TestResultRangeController::class, 'index'])->name('test-result-ranges.index');
        Route::get('test-result-ranges/create/{testId}', [TestResultRangeController::class, 'create'])->name('test-result-ranges.create');
        Route::post('test-result-ranges/{testId}', [TestResultRangeController::class, 'store'])->name('test-result-ranges.store');
        Route::any('test-result-ranges/{testId}/edit/{id}', [TestResultRangeController::class, 'edit'])->name('test-result-ranges.edit');
        Route::any('test-result-ranges/{testId}/update/{id}', [TestResultRangeController::class, 'update'])->name('test-result-ranges.update');
        Route::delete('test-result-ranges/{testId}/{id}', [TestResultRangeController::class, 'destroy'])->name('test-result-ranges.destroy');

        // ════════════════════════════════════════════════════════════════════════════
        // ENROLLMENTS MANAGEMENT
        // ════════════════════════════════════════════════════════════════════════════

        Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
        Route::get('/enrollments/{id}', [EnrollmentController::class, 'show'])->name('enrollments.show');
        Route::post('/enrollments/{id}/status', [EnrollmentController::class, 'updateStatus'])->name('enrollments.updateStatus');
        Route::delete('/enrollments/{id}', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');

        // ════════════════════════════════════════════════════════════════════════════
        // EMAIL TEMPLATES MANAGEMENT
        // ════════════════════════════════════════════════════════════════════════════

        Route::get('/email-templates', [EmailTemplateController::class, 'index'])->name('email-templates.index');
        Route::get('/email-templates/create', [EmailTemplateController::class, 'create'])->name('email-templates.create');
        Route::post('/email-templates', [EmailTemplateController::class, 'store'])->name('email-templates.store');
        Route::get('/email-templates/{id}/edit', [EmailTemplateController::class, 'edit'])->name('email-templates.edit');
        Route::put('/email-templates/{id}', [EmailTemplateController::class, 'update'])->name('email-templates.update');
        Route::delete('/email-templates/{id}', [EmailTemplateController::class, 'destroy'])->name('email-templates.destroy');
        Route::post('admin/email-templates/{id}/test', [EmailTemplateController::class, 'sendTest'])->name('email-templates.test');

        // ════════════════════════════════════════════════════════════════════════════
        // EMAIL LOGS
        // ════════════════════════════════════════════════════════════════════════════

        Route::get('/email-logs', [EmailLogController::class, 'index'])->name('email-logs.index');
        Route::get('/email-logs/{id}', [EmailLogController::class, 'show'])->name('email-logs.show');
        Route::delete('/email-logs/{id}', [EmailLogController::class, 'destroy'])->name('email-logs.destroy');
        Route::post('/email-logs/clear', [EmailLogController::class, 'clearAll'])->name('email-logs.clear');

        // ════════════════════════════════════════════════════════════════════════════
        // SUMMER CAMP MANAGEMENT
        // ════════════════════════════════════════════════════════════════════════════

        // People
        Route::get('/people', [PersonController::class, 'index'])->name('people-index');
        Route::get('/people/create', [PersonController::class, 'create'])->name('people-create');
        Route::post('/people/store', [PersonController::class, 'store'])->name('people-store');
        Route::get('/people/{person}/edit', [PersonController::class, 'edit'])->name('people-edit');
        Route::put('/people/{person}/update', [PersonController::class, 'update'])->name('people-update');
        Route::post('/people/status', [PersonController::class, 'status'])->name('people-status');
        Route::delete('/people/{person}', [PersonController::class, 'destroy'])->name('people-destroy');

        // Summer Camp Partners
        Route::get('/summer-partners', [SummerPartnerController::class, 'index'])->name('summer-partners.index');
        Route::get('/summer-partners/create', [SummerPartnerController::class, 'create'])->name('summer-partners.create');
        Route::post('/summer-partners', [SummerPartnerController::class, 'store'])->name('summer-partners.store');
        Route::get('/summer-partners/{partner}/edit', [SummerPartnerController::class, 'edit'])->name('summer-partners.edit');
        Route::put('/summer-partners/{partner}', [SummerPartnerController::class, 'update'])->name('summer-partners.update');
        Route::post('/summer-partners/status', [SummerPartnerController::class, 'status'])->name('summer-partners.status');
        Route::delete('/summer-partners/{partner}', [SummerPartnerController::class, 'destroy'])->name('summer-partners.destroy');

        // Workshop Age Groups
        Route::get('/workshop-age-groups', [WorkshopAgeGroupController::class, 'index'])->name('workshop-age-groups-index');
        Route::get('/workshop-age-groups/create', [WorkshopAgeGroupController::class, 'create'])->name('workshop-age-groups-create');
        Route::post('/workshop-age-groups/store', [WorkshopAgeGroupController::class, 'store'])->name('workshop-age-groups-store');
        Route::get('/workshop-age-groups/{workshopAgeGroup}/edit', [WorkshopAgeGroupController::class, 'edit'])->name('workshop-age-groups-edit');
        Route::put('/workshop-age-groups/{workshopAgeGroup}', [WorkshopAgeGroupController::class, 'update'])->name('workshop-age-groups-update');
        Route::post('/workshop-age-groups/status', [WorkshopAgeGroupController::class, 'status'])->name('workshop-age-groups-status');
        Route::delete('/workshop-age-groups/{workshopAgeGroup}', [WorkshopAgeGroupController::class, 'destroy'])->name('workshop-age-groups-destroy');

        // Workshop Cities
        Route::get('/workshop-cities', [WorkshopCityController::class, 'index'])->name('workshop-cities-index');
        Route::get('/workshop-cities/create', [WorkshopCityController::class, 'create'])->name('workshop-cities-create');
        Route::post('/workshop-cities/store', [WorkshopCityController::class, 'store'])->name('workshop-cities-store');
        Route::get('/workshop-cities/{workshopCity}/edit', [WorkshopCityController::class, 'edit'])->name('workshop-cities-edit');
        Route::put('/workshop-cities/{workshopCity}', [WorkshopCityController::class, 'update'])->name('workshop-cities-update');
        Route::post('/workshop-cities/status', [WorkshopCityController::class, 'status'])->name('workshop-cities-status');
        Route::delete('/workshop-cities/{workshopCity}', [WorkshopCityController::class, 'destroy'])->name('workshop-cities-destroy');

        // Merchandise
        Route::get('/merchandise', [MerchandiseController::class, 'index'])->name('merchandise.index');
        Route::get('/merchandise/create', [MerchandiseController::class, 'create'])->name('merchandise.create');
        Route::post('/merchandise/store', [MerchandiseController::class, 'store'])->name('merchandise.store');
        Route::get('/merchandise/{merchandise}/edit', [MerchandiseController::class, 'edit'])->name('merchandise.edit');
        Route::put('/merchandise/{merchandise}', [MerchandiseController::class, 'update'])->name('merchandise.update');
        Route::post('/merchandise/status', [MerchandiseController::class, 'status'])->name('merchandise.status');
        Route::delete('/merchandise/{merchandise}', [MerchandiseController::class, 'destroy'])->name('merchandise.destroy');

        // Workshop Registrations
        Route::get('/workshop-registrations', [WorkshopRegistrationAdminController::class, 'index'])->name('workshop-registrations.index');
        Route::get('/workshop-registrations/export', [WorkshopRegistrationAdminController::class, 'export'])->name('workshop-registrations.export');
        Route::get('/workshop-registrations/{id}', [WorkshopRegistrationAdminController::class, 'show'])->name('workshop-registrations.show');
        Route::patch('/workshop-registrations/{id}/status', [WorkshopRegistrationAdminController::class, 'updateStatus'])->name('workshop-registrations.status');

        // Workshop Schools
        Route::get('/workshop-schools', [WorkshopSchoolController::class, 'index'])->name('workshop-schools-index');
        Route::get('/workshop-schools/create', [WorkshopSchoolController::class, 'create'])->name('workshop-schools-create');
        Route::post('/workshop-schools/store', [WorkshopSchoolController::class, 'store'])->name('workshop-schools-store');
        Route::get('/workshop-schools/{workshopSchool}/edit', [WorkshopSchoolController::class, 'edit'])->name('workshop-schools-edit');
        Route::put('/workshop-schools/{workshopSchool}', [WorkshopSchoolController::class, 'update'])->name('workshop-schools-update');
        Route::post('/workshop-schools/status', [WorkshopSchoolController::class, 'status'])->name('workshop-schools-status');
        Route::delete('/workshop-schools/{workshopSchool}', [WorkshopSchoolController::class, 'destroy'])->name('workshop-schools-destroy');

        // Gallery Categories
        Route::get('/gallery-categories', [GalleryCategoryController::class, 'index'])->name('gallery-categories-index');
        Route::get('/gallery-categories/create', [GalleryCategoryController::class, 'create'])->name('gallery-categories-create');
        Route::post('/gallery-categories/store', [GalleryCategoryController::class, 'store'])->name('gallery-categories-store');
        Route::get('/gallery-categories/{galleryCategory}/edit', [GalleryCategoryController::class, 'edit'])->name('gallery-categories-edit');
        Route::put('/gallery-categories/{galleryCategory}', [GalleryCategoryController::class, 'update'])->name('gallery-categories-update');
        Route::post('/gallery-categories/status', [GalleryCategoryController::class, 'status'])->name('gallery-categories-status');
        Route::delete('/gallery-categories/{galleryCategory}', [GalleryCategoryController::class, 'destroy'])->name('gallery-categories-destroy');

        // Gallery Images
        Route::get('/gallery-images', [GalleryImageController::class, 'index'])->name('gallery-images-index');
        Route::get('/gallery-images/create', [GalleryImageController::class, 'create'])->name('gallery-images-create');
        Route::post('/gallery-images/store', [GalleryImageController::class, 'store'])->name('gallery-images-store');
        Route::get('/gallery-images/{galleryImage}/edit', [GalleryImageController::class, 'edit'])->name('gallery-images-edit');
        Route::put('/gallery-images/{galleryImage}', [GalleryImageController::class, 'update'])->name('gallery-images-update');
        Route::post('/gallery-images/status', [GalleryImageController::class, 'status'])->name('gallery-images-status');
        Route::delete('/gallery-images/{galleryImage}', [GalleryImageController::class, 'destroy'])->name('gallery-images-destroy');

        // Stats
        Route::get('/stats', [StatController::class, 'index'])->name('stats-index');
        Route::get('/stats/create', [StatController::class, 'create'])->name('stats-create');
        Route::post('/stats/store', [StatController::class, 'store'])->name('stats-store');
        Route::get('/stats/{stat}/edit', [StatController::class, 'edit'])->name('stats-edit');
        Route::put('/stats/{stat}', [StatController::class, 'update'])->name('stats-update');
        Route::post('/stats/status', [StatController::class, 'status'])->name('stats-status');
        Route::delete('/stats/{stat}', [StatController::class, 'destroy'])->name('stats-destroy');

        // About Section
        Route::get('/about-section', [AboutSectionController::class, 'index'])->name('about-section-index');
        Route::get('/about-section/create', [AboutSectionController::class, 'create'])->name('about-section-create');
        Route::post('/about-section/store', [AboutSectionController::class, 'store'])->name('about-section-store');
        Route::get('/about-section/{aboutSection}/edit', [AboutSectionController::class, 'edit'])->name('about-section-edit');
        Route::put('/about-section/{aboutSection}', [AboutSectionController::class, 'update'])->name('about-section-update');

        // Themes
        Route::get('/themes', [ThemeController::class, 'adminIndex'])->name('themes.index');
        Route::get('/themes/create', [ThemeController::class, 'create'])->name('themes.create');
        Route::post('/themes/store', [ThemeController::class, 'store'])->name('themes.store');
        Route::get('/themes/edit/{id}', [ThemeController::class, 'edit'])->name('themes.edit');
        Route::post('/themes/update/{id}', [ThemeController::class, 'update'])->name('themes.update');
        Route::delete('/themes/delete/{id}', [ThemeController::class, 'destroy'])->name('themes.delete');

        // Summer Events
        Route::get('summer-events', [SummerEventController::class, 'index'])->name('summer-events.index');
        Route::get('summer-events/create', [SummerEventController::class, 'create'])->name('summer-events.create');
        Route::post('summer-events', [SummerEventController::class, 'store'])->name('summer-events.store');
        Route::post('summer-events/status', [SummerEventController::class, 'status'])->name('summer-events.status');
        Route::get('summer-events/{id}', [SummerEventController::class, 'show'])->name('summer-events.show');
        Route::get('summer-events/{id}/edit', [SummerEventController::class, 'edit'])->name('summer-events.edit');
        Route::put('summer-events/{id}', [SummerEventController::class, 'update'])->name('summer-events.update');
        Route::delete('summer-events/{id}', [SummerEventController::class, 'destroy'])->name('summer-events.destroy');

        // Summer Sub Events
        Route::get('summer-events/{event_id}/sub-events', [SummerSubEventController::class, 'index'])->name('summer-sub-events.index');
        Route::get('summer-events/{event_id}/sub-events/create', [SummerSubEventController::class, 'create'])->name('summer-sub-events.create');
        Route::post('summer-events/{event_id}/sub-events', [SummerSubEventController::class, 'store'])->name('summer-sub-events.store');
        Route::get('summer-sub-events/{id}/edit', [SummerSubEventController::class, 'edit'])->name('summer-sub-events.edit');
        Route::put('summer-sub-events/{id}', [SummerSubEventController::class, 'update'])->name('summer-sub-events.update');
        Route::delete('summer-sub-events/{id}', [SummerSubEventController::class, 'destroy'])->name('summer-sub-events.destroy');
        Route::post('summer-sub-events/status', [SummerSubEventController::class, 'status'])->name('summer-sub-events.status');

        // Summer Camp Partners
        Route::get('summer-partners', [SummerPartnerController::class, 'index'])->name('summer-partners.index');
        Route::get('summer-partners/create', [SummerPartnerController::class, 'create'])->name('summer-partners.create');
        Route::post('summer-partners', [SummerPartnerController::class, 'store'])->name('summer-partners.store');
        Route::post('summer-partners/status', [SummerPartnerController::class, 'status'])->name('summer-partners.status');
        Route::get('summer-partners/{partner}/edit', [SummerPartnerController::class, 'edit'])->name('summer-partners.edit');
        Route::put('summer-partners/{partner}', [SummerPartnerController::class, 'update'])->name('summer-partners.update');
        Route::delete('summer-partners/{partner}', [SummerPartnerController::class, 'destroy'])->name('summer-partners.destroy');

        // Summer Camp Partner Categories
        Route::get('summer-partner-categories', [SummerPartnerCategoryController::class, 'index'])->name('summer-partner-categories.index');
        Route::get('summer-partner-categories/create', [SummerPartnerCategoryController::class, 'create'])->name('summer-partner-categories.create');
        Route::post('summer-partner-categories', [SummerPartnerCategoryController::class, 'store'])->name('summer-partner-categories.store');
        Route::post('summer-partner-categories/status', [SummerPartnerCategoryController::class, 'status'])->name('summer-partner-categories.status');
        Route::get('summer-partner-categories/{summerPartnerCategory}/edit', [SummerPartnerCategoryController::class, 'edit'])->name('summer-partner-categories.edit');
        Route::put('summer-partner-categories/{summerPartnerCategory}', [SummerPartnerCategoryController::class, 'update'])->name('summer-partner-categories.update');
        Route::delete('summer-partner-categories/{summerPartnerCategory}', [SummerPartnerCategoryController::class, 'destroy'])->name('summer-partner-categories.destroy');

        // School Sections (parent pages like Curriculum, DFD)
        Route::get('school-sections', [SchoolSectionController::class, 'index'])->name('school-sections.index');
        Route::get('school-sections/create', [SchoolSectionController::class, 'create'])->name('school-sections.create');
        Route::post('school-sections', [SchoolSectionController::class, 'store'])->name('school-sections.store');
        Route::post('school-sections/status', [SchoolSectionController::class, 'status'])->name('school-sections.status');
        Route::get('school-sections/{schoolSection}/edit', [SchoolSectionController::class, 'edit'])->name('school-sections.edit');
        Route::put('school-sections/{schoolSection}', [SchoolSectionController::class, 'update'])->name('school-sections.update');
        Route::delete('school-sections/{schoolSection}', [SchoolSectionController::class, 'destroy'])->name('school-sections.destroy');

        // School Partners (under sections)
        Route::get('school-partners', [SchoolPartnerController::class, 'index'])->name('school-partners.index');
        Route::get('school-partners/create', [SchoolPartnerController::class, 'create'])->name('school-partners.create');
        Route::post('school-partners', [SchoolPartnerController::class, 'store'])->name('school-partners.store');
        Route::post('school-partners/status', [SchoolPartnerController::class, 'status'])->name('school-partners.status');
        Route::get('school-partners/{schoolPartner}/edit', [SchoolPartnerController::class, 'edit'])->name('school-partners.edit');
        Route::put('school-partners/{schoolPartner}', [SchoolPartnerController::class, 'update'])->name('school-partners.update');
        Route::delete('school-partners/{schoolPartner}', [SchoolPartnerController::class, 'destroy'])->name('school-partners.destroy');

        // School Partner Categories
        Route::get('school-partner-categories', [SchoolPartnerCategoryController::class, 'index'])->name('school-partner-categories.index');
        Route::get('school-partner-categories/create', [SchoolPartnerCategoryController::class, 'create'])->name('school-partner-categories.create');
        Route::post('school-partner-categories', [SchoolPartnerCategoryController::class, 'store'])->name('school-partner-categories.store');
        Route::post('school-partner-categories/status', [SchoolPartnerCategoryController::class, 'status'])->name('school-partner-categories.status');
        Route::get('school-partner-categories/{schoolPartnerCategory}/edit', [SchoolPartnerCategoryController::class, 'edit'])->name('school-partner-categories.edit');
        Route::put('school-partner-categories/{schoolPartnerCategory}', [SchoolPartnerCategoryController::class, 'update'])->name('school-partner-categories.update');
        Route::delete('school-partner-categories/{schoolPartnerCategory}', [SchoolPartnerCategoryController::class, 'destroy'])->name('school-partner-categories.destroy');

        Route::get('action-items', [ActionItemController::class, 'index'])->name('action-items.index');
        Route::get('action-items/create', [ActionItemController::class, 'create'])->name('action-items.create');
        Route::post('action-items', [ActionItemController::class, 'store'])->name('action-items.store');
        Route::get('action-items/{id}/edit', [ActionItemController::class, 'edit'])->name('action-items.edit');
        Route::put('action-items/{id}', [ActionItemController::class, 'update'])->name('action-items.update');
        Route::delete('action-items/{id}', [ActionItemController::class, 'destroy'])->name('action-items.destroy');
        Route::post('action-items/status', [ActionItemController::class, 'status'])->name('action-items.status');

        //Gallerycategories
        Route::resource('galleryCategories', \App\Http\Controllers\admin\GalleryCategoryController::class);

        Route::resource('galleries', \App\Http\Controllers\admin\GalleryController::class);

        // ── Chatbot FAQ Management ──────────────────────────────────────────────
        Route::get('chatbot/faq', [ChatbotFaqController::class, 'index'])->name('admin.chatbot-faq');
        Route::get('chatbot/faq/create', [ChatbotFaqController::class, 'create'])->name('admin.chatbot-faq-create');
        Route::post('chatbot/faq/store', [ChatbotFaqController::class, 'store'])->name('admin.chatbot-faq-store');
        Route::get('chatbot/faq/{id}/edit', [ChatbotFaqController::class, 'edit'])->name('admin.chatbot-faq-edit');
        Route::post('chatbot/faq/{id}/update', [ChatbotFaqController::class, 'update'])->name('admin.chatbot-faq-update');
        Route::get('chatbot/faq/{id}/destroy', [ChatbotFaqController::class, 'destroy'])->name('admin.chatbot-faq-destroy');
        Route::post('chatbot/faq/toggle-status', [ChatbotFaqController::class, 'toggleStatus'])->name('admin.chatbot-faq-status');

        // ── Chatbot Support Tickets ─────────────────────────────────────────────
        Route::get('chatbot/tickets', [ChatbotSupportTicketController::class, 'index'])->name('admin.chatbot-tickets');
        Route::get('chatbot/tickets/{id}', [ChatbotSupportTicketController::class, 'show'])->name('admin.chatbot-tickets-show');
        Route::post('chatbot/tickets/{id}/status', [ChatbotSupportTicketController::class, 'updateStatus'])->name('admin.chatbot-tickets-status');
        Route::get('chatbot/tickets/{id}/destroy', [ChatbotSupportTicketController::class, 'destroy'])->name('admin.chatbot-tickets-destroy');
        Route::get('chatbot/tickets/new-count', [ChatbotSupportTicketController::class, 'newCount'])->name('admin.chatbot-tickets-count');

        Route::get('payments/', [App\Http\Controllers\admin\PaymentController::class, 'index'])->name('payments.index');

        Route::get('payments/{id}', [App\Http\Controllers\admin\PaymentController::class, 'show'])->name('payments.show');

        // Filter by type
        Route::get('payments/type/{type}', [App\Http\Controllers\admin\PaymentController::class, 'byType'])
            ->name('byType')
            ->where('type', '(course_enrollment|workshop_registration|event_registration|subscription|other)');

        // Statistics endpoint (for charts/analytics)
        Route::get('payments/statistics/{period?}', [App\Http\Controllers\admin\PaymentController::class, 'statistics'])
            ->name('payments.statistics')
            ->where('period', '(day|week|month|year)');

        // Export to CSV
        Route::get('payments/export/csv', [App\Http\Controllers\admin\PaymentController::class, 'export'])->name('payments.export');

        // Delete payment record
        Route::delete('payments/{id}', [App\Http\Controllers\admin\PaymentController::class, 'destroy'])->name('payments.destroy');
    });
});
use App\Services\EmailService;

Route::get('/test-mail', function () {
    app(EmailService::class)->send(
        'event-registration-confirmation',
        'your-email@gmail.com', // 👈 put your real email
        [
            'student_name' => 'Test User',
            'event_name' => 'Test Event',
            'reference_id' => '12345',
            'amount' => '₹100',
            'payment_id' => 'TEST123',
        ],
    );

    return 'Mail sent!';
});

// ── Dynamic school section pages (placed LAST to avoid shadowing other routes) ──
// URL: /{section-slug}              e.g. /curriculum, /dfd
// URL: /{section-slug}/{cat-slug}   e.g. /curriculum/cbse-schools, /dfd/icse-schools
Route::get('/{section:slug}', [SummerController::class, 'schoolSection'])
    ->name('school.section')
    ->where('section', '[a-z0-9\-]+');

Route::get('/{section:slug}/{category:slug}', [SummerController::class, 'schoolSectionCategory'])
    ->name('school.section.category')
    ->where(['section' => '[a-z0-9\-]+', 'category' => '[a-z0-9\-]+']);
