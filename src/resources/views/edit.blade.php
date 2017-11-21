@extends('admin::layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-md-left">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card" style="margin-top: 1rem;">
                <h4 class="card-header">
                    Edit Invitation
                </h4>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"></p>
                    @include('admin::partials.utils._success')
                    <form action="/admin/invitations/{{$invitation->id}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        @include('invitations::partials.forms.invitation', ['submitButtonText' => 'Update', 'mode'=>'edit'])
                    </form>
                    @include('admin::partials.utils._errors')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
