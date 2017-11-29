<?php

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

Route::get('/', function () {
    return view('pages.welcome');
})->name('home');

Route::get('/email/invite', function () {
    return view('email.InviteUser')->with([
        'invite' => \App\Models\Invite::all()->first(),
    ]);
})->name('email.invite');

Route::get('/email/verify', function () {
    return view('email.verify')->with([
        'user' => \App\Models\User::all()->first(),
    ]);
})->name('email.verify');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('verify', 'Auth\VerifyController@showVerify')->name('verify');
Route::get('verify/resend', 'Auth\VerifyController@showResend')->name('resend-verification');
Route::post('verify/resend', 'Auth\VerifyController@resend');
Route::get('verify/{token}', 'Auth\VerifyController@verify');
Route::get('invite/{token}', 'Auth\InviteController@showInvite')->name('invite');
Route::post('invite/{token}', 'Auth\InviteController@verifyInvite');

// Password Reset Routes...
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset.view');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.request');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('dashboard', 'Account\AccountController@directToDashboard')->name('dashboard');

Route::group(['middleware' => ['auth','auth.verified'], 'prefix' => 'docs'], function () {
    Route::get('/', 'Docs\DocsController@index')->name('docs');

    Route::group(['prefix' => 'opportunities'], function () {
        Route::get('/', 'Docs\OpportunitiesController@index')->name('docs.opportunities');
        Route::get('#statuses','Docs\OpportunitiesController@statuses')->name('docs.opportunities.statuses');
        Route::get('#considerations', 'Docs\OpportunitiesController@considerations')->name('docs.opportunities.considerations');
    });
});


Route::group(['middleware' => ['auth','auth.admin','auth.verified'], 'prefix' => 'admin'], function () {
    /*
     * ADMIN ROUTES
     */
    Route::get('/', 'Admin\AdminController@showDashboard')->name('admin.dashboard');

    /*
     * Account Routes
     */
    Route::get('account', 'Account\AccountController@showAccount')->name('admin.account');
    Route::post('account/avatar', 'Account\AccountController@postAvatar');
    Route::post('account/additional', 'Account\AccountController@postAdditional');

    Route::group(['prefix' => 'onboarding'], function () {
        Route::get('/', 'Admin\OrganisationController@showOnboarding')->name('admin.onboarding');
        Route::get('create', 'Admin\OrganisationController@showOrganisationCreation')->name('admin.onboarding.create');
        Route::get('{uuid}', 'Admin\OrganisationController@showOrganisation')->name('admin.onboarding.index');
        Route::get('{uuid}/add', 'Admin\OrganisationController@showUserAdd')->name('admin.onboarding.add-user');
        Route::get('{uuid}/unlink/{user}', 'Admin\OrganisationController@unlinkUser');

        Route::post('create', 'Admin\OrganisationController@postOrganisationCreation');
        Route::post('{uuid}/add/new', 'Admin\OrganisationController@postUserAddNew');
        Route::post('{uuid}/add/link', 'Admin\OrganisationController@postUserAddLink');


    });

    Route::group(['prefix' => 'partners'], function () {
        Route::get('/', 'Admin\PartnerController@showPartners')->name('admin.partners');
        Route::get('create', 'Admin\PartnerController@showPartnerCreation')->name('admin.partners.create');
        Route::post('invite', 'Admin\PartnerController@postPartnerInvite')->name('admin.partners.invite');
        Route::post('create', 'Admin\PartnerController@postPartnerCreation');
        Route::get('{uuid}', 'Admin\PartnerController@showPartner')->name('admin.partners.index');
        Route::get('{uuid}/delete', 'Admin\PartnerController@deletePartner')->name('admin.partners.index.delete');
    });

});

Route::group(['middleware' => ['auth','auth.partner','auth.verified'], 'prefix' => 'partner'], function () {
    /*
     * PARTNER ROUTES
     */
    Route::get('/', 'Partner\PartnerController@showDashboard')->Name('partner.dashboard');

    /*
     * Account Routes
     */
    Route::get('account', 'Account\AccountController@showAccount')->name('partner.account');
    Route::post('account/avatar', 'Account\AccountController@postAvatar');
    Route::post('account/additional', 'Account\AccountController@postAdditional');
    
    Route::get('deals', 'Partner\PartnerController@showDeals')->name('partner.deals');
    Route::get('deals/{uuid}', 'Partner\PartnerController@showDeal')->name('partner.deal');

    Route::get('end-users', 'Partner\EndUserController@showEndUsers')->name('partner.endUsers');
    Route::get('end-users/create', 'Partner\EndUserController@showCreateEndUser')->name('partner.endUsers.create');
    Route::post('end-users/create', 'Partner\EndUserController@postCreateEndUser');

    Route::get('opportunities', 'Partner\OpportunityController@showOpportunities')->name('partner.opportunities');
    Route::get('opportunities/create', 'Partner\OpportunityController@showCreateOpportunity')->name('partner.opportunities.create');
    Route::post('opportunities/create', 'Partner\OpportunityController@postCreateOpportunity');

    Route::get('opportunities/{uuid}', 'Partner\OpportunityController@showOpportunity')->name('partner.opportunity');
});

Route::group(['middleware' => ['auth','auth.vendor','auth.verified'], 'prefix' => 'vendor'], function () {
    /*
     * VENDOR ROUTES
     */
    Route::get('/', 'Vendor\VendorController@showDashboard')->name('vendor.dashboard');

    /*
     * Account Routes
     */
    Route::get('account', 'Account\AccountController@showAccount')->name('vendor.account');
    Route::post('account/avatar', 'Account\AccountController@postAvatar');
    Route::post('account/additional', 'Account\AccountController@postAdditional');

    Route::get('tags', 'Vendor\TagController@index')->name('vendor.tags');
    Route::get('tags/{tag_id}', 'Vendor\TagController@show')->name('vendor.tags.tag');

    Route::get('activity', 'Vendor\VendorController@showActivity')->name('vendor.activity');
    Route::get('deals', 'Vendor\VendorController@showDeals')->name('vendor.deals');
    Route::get('opportunities', 'Vendor\VendorController@showOpportunities')->name('vendor.opportunities');

    Route::get('opportunities/{uuid}', 'Vendor\OpportunityController@showOpportunity')->name('vendor.opportunity');
    Route::get('opportunities/{uuid}/assign', 'Vendor\OpportunityController@assignOpportunity')->name('vendor.opportunity.assign');
    Route::get('opportunities/{uuid}/review', 'Vendor\OpportunityController@reviewOpportunity')->name('vendor.opportunity.review');
    Route::get('opportunities/{uuid}/messages', 'Vendor\OpportunityController@showMessages')->name('vendor.opportunity.messages');
    Route::post('opportunities/{uuid}/messages', 'Vendor\OpportunityController@postMessage')->name('vendor.opportunity.postMessage');
    Route::post('opportunities/{uuid}/convert', 'Vendor\OpportunityController@postConvert')->name('vendor.opportunity.postConvert');
    Route::get('opportunities/{uuid}/threads', 'Vendor\OpportunityController@showThreads')->name('vendor.opportunity.threads');
    Route::post('opportunities/{uuid}/threads/create', 'Vendor\OpportunityController@postCreateThread')->name('vendor.opportunity.threads.create');
    Route::post('opportunities/{uuid}/threads/message', 'Vendor\OpportunityController@postNewThreadMessage')->name('vendor.opportunity.threads.message');
    
    Route::get('deals/{uuid}', 'Vendor\DealController@showDeal')->name('vendor.deal');
    Route::get('deals/{uuid}/tag', 'Vendor\DealController@showDealTag')->name('vendor.deal.tag');
    Route::post('deals/{uuid}/tag', 'Vendor\DealController@postDealTag')->name('vendor.deal.tag.post');
    Route::post('deals/{uuid}/tag/link', 'Vendor\DealController@linkDealTag')->name('vendor.deal.tag.link');
    Route::post('deals/{uuid}/tag/unlink', 'Vendor\DealController@unlinkDealTag')->name('vendor.deal.tag.unlink');

    Route::get('administration', 'Vendor\AdminController@showAdmin')->name('vendor.admin');
});

