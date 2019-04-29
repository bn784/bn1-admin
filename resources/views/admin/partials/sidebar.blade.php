<div class="my-sidebar ">

    <a href="{{ route('home') }}" class=" my-button">home</a>
    <a href="{{ route('showChangePasswordForm') }}" class=" my-button"><i class="fa fa-wrench"></i><span class="title">@lang('messages.change_password')</span></a>

    @can('management_access')
    <button class="bn-toggle my-button"> @lang('messages.user-management.title')</button>
    <ul class="nav flex-column ul-display-li ">
        @can('role_access')
        <li class="nav-item">
            <a class="nav-link bn-button" href="{{ route('admin.roles.index') }}">@lang('messages.roles.title')</a>
        </li>
        @endcan
        @can('user_access')
        <li class="nav-item">
            <a class="nav-link bn-button" href="{{ route('admin.users.index') }}">@lang('messages.users.title')</a>
        </li>
        @endcan
    </ul>
    @endcan
    <button class="bn-toggle my-button"> @lang('messages.preferred_language')</button>
    <ul class="nav flex-column ul-display-li ">
        <li class="nav-item">
            <a class="nav-link bn-button" href="{{ route('admin.preferred_language', ['lang' => 'ru'])}}">@lang('messages.RU')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link bn-button" href="{{ route('admin.preferred_language', ['lang' => 'uk'])}}">@lang('messages.UKR')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link bn-button" href="{{ route('admin.preferred_language', ['lang' => 'en'])}}">@lang('messages.EN')</a>
        </li>
    </ul>

</div>




