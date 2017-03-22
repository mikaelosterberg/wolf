<p>@ {{ $user->username }}<br>
{{ $user->name }}<br>
{{ $user->profile }}<br>
{{ $user->location }}<br>
{{ $user->created_at }}<br>
<img src="https://www.gravatar.com/avatar/{!! md5( strtolower( trim( $user->email ) ) ) !!}?s=200" />
</p>

