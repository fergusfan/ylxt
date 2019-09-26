<?php

// User Auth
Auth::routes();
Route::post('password/change', 'UserController@changePassword')->middleware('auth');

// Github Auth Route
Route::group(['prefix' => 'auth/github'], function () {
    Route::get('/', 'Auth\AuthController@redirectToProvider');
    Route::get('callback', 'Auth\AuthController@handleProviderCallback');
    Route::get('register', 'Auth\AuthController@create');
    Route::post('register', 'Auth\AuthController@store');
});

// Search
Route::get('search', 'HomeController@search');

// Discussion
Route::get('/discussion/search','DiscussionController@search');
Route::resource('discussion', 'DiscussionController', ['except' => 'destroy']);


// User
Route::group(['prefix' => 'user'], function () {
    Route::get('/', 'UserController@index');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('profile', 'UserController@edit');
        Route::put('profile/{id}', 'UserController@update');
        Route::post('follow/{id}', 'UserController@doFollow');
        Route::get('notification', 'UserController@notifications');
        Route::post('notification', 'UserController@markAsRead');
    });

    Route::group(['prefix' => '{username}'], function () {
        Route::get('/', 'UserController@show');
        Route::get('comments', 'UserController@comments');
        Route::get('following', 'UserController@following');
        Route::get('discussions', 'UserController@discussions');
    });
});

// User Setting
Route::group(['middleware' => 'auth', 'prefix' => 'setting'], function () {
    Route::get('/', 'SettingController@index')->name('setting.index');
    Route::get('binding', 'SettingController@binding')->name('setting.binding');

    Route::get('notification', 'SettingController@notification')->name('setting.notification');
    Route::post('notification', 'SettingController@setNotification');
});

// Link
Route::get('link', 'LinkController@index');

// Category
Route::group(['prefix' => 'category'], function () {
    Route::get('{category}', 'CategoryController@show');
    Route::get('/', 'CategoryController@index');
});

// Tag
Route::group(['prefix' => 'tag'], function () {
    Route::get('/', 'TagController@index');
    Route::get('{tag}', 'TagController@show');
});

/* Dashboard Index */
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'admin']], function () {
   Route::get('{path?}', 'HomeController@dashboard')->where('path', '[\/\w\.-]*');
});


//医生列表
Route::get('/doctors',Web\DoctorsController::class.'@list');
Route::get('/doctors/search',Web\DoctorsController::class.'@search');
//咨询
Route::get('/doctors/question/{id}',Web\DoctorsController::class.'@question')->middleware('auth');
//用户发起图文问诊
Route::get('/online/message/doctor/{id}',Web\OnlineMessageController::class.'@doctor')->middleware('auth');
//发消息(用户端)
Route::post('/online/message/store/user',Web\OnlineMessageController::class.'@storeMessage')->middleware('auth');
//挂号
Route::get('/order',Web\OrderController::class.'@index')->middleware('auth');//验证
//小药箱
Route::get('/drug',Web\DrugController::class.'@index');
Route::get('/drug/search',Web\DrugController::class.'@search');
//药品详情
Route::get('/drug/{id}',Web\DrugController::class.'@info');
//问诊回复
Route::get('/advice',Web\AdviceController::class.'@index');
Route::post('/advice',Web\AdviceController::class.'@store');
Route::get('/advice/info/{id}',Web\AdviceController::class.'@info');

// Article  注意此处路由覆盖id
Route::get('/', 'ArticleController@index');
Route::get('{slug}', 'ArticleController@show');
