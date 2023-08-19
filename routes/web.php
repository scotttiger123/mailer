<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Group\CreateGroupController;
use App\Http\Controllers\Scheduler\CampaignController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Template\TemplateController;

/* login */
Route::get('/', [LoginController::class,'index'])->name('login');
Route::get('/login', [LoginController::class, 'index']);
Route::post('login', [LoginController::class,'login'])->name('login');

/* register */
Route::get('register', [LoginController::class,'register'])->name('register');
Route::post('register', [LoginController::class,'register_user'])->name('register');

/* forgot password */
Route::get('forgot', [LoginController::class,'forgot'])->name('forgot');


/* Create Group */
Route::get('group', [CreateGroupController::class,'index'])->name('group');
Route::post('group', [CreateGroupController::class,'store'])->name('store');
Route::get('assign-mails', [CreateGroupController::class,'assign_mails_index']);
Route::post('assign-mails', [CreateGroupController::class,'store_assigned_mails']);
Route::get('view-groups', [CreateGroupController::class,'view_group']);

/*campaigns*/
Route::get('campaign', [CampaignController::class,'index']);
Route::post('campaign', [CampaignController::class, 'store'])->name('campaign');
Route::get('view-campaign', [CampaignController::class, 'view'])->name('campaign.view');

/*template*/
Route::get('template', [TemplateController::class, 'create'])->name('template.create');
Route::post('template', [TemplateController::class, 'store'])->name('template.create');
Route::get('view-templates',[TemplateController::class,'viewTemplates'])->name('view.templates');
Route::get('show-popup',[TemplateController::class,'viewPopup'])->name('show-popup');





/* Dashboard */
Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
Route::post('logout', [LoginController::class,'logout'])->name('logout');

Route::group(['middleware' => 'auth'],function() {
    Route::get('welcome', function () {
        return view('welcome');
   });
});