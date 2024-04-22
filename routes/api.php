<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');

    // User Alerts
    Route::apiResource('user-alerts', 'UserAlertsApiController', ['except' => ['update']]);

    // Disciplinary
    Route::post('disciplinaries/media', 'DisciplinaryApiController@storeMedia')->name('disciplinaries.storeMedia');
    Route::apiResource('disciplinaries', 'DisciplinaryApiController');
});
