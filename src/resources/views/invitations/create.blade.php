@extends('admin::layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-md-left">
        <div class="col-12 col-md-12 col-lg-9">
            <div class="card" style="margin-top: 1rem;">
                <h4 class="card-header">
                    Create Invitation
                </h4>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"></p>
                    @include('admin::partials.utils._success')
                    <form action="{{ config('invitations.resource_route') }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('invitations::partials.forms.invitation', ['submitButtonText' => 'Update', 'mode'=>'edit'])
                    </form>
                    @include('admin::partials.utils._errors')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
