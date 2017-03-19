@extends('layouts.app')

@section('content')
<div class="container">

@if (session('status'))
        {{ session('status') }}
@endif

<form method="POST" action="{{ route('password.request') }}">
{{ csrf_field() }}

<input type="hidden" name="token" value="{{ $token }}">

E-Mail Address: <input type="email" name="email" value="{{ $email or old('email') }}" required autofocus>

@if ($errors->has('email'))
        <strong>{{ $errors->first('email') }}</strong>
@endif

Password:  <input type="password" name="password" required>

@if ($errors->has('password'))
        <strong>{{ $errors->first('password') }}</strong>
@endif
Confirm Password:  <input type="password" name="password_confirmation" required>

@if ($errors->has('password_confirmation'))
        <strong>{{ $errors->first('password_confirmation') }}</strong>
@endif

<button type="submit">
    Reset Password
</button>

</form>

@endsection
