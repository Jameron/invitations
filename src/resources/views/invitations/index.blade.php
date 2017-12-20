@extends('admin::layouts.app')
@section('content')
    @component('partials._card')
        @slot('header')
            {{ config('invitations.display.card-header') }}
        @endslot
        @slot('body')
            @if(config('invitations.display.search')['show'])
                <div class="row">
                    <div class="col-md-9">
                        @include('partials._search', ['search'=> config('invitations.display.search') ])
                        <p class="subtle float-right mt-2">Displaying {!! $items->firstItem() !!} - {!! $items->lastItem() !!} of  {!! $items->total() !!} total</p>
                        @if(!empty($search_string))
                            <a href="{{ url($resource_route) }}">Clear Search</a>
                        @endif
                    </div>
                </div>
            @endif
            <table class="table table-hover table-responsive table-striped">
                <thead>
                    <tr>
                        @foreach($columns as $key => $column)
                            @include('admin::partials.utils._sortable_column', 
                            [
                                'th' => $column['label'], 
                                'url' => url($resource_route . '?sortBy=' . $column['column'] . '&search=' . $search_string), 
                                'column' => $column['column']
                                ])
                            @endforeach
                            @include('admin::partials.utils._sortable_column', 
                            [
                                'th' => 'Option', 
                                'url' => null, 
                                'column' => null 
                            ])
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            @foreach($columns as $key => $column)
                                <td data-column="{{ $column['column'] }}">
                                    @if(isset($column['link']))
                                        @if(isset($column['link']) && isset($column['link']['resource_route']))
                                            <a href="{{ url($column['link']['resource_route'] . '/' . $item->{$column['link']['id_column']} ) }}">{{ $item->{$column['column']}  }}</a>
                                        @endif
                                    @else
                                        {!! $item->{$column['column']}  !!}
                                    @endif
                                </td>
                            @endforeach
                            <td>
                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        @if(Gate::check('update_invitations'))
                                            <a href="{{ url(config('invitations.resource_route') . $item->id . '/edit' ) }}" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i></a>
                                        @endif
                                        @if(Gate::check('delete_invitations') )
                                            <a href="{{ url(config('invitations.resource_route') . $item->id . '/delete' ) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="table-footer">
                {!! $items->appends(['sortBy' => $sort_by, 'order' => $order])->render() !!}
            </div>
        @endslot
    @endcomponent
@endsection
