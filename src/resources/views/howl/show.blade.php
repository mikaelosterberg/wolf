@extends('layouts.app')

@section('content')

        <p>
            {{ $howl->user->name }} @ {{ $howl->created_at }}<br>
            @if (empty($howl->cache))
                {{-- If cache is missing run it thrue the parcer. --}}
                {!!   \Parser::Gethtml($howl->howl) !!}
            @else
                {{-- Return pre parced text --}}
                {!!  $howl->cache !!}
            @endif
            @if (auth()->user()->id == $howl->user_id)
                <form method="POST" action="{{ route('howl.destroy', ['id'=>$howl->id]) }}">{{ csrf_field() }}{{ method_field('DELETE') }}
                    <button type="submit">Delete</button>
                </form>
            @endif
        </p>
        <hr>

@endsection