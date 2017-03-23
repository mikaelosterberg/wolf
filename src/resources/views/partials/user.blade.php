    <div class="col-sm-5 col-md-3">
        <div class="thumbnail">
            <img src="https://www.gravatar.com/avatar/{!! md5( strtolower( trim( $user->email ) ) ) !!}?s=200" />
            <div class="caption">
                <h3><a href="{{ route('howl.user', ['name' => $user->username]) }}">{{ $user->name }}</a></h3>
                <p><a href="{{ route('howl.user', ['name' => $user->username]) }}">{{ "@" . $user->username }}</a><br>
                    {{ $user->profile }}<br>
                    {{ $user->location }}
                </p>
                <small><a href="{{ route('follower.following', ['name' => $user->username]) }}">Following</a>
                &nbsp;|&nbsp;
                <a href="{{ route('follower.followers', ['name' => $user->username]) }}">Followers</a></small>
            </div>
        </div>
    </div>

