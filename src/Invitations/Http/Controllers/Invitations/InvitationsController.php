<?php

namespace Jameron\Invitations\Http\Controllers\Invitations;

use Auth;
use Mail;
use Config;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Jameron\Regulator\Models\Role;
use App\Http\Controllers\Controller;
use Jameron\Invitations\Models\Invitation;
use Jameron\Enrollments\Http\Requests\InvitationRequest;
use Jameron\Invitations\Mail\Invitation as InvitationMail;

class InvitationsController extends Controller
{

    public $columns = [];

    public function getIndexViewColumns()
    {
        if(isset(config('invitations.roles')[Auth::user()->roles()->first()->slug])) {
            $this->columns = collect(config('invitations.roles')[Auth::user()->roles()->first()->slug]);
        }
        return $this->columns;
    }

    public function index(Request $request)
    {

        $read_invitations_permissions = config('invitations.permissions.read.slug');

        if(!Auth::user()->can($read_invitations_permissions)) {
            return view('errors.403');
        }

        $search = ($request->get('search')) ? $request->get('search') : null;
        $sort_by = ($request->get('sortBy')) ? $request->get('sortBy') : 'email';
        $order = ($request->get('order')) ? $request->get('order') : 'ASC';

        $invitations = Invitation::with('roles');

        if ($search) {

            $invitations = $invitations     
                ->select('invitations.*')
                ->where(function ($query) use ($search) {
                    $query->where('email', 'LIKE', '%'.$search.'%')
                        ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                        ->orWhere('first_name', 'LIKE', '%'.$search.'%');
                });
        }

        if ($sort_by!=='role') {

            $invitations = $invitations
                ->orderBy($sort_by, $order);
        } else {

            $invitations = $invitations        
                ->join('invitations_role_user', 'invitations_role_user.registration_key_id', '=', 'invitations.id')
                ->join('regulator_roles', 'regulator_roles.id', '=', 'invitations_role_user.role_id')
                ->orderBy('regulator_roles.label', $order)
                ->select('invitations.*');
        }

        $invitations = $invitations->paginate(config('admin.paginate.count'));

        $data = [];
        $data['search'] = [
            'show' => config('invitations.index.search')['show'],
            'placeholder' => 'Search invitations by email',
            'button_text' => 'Search',
			'icon' => 'search',
            'route' => '/invitations/search',
            'string' => $search
        ];
        
        $data['create_button'] = config('invitations.create.button');
        $data['resource_route'] = config('invitations.resource_route');
        $data['permissions'] = [
            'create' => 'create_invitations',
            'read' => 'read_invitations',
            'update' => 'update_invitations',
            'delete' => 'delete_invitations'
        ];
        $data['sort_by'] = $sort_by;
        $data['order'] = $order;
        $data['items'] = $invitations;
        $data['columns'] = $this->getIndexViewColumns();

        return view('invitations::index')
            ->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];

        $roles = Role::all();

        $data['roles'] = $roles;

        if(Config::get('invitations.related')) {
            $invitables = resolve('App\Invitable');
            if(config('invitations.related.owner_foreign_key')) {
                if(count(config('invitations.related.restrict_roles'))) {
                    if(in_array(Auth::user()->roles()->first()->slug, config('invitations.related.restrict_roles'))) {
                        $invitables = $invitables->where(config('invitations.related.owner_foreign_key'), Auth::user()->id);
                    }
                }
            }
            $invitables = $invitables->pluck(Config::get('invitations.related.value_column'), Config::get('invitations.related.id_column'));
            $data['invitables'] = $invitables;
        }

        return view('invitations::create')
            ->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvitationRequest $request)
    {

        $invitation = new Invitation();
        $invitation->first_name = $request->get('first_name');
        $invitation->last_name = $request->get('last_name');
        $invitation->email = ($request->email);
        $invitation->token = ($request->token);
        $invitation->expires_at = ($request->get('days_until_expires')) ? Carbon::now()->addDays($request->get('days_until_expires')) : null;

        if(Config('invitations.related.active') && $request->get('related')) {
            $invitable_model = resolve('App\Invitable');
            $invitable_model_id = (integer)$request->get('related');
            $invitable_model = $invitable_model->find($invitable_model_id);
            $invitable_model->relate($invitation);
        }
        $invitation->save();
        
        // If there are no roles then create an empty array
        $request->roles = ($request->roles) ? $request->roles : [];
        $invitation->roles()->sync($request->roles);

        $message = Mail::to($invitation)
                    ->send(
                        (new InvitationMail($invitation))
                            ->withSwiftMessage(function ($message) use ($invitation) {
                                $invitation->message_id = $message->getId();
                                $invitation->sent_at = Carbon::now();
                                $invitation->save();
                            }));

        return redirect(config('invitations.resource_route'))
            ->with('success_message', 'Invitation created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $roles = Role::all();
        $data['roles'] = $roles;
        $invitation = Invitation::where('id', $id)
            ->with('roles');

        if(Config::get('invitations.related')) {
            $invitation = $invitation
                ->with('invitable');
        }
        $invitation = $invitation
            ->first();

        if(Config::get('invitations.related')) {
            $invitables = resolve('App\Invitable');
            if(config('invitations.related.owner_foreign_key')) {
                $invitables = $invitables->where(config('invitations.related.owner_foreign_key'), Auth::user()->id);
            }
            $invitables = $invitables->pluck(Config::get('invitations.related.value_column'), Config::get('invitations.related.id_column'));
            $data['invitables'] = $invitables;
        }

        $data['invitation'] = $invitation;

        return view('invitations::edit')
            ->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvitationRequest $request, $id)
    {
        $invitation = Invitation::where('id', $id)
            ->firstOrFail();
        $invitation->first_name = $request->get('first_name');
        $invitation->last_name = $request->get('last_name');
        $invitation->email = ($request->email);
        $invitation->token = ($request->token);
        $invitation->expires_at = ($request->get('days_until_expires')) ? Carbon::now()->addDays($request->get('days_until_expires')) : null;
        $invitation->save();

        $request->roles = ($request->roles) ? $request->roles : [];
        $invitation->roles()->sync($request->roles);

        return redirect(config('invitations.route'))
            ->with('success_message', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invitation = Invitation::findOrFail($id);
        $invitation->delete();

        return redirect()->to(config('invitations.route'))->with('success_message', $invitation->email . ' was deleted.');

    }

    public function resendInvitation($id)
    {
		$invitation = Invitation::findOrFail($id);	
        $message = Mail::to($invitation)
                    ->send(
                        (new InvitationMail($invitation))
                            ->withSwiftMessage(function ($message) use ($invitation) {
                                $invitation->message_id = $message->getId();
                                $invitation->sent_at = Carbon::now();
                                $invitation->save();
                            }));

        return redirect(config('invitations.route'))
            ->with('success_message', 'Invitation was resent successfully.');
    }

    public function getRegister($id, Request $request)
    {

        $invitation = Invitation::where("token", $request->route('token'))
            ->first();

		if ($invitation) {
			return view('invitations::auth.register', compact('invitation'));
		} else {
			return redirect('/login')->with('error', 'You have already registered. Please sign-in or reset your password.');
        } 

    }
}
