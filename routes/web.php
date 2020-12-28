<?php

use Illuminate\Support\Facades\Route;

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




// http://domain/

Route::middleware('setWebGlobalVariable')->prefix('/')->name('web.')->group(function () {

    // home
    Route::get('/', 'Web\WebHomeController@index')->name('home.index');

    // user authentication
    Route::prefix('profile')->name('profile.')->middleware('auth:web')->group(function () {
    });
});




// http://domain/admin

Route::middleware('setAdminGlobalVariable')->prefix('admin')->name('admin.')->group(function () {

    // admin authentication
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', 'Auth\AdminLoginController@index')->name('login');
        Route::post('login', 'Auth\AdminLoginController@login');
    });

    // when the account locked
    Route::get('locked', 'Admin\AdminLockController@locked')->name('locked')->middleware('auth:admin');
    Route::post('unlock', 'Admin\AdminLockController@unlock')->name('unlock')->middleware('auth:admin');


    Route::middleware('auth:admin', 'setAdminPermission', 'lockTheAdminAccount')->group(function () {

        // log out
        Route::post('logout', 'Auth\AdminLogoutController@index')->name('logout');

        // lock the account
        Route::get('lock', 'Admin\AdminLockController@lock')->name('lock');

        // dashboard
        Route::get('/', 'Admin\AdminDashboardController@index')->name('dashboard.index');

        // admin
        Route::resource('management', 'Admin\AdminController')->except(['destroy', 'show']);
        Route::post('management/{management}/status', 'Admin\AdminController@changeIsActive')->name('management.changeIsActive');

        // -----role and permission
        Route::resource('role', 'Admin\AdminRoleController')->except('show');

        // -----logs activity
        Route::get('logsActivity', 'Admin\AdminLogsActivity@index')->name('logsActivity.index');


        // definition
        // ----------businessCategory
        Route::resource('businessCategory', 'Admin\AdminBusinessCategoryController');
        Route::get('businessCategory/{businessCategory}/create', "Admin\AdminBusinessCategoryController@createSubCategory")->name('businessCategory.createSubCategory');
        Route::post('businessCategory/{businessCategory}/store', "Admin\AdminBusinessCategoryController@storeSubCategory")->name('businessCategory.storeSubCategory');

        // ----------location
        Route::apiResource('country', 'Admin\AdminCountryController');
        Route::apiResource('country/{country}/region', 'Admin\AdminRegionController');
        Route::apiResource('region/{region}/city', 'Admin\AdminCityController');



        // notification
        Route::get('notification', 'Admin\AdminNotificationController@index')->name('notification.index');
        Route::post('notification', 'Admin\AdminNotificationController@store')->name('notification.store');
        Route::delete('notification/{notification}', 'Admin\AdminNotificationController@destroy')->name('notification.destroy');
        Route::post('notification/savePushToken', 'Admin\AdminNotificationController@savePushToken')->name('notification.savePushToken');
        Route::post('notification/removePushToken', 'Admin\AdminNotificationController@removePushToken')->name('notification.removePushToken');
        Route::get('notification/testAdmin', 'Admin\AdminNotificationController@testAdmin')->name('notification.testAdmin');


        // user
        Route::get('user', 'Admin\AdminUserController@index')->name('user.index');

        // support
        Route::get('support', 'Admin\AdminSupportController@index')->name('support.index');
        Route::get('support/{support}', 'Admin\AdminSupportController@show')->name('support.show');
        Route::post('support/{support}/response', 'Admin\AdminSupportController@response')->name('support.response');
        Route::get('support/{support}/close', 'Admin\AdminSupportController@close')->name('support.close');

        // settings
        // -------config
        Route::post('config', 'Admin\AdminConfigController@index')->name('config.index');
        Route::post('config/language', 'Admin\AdminConfigController@language')->name('config.language');

        // -------genral
        Route::get('settings', 'Admin\AdminSettingsController@index')->name('settings.index');
        Route::post('settings', 'Admin\AdminSettingsController@store');

        // -------application setting
        Route::get('application/settings', 'Admin\AdminApplicationSettingsController@index')->name('application.settings.index');
        Route::post('application/settings', 'Admin\AdminApplicationSettingsController@store')->name('application.settings.store');

        // -------contact us
        Route::get('contact', 'Admin\AdminContactController@index')->name('contact.index');
        Route::post('contact', 'Admin\AdminContactController@store')->name('contact.store');

        // -------about us
        Route::get('about', 'Admin\AdminAboutController@index')->name('about.index');
        Route::post('about', 'Admin\AdminAboutController@store')->name('about.store');

        // -------terms of service
        Route::get('termsOfService', 'Admin\AdminTermsOfServiceController@index')->name('termsOfService.index');
        Route::post('termsOfService', 'Admin\AdminTermsOfServiceController@store')->name('termsOfService.store');

        // -------faq
        Route::apiResource('faq', 'Admin\AdminFaqController');

        // -------page
        Route::apiResource('page', 'Admin\AdminPageController');

        // search
        Route::post('search/findUser', 'Admin\AdminSearchController@findUser')->name('search.findUser');
        Route::get('search/keyword', 'Admin\AdminSearchController@keyword')->name('search.keyword');
        Route::post('search/getRegions', 'Admin\AdminSearchController@getRegions')->name('search.getRegions');
        Route::post('search/getCities', 'Admin\AdminSearchController@getCities')->name('search.getCities');

        // common things
        Route::post('common/changeIsActive', 'Admin\AdminCommonController@changeIsActive')->name('common.changeIsActive');
        Route::post('common/changePriority', 'Admin\AdminCommonController@changePriority')->name('common.changePriority');
        Route::post('common/checkLinkIsUnique', 'Admin\AdminCommonController@checkLinkIsUnique')->name('common.checkLinkIsUnique');
        Route::post('common/checkMobileIsUnique', 'Admin\AdminCommonController@checkMobileIsUnique')->name('common.checkMobileIsUnique');
        Route::post('common/checkEmailIsUnique', 'Admin\AdminCommonController@checkEmailIsUnique')->name('common.checkEmailIsUnique');

        // 
    });
});

// access lang files in js files

Route::get('/js/lang', function () {
    $lang = request()->cookie('adminResourceLocale');
    $files   = glob(resource_path('lang/' . $lang . '/*.php'));
    $strings = [];
    foreach ($files as $file) {
        $name           = basename($file, '.php');
        $strings[$name] = require $file;
    }
    header('Content-Type: text/javascript');
    echo ('window.i18n = ' . json_encode($strings) . ';');
    exit();
})->name('assets.lang');
