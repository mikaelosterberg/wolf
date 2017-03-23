@extends('layouts.app')

@section('content')
    @include('partials.howl_create', ['next' => 'home'])
    @include('partials.howl', ['howls' => $howls, 'user' => $user])
    {{ $howls->links() }}
@endsection