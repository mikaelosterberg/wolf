@extends('layouts.app')

@section('content')
    <p>follower.following</p>

    @foreach($followings as $following)
        @include('partials.user', ['user' => $following->follower()->first()])
    @endforeach



@endsection
