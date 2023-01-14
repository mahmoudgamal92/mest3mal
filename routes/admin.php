<?php

    Route::get(GetSettings()->admin_path.'/lang/{lang?}','SettingsController@ChangeLanguage');
    Route::get(GetSettings()->admin_path.'/login','AdminController@Login');
    Route::post(GetSettings()->admin_path.'/login','AdminController@Login_Request');
    Route::get(GetSettings()->admin_path.'/forget-password','AdminController@Forget_Password');
    Route::get(GetSettings()->admin_path.'/logout','AdminController@Logout');

    // Define Route Group Of admin
    Route::group(['middleware'=>['admin','timeout'],'prefix'=>GetSettings()->admin_path],function(){
        Route::get('/', 'AdminController@Index')->name('adminhomepage');
        //Logs Routes
        Route::post('logs/multi_delete', 'LogsController@multi_delete');
        Route::get('logs/{id}/recover', 'LogsController@recover');
        Route::get('email_marketing', 'LogsController@email_marketing');
        Route::post('send_emails', 'LogsController@send_emails');
        Route::get('news', 'LogsController@news');
        Route::get('delete/{id}/news', 'LogsController@delete_news');

        Route::resource('logs','LogsController');





        // settings
        Route::get('settings','LogsController@settings_show');
        Route::get('/ghangepass','LogsController@ghange_pass');
        Route::get('/profile','LogsController@profile');
        Route::post('ghange_pass','LogsController@store_pass');
        Route::post('settings','LogsController@settings_update')->name('settings.edit');

        // Agents
        Route::post('agents/multi_delete', 'AgentsController@multi_delete');
        Route::resource('agents','AgentsController');

         // agentTypes
        Route::post('agentTypes/multi_delete', 'AgentTypesController@multi_delete');
        Route::resource('agentTypes','AgentTypesController');


        //department
        Route::post('department/multi_delete', 'DepartmentController@multi_delete');
        Route::resource('department','DepartmentController');

        //orders
        Route::resource('orders','OrdersController');


        Route::post('get/cats', 'ResourceController@get_cats');
        Route::get('/pending_resource', 'ResourceController@pending_resource');
        Route::get('download_file/files/{id}', 'ResourceController@downfile');
        Route::resource('resource','ResourceController');


        //countries
        Route::post('countries/multi_delete', 'CountriesController@multi_delete');
        Route::resource('countries','CountriesController');

        // Cities Routes
        Route::post('cities/multi_delete', 'CitiesController@multi_delete');
        Route::resource('cities','CitiesController');

        // Services Routes

        Route::post('services/multi_delete', 'ServicesController@multi_delete');
        Route::resource('services','ServicesController');


        Route::post('category/multi_delete', 'CategoryController@multi_delete');
        Route::get('category/{id}/sub_category', 'CategoryController@get_Subcategory');
        Route::resource('category','CategoryController');


        //

        Route::get('status/{id}/ad/{status}', 'AdsController@status');
        Route::get('auctions', 'AdsController@auctions');
        Route::post('delete/auction/{id}', 'AdsController@delete_auction');
        Route::resource('ads','AdsController');




        //sub_categories
        Route::post('sub_category/multi_delete', 'SubCategoryController@multi_delete');
        Route::post('subcategory/ajax', 'SubCategoryController@subcat_ajax');
        Route::resource('sub_category','SubCategoryController');





        Route::post('users/multi_delete', 'UsersController@multi_delete');
        Route::get('user/{id}/{status}', 'UsersController@user_status');
        Route::get('users_balance', 'UsersController@users_balance');
        Route::post('user/set_balance', 'UsersController@set_balance');
        Route::get('users/{id}/rates', 'UsersController@rates');
        Route::get('users/{id}/rates', 'UsersController@rates');
        Route::get('depositing', 'UsersController@depositing');
        Route::get('withdrawals', 'UsersController@withdrawals');
        Route::get('order_withdrawals/{id}', 'PaypalPaymentController@withdrawals_done');
        Route::get('withdrawals/requests', 'UsersController@withdrawals_requests');
        Route::get('user_cv/cv_editor/{id}', 'UsersController@download_cv');
        Route::resource('users','UsersController');



        Route::resource('roles','RoleController');
        Route::resource('permissions','PermissionController');

        //projects

        Route::get('orders/{status}', 'AdminController@orders');


        Route::get('download_files/cv_files/{id}', 'Cv_StyleController@download');

    });
