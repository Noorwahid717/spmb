<?php

use Illuminate\Support\Facades\Route;

Route::impersonate();

Route::get('/', '\Wave\Http\Controllers\HomeController@index')->name('wave.home');
Route::get('@{username}', '\Wave\Http\Controllers\ProfileController@index')->name('wave.profile');

// Documentation routes
Route::view('docs/{page?}', 'docs::index')->where('page', '(.*)');

// Additional Auth Routes
Route::get('logout', '\Wave\Http\Controllers\Auth\LoginController@logout')->name('wave.logout');
Route::get('user/verify/{verification_code}', '\Wave\Http\Controllers\Auth\RegisterController@verify')->name('verify');
Route::post('register/complete', '\Wave\Http\Controllers\Auth\RegisterController@complete')->name('wave.register-complete');

Route::get('blog', '\Wave\Http\Controllers\BlogController@index')->name('wave.blog');
Route::get('blog/{category}', '\Wave\Http\Controllers\BlogController@category')->name('wave.blog.category');
Route::get('blog/{category}/{post}', '\Wave\Http\Controllers\BlogController@post')->name('wave.blog.post');

Route::view('install', 'wave::install')->name('wave.install');

/***** Pages *****/
Route::get('p/{page}', '\Wave\Http\Controllers\PageController@page');

/***** Pricing Page *****/
Route::view('pricing', 'theme::pricing')->name('wave.pricing');

/***** Billing Routes *****/
Route::post('paddle/webhook', '\Wave\Http\Controllers\SubscriptionController@webhook');
Route::post('checkout', '\Wave\Http\Controllers\SubscriptionController@checkout')->name('checkout');

Route::get('test', '\Wave\Http\Controllers\SubscriptionController@test');

Route::group(['middleware' => 'wave'], function () {
	Route::get('dashboard', '\Wave\Http\Controllers\DashboardController@index')->name('wave.dashboard');
	Route::get('biodata', '\Wave\Http\Controllers\BiodataController@index')->name('wave.biodata');
	Route::get('biodata-kewarganegaraan', '\Wave\Http\Controllers\BiodataController@cariKewarganegaraan')->name('wave.biodata-kewarganegaraan');
	Route::get('biodata-wilayah', '\Wave\Http\Controllers\BiodataController@cariWilayah')->name('wave.biodata-wilayah');
	Route::get('biodata-download-surat-pernyataan', '\Wave\Http\Controllers\BiodataController@downloadSuratPernyataan')->name('wave.biodata-download-surat-pernyataan');
	Route::post('biodata-update-data-pokok', '\Wave\Http\Controllers\BiodataController@updateDataPokok')->name('wave.biodata-update-data-pokok');
	Route::post('biodata-update-data-alamat', '\Wave\Http\Controllers\BiodataController@updateDataAlamat')->name('wave.biodata-update-data-alamat');
	Route::post('biodata-update-data-ortu', '\Wave\Http\Controllers\BiodataController@updateDataOrtu')->name('wave.biodata-update-data-ortu');
	Route::post('biodata-update-data-wali-ps', '\Wave\Http\Controllers\BiodataController@updateDataWaliPs')->name('wave.biodata-update-data-wali-ps');
	Route::post('biodata-update-data-riwayat-pendidikan', '\Wave\Http\Controllers\BiodataController@updateDataRiwayatPendidikan')->name('wave.biodata-update-data-riwayat-pendidikan');
	Route::post('biodata-update-data-program-studi', '\Wave\Http\Controllers\BiodataController@updateDataProgramStudi')->name('wave.biodata-update-data-program-studi');
	
	Route::get('seleksi-info', '\Wave\Http\Controllers\SeleksiController@index')->name('wave.seleksi-info');	

	Route::get('registrasi-awal', '\Wave\Http\Controllers\RegistrasiAwalController@index')->name('wave.registrasi-awal');	
	Route::post('registrasi-awal-getlist', '\Wave\Http\Controllers\RegistrasiAwalController@getList')->name('wave.registrasi-awal-getlist');	
	Route::post('update-registrasi-awal-status', '\Wave\Http\Controllers\RegistrasiAwalController@updateStatus')->name('wave.update-registrasi-awal-status');	
	
	Route::get('registrasi-ulang', '\Wave\Http\Controllers\RegistrasiUlangController@index')->name('wave.registrasi-ulang');	
	
	Route::get('tagihan-camaba', '\Wave\Http\Controllers\TagihanCamabaController@index')->name('wave.tagihan-camaba');	
	Route::post('tagihan-camaba-update-slip-pendaftaran', '\Wave\Http\Controllers\TagihanCamabaController@updateSlipPendaftaran')->name('wave.tagihan-camaba-update-slip-pendaftaran');	
	
});

Route::group(['middleware' => 'auth'], function(){
	Route::get('settings/{section?}', '\Wave\Http\Controllers\SettingsController@index')->name('wave.settings');

	Route::post('settings/profile', '\Wave\Http\Controllers\SettingsController@profilePut')->name('wave.settings.profile.put');
	Route::put('settings/security', '\Wave\Http\Controllers\SettingsController@securityPut')->name('wave.settings.security.put');

	Route::post('settings/api', '\Wave\Http\Controllers\SettingsController@apiPost')->name('wave.settings.api.post');
	Route::put('settings/api/{id?}', '\Wave\Http\Controllers\SettingsController@apiPut')->name('wave.settings.api.put');
	Route::delete('settings/api/{id?}', '\Wave\Http\Controllers\SettingsController@apiDelete')->name('wave.settings.api.delete');

	Route::get('settings/invoices/{invoice}', '\Wave\Http\Controllers\SettingsController@invoice')->name('wave.invoice');

	Route::get('notifications', '\Wave\Http\Controllers\NotificationController@index')->name('wave.notifications');
	Route::get('announcements', '\Wave\Http\Controllers\AnnouncementController@index')->name('wave.announcements');
	Route::get('announcement/{id}', '\Wave\Http\Controllers\AnnouncementController@announcement')->name('wave.announcement');
	Route::post('announcements/read', '\Wave\Http\Controllers\AnnouncementController@read')->name('wave.announcements.read');
	Route::get('notifications', '\Wave\Http\Controllers\NotificationController@index')->name('wave.notifications');
	Route::post('notification/read/{id}', '\Wave\Http\Controllers\NotificationController@delete')->name('wave.notification.read');

    /********** Checkout/Billing Routes ***********/
    Route::post('cancel', '\Wave\Http\Controllers\SubscriptionController@cancel')->name('wave.cancel');
    Route::view('checkout/welcome', 'theme::welcome');

    Route::post('subscribe', '\Wave\Http\Controllers\SubscriptionController@subscribe')->name('wave.subscribe');
	Route::view('trial_over', 'theme::trial_over')->name('wave.trial_over');
	Route::view('cancelled', 'theme::cancelled')->name('wave.cancelled');
    Route::post('switch-plans', '\Wave\Http\Controllers\SubscriptionController@switchPlans')->name('wave.switch-plans');
});

Route::group(['middleware' => 'admin.user'], function(){
    Route::view('admin/do', 'wave::do');
});
