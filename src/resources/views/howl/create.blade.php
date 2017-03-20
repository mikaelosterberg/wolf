@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('howl.store') }}">{{ csrf_field() }}
        Your Howl: <input type="text" name="howl" value="{{ old('howl') }}" required autofocus>
        @if ($errors->has('howl'))
            <strong>{{ $errors->first('howl') }}</strong>
    @endif
    </form>
@endsection