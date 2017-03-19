@extends('layouts.app')

@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

E-Mail Address: <input type="email" name="email" value="{{ old('email') }}" required autofocus>

@if ($errors->has('email'))
        <strong>{{ $errors->first('email') }}</strong>
@endif

Password: <input id="password" type="password" class="form-control" name="password" required>

@if ($errors->has('password'))
        <strong>{{ $errors->first('password') }}</strong>
@endif

<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
<button type="submit" class="btn btn-primary">Login</button>
<a href="{{ route('password.request') }}">Forgot Your Password?</a>
</form>
@endsection
