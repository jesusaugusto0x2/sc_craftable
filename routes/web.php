<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/logout', 'Auth\LoginController@logout');

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::get('/', 'CampsController@index')->name('index');
        Route::prefix('camps')->name('camps/')->group(static function() {
            Route::get('/',                                             'CampsController@index')->name('index');
            Route::get('/create',                                       'CampsController@create')->name('create');
            Route::post('/',                                            'CampsController@store')->name('store');
            Route::get('/{camp}/edit',                                  'CampsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'CampsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{camp}',                                      'CampsController@update')->name('update');
            Route::delete('/{camp}',                                    'CampsController@destroy')->name('destroy');

            //Gallery view
            Route::get('/{id}/gallery', 'CampsController@viewGallery')->name('gallery');
            Route::post('{id}/savePhoto', 'CampsController@savePhoto')->name('gallery/save-photo');
            Route::get('deletePhoto/{photo_id}', 'CampsController@deletePhoto')->name('gallery/delete-photo');

            // Custom
            Route::get('/{id}/payments', 'CampPaymentController@getPayments')->name('payments');
            Route::get('/payment-info/{payment_id}', 'CampPaymentController@viewPayment')->name('payment-info');
            Route::get('/payment-validate/{payment_id}/{status}', 'CampPaymentController@validatePayment')->name('payment-validate');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('users')->name('users/')->group(static function() {
            Route::get('/',                                             'UsersController@index')->name('index');
            Route::get('/create',                                       'UsersController@create')->name('create');
            Route::post('/',                                            'UsersController@store')->name('store');
            Route::get('/{user}/edit',                                  'UsersController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'UsersController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{user}',                                      'UsersController@update')->name('update');
            Route::delete('/{user}',                                    'UsersController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('banks')->name('banks/')->group(static function() {
            Route::get('/',                                             'BanksController@index')->name('index');
            Route::get('/create',                                       'BanksController@create')->name('create');
            Route::post('/',                                            'BanksController@store')->name('store');
            Route::get('/{bank}/edit',                                  'BanksController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'BanksController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{bank}',                                      'BanksController@update')->name('update');
            Route::delete('/{bank}',                                    'BanksController@destroy')->name('destroy');
        });
    });
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('methods')->name('methods/')->group(static function() {
            Route::get('/',                                             'MethodsController@index')->name('index');
            Route::get('/create',                                       'MethodsController@create')->name('create');
            Route::post('/',                                            'MethodsController@store')->name('store');
            Route::get('/{method}/edit',                                'MethodsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'MethodsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{method}',                                    'MethodsController@update')->name('update');
            Route::delete('/{method}',                                  'MethodsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
/*Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('camps-payments')->name('camps-payments/')->group(static function() {
            Route::get('/',                                             'CampsPaymentsController@index')->name('index');
            Route::get('/create',                                       'CampsPaymentsController@create')->name('create');
            Route::post('/',                                            'CampsPaymentsController@store')->name('store');
            Route::get('/{campsPayment}/edit',                          'CampsPaymentsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'CampsPaymentsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{campsPayment}',                              'CampsPaymentsController@update')->name('update');
            Route::delete('/{campsPayment}',                            'CampsPaymentsController@destroy')->name('destroy');
        });
    });
});*/


Auth::routes();

Route::get('/home', 'User\CampsController@index')->name('home')->middleware('auth');
Route::prefix('camps')->middleware('auth')->name('camps/')->group(static function() {
    Route::get('/', 'User\CampsController@index')->name('index');
    Route::get('/{id}/gallery', 'User\CampsController@gallery')->name('{id}/gallery');
    Route::get('/{id}/payment', 'User\CampsPaymentsController@create')->name('{id}/payment');
    Route::post('/{id}/payment', 'User\CampsPaymentsController@store')->name('{id}/payment');
    Route::post('/{id}/payment/save-photo', 'User\CampsPaymentsController@savePhoto')->name('{id}/payment/save-photo');
});

Route::prefix('/my-camps')->middleware('auth')->name('my-camps/')->group(static function() {
    Route::get('/', 'User\CampsController@myCamps')->name('');
    Route::get('/{id}/gallery', 'User\CampsController@myCampsGallery')->name('{id}/gallery');
    Route::get('/{id}/payment', 'User\CampsController@payment')->name('{id}/payment');
});

Route::prefix('payments')->middleware('auth')->name('payments/')->group(static function() {
    Route::get('/', 'User\CampsPaymentsController@index')->name('');
    Route::get('/{id}', 'User\CampsPaymentsController@show')->name('{id}');
});

Route::prefix('user')->middleware('auth')->name('user/')->group(static function() {
    Route::get('/profile', 'User\ProfileController@editProfile')->name('edit-profile');
    Route::post('/profile', 'User\ProfileController@updateProfile')->name('update-profile');
    Route::get('/password', 'User\ProfileController@editPassword')->name('edit-password');
    Route::post('/password', 'User\ProfileController@updatePassword')->name('update-password');
});

