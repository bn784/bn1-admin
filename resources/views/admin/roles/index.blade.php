
@extends('layouts.auth')
<?php
$locale = Auth::user()->preferred_language;
App::setLocale($locale);
?>
@section('content')
@if(session('warning'))
        <!--  warning show message -->
<div class="row">
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
</div>
@endif
@if(session('success'))
        <!--  successfully show message -->
<div class="row">
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
</div>
@endif
    <h3 class="page-title">@lang('messages.roles.title')</h3>

    @can('role_create')
    <p>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-success">@lang('messages.add_new')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('messages.list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped dt-select ">
                <tbody>
                @if (count($roles) > 0)
                    @foreach ($roles as $role)
                        <tr data-entry-id="{{ $role->id }}">
                            <td field-key='title'>{{ $role->title }}</td>
                            <td>
                                @can('role_view')
                                <a href="{{ route('admin.roles.show',[$role->id]) }}" class="btn btn-xs btn-primary">@lang('messages.view')</a>
                                @endcan
                                @can('role_edit')
                                <a href="{{ route('admin.roles.edit',[$role->id]) }}" class="btn btn-xs btn-info">@lang('messages.edit')</a>
                                @endcan

                                @can('role_delete')
                                @if(!in_array($role->title, ['user','administrator']))
                                {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("messages.are_you_sure")."');",
                                        'route' => ['admin.roles.destroy', $role->id])) !!}
                                {!! Form::submit(trans('messages.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
                                @endif
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">@lang('messages.no_entries_in_table')</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

