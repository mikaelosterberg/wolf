@extends('layouts.app')

@section('content')
    <p>follower.followers</p>

    @foreach($followers as $follower)
        @include('partials.user', ['user' => $follower->following()->first()])
    @endforeach


@endsection
