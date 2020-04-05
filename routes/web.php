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
Auth::routes();

Route::get('/segment/second', 'LandingController@segment');
/*
* Main landing page
*/
Route::group(['prefix' => '/'], function(){
  Route::get('/', 'LandingController@index')->name('landing.homepage');
  Route::get('about', 'LandingController@about')->name('landing.about');
  Route::get('contact', 'LandingController@contact')->name('landing.contact');
  Route::get('/location_{latitude}_{longitude}', 'LandingController@location')->name('home.location');
  Route::get('/blog', 'LandingController@blogs')->name('landing.blogs');
  Route::get('/blog/{id}', 'LandingController@blog')->name('landing.blog');
  Route::post('/blog/comment', 'LandingController@comment')->name('landing.comment');
  Route::post('/comment_reply', 'LandingController@reply_comment')->name('landing.reply');
  Route::post('/view_reply', 'LandingController@view_reply_comment')->name('landing.view_reply');
  Route::post('/contact-us', 'LandingController@contactUs')->name('landing.contactUs');
  Route::get('/apprentice', 'LandingController@apprentice');
  Route::post('/apprentice', 'LandingController@apprentice_');
  Route::get('/category/{id}', 'LandingController@viewTechnician');
  Route::get('/local_contractor', 'LandingController@viewContractor');
  Route::get('/technician_list', 'LandingController@allTechnician');
  Route::get('/project_listing', 'LandingController@listProject');
  Route::post('/project_listing', 'LandingController@listProject_');
  Route::get('/customize', 'LandingController@customise');
  Route::post('/customize', 'LandingController@customise_');
});

/*
* User registration and authenticated route
*/
Route::group(['prefix' => 'register', 'middleware' => ['guest']], function(){
  


  Route::get('residential', 'EmployerController@registerResidential')->name('residential.register');
  Route::post('residential', 'EmployerController@registration')->name('residential.registration');  

  Route::get('commercial', 'EmployerController@registerCommercial')->name('commercial.register');
  Route::post('commercial', 'EmployerController@registration')->name('commercial.registration');

  Route::get('technician', 'TechnicianController@register')->name('technician.register');
  Route::post('technician', 'TechnicianController@registration')->name('technician.registration');  
  
  Route::get('contractor', 'TechnicianController@register');
  
  Route::get('/technician_list', 'UserController@list');
  
  
});

Route::get('/register/technician_list_', 'UserController@list_')->middleware(['auth']);


Route::group(['middleware' => ['guest']], function(){  
    Route::get('/user/login', 'UserController@login')->name('user.login');  
    Route::get('/user/register', 'UserController@register')->name('user.register');
    Route::get('/registration/residential', 'EmployerController@registrationViewR')->name('residential.registration');
    Route::get('/registration/commercial', 'EmployerController@registrationViewC')->name('commercial.registration');
    Route::get('/commercial/request', 'EmployerController@commercial_view_customised')->name('commercial.customise_');
    Route::post('/commercial/request', 'EmployerController@commercial_customised')->name('commercial.customised');
    Route::get('/commercial_view_technician/{id}', 'EmployerController@profileTechnicianCommercial')->name('profile.technician');
    Route::get('/residential_view_technician/{id}', 'EmployerController@profileTechnicianResidential')->name('profile.technician');    
    Route::post('/user/register', 'UserController@registration')->name('user.registration');
});




/*
* Social authentication
*/
Route::group(['prefix' => 'social', 'middleware' => ['guest']], function(){
  Route::get('facebook', 'SocialAuthController@facebook');
  Route::get('google', 'SocialAuthController@google');
  Route::group(['prefix' => 'callback'], function(){
    Route::get('facebook', 'SocialAuthController@facebookCallback');
    Route::get('google', 'SocialAuthController@googleCallback');
  });
});


/*
* after authenticate
* check if user type is set
*/
Route::group(['prefix' => '/', 'middleware' => ['auth', 'suspend_check']], function(){

  Route::get('/view_technician/{id}', 'EmployerController@profileTechnicianResidential')->name('profile.technician');
  Route::post('/accept_invitation', 'TechnicianController@accept_invitation');


  Route::group(['middleware' => 'password_check'], function(){
    Route::get('/set_account_password', 'SocialAuthController@setAccountPassword');
    Route::post('/set_account_password', 'SocialAuthController@saveAccountPassword');
  });
  Route::group(['middleware' => ['password']], function(){
    Route::get('logout', 'UserController@logout')->name('user.logout');

    /*
    * middleware account check if account type set
    */
    Route::group(['middleware' => ['account']], function(){
      Route::get('/verificat_token_/{token}', 'EmployerController@verify');
      Route::get('/redirect_dashboard', 'UserController@redirect')->name('user.redirect');

      Route::post('/update_password', 'UserController@updatePassword')->name('updatePassword.user');

      /*profile*/
      Route::post('/upload_profile_picture', 'UserController@uploadProfile')->name('user.uploadProfile');
      Route::get('/update_location', 'UserController@updateLocation')->name('user.updateLocation');
      Route::get('/update_schedule', 'UserController@updateSchedule')->name('user.updateSchedule');
      Route::get('/update_profile', 'UserController@updateProfile')->name('user.updateProfile');

      /*bidding*/
      Route::get('/bid', 'TechnicianController@bid')->name('technician.bid');
      /*view profile*/
      Route::get('/view_profile/{id}', 'UserController@profile')->name('profile');
      /*add review*/
      Route::post('/add_review', 'UserController@addReview')->name('profile');
      /*chat*/
      Route::get('/search', 'UserController@search')->name('search');

      /*
      * chat route
      */
      Route::group(['prefix' => 'chat'], function(){
        Route::post('/viewMessage', 'ChatController@index')->name('view_message');
        Route::post('/sendMessage', 'ChatController@store')->name('send_message');
        Route::get('/viewContact', 'ChatController@show')->name('view_contact');
        Route::get('/inboxContact', 'ChatController@showInbox')->name('inbox_contact');
        Route::post('/inboxMessage', 'ChatController@inboxMessage')->name('inbox_message');
        Route::get('/hired', 'ChatController@hired')->name('hired_technician');
      });

      /*
      * chat route
      */
      Route::group(['prefix' => 'transaction'], function(){
        Route::post('/pay_with_paypal', 'PaymentController@payWithPaypal')->name('pay');
        Route::post('/withdraw', 'PaymentController@CreateSinglePayout')->name('withdraw');
        Route::get('/paypal/top_up', 'PaymentController@getPaymentStatus')->name('status');
        Route::post('/subscribe', 'SendPaymentController@payWithPaypal')->name('subscribe');
        Route::get('/paypal/subscribe', 'SendPaymentController@getPaymentStatus')->name('status_subscribe');
        Route::post('/subscribe_stripe', 'StripePaymentController@index')->name('subscribe_stripe');
        Route::post('/top_stripe', 'StripePaymentController@top')->name('top_stripe');
        Route::post('/subscribe_with_stripe', 'StripePaymentController@pay')->name('subscribe_stripe_pay');
        Route::post('/top_with_stripe', 'StripePaymentController@top_')->name('top_stripe_pay'); 
      });




      /*
      * validate the url segment
      */
      Route::group(['middleware' => ['check']], function(){
        /*
        * job view
        */
        Route::group(['prefix' => 'job'], function(){
          Route::get('/technician/{id}', 'UserController@singleJob')->name('singleJob.technician');
          Route::get('/contractor/{id}', 'UserController@singleJob')->name('singleJob.technician');
          Route::get('/residential/{id}', 'UserController@singleJob')->name('singleJob.residential');
          Route::get('/commercial/{id}', 'UserController@singleJob')->name('singleJob.commercial');
        });

        Route::group(['prefix' => 'job_invite'], function(){
          Route::get('/residential/{id}_{user_id}', 'EmployerController@invite_')->name('invite.residential');
          Route::get('/commercial/{id}_{user_id}', 'EmployerController@invite_')->name('invite.commercial');
        });

        /*
        * view profile
        */
        Route::group(['prefix' => 'profile'], function(){
          Route::get('technician', 'TechnicianController@profile')->name('profile.technician');
          Route::get('contractor', 'TechnicianController@profile')->name('profile.contractor');
          Route::get('residential', 'EmployerController@profile')->name('profile.residential');
          Route::get('commercial', 'EmployerController@profile')->name('profile.commercial');
        });

        /*
        * edit profile
        */
        Route::group(['prefix' => 'edit'], function(){
          Route::get('technician', 'TechnicianController@edit')->name('edit.technician');
          Route::get('contractor', 'TechnicianController@edit')->name('edit.contractor');
          Route::get('residential', 'EmployerController@edit')->name('edit.residential');
          Route::get('commercial', 'EmployerController@edit')->name('edit.commercial');
        });

        /*
        * edit profile
        */
        Route::group(['prefix' => 'invitation'], function(){
          Route::get('/residential/{id}', 'EmployerController@invitation')->name('invitation.residential');
          Route::get('/commercial{id}', 'EmployerController@invitation')->name('invitation.commercial');
        });

        /*
        * forgot Password
        */
        Route::group(['prefix' => 'change_password'], function(){
          Route::get('technician', 'TechnicianController@forgot')->name('change_password.technician');
          Route::get('contractor', 'TechnicianController@forgot')->name('change_password.contractor');
          Route::get('residential', 'EmployerController@forgot')->name('change_password.residential');
          Route::get('commercial', 'EmployerController@forgot')->name('change_password.commercial');
        });

        /*
        * dashboard
        */
        Route::group(['prefix' => 'dashboard'], function(){
          Route::get('technician', 'TechnicianController@dashboard')->name('dashboard.technician');
          Route::get('contractor', 'TechnicianController@dashboard')->name('dashboard.contractor');
          Route::get('residential', 'EmployerController@dashboard')->name('dashboard.residential');
          Route::get('commercial', 'EmployerController@dashboard')->name('dashboard.commercial');
        });

        /*
        * settings

        Route::group(['prefix' => 'settings'], function(){
          Route::get('technician', 'TechnicianController@settings')->name('settings.technician');
          Route::get('residential', 'EmployerController@settings')->name('settings.residential');
          Route::get('commercial', 'EmployerController@settings')->name('settings.commercial');
        });
        */

        /*
        * invoice
        */
        Route::group(['prefix' => 'invoices'], function(){
          Route::get('technician', 'TechnicianController@invoices')->name('invoices.technician');
          Route::get('contractor', 'TechnicianController@invoices')->name('invoices.contractor');
        });

        /*
        * upgrade
        */
        Route::group(['prefix' => 'upgrade'], function(){
          Route::get('technician', 'TechnicianController@upgrade')->name('upgrade.technician');
          Route::get('contractor', 'TechnicianController@upgrade')->name('upgrade.contractor');
          
        });

        /*
        * search
        */
        Route::group(['prefix' => 'search'], function(){
          Route::get('technician', 'TechnicianController@search')->name('search.technician');
          Route::get('contractor', 'TechnicianController@search')->name('search.contractor');
        });

        /*
        * post job
        */
        Route::group(['prefix' => 'upload_job'], function(){
          Route::post('commercial', 'EmployerController@post')->name('post_job.commercial');
          Route::post('residential', 'EmployerController@post')->name('post_job.residential');
        });

        /*
        * bidding
        */
        Route::group(['prefix' => 'bidding'], function(){
          Route::get('technician', 'TechnicianController@bidding')->name('bidding.technician');
          Route::get('contractor', 'TechnicianController@bidding')->name('bidding.contractor');
        });

        Route::group(['prefix' => 'accept_offer_{job_id}'], function(){
          Route::get('technician', 'TechnicianController@acceptOffer')->name('accept.offer');
          Route::get('contractor', 'TechnicianController@acceptOffer')->name('accept.contractor');
        });
        Route::group(['prefix' => 'decline_offer_{job_id}'], function(){
          Route::get('technician', 'TechnicianController@declineOffer')->name('decline.offer');
          Route::get('contractor', 'TechnicianController@declineOffer')->name('decline.contractor');
        });

        /*
        * Accepted project
        */
        Route::group(['prefix' => 'accepted'], function(){
          Route::get('commercial', 'EmployerController@accepted')->name('accepted.commercial');
          Route::get('residential', 'EmployerController@accepted')->name('accepted.residential');
        });


        /*
        * Technician List
        */
        Route::group(['prefix' => 'browse_technician'], function(){
          Route::get('commercial', 'EmployerController@technicianList')->name('technicianList.commercial');
          Route::get('residential', 'EmployerController@technicianList')->name('technicianList.residential');
        });

        /*
        * pending project
        */
        Route::group(['prefix' => 'pending'], function(){
          Route::get('commercial', 'EmployerController@pending')->name('pending.commercial');
          Route::get('residential', 'EmployerController@pending')->name('pending.residential');
        });

        /*
        * pending project
        */
        Route::group(['prefix' => 'transaction'], function(){
          Route::get('commercial', 'EmployerController@transaction')->name('transaction.commercial');
          Route::get('residential', 'EmployerController@transaction')->name('transaction.residential');
        });


        /*
        * inbox
        */
        /*Route::group(['prefix' => 'inbox'], function(){
          Route::get('technician', 'TechnicianController@inbox')->name('inbox.technician');
          Route::get('commercial', 'EmployerController@inbox')->name('inbox.commercial');
          Route::get('residential', 'EmployerController@inbox')->name('inbox.residential');
        });*/

        /*
        * sent
        */
        /*Route::group(['prefix' => 'sent'], function(){
          Route::get('technician', 'TechnicianController@sent')->name('sent.technician');
          Route::get('commercial', 'EmployerController@sent')->name('sent.commercial');
          Route::get('residential', 'EmployerController@sent')->name('sent.residential');
        });*/

        /*
        * deleted
        */
        /*Route::group(['prefix' => 'deleted'], function(){
          Route::get('technician', 'TechnicianController@deleted')->name('deleted.technician');
          Route::get('commercial', 'EmployerController@deleted')->name('deleted.commercial');
          Route::get('residential', 'EmployerController@deleted')->name('deleted.residential');
        });*/

        /*
        * review
        */
        Route::group(['prefix' => 'review'], function(){
          Route::get('technician', 'TechnicianController@review')->name('review.technician');
          Route::get('contractor', 'TechnicianController@review')->name('review.contractor');
          Route::get('commercial', 'EmployerController@review')->name('review.commercial');
          Route::get('residential', 'EmployerController@review')->name('review.residential');
        });

        /*
        * faq
        */
        Route::group(['prefix' => 'faq'], function(){
          Route::get('technician', 'TechnicianController@faq')->name('faq.technician');
          Route::get('contractor', 'TechnicianController@faq')->name('faq.contractor');
          Route::get('commercial', 'EmployerController@faq')->name('faq.commercial');
          Route::get('residential', 'EmployerController@faq')->name('faq.residential');
        });
      });
    });

    Route::group(['middleware' => ['account_set']], function(){
      Route::get('/set_account_type', 'UserController@setAccount')->name('user.setAccount');
      Route::post('/set_account_type', 'UserController@accountSet')->name('user.accountSet');
    });
  });
});
