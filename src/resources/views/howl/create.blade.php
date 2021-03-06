@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('howl.store') }}">{{ csrf_field() }} <input type="hidden" name="next" value="{{ $next }}" />
        Your Howl: <input type="text" name="howl" value="{{ old('howl') }}" maxlength="160" required autofocus>
        @if ($errors->has('howl'))
            <strong>{{ $errors->first('howl') }}</strong>
        @endif
        <button type="submit">Howl</button>
    </form>
@endsection