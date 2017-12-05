<?php 

Route::group(['middleware' => ['web', 'auth', 'role:admin']], function () {
	Route::resource(config('invitations.route'), 'Jameron\Invitations\Http\Controllers\Invitations\InvitationsController');
	Route::post(config('invitations.route') . '/{id}/resend', 'Jameron\Invitations\Http\Controllers\Invitations\InvitationsController@resendInvitation');
});

Route::group(['middleware' => ['web','guest']], function () {
    Route::get('register/{token}', 'Jameron\Invitations\Http\Controllers\Invitations\InvitationsController@getRegister');
    Route::post(config('invitations.route') . '/register', 'Jameron\Invitations\Http\Controllers\Auth\InvitationRegisterController@register');
});
