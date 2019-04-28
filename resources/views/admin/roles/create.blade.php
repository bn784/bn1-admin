@extends('layouts.auth')
<?php
$locale = Auth::user()->preferred_language;
App::setLocale($locale);
?>
@section('content')
    <div class="content">
        @if(session('warning'))
                <!-- If password successfully show message -->
        <div class="row">
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        </div>
        @endif
        @if(session('success'))
                <!-- If password successfully show message -->
        <div class="row">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
        @else
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">@lang('messages.roles.title')</div>

                            <div class="card-body">
                                {!! Form::open(['method' => 'POST', 'route' => ['admin.roles.store']]) !!}

                                @csrf

                                <div class="form-group row">
                                    <label for="title_input" class="col-md-4 col-form-label text-md-right">@lang('messages.roles.fields.title')</label>

                                    <div class="col-md-6">
                                        <input id="title_input" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                               name="title" required autocomplete="title">

                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="management_access" name="management_access" >
                                    <label class="form-check-label" for="management_access">
                                        management access
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="user_access" name="user_access">
                                    <label class="form-check-label" for="user_access">
                                        user access
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="user_create" name="user_create">
                                    <label class="form-check-label" for="user_create">
                                        user create
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="user_edit" name="user_edit">
                                    <label class="form-check-label" for="user_edit">
                                        user edit
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="user_view" name="user_view">
                                    <label class="form-check-label" for="user_view">
                                        user view
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="user_delete" name="user_delete">
                                    <label class="form-check-label" for="user_delete">
                                        user delete
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="role_access" name="role_access">
                                    <label class="form-check-label" for="role_access">
                                        role access
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="role_create" name="role_create">
                                    <label class="form-check-label" for="role_create">
                                        role create
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="role_edit" name="role_edit">
                                    <label class="form-check-label" for="role_edit">
                                        role edit
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="role_view" name="role_view">
                                    <label class="form-check-label" for="role_view">
                                        role view
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="role_delete" name="role_delete">
                                    <label class="form-check-label" for="role_delete">
                                        role delete
                                    </label>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            @lang('messages.create')
                                        </button>
                                    </div>
                                </div>
                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@stop

