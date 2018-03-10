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

Route::post('beta/interest', 'Marketing\BetaController@postInterestSubmission')->name('beta.interest');

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
    Route::post('account/email', 'Account\AccountController@postEmailUpdate')->name('admin.account.email');
    Route::post('account/password', 'Account\AccountController@postPasswordUpdate')->name('admin.account.password');

    Route::group(['prefix' => 'onboarding'], function () {
        Route::get('/', 'Admin\OrganisationController@showOnboarding')->name('admin.onboarding');
        Route::get('create', 'Admin\OrganisationController@showOrganisationCreation')->name('admin.onboarding.create');
        Route::get('{uuid}', 'Admin\OrganisationController@showOrganisation')->name('admin.onboarding.index');
        Route::get('{uuid}/add', 'Admin\OrganisationController@showUserAdd')->name('admin.onboarding.add-user');
        Route::get('{uuid}/invites', 'Admin\OrganisationController@showInvites')->name('admin.onboarding.invites');
        Route::get('{uuid}/unlink/{user}', 'Admin\OrganisationController@unlinkUser');
        Route::get('{uuid}/adminify/{user}', 'Admin\OrganisationController@adminifyUser');
        Route::get('{uuid}/deadminify/{user}', 'Admin\OrganisationController@deadminifyUser');

        Route::post('create', 'Admin\OrganisationController@postOrganisationCreation');
        Route::post('{uuid}/add/new', 'Admin\OrganisationController@postUserAddNew')->name('admin.onboarding.invite_new');
        Route::post('{uuid}/add/link', 'Admin\OrganisationController@postUserAddLink');

        Route::get('{uuid}/delete_invite/{invite_id}', 'Admin\OrganisationController@deleteInvite')->name('admin.onboarding.delete_invite');
        Route::get('{uuid}/renew_invite/{invite_id}', 'Admin\OrganisationController@renewInvite')->name('admin.onboarding.renew_invite');

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
    Route::get('/', 'Partner\PartnerController@showDashboard')->name('partner.dashboard');

    /*
     * Magic Link
     */
    Route::get('/magic-link/{uuid}', 'Partner\OpportunityController@showMagicLink')->name('magic-link');

    /*
     * Account Routes
     */
    Route::get('account', 'Account\AccountController@showAccount')->name('partner.account');
    Route::post('account/avatar', 'Account\AccountController@postAvatar');
    Route::post('account/additional', 'Account\AccountController@postAdditional');
    Route::post('account/email', 'Account\AccountController@postEmailUpdate')->name('partner.account.email');
    Route::post('account/password', 'Account\AccountController@postPasswordUpdate')->name('partner.account.password');

    /*
     * Deal Routes
     */
    Route::group(['prefix' => 'deals'], function () {
        Route::get('/', 'Partner\DealController@showDeals')->name('partner.deals');

        Route::group(['middleware' => ['auth.partner.has_deal']], function () {
            Route::get('{uuid}', 'Partner\DealController@showDeal')->name('partner.deal');
            Route::get('{uuid}/won', 'Partner\DealController@postDealWon')->name('partner.deal.won');
            Route::get('{uuid}/lost', 'Partner\DealController@postDealLost')->name('partner.deal.lost');
            Route::post('{uuid}/implementation_date_change_request', 'Partner\DealController@postRequestImplementationDateChange')->name('partner.deal.implementation_change_request');
        });
    });

    /*
     * End User Routes
     */
    Route::group(['prefix' => 'end-users'], function () {
        Route::get('/', 'Partner\EndUserController@showEndUsers')->name('partner.endUsers');
        Route::get('create', 'Partner\EndUserController@showCreateEndUser')->name('partner.endUsers.create');
        Route::post('create', 'Partner\EndUserController@postCreateEndUser');
    });


    /*
     * Opportunity Routes
     */
    Route::group(['prefix' => 'opportunities'], function () {
        Route::get('/', 'Partner\OpportunityController@showOpportunities')->name('partner.opportunities');
        Route::get('create', 'Partner\OpportunityController@showCreateOpportunity')->name('partner.opportunities.create');
        Route::post('create', 'Partner\OpportunityController@postCreateOpportunity');

        Route::group(['middleware' => ['auth.partner.has_opportunity']], function () {
            Route::get('{uuid}', 'Partner\OpportunityController@showOpportunity')->name('partner.opportunity');
            Route::get('{uuid}/threads', 'Partner\OpportunityController@showThreads')->name('partner.opportunity.threads');
            Route::post('{uuid}/threads/create', 'Partner\OpportunityController@postCreateThread')->name('partner.opportunity.threads.create')->middleware('opportunity.not.rejected');
            Route::post('{uuid}/threads/message', 'Partner\OpportunityController@postNewThreadMessage')->name('partner.opportunity.threads.message')->middleware('opportunity.not.rejected');
        });
    });
});

Route::group(['middleware' => ['auth','auth.vendor','auth.verified'], 'prefix' => 'vendor'], function () {
    /*
     * VENDOR ROUTES
     */
    Route::get('/', 'Vendor\VendorController@showDashboard')->name('vendor.dashboard');
    Route::get('activity', 'Vendor\VendorController@showActivity')->name('vendor.activity');
    Route::get('deals', 'Vendor\VendorController@showDeals')->name('vendor.deals');
    Route::get('opportunities', 'Vendor\VendorController@showOpportunities')->name('vendor.opportunities');

    Route::group(['prefix' => 'tags'], function () {
        Route::get('/', 'Vendor\TagController@index')->name('vendor.tags');
        Route::get('{tag_id}', 'Vendor\TagController@show')->name('vendor.tags.tag');
    });

    Route::group(['prefix' => 'account'], function () {
        Route::get('/', 'Account\AccountController@showAccount')->name('vendor.account');
        Route::post('avatar', 'Account\AccountController@postAvatar');
        Route::post('additional', 'Account\AccountController@postAdditional');
        Route::post('email', 'Account\AccountController@postEmailUpdate')->name('vendor.account.email');
        Route::post('password', 'Account\AccountController@postPasswordUpdate')->name('vendor.account.password');
    });

    /**
     * Check to see if Opportunity ID belongs to the same organisation as User
     */
    Route::group(['middleware' => ['auth.vendor.owns_opportunity'], 'prefix' => 'opportunities'], function () {

        Route::get('{uuid}', 'Vendor\OpportunityController@showOpportunity')->name('vendor.opportunity');
        Route::get('{uuid}/assign', 'Vendor\OpportunityController@assignOpportunity')->name('vendor.opportunity.assign')->middleware('opportunity.not.rejected');

        /**
         * Check the user is assigned to the opportunity in question
         */
        Route::group(['middleware' => ['auth.vendor.assigned_opportunity']], function () {
            Route::get('{uuid}/review', 'Vendor\OpportunityController@reviewOpportunity')->name('vendor.opportunity.review');
            Route::get('{uuid}/threads', 'Vendor\OpportunityController@showThreads')->name('vendor.opportunity.threads');
            Route::get('{uuid}/messages', 'Vendor\OpportunityController@showMessages')->name('vendor.opportunity.messages');

            /**
             * Check the opportunity has not been rejected
             */
            Route::group(['middleware' => ['opportunity.not.rejected']], function () {
                Route::get('{uuid}/review/reject', 'Vendor\OpportunityController@rejectOpportunity')->name('vendor.opportunity.reject');
                Route::post('{uuid}/messages', 'Vendor\OpportunityController@postMessage')->name('vendor.opportunity.postMessage');
                Route::post('{uuid}/convert', 'Vendor\OpportunityController@postConvert')->name('vendor.opportunity.postConvert');
                Route::post('{uuid}/threads/create', 'Vendor\OpportunityController@postCreateThread')->name('vendor.opportunity.threads.create');
                Route::post('{uuid}/threads/message', 'Vendor\OpportunityController@postNewThreadMessage')->name('vendor.opportunity.threads.message');
                Route::get('{uuid}/considerations/{consideration_id}/complete', 'Vendor\OpportunityController@markConsiderationComplete')->name('vendor.opportunity.consideration.complete');
            });
        });
    });

    /**
     * Check to make sure the Deal ID belongs to the same organisation as User
     */
    Route::group(['middleware' => ['auth.vendor.owns_deal','auth.vendor.assigned_deal'], 'prefix' => 'deals'], function () {
        Route::get('{uuid}', 'Vendor\DealController@showDeal')->name('vendor.deal');
        Route::get('{uuid}/won', 'Vendor\DealController@postDealWon')->name('vendor.deal.won');
        Route::get('{uuid}/lost', 'Vendor\DealController@postDealLost')->name('vendor.deal.lost');
        Route::get('{uuid}/request_update', 'Vendor\DealController@postDealRequestUpdate')->name('vendor.deal.request_update');
        Route::get('{uuid}/tag', 'Vendor\DealController@showDealTag')->name('vendor.deal.tag');
        Route::post('{uuid}/tag', 'Vendor\DealController@postDealTag')->name('vendor.deal.tag.post');
        Route::post('{uuid}/tag/link', 'Vendor\DealController@linkDealTag')->name('vendor.deal.tag.link');
        Route::post('{uuid}/tag/unlink', 'Vendor\DealController@unlinkDealTag')->name('vendor.deal.tag.unlink');
        Route::get('{uuid}/update/{update_id}/accept', 'Vendor\DealController@acceptDealUpdate')->name('vendor.deal.update.accept');
        Route::get('{uuid}/update/{update_id}/reject', 'Vendor\DealController@rejectDealUpdate')->name('vendor.deal.update.reject');
    });

    /**
     * CHeck to make sure that the user is the administrator of this organisation
     */
    Route::group(['middleware' => ['auth.vendor_admin'], 'prefix' => 'administration'], function () {
        Route::get('/', 'Vendor\Admin\AdminController@showAdmin')->name('vendor.admin');

        Route::group(['prefix' => 'onboarding'], function () {
            Route::get('/', 'Vendor\Admin\OnboardingController@showOnboarding')->name('vendor.admin.onboarding');
            Route::post('/', 'Vendor\Admin\OnboardingController@postInvite')->name('vendor.admin.onboarding.invite');
            Route::get('/delete_invite/{invite_id}', 'Vendor\Admin\OnboardingController@deleteInvite')->name('vendor.admin.onboarding.delete_invite');
            Route::get('/renew_invite/{invite_id}', 'Vendor\Admin\OnboardingController@renewInvite')->name('vendor.admin.onboarding.renew_invite');
        });

        Route::group(['prefix' => 'users'], function () {
           Route::get('/', 'Vendor\Admin\UserController@showUsers')->name('vendor.admin.users');
        });

        Route::group(['prefix' => 'tags'], function () {
            Route::get('/', 'Vendor\Admin\TagController@showTags')->name('vendor.admin.tags');

            Route::group(['middleware' => 'auth.vendor.owns_tag'], function () {
                Route::get('{tag_id}', 'Vendor\Admin\TagController@showTagPage')->name('vendor.admin.tags.tag');
                Route::post('{tag_id}/text_color', 'Vendor\Admin\TagController@updateTagTextColor')->name('vendor.admin.tag.text_color');
                Route::post('{tag_id}/background_color', 'Vendor\Admin\TagController@updateTagBackgroundColor')->name('vendor.admin.tag.background_color');
                Route::post('{tag_id}/rename', 'Vendor\Admin\TagController@updateTagName')->name('vendor.admin.tag.rename');
                Route::post('{tag_id}/delete', 'Vendor\Admin\TagController@deleteTag')->name('vendor.admin.tag.delete');
            });

        });

    });
    
});

