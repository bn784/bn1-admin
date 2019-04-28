@extends('layouts.auth')
<?php
$locale = Auth::user()->preferred_language;
App::setLocale($locale);
?>
@section('content')
    <div class="content">
        @if(session('warning'))
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
                            <div class="card-header">@lang('messages.users.title')</div>

                            <div class="card-body">
                                {!! Form::model($user, ['method' => 'PUT', 'route' => ['admin.users.update', $user->id]]) !!}

                                    @csrf

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   name="name" required autocomplete="name" value="{{$user->name}}">

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                        <div class="col-md-6">
                                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   name="email" required autocomplete="email" value="{{$user->email}}">

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="srole" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                                        <div class="col-md-6">
                                            <select id="srole" style="height: 35px" name="role_id" >
                                                <option selected value="{{$user->role->id}}">{{$user->role->title}}</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->title}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('role'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control" name="password" required autocomplete="password">

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                @lang('messages.update')
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

