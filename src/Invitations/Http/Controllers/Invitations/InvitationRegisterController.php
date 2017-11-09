<?php

namespace Jameron\Invitations\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Jameron\Invitations\Models\Invitation;


use App\Http\Controllers\Auth\RegisterController as LaravelRegisterController;

class InvitationRegisterController extends LaravelRegisterController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => 'required|string|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,10}/',
            'invitation_token' => 'exists:invitations,token',
        ]);
    }

    /**
     * Create a new user instance after a valid invitation registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $invitation = Invitation::where('token', $data['invitation_token'])
            ->with('roles')
            ->first();

        if ($invitation) {

            $user = resolve('App\User');
            $user = User::create([
                'name' => $invitation->name,
                'email' => $invitation->email,
                'password' => bcrypt($data['password']),
            ]);

            foreach($invitation->roles as $role) {

                $user->assignRole($role->slug);

            }

            $invitation->delete($user);
            $this->claimed();
            
            $this->redirectTo = $user->roles()->first()->slug;
            return $user;

        }
    }

    protected function claimed(User $user)
    {
        // do something with the user object after the token has been claimed
    }

}
