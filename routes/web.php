<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//For Downloading Files
Route::get('/file-download/{fileName}','HomeController@fileDownload')->name('file.download');


Route::get('/','FrontendController@index')->name('main.page');
Route::get('/session-data',function (){
    session()->put('showroom_id',1);
});

Auth::routes(['verify' => true, 'register' => true]);

Route::post('/resend', '\App\Http\Controllers\Auth\VerificationController@resend_mail')->name('verification_mail_resend');
Route::group(['middleware' => ['auth']], function(){
    Route::view('team-html', 'team');
    Route::view('project-default', 'project-default');
    Route::view('project-html', 'project');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::post('/menu-search', 'HomeController@menuSearch')->name('menu.search');

    Route::middleware('permission')->prefix('hr')->group(function(){
        Route::resource('staffs', 'StaffController')->except('destroy');
        Route::post('/staff-status-update', 'StaffController@status_update')->name('staffs.update_active_status')->middleware('prohibited.demo.mode');
        Route::get('/staff/view/{id}', 'StaffController@show')->name('staffs.view');
        Route::get('/staff/report-print/{id}', 'StaffController@report_print')->name('staffs.report_print');
        Route::get('/staff/destroy/{id}', 'StaffController@destroy')->name('staffs.destroy');

        Route::get('/staff/csv-upload-page', 'StaffController@csv_upload')->name('staffs.csv_upload.create');
        Route::post('/staff/csv-upload-store', 'StaffController@csv_upload_store')->name('staffs.csv_upload.store');
    });


    Route::post('/staff-document/store', 'StaffController@document_store')->name('staff_document.store');
    Route::get('/staff-document/destroy/{id}', 'StaffController@document_destroy')->name('staff_document.destroy');
    Route::get('/profile-view', 'StaffController@profile_view')->name('profile_view');
    Route::post('/profile-edit', 'StaffController@profile_edit')->name('profile_edit_modal');
    Route::post('/profile-update/{id}', 'StaffController@profile_update')->name('profile.update');
    Route::get('/company_info', 'HomeController@company')->name('company_info');
    Route::post('/dashboard-cards-info/{type}', 'HomeController@dashboardCards')->name('dashboard.card.info');
    Route::post('/notification/update', 'HomeController@notificationUpdate')->name('notification.update');

    Route::get('notification-lists', 'HomeController@notification_list')->name('all_notifications');
    Route::get('notification-read-all', 'HomeController@notification_read_all')->name('mark_notifications');
    Route::post('notification-read-all', 'HomeController@post_notification_read_all');

    Route::get('/change-password', 'HomeController@change_password')->name('change_password');
    Route::post('/change-password', 'HomeController@post_change_password');
});

Route::get('/js/lang/js', function () {

//    if (\App::environment('local')) {
        \Cache::forget('jslang.js');
//    }

    if (\Cache::has('locale')) {
        config(['app.locale' => \Cache::get('locale')]);
    }

    $strings =  Cache::rememberForever('jslang.js', function () {
        $lang = config('app.locale');

        $file   = resource_path('lang/' . $lang . '/js.php');
        $strings = [];
        if (\Illuminate\Support\Facades\File::exists($file)){
            $name           = basename($file, '.php');
            $strings[$name] = require $file;
        }

//        Remove this if block if you dont need to load language insides module

        if(class_exists(\Nwidart\Modules\Module::class)){
            $modules = \Module::all();
            $module_files = [];
            foreach ($modules as $module) {
                if ($module->isEnabled()) {
                    $file = module_path($module->getName()) . '/Resources/lang/'.$lang.'/js.php';
                    if (\Illuminate\Support\Facades\File::exists($file)) {
                        $module_files[$module->getLowerName()] = $file;
                    }
                }
            }

            foreach ($module_files as $module => $file) {
                $name           = basename($file, '.php');
                $strings[$module.'::'.$name] = require $file;

            }
        }

        return $strings;
    });
    header('Content-Type: text/javascript');
    echo('window.jsi18n = ' . json_encode($strings) . ';');
    exit();
})->name('assets.lang.js');
