<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Boat
    Route::delete('boats/destroy', 'BoatController@massDestroy')->name('boats.massDestroy');
    Route::resource('boats', 'BoatController');

    // Address
    Route::delete('addresses/destroy', 'AddressController@massDestroy')->name('addresses.massDestroy');
    Route::post('addresses/parse-csv-import', 'AddressController@parseCsvImport')->name('addresses.parseCsvImport');
    Route::post('addresses/process-csv-import', 'AddressController@processCsvImport')->name('addresses.processCsvImport');
    Route::resource('addresses', 'AddressController');

    // Sticker
    Route::delete('stickers/destroy', 'StickerController@massDestroy')->name('stickers.massDestroy');
    Route::resource('stickers', 'StickerController');

    // Payment
    Route::delete('payments/destroy', 'PaymentController@massDestroy')->name('payments.massDestroy');
    Route::resource('payments', 'PaymentController');

    // Reservation
    Route::delete('reservations/destroy', 'ReservationController@massDestroy')->name('reservations.massDestroy');
    Route::resource('reservations', 'ReservationController');

    // Newsletter
    Route::delete('newsletters/destroy', 'NewsletterController@massDestroy')->name('newsletters.massDestroy');
    Route::post('newsletters/media', 'NewsletterController@storeMedia')->name('newsletters.storeMedia');
    Route::post('newsletters/ckmedia', 'NewsletterController@storeCKEditorImages')->name('newsletters.storeCKEditorImages');
    Route::resource('newsletters', 'NewsletterController');

    // Minute Data
    Route::delete('minute-datas/destroy', 'MinuteDataController@massDestroy')->name('minute-datas.massDestroy');
    Route::post('minute-datas/media', 'MinuteDataController@storeMedia')->name('minute-datas.storeMedia');
    Route::post('minute-datas/ckmedia', 'MinuteDataController@storeCKEditorImages')->name('minute-datas.storeCKEditorImages');
    Route::post('minute-datas/parse-csv-import', 'MinuteDataController@parseCsvImport')->name('minute-datas.parseCsvImport');
    Route::post('minute-datas/process-csv-import', 'MinuteDataController@processCsvImport')->name('minute-datas.processCsvImport');
    Route::resource('minute-datas', 'MinuteDataController');

    // Todo
    Route::delete('todos/destroy', 'TodoController@massDestroy')->name('todos.massDestroy');
    Route::post('todos/parse-csv-import', 'TodoController@parseCsvImport')->name('todos.parseCsvImport');
    Route::post('todos/process-csv-import', 'TodoController@processCsvImport')->name('todos.processCsvImport');
    Route::resource('todos', 'TodoController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
