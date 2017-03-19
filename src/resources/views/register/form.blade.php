@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('register') }}">{{ csrf_field() }}
Username: <input type="text" name="username" value="{{ old('username') }}" required autofocus>
@if ($errors->has('username'))
    <strong>{{ $errors->first('username') }}</strong>
@endif

Name: <input type="text" name="name" value="{{ old('name') }}" required autofocus>

@if ($errors->has('name'))
    <strong>{{ $errors->first('name') }}</strong>
@endif

E-Mail Address: <input type="email" name="email" value="{{ old('email') }}" required>

@if ($errors->has('email'))
        <strong>{{ $errors->first('email') }}</strong>
@endif

Password: <input type="password" name="password" required>

@if ($errors->has('password'))
        <strong>{{ $errors->first('password') }}</strong>
@endif

Confirm Password: <input type="password" name="password_confirmation" required>

<button type="submit">
    Register
</button>
</form>
@endsection
