@if (auth()->user()->id == $user->id)
<br>
    <div class="panel panel-default">
        <form method="POST" action="{{ route('howl.store') }}">{{ csrf_field() }}<input type="hidden" name="next" value="{{ $next }}" />
        <div class="panel-heading">
            <h3 class="panel-title">Post a new Howl</h3>
        </div>
        <div class="panel-body">

                <input type="text" name="howl" value="{{ old('howl') }}" maxlength="160" required autofocus class="form-control" aria-describedby="sizing-addon1">
                @if ($errors->has('howl'))
                    <strong>{{ $errors->first('howl') }}</strong>
                @endif
        </div>
        <div class="panel-footer"><button type="submit">Howl</button></div>
        </form>
    </div>

@endif