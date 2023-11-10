<?php

use App\Models\Donor;
use Illuminate\Support\Facades\Route;
use Twilio\TwiML\Video\Room;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

Route::get('/clear', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    echo "Clear All";
});

Route::prefix('ticket')->group(function () {
    Route::post('/create', 'TicketController@storeSupportTicket')->name('ticket.store');
    Route::get('/view/{ticket}', 'TicketController@viewTicket')->name('ticket.view');
    Route::post('/reply/{ticket}', 'TicketController@replyTicket')->name('ticket.reply');
    Route::get('/download/{ticket}', 'TicketController@ticketDownload')->name('ticket.download');
});

Route::namespace('Donor')->prefix('donor')->name('donor.')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::get('/', 'LoginController@showLoginForm')->name('login');
        Route::post('/', 'LoginController@login')->name('login.save');
        Route::get('logout', 'LoginController@logout')->name('logout');
        // Donor Password Reset
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        Route::post('password/reset', 'ForgotPasswordController@sendResetCodeEmail');
        Route::post('password/verify-code', 'ForgotPasswordController@verifyCode')->name('password.verify.code');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.form');
        Route::post('password/reset/change', 'ResetPasswordController@reset')->name('password.change');
    });
    Route::group(['middleware' => ['donor']], function () {
        Route::get('dashboard', 'DonorController@dashboard')->name('dashboard');
        Route::get('profile', 'DonorController@profile')->name('profile');
        Route::post('profile', 'DonorController@profileUpdate')->name('profile.update');
        Route::get('password', 'DonorController@password')->name('password');
        Route::post('password', 'DonorController@passwordUpdate')->name('password.update');

        // Route::get('donor/list', 'ManageDonorController@index')->name('donor.index');
        // Route::get('donor/pending', 'ManageDonorController@pending')->name('donor.pending');
        // Route::get('donor/approved', 'ManageDonorController@approved')->name('donor.approved');
        // Route::get('donor/banned', 'ManageDonorController@banned')->name('donor.banned');
        // Route::get('donor/create', 'ManageDonorController@create')->name('donor.create');
        // Route::post('donor/store', 'ManageDonorController@store')->name('donor.store');
        // Route::get('donor/edit/{id}', 'ManageDonorController@edit')->name('donor.edit');
        // Route::post('donor/update/{id}', 'ManageDonorController@update')->name('donor.update');
        // Route::post('donor/approved/status', 'ManageDonorController@approvedStatus')->name('donor.approved.status');
        // Route::post('donor/banned/status', 'ManageDonorController@bannedStatus')->name('donor.banned.status');
        // Route::get('donor/search', 'ManageDonorController@search')->name('donor.search');
        // Route::get('donor/blood/search', 'ManageDonorController@donorBloodSearch')->name('donor.blood.search');
        // Route::post('donor/featured/list/Include', 'ManageDonorController@featuredInclude')->name('donor.featured.include');
        // Route::post('donor/featured/list/remove', 'ManageDonorController@featuredNotInclude')->name('donor.featured.remove');

        // Route::get('blood/list', 'BloodController@index')->name('blood.index');
        // Route::post('blood/store', 'BloodController@store')->name('blood.store');
        // Route::post('blood/update', 'BloodController@update')->name('blood.update');

        // Route::get('location/list', 'LocationController@index')->name('location.index');
        // Route::post('location/store', 'LocationController@store')->name('location.store');
        // Route::post('location/update', 'LocationController@update')->name('location.update');

        // Route::get('city/list', 'CityController@index')->name('city.index');
        // Route::post('city/store', 'CityController@store')->name('city.store');
        // Route::post('city/update', 'CityController@update')->name('city.update');

        // Refer Routes
        Route::get('referer/list', 'RefererController@index')->name('referer.index');

        // Blood Request
        Route::get('blood-request/list', 'BloodRequestController@index')->name('blood-request.index');
        Route::get('blood-request/create', 'BloodRequestController@create')->name('blood-request.create');
        Route::post('blood-request/store', 'BloodRequestController@store')->name('blood-request.store');
        Route::get('blood-request/edit/{id}', 'BloodRequestController@edit')->name('blood-request.edit');
        Route::post('blood-request/update/{id}', 'BloodRequestController@update')->name('blood-request.update');

        //Division->City->Upazila
        Route::post('api/fetch-cities', 'DonorController@fetchCity')->name('fetchcity');
        Route::post('api/fetch-locations', 'DonorController@fetchLocation')->name('fetchlocation');
    });
});

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::get('/login-panel', 'LoginController@showLoginForm')->name('login');
        Route::post('/login-panel', 'LoginController@login')->name('login.save');
        Route::get('logout', 'LoginController@logout')->name('logout');
        // Admin Password Reset
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        Route::post('password/reset', 'ForgotPasswordController@sendResetCodeEmail');
        Route::post('password/verify-code', 'ForgotPasswordController@verifyCode')->name('password.verify.code');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.form');
        Route::post('password/reset/change', 'ResetPasswordController@reset')->name('password.change');
    });

    Route::middleware('admin')->group(function () {
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('profile', 'AdminController@profile')->name('profile');
        Route::post('profile', 'AdminController@profileUpdate')->name('profile.update');
        Route::get('password', 'AdminController@password')->name('password');
        Route::post('password', 'AdminController@passwordUpdate')->name('password.update');

        //Blood
        Route::get('blood/list', 'BloodController@index')->name('blood.index');
        Route::post('blood/store', 'BloodController@store')->name('blood.store');
        Route::post('blood/update', 'BloodController@update')->name('blood.update');

        //Advertisement
        Route::get('advertisement/list', 'AdvertisementController@index')->name('ads.index');
        Route::get('advertisement/edit/{id}', 'AdvertisementController@edit')->name('ads.edit');
        Route::post('advertisement/store', 'AdvertisementController@store')->name('ads.store');
        Route::post('advertisement/update/{id}', 'AdvertisementController@update')->name('ads.update');
        Route::post('advertisement/delete', 'AdvertisementController@delete')->name('ads.delete');

        //Location
        Route::get('location/list', 'LocationController@index')->name('location.index');
        Route::post('location/store', 'LocationController@store')->name('location.store');
        Route::post('location/update', 'LocationController@update')->name('location.update');

        //City
        Route::get('city/list', 'CityController@index')->name('city.index');
        Route::post('city/store', 'CityController@store')->name('city.store');
        Route::post('city/update', 'CityController@update')->name('city.update');

        //Division
        Route::get('division/list', 'DivisionController@index')->name('division.index');
        Route::post('division/store', 'DivisionController@store')->name('division.store');
        Route::post('division/update', 'DivisionController@update')->name('division.update');

        // Donor
        Route::get('donor/list', 'ManageDonorController@index')->name('donor.index');
        Route::get('donor/pending', 'ManageDonorController@pending')->name('donor.pending');
        Route::get('donor/approved', 'ManageDonorController@approved')->name('donor.approved');
        Route::get('donor/banned', 'ManageDonorController@banned')->name('donor.banned');
        Route::get('donor/referer', 'ManageDonorController@referer')->name('donor.referer');

        Route::get('donor/create', 'ManageDonorController@create')->name('donor.create');

        Route::post('donor/store', 'ManageDonorController@store')->name('donor.store');

        Route::get('donor/edit/{id}', 'ManageDonorController@edit')->name('donor.edit');
        Route::post('donor/update/{id}', 'ManageDonorController@update')->name('donor.update');
        Route::post('donor/approved/status', 'ManageDonorController@approvedStatus')->name('donor.approved.status');
        Route::post('donor/banned/status', 'ManageDonorController@bannedStatus')->name('donor.banned.status');
        Route::get('donor/search', 'ManageDonorController@search')->name('donor.search');
        Route::get('donor/search-data', 'ManageDonorController@searchData')->name('donor.search.data');
        Route::get('donor/blood/search', 'ManageDonorController@donorBloodSearch')->name('donor.blood.search');
        Route::post('donor/featured/list/Include', 'ManageDonorController@featuredInclude')->name('donor.featured.include');
        Route::post('donor/featured/list/remove', 'ManageDonorController@featuredNotInclude')->name('donor.featured.remove');

        // Blood Request
        Route::get('blood-request/list', 'BloodRequestController@index')->name('blood-request.index');
        Route::get('blood-request/create', 'BloodRequestController@create')->name('blood-request.create');
        Route::post('blood-request/store', 'BloodRequestController@store')->name('blood-request.store');
        Route::get('blood-request/edit/{id}', 'BloodRequestController@edit')->name('blood-request.edit');
        Route::post('blood-request/update/{id}', 'BloodRequestController@update')->name('blood-request.update');
        Route::post('blood-request/delete', 'BloodRequestController@destroy')->name('blood-request.delete');

        //Report Bugs
        Route::get('request-report', 'AdminController@requestReport')->name('request.report');
        Route::post('request-report', 'AdminController@reportSubmit');
        Route::get('system-info', 'AdminController@systemInfo')->name('system.info');

        // Subscriber
        Route::get('subscriber', 'SubscriberController@index')->name('subscriber.index');
        Route::get('subscriber/send-email', 'SubscriberController@sendEmailForm')->name('subscriber.sendEmail');
        Route::post('subscriber/remove', 'SubscriberController@remove')->name('subscriber.remove');
        Route::post('subscriber/send-email', 'SubscriberController@sendEmail')->name('subscriber.sendEmail.save');

        // Admin Support
        Route::get('tickets', 'SupportTicketController@tickets')->name('ticket');
        Route::get('tickets/pending', 'SupportTicketController@pendingTicket')->name('ticket.pending');
        Route::get('tickets/closed', 'SupportTicketController@closedTicket')->name('ticket.closed');
        Route::get('tickets/answered', 'SupportTicketController@answeredTicket')->name('ticket.answered');
        Route::get('tickets/view/{id}', 'SupportTicketController@ticketReply')->name('ticket.view');
        Route::post('ticket/reply/{id}', 'SupportTicketController@ticketReplySend')->name('ticket.reply');
        Route::get('ticket/download/{ticket}', 'SupportTicketController@ticketDownload')->name('ticket.download');
        Route::post('ticket/delete', 'SupportTicketController@ticketDelete')->name('ticket.delete');

        // Language Manager
        Route::get('/language', 'LanguageController@langManage')->name('language.manage');
        Route::post('/language', 'LanguageController@langStore')->name('language.manage.store');
        Route::post('/language/delete/{id}', 'LanguageController@langDel')->name('language.manage.del');
        Route::post('/language/update/{id}', 'LanguageController@langUpdate')->name('language.manage.update');
        Route::get('/language/edit/{id}', 'LanguageController@langEdit')->name('language.key');
        Route::post('/language/import', 'LanguageController@langImport')->name('language.importLang');

        Route::post('language/store/key/{id}', 'LanguageController@storeLanguageJson')->name('language.store.key');
        Route::post('language/delete/key/{id}', 'LanguageController@deleteLanguageJson')->name('language.delete.key');
        Route::post('language/update/key/{id}', 'LanguageController@updateLanguageJson')->name('language.update.key');

        // General Setting
        Route::get('general-setting', 'GeneralSettingController@index')->name('setting.index');
        Route::post('general-setting', 'GeneralSettingController@update')->name('setting.update');
        Route::get('optimize', 'GeneralSettingController@optimize')->name('setting.optimize');

        // Logo-Icon
        Route::get('setting/logo-icon', 'GeneralSettingController@logoIcon')->name('setting.logo.icon');
        Route::post('setting/logo-icon', 'GeneralSettingController@logoIconUpdate')->name('setting.logo.icon.save');

        //Custom CSS
        Route::get('custom-css', 'GeneralSettingController@customCss')->name('setting.custom.css');
        Route::post('custom-css', 'GeneralSettingController@customCssSubmit');

        //Cookie
        Route::get('cookie', 'GeneralSettingController@cookie')->name('setting.cookie');
        Route::post('cookie', 'GeneralSettingController@cookieSubmit');

        // Plugin
        Route::get('extensions', 'ExtensionController@index')->name('extensions.index');
        Route::post('extensions/update/{id}', 'ExtensionController@update')->name('extensions.update');
        Route::post('extensions/activate', 'ExtensionController@activate')->name('extensions.activate');
        Route::post('extensions/deactivate', 'ExtensionController@deactivate')->name('extensions.deactivate');

        // Email Setting
        Route::get('email-template/global', 'EmailTemplateController@emailTemplate')->name('email.template.global');
        Route::post('email-template/global', 'EmailTemplateController@emailTemplateUpdate')->name('email.template.global.save');
        Route::get('email-template/setting', 'EmailTemplateController@emailSetting')->name('email.template.setting');
        Route::post('email-template/setting', 'EmailTemplateController@emailSettingUpdate')->name('email.template.setting.save');
        Route::get('email-template/index', 'EmailTemplateController@index')->name('email.template.index');
        Route::get('email-template/{id}/edit', 'EmailTemplateController@edit')->name('email.template.edit');
        Route::post('email-template/{id}/update', 'EmailTemplateController@update')->name('email.template.update');
        Route::post('email-template/send-test-mail', 'EmailTemplateController@sendTestMail')->name('email.template.test.mail');

        // SMS Setting
        Route::get('sms-template/global', 'SmsTemplateController@smsTemplate')->name('sms.template.global');
        Route::post('sms-template/global', 'SmsTemplateController@smsTemplateUpdate')->name('sms.template.global.save');
        Route::get('sms-template/setting', 'SmsTemplateController@smsSetting')->name('sms.templates.setting');
        Route::post('sms-template/setting', 'SmsTemplateController@smsSettingUpdate')->name('sms.template.setting');
        Route::get('sms-template/index', 'SmsTemplateController@index')->name('sms.template.index');
        Route::get('sms-template/edit/{id}', 'SmsTemplateController@edit')->name('sms.template.edit');
        Route::post('sms-template/update/{id}', 'SmsTemplateController@update')->name('sms.template.update');
        Route::post('email-template/send-test-sms', 'SmsTemplateController@sendTestSMS')->name('sms.template.test.sms');

        // SEO
        Route::get('seo', 'FrontendController@seoEdit')->name('seo');

        // Frontend
        Route::name('frontend.')->prefix('frontend')->group(function () {
            Route::get('templates', 'FrontendController@templates')->name('templates');
            Route::post('templates', 'FrontendController@templatesActive')->name('templates.active');

            Route::get('frontend-sections/{key}', 'FrontendController@frontendSections')->name('sections');
            Route::post('frontend-content/{key}', 'FrontendController@frontendContent')->name('sections.content');
            Route::get('frontend-element/{key}/{id?}', 'FrontendController@frontendElement')->name('sections.element');
            Route::post('remove', 'FrontendController@remove')->name('remove');

            // Page Builder
            Route::get('manage-pages', 'PageBuilderController@managePages')->name('manage.pages');
            Route::post('manage-pages', 'PageBuilderController@managePagesSave')->name('manage.pages.save');
            Route::post('manage-pages/update', 'PageBuilderController@managePagesUpdate')->name('manage.pages.update');
            Route::post('manage-pages/delete', 'PageBuilderController@managePagesDelete')->name('manage.pages.delete');
            Route::get('manage-section/{id}', 'PageBuilderController@manageSection')->name('manage.section');
            Route::post('manage-section/{id}', 'PageBuilderController@manageSectionUpdate')->name('manage.section.update');
        });
    });
});

Route::post('/comments', 'CommentController@store')->name('comments');
Route::post('/blog-comments', 'CommentController@blogcommentStore')->name('blog.comments');
Route::post('/bloodrequest-comments', 'CommentController@bloodrequestcommentStore')->name('bloodrequest.comments');
Route::post('/delete-comment', 'CommentController@destroy')->name('delete.comments');
Route::post('/donor-delete-comment', 'CommentController@dcdestroy')->name('donor.delete.comments');

Route::get('/donor-list', 'SiteController@donor')->name('donor.list');
Route::get('donor-list/{slug}/{id}', 'SiteController@donorDetails')->name('donor.details');
Route::get('/donor-list/search', 'SiteController@donorSearch')->name('donor.search');
Route::post('/donor-list/contact', 'SiteController@contactWithDonor')->name('donor.contact');
Route::get('/blood/donor/{slug}/{id}', 'SiteController@bloodGroup')->name('blood.group.donor');
Route::get('/contact', 'SiteController@contact')->name('contact');
Route::post('/contact', 'SiteController@contactSubmit');

Route::get('/change/{lang?}', 'SiteController@changeLanguage')->name('lang');
Route::get('/cookie/accept', 'SiteController@cookieAccept')->name('cookie.accept');

Route::get('/blog', 'SiteController@blog')->name('blog');
Route::get('blog/{id}/{slug}', 'SiteController@blogDetails')->name('blog.details');

Route::get('/blood-request', 'SiteController@bloodRequest')->name('bloodrequest');
Route::get('blood-request/{id}', 'SiteController@bloodRequestDetails')->name('bloodrequest.details');

Route::get('placeholder-image/{size}', 'SiteController@placeholderImage')->name('placeholder.image');
Route::get('/', 'SiteController@index')->name('home');

Route::get('/apply/donor', 'SiteController@applyDonor')->name('apply.donor');
Route::post('/apply/donor/store', 'SiteController@applyDonorstore')->name('apply.donor.store');
Route::get('/verify-account', 'SiteController@verifyaccount')->name('verifyAccount');
Route::post('/verifyotp', 'SiteController@useractivation')->name('verifyotp');


Route::post('api/fetch-cities', 'SiteController@fetchCity')->name('fetchcity');
Route::post('api/fetch-locations', 'SiteController@fetchLocation')->name('fetchlocation');

Route::get('/menu/{slug}/{id}', 'SiteController@footerMenu')->name('footer.menu');
Route::get('/add/{id}', 'SiteController@adclicked')->name('add.clicked');
Route::post('/subscribe', 'SiteController@subscribe')->name('subscribe');

Route::get('/sitemap.xml', function () {
    $donors = \App\Models\Donor::all();
    $sitemap = Sitemap::create();

    // Add URLs to the sitemap
    $sitemap->add(Url::create('/'));
    $sitemap->add(Url::create('/about-us'));
    $sitemap->add(Url::create('/blog'));
    $sitemap->add(Url::create('/blood-request'));
    $sitemap->add(Url::create('/contact'));
    $sitemap->add(Url::create('/donor-list'));

    foreach ($donors as $donor) {
        $sitemap->add('donor-list/' . slug($donor->name) . '/' .  $donor->id);
    }

    $sitemap->add(Url::create('/menu/privacy-policy/42'));
    $sitemap->add(Url::create('/menu/terms-of-service/43'));
    // Generate the sitemap
    return $sitemap->toResponse('sitemap.xml');
});

Route::get('/sms-page', 'SiteController@sms_page')->name('sms.page');
Route::post('/send-sms', 'SiteController@send_sms')->name('send.sms');
Route::get('/{slug}', 'SiteController@pages')->name('pages');
