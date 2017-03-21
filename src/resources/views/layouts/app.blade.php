<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<p>
@if (Auth::guest())
    <a href="{{ route('login') }}">Login</a><br>
    <a href="{{ route('register') }}">Register</a>
@else
<a href="{{ route('howl.user', ['name' => auth()->user()->username]) }}">{{ auth()->user()->name }}</a><br>
<a href="{{ route('logout') }}">Logout</a>
@endif
</p>
<p>
    <a href="{{ route('howl.index') }}">Show Howls</a>
    @if (Auth::authenticate())
    <a href="{{ route('howl.user', ['name' => auth()->user()->username]) }}">Show My Howls</a>
    @endif
    <a href="{{ route('howl.create') }}">New Howl</a>

</p>
@yield('content')
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
