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
    <h3 class="page-title">@lang('messages.users.title')</h3>
    @can('user_create')
    <p>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">@lang('messages.add_new')</a>

    </p>
    @endcan
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('messages.list')
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped dt-select ">
                <thead>
                <tr>
                    @can('user_delete')
                    <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                    @endcan
                    <th>@lang('messages.users.fields.name')</th>
                    <th>@lang('messages.users.fields.email')</th>
                    <th>@lang('messages.users.fields.role')</th>
                    <th>

                        @can('user_delete')
                        <a href="" class="btn btn-xs btn-danger js-delete-selected" >@lang('messages.delete')</a>
                        @endcan
                    </th>
                </tr>
                </thead>

                <tbody>
                @if (count($users) > 0)
                    @foreach ($users as $user)
                        <tr data-entry-id="{{ $user->id }}" class="bn">
                            @can('user_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-{{ $user->id }}" value="{{ $user->id }}" class="bn"/></th>
                            @endcan

                            <td field-key='name'>{{ $user->name }}</td>
                            <td field-key='email'>{{ $user->email }}</td>
                            <td field-key='role'>{{ $user->role->title}}</td>
                            <td>
                                @can('user_view')
                                <a href="{{ route('admin.users.show',[$user->id]) }}" class="btn btn-xs btn-primary">@lang('messages.view')</a>
                                @endcan
                                @can('user_edit')
                                <a href="{{ route('admin.users.edit',[$user->id]) }}" class="btn btn-xs btn-info">@lang('messages.edit')</a>
                                @endcan
                                @can('user_delete')
                                @if(!in_array($user->email, ['administrator@example.com']))
                                {!! Form::open(array(
                                                                        'style' => 'display: inline-block;',
                                                                        'method' => 'DELETE',
                                                                        'onsubmit' => "return confirm('".trans("messages.are_you_sure")."');",
                                                                        'route' => ['admin.users.destroy', $user->id])) !!}
                                {!! Form::submit(trans('messages.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
                                @endif
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">@lang('messages.no_entries_in_table')</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>


@stop

@section('javascript')
    <script>
        $(document).on('click', '#select-all', function () {
            if(this.checked){
                $(".bn").prop('checked', true);
            }else {
                $(".bn").prop('checked',  false);
            }

        });
        $(document).on('click', '.js-delete-selected', function () {
            if (confirm('Are you sure')) {
                var ids = [];
                $('.bn input:checkbox:checked').each(function() {
                    ids.push($(this).val());
                });
                jQuery.ajax({
                    url: "{{ route('admin.users.mass_destroy') }}",
                    method: 'post',
                    data: {
                        ids: ids,
                    },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result){
                        console.log(result);
                     //   alert('ok');
                    },
                    error: function(msg){
                        console.log(msg);
                    }
                }).done(function () {
                    location.reload();
                });

            }

            return false;
        });
    </script>
@endsection