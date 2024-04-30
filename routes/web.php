<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['change_password', 'auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::post('users/restore', 'UsersController@restore')->name('users.restore')->withTrashed();
    Route::post('users/forcedestroy', 'UsersController@forceDestroy')->name('users.forcedestroy')->withTrashed();
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController')->withTrashed();

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Disciplinary
    Route::post('disciplinaries/restore', 'DisciplinaryController@restore')->name('disciplinaries.restore')->withTrashed();
    Route::post('disciplinaries/forcedestroy', 'DisciplinaryController@forceDestroy')->name('disciplinaries.forcedestroy')->withTrashed();
    Route::delete('disciplinaries/destroy', 'DisciplinaryController@massDestroy')->name('disciplinaries.massDestroy');
    Route::post('disciplinaries/media', 'DisciplinaryController@storeMedia')->name('disciplinaries.storeMedia');
    Route::post('disciplinaries/ckmedia', 'DisciplinaryController@storeCKEditorImages')->name('disciplinaries.storeCKEditorImages');
    Route::resource('disciplinaries', 'DisciplinaryController');

    // Sop
    Route::post('sops/restore', 'SopController@restore')->name('sops.restore')->withTrashed();
    Route::post('sops/forcedestroy', 'SopController@forceDestroy')->name('sops.forcedestroy')->withTrashed();
    Route::delete('sops/destroy', 'SopController@massDestroy')->name('sops.massDestroy');
    Route::post('sops/media', 'SopController@storeMedia')->name('sops.storeMedia');
    Route::post('sops/ckmedia', 'SopController@storeCKEditorImages')->name('sops.storeCKEditorImages');
    Route::resource('sops', 'SopController');

    // Certifications
    Route::delete('certifications/destroy', 'CertificationsController@massDestroy')->name('certifications.massDestroy');
    Route::resource('certifications', 'CertificationsController');

    // Comments
    Route::post('comments/restore', 'CommentsController@restore')->name('comments.restore')->withTrashed();
    Route::post('comments/forcedestroy', 'CommentsController@forceDestroy')->name('comments.forcedestroy')->withTrashed();
    Route::delete('comments/destroy', 'CommentsController@massDestroy')->name('comments.massDestroy');
    Route::post('comments/media', 'CommentsController@storeMedia')->name('comments.storeMedia');
    Route::post('comments/ckmedia', 'CommentsController@storeCKEditorImages')->name('comments.storeCKEditorImages');
    Route::resource('users.comments', 'CommentsController')->withTrashed();
    Route::resource('comments', 'CommentsController')->withTrashed();

    // Course
    Route::post('courses/restore', 'CourseController@restore')->name('courses.restore')->withTrashed();
    Route::post('courses/forcedestroy', 'CourseController@forceDestroy')->name('courses.forcedestroy')->withTrashed();
    Route::delete('courses/destroy', 'CourseController@massDestroy')->name('courses.massDestroy');
    Route::post('courses/media', 'CourseController@storeMedia')->name('courses.storeMedia');
    Route::post('courses/ckmedia', 'CourseController@storeCKEditorImages')->name('courses.storeCKEditorImages');
    Route::resource('courses', 'CourseController');

    // Training
    Route::post('trainings/restore', 'TrainingController@restore')->name('trainings.restore')->withTrashed();
    Route::post('trainings/forcedestroy', 'TrainingController@forceDestroy')->name('trainings.forcedestroy')->withTrashed();
    Route::delete('trainings/destroy', 'TrainingController@massDestroy')->name('trainings.massDestroy');
    Route::post('trainings/media', 'TrainingController@storeMedia')->name('trainings.storeMedia');
    Route::post('trainings/ckmedia', 'TrainingController@storeCKEditorImages')->name('trainings.storeCKEditorImages');
    Route::resource('trainings', 'TrainingController');

    // Sop Sign Offs
    Route::post('sop-sign-offs/restore', 'SopSignOffsController@restore')->name('sop-sign-offs.restore')->withTrashed();
    Route::post('sop-sign-offs/forcedestroy', 'SopSignOffsController@forceDestroy')->name('sop-sign-offs.forcedestroy')->withTrashed();
    Route::delete('sop-sign-offs/destroy', 'SopSignOffsController@massDestroy')->name('sop-sign-offs.massDestroy');
    Route::resource('sop-sign-offs', 'SopSignOffsController');

    // Rank
    Route::delete('ranks/destroy', 'RankController@massDestroy')->name('ranks.massDestroy');
    Route::resource('ranks', 'RankController');

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        //Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
