<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name">Name</label>
        <input id="name" type="text" class="form-control @if(config('admin.theme')=='dark')form-control-dark @endif" name="name" value="{{ old('name') ? old('name') : $invitation->name }}" disabled>
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
</div>
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email">E-Mail Address</label>
        <input id="email" type="email" class="form-control @if(config('admin.theme')=='dark')form-control-dark @endif" name="email" value="{{ old('email') ? old('email') : $invitation->email }}" disabled>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
</div>
<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label for="password">Password</label>
        <input id="password" type="password" class="form-control @if(config('admin.theme')=='dark')form-control-dark @endif" name="password" required>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
</div>
<div class="form-group">
    <label for="password-confirm">Confirm Password</label>
        <input id="password-confirm" type="password" class="form-control @if(config('admin.theme')=='dark')form-control-dark @endif" name="password_confirmation" required>
    </div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">
        Register
    </button>
</div>
