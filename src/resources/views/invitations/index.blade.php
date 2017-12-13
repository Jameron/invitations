@extends('admin::layouts.app')
@section('content')
    <div class="container-fluid">
    <div class="row justify-content-md-left">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card" style="margin-top: 1rem;">
                <h4 class="card-header">
                    Invitations
                </h4>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"></p>
                        @include('admin::partials.utils._success')
                        <a href="{{ url(config('invitations.route') . '/create') }}" class="btn btn-primary">Create</a>
                        <table class="table table-hover table-responsive">
                            <thead>
                                <tr>
                                    @include('admin::partials.utils._sortable_column', 
                                    [
                                        'th' => 'Name', 
                                        'column' => 'name' 
                                    ])
                                    @include('admin::partials.utils._sortable_column', 
                                    [
                                        'th' => 'Email', 
                                        'column' => 'email' 
                                    ])
                                    @include('admin::partials.utils._sortable_column', 
                                    [
                                        'th' => 'Token', 
                                        'column' => 'token' 
                                    ])
                                    @include('admin::partials.utils._sortable_column', 
                                    [
                                        'th' => 'Sent at', 
                                        'column' => 'sent_at' 
                                    ])
                                    @if(config('invitations.expires'))
                                    @include('admin::partials.utils._sortable_column', 
                                    [
                                        'th' => 'Expires at', 
                                        'column' => 'expires_at' 
                                    ])
                                    @endif
                                    @include('admin::partials.utils._sortable_column', 
                                    [
                                        'th' => 'Status', 
                                        'column' => 'status' 
                                    ])
                                    @if(config('invitations.related.active'))
                                    <th>Related Model</th>
                                    @endif
                                    <th>Edit</th>
                                    <th>Resend</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invitations as $invitation)
                                    <tr>
                                        <td>{{ $invitation->first_name . ' ' . $invitation->last_name }}</td>
                                        <td>{{ $invitation->email }}</td>
                                        <td>{{ $invitation->token }}</td>
                                        <td>
                                            {!! ($invitation->sent_at) ? date('M d, Y h:i a', strtotime($invitation->sent_at)) : 'Not yet sent' !!}
                                        </td>
                                        @if(config('invitations.expires'))
                                        <td>
                                            {!! ($invitation->expires_at) ? date('M d, Y h:i a', strtotime($invitation->expires_at)) : '' !!}
                                        </td>
                                        @endif
                                        <td>
                                            {!! $invitation->status !!}
                                        </td>
                                        @if(config('invitations.related.active'))
                                        <td>
                                            <a href="{{ config('invitations.related.resource_route') . '/' . $invitation->invitable->{config('invitations.related.id_column')} }}">
                                                {!! ucfirst(strtolower($invitation->invitable->{config('invitations.related.value_column')})) !!}
                                            </a>
                                        </td>
                                        @endif
                                        <td>
                                            <a href="{!! config('invitations.route') . '/' . $invitation->id !!}/edit">Edit</a>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ url(config('invitations.route') . '/' . $invitation->id . '/resend') }}" onsubmit='return confirm("Are you sure you want to resend this invitation?");'>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-link"><span>Resend Invitation</span></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ url(config('invitations.route') . '/' . $invitation->id) }}" onsubmit='return confirm("Are you sure you want to delete this invitation?");'>
                                                <input type="hidden" name="_method" value="DELETE"> 
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-link"><span>Delete</span></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
