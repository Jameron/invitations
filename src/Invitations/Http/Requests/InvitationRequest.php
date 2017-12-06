<?php 

namespace Jameron\Enrollments\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvitationRequest extends FormRequest {

	public function messages()
	{
		return [
            'email.unique' => 'The email has been used on either the users table, or the invitations table.',
            'related.required' => 'You must select a related option.'
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
                    'email' => 'required|email|unique:invitations,email|unique:users,email'
                ];

                if(file_exists(base_path() . '/vendor/jameron/regulator/')) {
                    $rules['roles'] = 'required';
                }

                if(file_exists(base_path() . '/vendor/jameron/invitations/')) {
                    if(config('invitations.related.active')) {
                        $rules['related'] = 'required';
                    }
                }

                return $rules;
			}
			case 'PUT':
			case 'PATCH':
			{
				$rules = [
					'first_name'  => 'required|min:1',
					'last_name'  => 'required|min:1',
					'email' => 'required|email|unique:users,email|unique:invitations,email,'.$id
                ];

                if(file_exists(base_path() . '/vendor/jameron/regulator/')) {
                    $rules['roles'] = 'required';
                }

                if(file_exists(base_path() . '/vendor/jameron/invitations/')) {
                    if(config('invitations.related.active')) {
                        $rules['related'] = 'required';
                    }
                }

                return $rules;
			}
			default: break;
		}
	}
}
