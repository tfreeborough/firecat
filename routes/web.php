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

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('verify', 'Auth\VerifyController@showVerify')->name('verify');
Route::get('verify/resend', 'Auth\VerifyController@showResend')->name('resend-verification');
Route::post('verify/resend', 'Auth\VerifyController@resend');
Route::get('verify/{token}', 'Auth\VerifyController@verify');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('dashboard', 'Account\AccountController@directToDashboard')->name('dashboard');

Route::group(['prefix' => 'docs'], function () {

    Route::get('/', 'Docs\DocsController@index')->name('docs');
    
    Route::group(['prefix' => 'opportunities'], function () {
        Route::get('/', 'Docs\OpportunitiesController@index')->name('docs.opportunities');
        Route::get('statuses','Docs\OpportunitiesController@statuses')->name('docs.opportunities.statuses');
    });
});

Route::group(['middleware' => ['auth','auth.admin','auth.verified'], 'prefix' => 'admin'], function () {
    Route::get('/', 'Admin\AdminController@showDashboard')->name('admin.dashboard');
    Route::get('account', 'Account\AccountController@showAccount')->name('admin.account');

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
        Route::post('create', 'Admin\PartnerController@postPartnerCreation');
        Route::get('{uuid}', 'Admin\PartnerController@showPartner')->name('admin.partners.index');
    });

});

Route::group(['middleware' => ['auth','auth.partner','auth.verified'], 'prefix' => 'partner'], function () {
    Route::get('/', 'Partner\PartnerController@showDashboard')->Name('partner.dashboard');
    Route::get('account', 'Account\AccountController@showAccount')->name('partner.account');
    Route::get('deals', 'Partner\PartnerController@showDeals')->name('partner.deals');

    Route::get('end-users', 'Partner\EndUserController@showEndUsers')->name('partner.endUsers');
    Route::get('end-users/create', 'Partner\EndUserController@showCreateEndUser')->name('partner.endUsers.create');
    Route::post('end-users/create', 'Partner\EndUserController@postCreateEndUser');

    Route::get('opportunities', 'Partner\OpportunityController@showOpportunities')->name('partner.opportunities');
    Route::get('opportunities/create', 'Partner\OpportunityController@showCreateOpportunity')->name('partner.opportunities.create');
    Route::post('opportunities/create', 'Partner\OpportunityController@postCreateOpportunity');

    Route::get('opportunities/{uuid}', 'Partner\OpportunityController@showOpportunity')->name('partner.opportunity');
});

Route::group(['middleware' => ['auth','auth.vendor','auth.verified'], 'prefix' => 'vendor'], function () {
    Route::get('/', 'Vendor\VendorController@showDashboard')->name('vendor.dashboard');
    Route::get('account', 'Account\AccountController@showAccount')->name('vendor.account');
    Route::get('activity', 'Vendor\VendorController@showActivity')->name('vendor.activity');
    Route::get('deals', 'Vendor\VendorController@showDeals')->name('vendor.deals');
    Route::get('opportunities', 'Vendor\VendorController@showOpportunities')->name('vendor.opportunities');
});

