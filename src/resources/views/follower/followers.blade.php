@extends('layouts.app')

@section('content')
    <h4>{{ $user->name . "s" }} followers</h4>
    @foreach($followers->chunk(4) as $collection)
    <div class="row">
    @foreach($collection as $follower)
        @include('partials.user', ['user' => $follower->following()->first()])
    @endforeach
    </div>
    @endforeach
@endsection

