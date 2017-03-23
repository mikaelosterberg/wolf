@extends('layouts.app')

@section('content')
    <form class="form-signin" role="form" method="POST" action="{{ route('password.email') }}">{{ csrf_field() }}
        <h2 class="form-signin-heading">Password Reset</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control" placeholder="Email address" required autofocus>
        @if ($errors->has('email'))
            <strong>{{ $errors->first('email') }}</strong>
        @endif
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Send Password Reset Link</button>
    </form>
@endsection

@section('head')
    <style type="text/css">
        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }
        .form-signin .form-signin-heading {
            margin-bottom: 10px;
        }
        .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
@endsection
