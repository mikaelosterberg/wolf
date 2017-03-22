<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Wolf</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                <li><a href="{{ route('register') }}">Register</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><a href="{{ route('howl.user', ['name' => auth()->user()->username]) }}">{{ auth()->user()->name }}</a>| <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('follower.following', ['name' => auth()->user()->username]) }}">My following</a></li>
                        <li><a href="{{ route('follower.followers', ['name' => auth()->user()->username]) }}">My followers</a></li>
                        <li role="separator" class="divider"></li>
                        <li><br> <a href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </li>
            @endif
            </ul>
        </div>
    </div>
</nav>

{{--

  <ul class="nav navbar-nav">
                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
            </ul>


<form class="form-horizontal" ">
    {{ csrf_field() }}

    E-Mail Address: <input type="email" name="email" value="{{ old('email') }}" required autofocus>

    @if ($errors->has('email'))
        <strong>{{ $errors->first('email') }}</strong>
    @endif

    Password: <input id="password" type="password" class="form-control" name="password" required>

    @if ($errors->has('password'))
        <strong>{{ $errors->first('password') }}</strong>
    @endif

    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
    <button type="submit" class="btn btn-primary">Login</button>
    <a href="{{ route('password.request') }}">Forgot Your Password?</a>
</form>

--}}
