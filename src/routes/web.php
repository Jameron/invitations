<?php 

Route::group(['middleware' => ['web', 'auth', 'role:admin']], function () {
	Route::resource('admin/invitations', 'Jameron\Invitations\Http\Controllers\Invitations\InvitationsController');
	Route::post('admin/invitations/{id}/resend', 'Jameron\Invitations\Http\Controllers\Invitations\InvitationsController@resendInvitation');
});

Route::group(['middleware' => ['web','guest']], function () {
    Route::get('register/{token}', 'Jameron\Invitations\Http\Controllers\Invitations\InvitationsController@getRegister');
    Route::post('invitations/register', 'Jameron\Invitations\Http\Controllers\Auth\InvitationRegisterController@register');
});
