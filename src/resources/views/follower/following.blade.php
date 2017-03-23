@extends('layouts.app')

@section('content')
    <h4>Users that follow {{ $user->name }}</h4>
    @foreach($followings->chunk(4) as $collection)
        <div class="row">
            @foreach($collection as $following)
                @include('partials.user', ['user' => $following->follower()->first()])
            @endforeach
        </div>
    @endforeach
@endsection

