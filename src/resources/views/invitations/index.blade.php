@extends('admin::layouts.app')
@section('content')
    @component('admin::partials._card')
        @slot('header')
            {{ config('invitations.display.card-header') }}
        @endslot
        @slot('body')
            @include('admin::partials.utils._index', [
            'items'=>$items,
            'search'=>$search,
            'columns'=>$columns,
            'permissions'=>$permissions,
            'resource_route' => $resource_route
            ])
        @endslot
    @endcomponent
@endsection
