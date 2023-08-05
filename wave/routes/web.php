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
	// route camaba
	Route::get('dashboard', '\Wave\Http\Controllers\DashboardController@index')->name('wave.dashboard');
	Route::post('dashboard-pendaftaran-grafik-by-periode', '\Wave\Http\Controllers\DashboardController@pendaftaranGrafikByPeriode')->name('wave.dashboard-pendaftaran-grafik-by-periode');
	
	// ujian 
	Route::get('do-exam-academic', '\Wave\Http\Controllers\DoExamAcademicController@index')->name('wave.do-exam-academic');
	Route::post('do-exam-academic-updatelist', '\Wave\Http\Controllers\DoExamAcademicController@updateList')->name('wave.do-exam-academic-updatelist');

	
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
	Route::post('biodata-update-data-dokumen', '\Wave\Http\Controllers\BiodataController@updateDataDokumen')->name('wave.biodata-update-data-dokumen');	
	Route::post('biodata-update-data-pernyataan', '\Wave\Http\Controllers\BiodataController@updateDataPernyataan')->name('wave.biodata-update-data-pernyataan');	
	
	Route::get('seleksi-info', '\Wave\Http\Controllers\SeleksiController@index')->name('wave.seleksi-info');	

	Route::get('tagihan-camaba', '\Wave\Http\Controllers\TagihanCamabaController@index')->name('wave.tagihan-camaba');	
	Route::post('tagihan-camaba-update-slip-pendaftaran', '\Wave\Http\Controllers\TagihanCamabaController@updateSlipPendaftaran')->name('wave.tagihan-camaba-update-slip-pendaftaran');	

	// route admin bendahara
	Route::get('registrasi-awal', '\Wave\Http\Controllers\RegistrasiAwalController@index')->name('wave.registrasi-awal');	
	Route::post('registrasi-awal-getlist', '\Wave\Http\Controllers\RegistrasiAwalController@getList')->name('wave.registrasi-awal-getlist');	
	Route::post('update-registrasi-awal-status', '\Wave\Http\Controllers\RegistrasiAwalController@updateStatus')->name('wave.update-registrasi-awal-status');	
	
	Route::get('registrasi-ulang', '\Wave\Http\Controllers\RegistrasiUlangController@index')->name('wave.registrasi-ulang');	
	
	// route admin pendaftaran
	Route::get('validasi-pendaftaran', '\Wave\Http\Controllers\ValidasiPendaftaranController@index')->name('wave.validasi-pendaftaran');
	Route::post('validasi-pendaftaran-getlist', '\Wave\Http\Controllers\ValidasiPendaftaranController@getList')->name('wave.validasi-pendaftaran-getlist');	
	Route::get('validasi-pendaftaran-detail/{id}/{ta}', '\Wave\Http\Controllers\ValidasiPendaftaranController@detailValidasiPendaftaran')->name('wave.validasi-pendaftaran-detail');	
	Route::post('validasi-pendaftaran-update-data-pokok', '\Wave\Http\Controllers\ValidasiPendaftaranController@updateDataPokok')->name('wave.validasi-pendaftaran-update-data-pokok');
	Route::post('validasi-pendaftaran-update-data-alamat', '\Wave\Http\Controllers\ValidasiPendaftaranController@updateDataAlamat')->name('wave.validasi-pendaftaran-update-data-alamat');
	Route::post('validasi-pendaftaran-update-data-ortu', '\Wave\Http\Controllers\ValidasiPendaftaranController@updateDataOrtu')->name('wave.validasi-pendaftaran-update-data-ortu');
	Route::post('validasi-pendaftaran-update-data-wali-ps', '\Wave\Http\Controllers\ValidasiPendaftaranController@updateDataWaliPs')->name('wave.validasi-pendaftaran-update-data-wali-ps');
	Route::post('validasi-pendaftaran-update-data-riwayat-pendidikan', '\Wave\Http\Controllers\ValidasiPendaftaranController@updateDataRiwayatPendidikan')->name('wave.validasi-pendaftaran-update-data-riwayat-pendidikan');
	Route::post('validasi-pendaftaran-update-data-program-studi', '\Wave\Http\Controllers\ValidasiPendaftaranController@updateDataProgramStudi')->name('wave.validasi-pendaftaran-update-data-program-studi');
	Route::post('validasi-pendaftaran-update-data-dokumen', '\Wave\Http\Controllers\ValidasiPendaftaranController@updateDataDokumen')->name('wave.validasi-pendaftaran-update-data-dokumen');	
	Route::post('validasi-pendaftaran-update-data-pernyataan', '\Wave\Http\Controllers\ValidasiPendaftaranController@updateDataPernyataan')->name('wave.validasi-pendaftaran-update-data-pernyataan');	
	Route::get('validasi-pendaftaran-download-surat-pernyataan', '\Wave\Http\Controllers\ValidasiPendaftaranController@downloadSuratPernyataan')->name('wave.validasi-pendaftaran-download-surat-pernyataan');
	Route::post('validasi-pendaftaran-rotate-image', '\Wave\Http\Controllers\ValidasiPendaftaranController@rotateImage')->name('wave.validasi-pendaftaran-rotate-image');	
	

	// route super admin seleksi
	// pengujian
	Route::get('examination', '\Wave\Http\Controllers\ExaminationController@index')->name('wave.examination');	

	// route super admin seleksi
	// bank-soal
	Route::get('bank-soal', '\Wave\Http\Controllers\BankSoalController@index')->name('wave.bank-soal');	
	Route::post('bank-soal-getlist', '\Wave\Http\Controllers\BankSoalController@getList')->name('wave.bank-soal-getlist');	
	Route::post('bank-soal-add', '\Wave\Http\Controllers\BankSoalController@addBankSoal')->name('wave.bank-soal-add');	
	Route::post('bank-soal-delete', '\Wave\Http\Controllers\BankSoalController@deleteBankSoal')->name('wave.bank-soal-delete');	
	Route::post('bank-soal-edit', '\Wave\Http\Controllers\BankSoalController@updateBankSoal')->name('wave.bank-soal-edit');	
	// interview-question
	Route::get('interview-question', '\Wave\Http\Controllers\InterviewQuestionController@index')->name('wave.interview-question');	
	Route::post('interview-question-getlist', '\Wave\Http\Controllers\InterviewQuestionController@getList')->name('wave.interview-question-getlist');	
	Route::post('interview-question-add', '\Wave\Http\Controllers\InterviewQuestionController@addInterviewQuestion')->name('wave.interview-question-add');	
	Route::post('interview-question-delete', '\Wave\Http\Controllers\InterviewQuestionController@deleteInterviewQuestion')->name('wave.interview-question-delete');	
	Route::post('interview-question-edit', '\Wave\Http\Controllers\InterviewQuestionController@updateInterviewQuestion')->name('wave.interview-question-edit');	
	// konversi-nilai-akademik	
	Route::get('exam-convertion-result', '\Wave\Http\Controllers\ExamConvertionResultController@index')->name('wave.exam-convertion-result');	
	Route::post('exam-convertion-result-getlist', '\Wave\Http\Controllers\ExamConvertionResultController@getList')->name('wave.exam-convertion-result-getlist');	
	Route::post('exam-convertion-result-add', '\Wave\Http\Controllers\ExamConvertionResultController@addExamConvertionResult')->name('wave.exam-convertion-result-add');	
	Route::post('exam-convertion-result-delete', '\Wave\Http\Controllers\ExamConvertionResultController@deleteExamConvertionResult')->name('wave.exam-convertion-result-delete');	
	Route::post('exam-convertion-result-edit', '\Wave\Http\Controllers\ExamConvertionResultController@updateExamConvertionResult')->name('wave.exam-convertion-result-edit');	
	// daftar-penguji
	Route::get('daftar-penguji', '\Wave\Http\Controllers\DaftarPengujiController@index')->name('wave.daftar-penguji');	
	Route::post('daftar-penguji-getlist', '\Wave\Http\Controllers\DaftarPengujiController@getList')->name('wave.daftar-penguji-getlist');	
	Route::post('daftar-penguji-add', '\Wave\Http\Controllers\DaftarPengujiController@addDaftarPenguji')->name('wave.daftar-penguji-add');	
	Route::post('daftar-penguji-delete', '\Wave\Http\Controllers\DaftarPengujiController@deleteDaftarPenguji')->name('wave.daftar-penguji-delete');	
	Route::post('daftar-penguji-edit', '\Wave\Http\Controllers\DaftarPengujiController@updateDaftarPenguji')->name('wave.daftar-penguji-edit');	
	// penjadwalan-ujian
	Route::get('penjadwalan-ujian', '\Wave\Http\Controllers\PenjadwalanUjianController@index')->name('wave.penjadwalan-ujian');	
	Route::post('penjadwalan-ujian-getlist', '\Wave\Http\Controllers\PenjadwalanUjianController@getList')->name('wave.penjadwalan-ujian-getlist');	
	Route::post('penjadwalan-ujian-add', '\Wave\Http\Controllers\PenjadwalanUjianController@addPenjadwalanUjian')->name('wave.penjadwalan-ujian-add');	
	Route::post('penjadwalan-ujian-edit', '\Wave\Http\Controllers\PenjadwalanUjianController@updatePenjadwalanUjian')->name('wave.penjadwalan-ujian-edit');	
	// ujian-interview
	Route::get('exam-interview/{id}', '\Wave\Http\Controllers\ExamInterviewController@index')->name('wave.exam-interview');	
	Route::post('exam-interview-getlist', '\Wave\Http\Controllers\ExamInterviewController@getList')->name('wave.exam-interview-getlist');	
	Route::post('exam-interview-getlist-available-member', '\Wave\Http\Controllers\ExamInterviewController@getListAvailable')->name('wave.exam-interview-getlist-available-member');	
	Route::post('exam-interview-getlist-joined-member', '\Wave\Http\Controllers\ExamInterviewController@getListJoined')->name('wave.exam-interview-getlist-joined-member');	
	Route::post('exam-interview-add', '\Wave\Http\Controllers\ExamInterviewController@addExamInterview')->name('wave.exam-interview-add');	
	Route::post('exam-interview-edit', '\Wave\Http\Controllers\ExamInterviewController@updateExamInterview')->name('wave.exam-interview-edit');	
	Route::post('exam-interview-add-member', '\Wave\Http\Controllers\ExamInterviewController@addMember')->name('wave.exam-interview-add-member');	
	Route::post('exam-interview-delete-member', '\Wave\Http\Controllers\ExamInterviewController@deleteMember')->name('wave.exam-interview-delete-member');	
	Route::post('exam-interview-delete', '\Wave\Http\Controllers\ExamInterviewController@deleteExamInterview')->name('wave.exam-interview-delete');	
	// ujian-baca-quran	
	Route::get('exam-read-quran/{id}', '\Wave\Http\Controllers\ExamReadQuranController@index')->name('wave.exam-read-quran');	
	Route::post('exam-read-quran-getlist', '\Wave\Http\Controllers\ExamReadQuranController@getList')->name('wave.exam-read-quran-getlist');	
	Route::post('exam-read-quran-getlist-available-member', '\Wave\Http\Controllers\ExamReadQuranController@getListAvailable')->name('wave.exam-read-quran-getlist-available-member');	
	Route::post('exam-read-quran-getlist-joined-member', '\Wave\Http\Controllers\ExamReadQuranController@getListJoined')->name('wave.exam-read-quran-getlist-joined-member');	
	Route::post('exam-read-quran-add', '\Wave\Http\Controllers\ExamReadQuranController@addExamReadQuran')->name('wave.exam-read-quran-add');	
	Route::post('exam-read-quran-edit', '\Wave\Http\Controllers\ExamReadQuranController@updateExamReadQuran')->name('wave.exam-read-quran-edit');	
	Route::post('exam-read-quran-add-member', '\Wave\Http\Controllers\ExamReadQuranController@addMember')->name('wave.exam-read-quran-add-member');	
	Route::post('exam-read-quran-delete-member', '\Wave\Http\Controllers\ExamReadQuranController@deleteMember')->name('wave.exam-read-quran-delete-member');	
	Route::post('exam-read-quran-delete', '\Wave\Http\Controllers\ExamReadQuranController@deleteExamReadQuran')->name('wave.exam-read-quran-delete');	
	// ujian-hafalan-shalawat-wahidiyah
	Route::get('exam-read-shalawat/{id}', '\Wave\Http\Controllers\ExamReadShalawatController@index')->name('wave.exam-read-shalawat');	
	Route::post('exam-read-shalawat-getlist', '\Wave\Http\Controllers\ExamReadShalawatController@getList')->name('wave.exam-read-shalawat-getlist');	
	Route::post('exam-read-shalawat-getlist-available-member', '\Wave\Http\Controllers\ExamReadShalawatController@getListAvailable')->name('wave.exam-read-shalawat-getlist-available-member');	
	Route::post('exam-read-shalawat-getlist-joined-member', '\Wave\Http\Controllers\ExamReadShalawatController@getListJoined')->name('wave.exam-read-shalawat-getlist-joined-member');	
	Route::post('exam-read-shalawat-add', '\Wave\Http\Controllers\ExamReadShalawatController@addExamReadShalawat')->name('wave.exam-read-shalawat-add');	
	Route::post('exam-read-shalawat-edit', '\Wave\Http\Controllers\ExamReadShalawatController@updateExamReadShalawat')->name('wave.exam-read-shalawat-edit');	
	Route::post('exam-read-shalawat-add-member', '\Wave\Http\Controllers\ExamReadShalawatController@addMember')->name('wave.exam-read-shalawat-add-member');	
	Route::post('exam-read-shalawat-delete-member', '\Wave\Http\Controllers\ExamReadShalawatController@deleteMember')->name('wave.exam-read-shalawat-delete-member');	
	Route::post('exam-read-shalawat-delete', '\Wave\Http\Controllers\ExamReadShalawatController@deleteExamReadShalawat')->name('wave.exam-read-shalawat-delete');	
	// ujian-akademik
	Route::get('exam-academic/{id}', '\Wave\Http\Controllers\ExamAcademicController@index')->name('wave.exam-academic');	
	Route::post('exam-academic-getlist', '\Wave\Http\Controllers\ExamAcademicController@getList')->name('wave.exam-academic-getlist');	
	Route::post('exam-academic-getlist-available-member', '\Wave\Http\Controllers\ExamAcademicController@getListAvailable')->name('wave.exam-academic-getlist-available-member');	
	Route::post('exam-academic-getlist-joined-member', '\Wave\Http\Controllers\ExamAcademicController@getListJoined')->name('wave.exam-academic-getlist-joined-member');	
	Route::post('exam-academic-add', '\Wave\Http\Controllers\ExamAcademicController@addExamAcademic')->name('wave.exam-academic-add');	
	Route::post('exam-academic-edit', '\Wave\Http\Controllers\ExamAcademicController@updateExamAcademic')->name('wave.exam-academic-edit');	
	Route::post('exam-academic-add-member', '\Wave\Http\Controllers\ExamAcademicController@addMember')->name('wave.exam-academic-add-member');	
	Route::post('exam-academic-delete-member', '\Wave\Http\Controllers\ExamAcademicController@deleteMember')->name('wave.exam-academic-delete-member');	
	Route::post('exam-academic-delete', '\Wave\Http\Controllers\ExamAcademicController@deleteExamAcademic')->name('wave.exam-academic-delete');	
	Route::post('exam-academic-validate', '\Wave\Http\Controllers\ExamAcademicController@validateExamAcademic')->name('wave.exam-academic-validate');	
	// ploting-ujian
	Route::get('kelompok-ujian', '\Wave\Http\Controllers\KelompokUjianController@index')->name('wave.kelompok-ujian');	

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
