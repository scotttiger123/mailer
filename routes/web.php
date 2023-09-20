<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Group\CreateGroupController;
use App\Http\Controllers\Scheduler\CampaignController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Template\TemplateController;
use App\Http\Controllers\Subscribe\PricingController;
use App\Http\Controllers\Stripe\StripePaymentController;
use App\Http\Controllers\PayPal\PayPalController;

/* login */
Route::get('/', [LoginController::class,'index'])->name('login');
Route::get('/login', [LoginController::class, 'index']);
Route::post('login', [LoginController::class,'login'])->name('login');

/* register */
Route::get('register', [LoginController::class,'register'])->name('register');
Route::post('register', [LoginController::class,'register_user'])->name('register');

/* forgot password */
Route::get('forgot', [LoginController::class,'forgot'])->name('forgot');

Route::group(['middleware' => 'auth'],function() {
    
/* Create Group */
Route::get('group', [CreateGroupController::class,'index'])->name('group');
Route::post('group', [CreateGroupController::class,'store'])->name('store');
Route::get('assign-mails', [CreateGroupController::class,'assign_mails_index'])->name('assign-mails');
Route::post('assign-mails', [CreateGroupController::class,'store_assigned_mails']);
Route::get('view-groups', [CreateGroupController::class,'view_group'])->name('view-groups');
Route::delete('view-groups/{id}', [CreateGroupController::class,'deleteGroup'])->name('groups.delete');
Route::put('/groups', [CreateGroupController::class,'update'])->name('groups.update');


/*campaigns*/
Route::get('campaign', [CampaignController::class,'index'])->name('create-campaign');;
Route::post('campaign', [CampaignController::class, 'store'])->name('campaign');
Route::get('view-campaign', [CampaignController::class, 'view'])->name('campaign.view');
Route::delete('view-campaign/{id}', [CampaignController::class,'deleteCampaign'])->name('campaigns.destroy');
Route::post('campaigns/{id}/resend', [CampaignController::class, 'resendCampaign'])->name('campaigns.resend');
Route::get('campaigns/{campaign}/edit', [CampaignController::class, 'edit'])->name('campaigns.edit');
Route::put('/campaigns/{campaign}', [CampaignController::class,'update'])->name('campaigns.update');





/*template*/
Route::get('template', [TemplateController::class, 'create'])->name('template.create');
Route::post('template', [TemplateController::class, 'store'])->name('template.create');
Route::get('view-templates',[TemplateController::class,'viewTemplates'])->name('view.templates');
Route::get('/show-popup/{id}', [TemplateController::class,'showPopup'])->name('show-popup');
Route::delete('view-templates/{id}', [TemplateController::class, 'destroy'])->name('templates.destroy');
Route::get('templates/{id}/edit', [TemplateController::class,'edit'])->name('templates.edit');
Route::put('/templates/{template}', [TemplateController::class,'update'])->name('templates.update');

/*emailLog*/

Route::get('/emails/{emailLogId}/opened', [EmailLogController::class, 'viewOpenedEmail']);


/* Dashboard */
Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
Route::post('logout', [LoginController::class,'logout'])->name('logout');
Route::get('/campaign/{campaignId}/emaillog', [DashboardController::class,'getEmailLogData']);
/*packages*/
Route::get('/pricing', [PricingController::class, 'showPricing'])->name('pricing');
Route::get('/upgrade-plan', [PricingController::class, 'showUpgradeForm'])->name('upgrade-plan');
Route::get('/process-upgrade', [PricingController::class, 'processUpgrade'])->name('process-upgrade');


/* stripe payments */ 
Route::post('/stripepost', [StripePaymentController::class, 'stripePost'])->name('stripe-post');

/*paypal*/

Route::get('paypal', [PayPalController::class, 'index'])->name('paypal');
Route::get('paypal/payment', [PayPalController::class, 'payment'])->name('paypal.payment');
Route::get('paypal/payment/success', [PayPalController::class, 'paymentSuccess'])->name('paypal.payment.success');
Route::get('paypal/payment/cancel', [PayPalController::class, 'paymentCancel'])->name('paypal.payment/cancel');



    Route::get('welcome', function () {
        return view('welcome');
   });
});