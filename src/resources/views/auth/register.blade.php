@extends('admin::layouts.student')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    @include('admin::partials.utils._success')
                    <form class="form-horizontal" action="{{ url('invitations/register') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('invitations::partials.forms.register', ['submitButtonText' => 'Register', 'mode'=>'edit'])
                    </form>
                    @include('admin::partials.utils._errors')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
