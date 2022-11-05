<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//Home page
Route::get('/', function () {
    return view('auth/login');
});

Route::get('/reset_password', 'PasswordResetController@index')->name('resetPassword');
Route::post('/reset_password', 'PasswordResetController@search_user')->name('getUser');
Route::post('/reset_password/confirmed', 'PasswordResetController@update')->name('password_reset');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('change_password', 'PasswordChangeController');
    Route::get('/changed_password', 'PasswordChangeController@create');

});


Route::group(['middleware' => 'auth', 'middleware' => ['role:supadmin|salescenter|servicepoint']], function () {
    Route::post('/chk_disclaimer', 'HomeController@disclaimer')->name('chk_disclaimer');
    Route::resource('sales', 'SaleController');
    Route::post('/get_fscode', 'SaleController@get_fs')->name('get_fscode');
    Route::post('/get_device_info', 'SaleController@get_device_info')->name('get_device_info');
    Route::post('/get_service_type_price_range', 'SaleController@get_service_type_price_range')->name('get_service_type_price_range');
    Route::post('/sales_report', 'SaleController@date_wise_sales_report')->name('sales_report');
    Route::post('/get_mrp', 'SaleController@get_mrp')->name('get_mrp');
    Route::post('/get_model', 'SaleController@get_model')->name('get_model');
    Route::post('/get_models', 'SaleController@get_models')->name('get_models');
    Route::post('/get_imei_info', 'SaleController@get_info_by_imei')->name('get_imei_info');
});

Route::group(['namespace' => 'Admin', 'middleware' => 'auth', 'middleware' => ['role:supadmin|servicepoint|callcenter']], function () {
    Route::post('/chk_service_disclaimer', 'ServicePointController@disclaimer_service')->name('chk_service_disclaimer');
    Route::resource('servicepoint', 'ServicePointController');
    Route::post('servicepoint', 'ServicePointController@search')->name('search');
    Route::post('servicepoint/search_by_phone_number', 'ServicePointController@search_by_phone_number')->name('search_by_phone');
    Route::post('servicepoint/search_by_serviceType', 'ServicePointController@search_by_serviceType')->name('search_by_service_type');
    Route::post('servicepoint/record_history', 'ServicePointController@store')->name('record_history');
    Route::post('servicepoint/delivery', 'ServicePointController@handset_delivery')->name('delivery');
    Route::post('servicepoint/notification', 'ServicePointController@send_early_notification')->name('notification');
    Route::post('servicepoint/verify', 'ServicePointController@verify')->name('verify_otp');
    Route::post('servicepoint/displayImage', 'ServicePointController@display_sales_image')->name('displayImage');
});

Route::group(['namespace' => 'Admin', 'middleware' => 'auth', 'middleware' => ['role:supadmin|admin|subadmin']], function () {
    Route::get('/total_sale', 'ReportController@total_sale')->name('total');
    Route::post('/total_sale', 'ReportController@total_sale_report')->name('total_sale_report');
    Route::get('/store_wise', 'ReportController@store_wise')->name('store');
    Route::post('/store_wise', 'ReportController@store_wise_report')->name('store_wise_report');
    Route::get('/date_wise', 'ReportController@date_wise')->name('date');
    Route::post('/date_wise', 'ReportController@date_wise_report_search')->name('date_wise_reaport');
    Route::get('/date_wise_log', 'ReportController@date_wise_log')->name('logdate');
    Route::post('/date_wise_log', 'ReportController@date_wise_log_report_search')->name('date_wise_log_reaport');
    Route::get('/imei_wise', 'ReportController@imei_wise')->name('imei');
    Route::post('/imei_wise', 'ReportController@imei_wise_report')->name('imei_wise_report');
    Route::get('/imei_wise_delete', 'ReportController@imei_wise_delete')->name('imeidelete');
    Route::post('/imei_wise_delete', 'ReportController@imei_wise_delete_report')->name('imei_wise_delete_report');
    Route::get('/head_office', 'ReportController@date_wise')->name('head');
    Route::post('/showImage', 'ReportController@display_image')->name('show_image');
    Route::post('/deleteSale/{fscode}/{imei}', 'ReportController@delete_sale')->name('delete_sale');
    Route::post('/deleteSales/{imei}', 'ReportController@delete_sales')->name('delete_sales');

});


Route::group(['namespace' => 'Admin', 'middleware' => 'auth', 'middleware' => ['role:supadmin']], function () {
    Route::resource('users', 'UsersController');
    Route::resource('permission', 'PermissionController');
    Route::resource('roles', 'RolesController');
    Route::resource('outlet', 'OutletController');
    Route::resource('import', 'ImportExportController');
    Route::delete('import', 'ImportExportController@destroy_all')->name('delete_all');
    Route::resource('txtimport', 'TxtFileImportController');
    Route::delete('txtimport', 'TxtFileImportController@destroy_all')->name('txt_delete_all');
    Route::resource('download', 'FileDownloadController');
    Route::resource('imeichange', 'ImeiChangeController');
    Route::post('/imeichange', 'ImeiChangeController@get_details_by_imei')->name('imeidetail');
    Route::get('/extractfile', 'FileExtractionController@index')->name('file_extraction');
    Route::post('/extractfile', 'FileExtractionController@fileExtraction')->name('file_extraction');
    Route::resource('tiers', 'TierController');
    Route::resource('phone_models', 'PhoneModelController');
    Route::resource('phone_brands', 'PhoneBrandController');
    Route::resource('service', 'ServiceController');
    Route::resource('import_imei', 'ImeiController');
    Route::get('/download_sample_imei', 'FileDownloadController@imei_sample')->name('download_sample_imei');
    Route::get('/download_sample_bulk_user_creation', 'FileDownloadController@bulk_user_creation_sample')->name('download_sample_bulk_user_creation');
    Route::get('/bulk_user_creation', 'UsersController@get_bulk_user_creation_view')->name('create_bulk_user');
    Route::post('/bulk_user_creation', 'UsersController@bulk_user_creation')->name('bulk_user');
    Route::resource('bongoTvCodes', 'BongoTvCodeController');
    Route::delete('bongoTvCodes', 'BongoTvCodeController@destroy_unusedCodes')->name('delete_unused_codes');
    Route::get('/download_sample_bongoTvCodes', 'FileDownloadController@bongoTvCodesSample')->name('download_sample_bongoTvCodes');
    Route::resource('fsecure', 'FSecureController');
    Route::delete('fsecure', 'FSecureController@destroy_unusedCodes')->name('delete_unused_codes');
    Route::get('/download_sample_fsecure', 'FileDownloadController@fsecureSample')->name('download_sample_fsecure');

});

Route::group(['namespace' => 'Admin', 'middleware' => 'auth', 'middleware' => ['role:supadmin|insurance|admin|subadmin']], function () {
    Route::get('/ins_sales_report', 'ReportController@insurance_sales')->name('ins_sales');
    Route::post('/ins_sales_report', 'ReportController@insurance_sales_report')->name('insurance_sales_report');
    Route::post('/insImageDisplay', 'ReportController@display_image')->name('ins_display_image');
    Route::get('/ins_service_report', 'ReportController@insurance_service')->name('ins_service');
    Route::post('/ins_service_report', 'ReportController@insurance_service_report')->name('insurance_service_report');
    Route::post('/insServiceImageDisplay', 'ReportController@ins_display_image')->name('ins_display_service_image');
});

Route::group(['namespace' => 'Admin', 'middleware' => 'auth', 'middleware' => ['role:supadmin|admin|insurance|subadmin']], function () {
    Route::get('/date_wise_claim_search', 'ReportController@get_date_wise_claim_report')->name('date_wise_claim_search');
    Route::post('/date_wise_claim_search', 'ReportController@date_wise_claim_report_search')->name('date_wise_claim_report');
});

Route::group(['namespace' => 'Admin', 'middleware' => 'auth', 'middleware' => ['role:supadmin|admin|insurance|servicepoint|callcenter']], function () {
    Route::get('/date_wise_claim_search', 'ReportController@get_date_wise_claim_report')->name('date_wise_claim_search');
    Route::post('/date_wise_claim_search', 'ReportController@date_wise_claim_report_search')->name('date_wise_claim_report');
    Route::post('/insServiceImageDisplay', 'ReportController@ins_display_image')->name('ins_display_service_image');
});

Route::group(['middleware' => 'auth', 'middleware' => ['role:supadmin|salescenter|callcenter|servicepoint']], function () {
    Route::post('/verify_sales', 'SaleController@verifyOtp')->name('otpVerify');
    Route::post('/resend_otp', 'SaleController@resendOtp')->name('resend_otp');
    Route::post('/submit_without_otp', 'SaleController@submitWithoutOtp')->name('submit_without_otp');
    Route::post('/verify_sale/{id}', 'SaleController@saleVerification')->name('sale_verification');
    Route::resource('sales', 'SaleController');
    Route::post('/sales_report', 'SaleController@date_wise_sales_report')->name('sales_report');
});
