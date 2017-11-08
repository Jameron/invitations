@extends('admin::layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Invitations Index Page</div>
                    <div class="panel-body">
                        @include('admin::partials.utils._success')
                        <a href="{{ url('/admin/invitations/create') }}" class="btn btn-primary">Create</a>
                        <table class="table table-hover">
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
                                    @include('admin:partials.utils._sortable_column', 
                                    [
                                        'th' => 'Token', 
                                        'column' => 'token' 
                                    ])
                                    @include('admin::partials.utils._sortable_column', 
                                    [
                                        'th' => 'Sent at', 
                                        'column' => 'sent_at' 
                                    ])
                                    @include('admin::partials.utils._sortable_column', 
                                    [
                                        'th' => 'Status', 
                                        'column' => 'status' 
                                    ])
                                    <th>Resend</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invitations as $invitation)
                                    <tr>
                                        <td>{{ $invitation->name }}</td>
                                        <td>{{ $invitation->email }}</td>
                                        <td>{{ $invitation->token }}</td>
                                        <td>
                                            {!! ($invitation->sent_at) ? date('M d, Y h:i a', strtotime($invitation->sent_at)) : 'Not yet sent' !!}
                                        </td>
                                        <td>
                                            {!! ($invitation->expires_at) ? date('M d, Y h:i a', strtotime($invitation->expires_at)) : '' !!}
                                        </td>
                                        <td>{!! ucfirst(strtolower($invitation->status)) !!}</td>
                                        <td>
                                            <form method="POST" action="{{ url('admin/invitations/' . $invitation->id . '/resend') }}" onsubmit='return confirm("Are you sure you want to resend this invitation?");'>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-link"><span>Resend Invitation</span></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ url('admin/invitations/' . $invitation->id) }}" onsubmit='return confirm("Are you sure you want to delete this invitation?");'>
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
@endsection
