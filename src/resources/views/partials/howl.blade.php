@foreach ($howls as $howl)
    <div class="media">
        <div class="media-left">
            <img src="https://www.gravatar.com/avatar/{!! md5( strtolower( trim( $howl->user->email ) ) ) !!}?s=64" class="media-object" style="width: 64px; height: 64px;" >
        </div>
        <div class="media-body">
            <h5 class="media-heading"><a href="{{ route('howl.user', ['name' => $howl->user->username]) }}">{{ $howl->user->name }}</a>
                <small><a href="{{ route('howl.user', ['name' => $howl->user->username]) }}">{{ "@" . $howl->user->username }}</a> on {{ $howl->created_at  }}</small></h5>
            <p>
                @if (empty($howl->cache))
                    {{-- If cache is missing run it thrue the parcer. --}}
                    {!!   \Parser::Gethtml($howl->howl) !!}
                @else
                    {{-- Return pre parced text --}}
                    {!!  $howl->cache !!}
                @endif
            </p>
        </div>
        <div class="media-right" style="width: 3em;">
            @if (auth()->user()->id == $howl->user_id)
                <form method="POST" action="{{ route('howl.destroy', ['id'=>$howl->id]) }}">{{ csrf_field() }}{{ method_field('DELETE') }}
                    <button type="submit">Delete Howl</button>
                </form>
            @endif
        </div>
    </div>
@endforeach




