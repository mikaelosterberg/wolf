@extends('layouts.app')

@section('content')

@if (session('status'))
        {{ session('status') }}
@endif

<form method="POST" action="{{ route('password.email') }}">{{ csrf_field() }}<br/>
E-Mail Address: <input id="email" type="email" name="email" value="{{ old('email') }}" required>

@if ($errors->has('email'))
        <strong>{{ $errors->first('email') }}</strong>
@endif

<button type="submit">
    Send Password Reset Link
</button>

</form>

@endsection
