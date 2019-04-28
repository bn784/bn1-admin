<?php
$locale = Auth::user()->preferred_language;
App::setLocale($locale);
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('admin.partials.head')
</head>
<body>
<div id="app">
    @include('admin.partials.topbar')
    <div>
        <!-- sidebar -->
        <section  id="section_sidebar">
            @include('admin.partials.sidebar')
        </section>
        <!-- end sidebar -->

        <!-- content -->
        <section  id="section_content">
            <div class="container_my ">
                @if (Session::has('message'))
                    <div class="alert alert-info">
                        <p>{{ Session::get('message') }}</p>
                    </div>
                @endif
                @if ($errors->count() > 0)
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @yield('content')
            </div>
        </section>
        <!-- end content -->
    </div>
</div>

<!-- Scripts -->
@include('admin.partials.javascripts')
@yield('javascript')
</body>
</html>
