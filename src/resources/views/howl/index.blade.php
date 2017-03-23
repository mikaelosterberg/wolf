@extends('layouts.app')

@section('content')
    @include('partials.profile', ['user' => $user])
    @include('partials.howl_create', ['next' => 'me', 'user' => $user])
    @include('partials.howl', ['howls' => $howls])
    {{ $howls->links() }}
@endsection