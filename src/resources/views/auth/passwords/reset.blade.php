@extends('layouts.app')

@section('content')
    <form class="form-signup" method="POST" action="{{ route('password.request') }}">{{ csrf_field() }}<input type="hidden" name="token" value="{{ $token }}">

        <h2 class="form-signup-heading">Reset Password</h2>

        <label for="email" class="sr-only">Email address</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control first" placeholder="Email address" required autofocus>
        @if ($errors->has('email'))
            <strong>{{ $errors->first('email') }}</strong>
        @endif

        <label for="password" class="sr-only">Password</label>
        <input id="password" type="password" class="form-control input" name="password" placeholder="Password" required>
        @if ($errors->has('password'))
            <strong>{{ $errors->first('password') }}</strong>
        @endif


        <label for="password_confirmation" class="sr-only">Confirm Password</label>
        <input id="password" type="password" class="form-control last" name="password_confirmation" placeholder="Confirm Password" required>
        @if ($errors->has('password_confirmation'))
            <strong>{{ $errors->first('password_confirmation') }}</strong>
        @endif

        <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>

    </form>
@endsection

@section('head')
    <style type="text/css">
        .form-signup {
            max-width: 600px;
            padding: 15px;
            margin: 0 auto;
        }
        .form-signup .form-signup-heading
        {
            margin-bottom: 10px;
        }

        .form-signup .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }
        .form-signup .form-control:focus {
            z-index: 2;
        }
        .form-signup .input {
            border-radius: 0;
            border-radius: 0;
        }
        .form-signup .first {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signup .last {
            margin-bottom: 15px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
@endsection
