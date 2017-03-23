<div>
    <div class="media">
        <div class="media-left">
            <img src="https://www.gravatar.com/avatar/{!! md5( strtolower( trim( $user->email ) ) ) !!}?s=64" class="media-object" style="width: 64px; height: 64px;" >
        </div>
        <div class="media-body">
            <h4 class="media-heading">{{ $user->name }}
            <small>{{ "@" . $user->username }}</small></h4>
            <p>
                {{ $user->profile }}<br>
                {{ $user->location }}
            </p>
        </div>
        @if (auth()->user()->id != $user->id)
            <div class="media-right" style="width: 3em;">
            <form method="POST" action="{{ route('follow.toggle', ['name'=>$user->username]) }}">{{ csrf_field() }}
                @if ($follows)
                    <button type="submit">Un Follow</button>
                @else
                    <button type="submit">Follow</button>
                @endif
            </form>
            </div>
        @endif
    </div>
</div>
