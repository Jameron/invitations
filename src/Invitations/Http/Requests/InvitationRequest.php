<?php 

namespace Jameron\Enrollments\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvitationRequest extends FormRequest {

	public function messages()
	{
		return [
			'email.unique' => 'The email has been used on either the users table, or the invitations table.',
		];
	}

	public function authorize()
	{
		$this->request->add([
            'token'	=> sha1( time() . $this->request->get('email') )
        ]);
		return true;
	}

	public function rules()
	{
        $id = $this->route('invitation');
		switch($this->method())
   	 	{
			case 'GET':
        	case 'DELETE':
        	{
            	return [];
        	}
			case 'POST':
			{
				$rules = [
					'first_name'  => 'required|min:1',
					'last_name'  => 'required|min:1',
					'email' => 'required|email|unique:invitations,email|unique:users,email',
					'roles' => 'required',
                ];

                if(config('invitations.related') {

                    $rules[] = [
                        'related' => 'required'
                    ];

                }

                return $rules;
			}
			case 'PUT':
			case 'PATCH':
			{
				$rules = [
					'first_name'  => 'required|min:1',
					'last_name'  => 'required|min:1',
					'email' => 'required|email|unique:users,email|unique:invitations,email,'.$id,
					'roles' => 'required',
                ];
                if(config('invitations.related') {

                    $rules[] = [
                        'related' => 'required'
                    ];

                }
                return $rules;
			}
			default: break;
		}
	}
}
