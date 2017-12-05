<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
    <label for="name">First name</label>
        <input id="first_name" type="text" class="form-control @if(config('admin.theme')=='dark')form-control-dark @endif" name="first_name" value="{{ old('first_name') ? old('first_name') : $invitation->first_name }}" disabled>
        @if ($errors->has('first_name'))
            <span class="help-block">
                <strong>{{ $errors->first('first_name') }}</strong>
            </span>
        @endif
</div>
<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
    <label for="name">Last name</label>
        <input id="last_name" type="text" class="form-control @if(config('admin.theme')=='dark')form-control-dark @endif" name="last_name" value="{{ old('last_name') ? old('last_name') : $invitation->last_name }}" disabled>
        @if ($errors->has('last_name'))
            <span class="help-block">
                <strong>{{ $errors->first('last_name') }}</strong>
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
<input type="hidden" name="invitation_token" value="{{ $invitation->token }}">
<div class="form-group">
    <button type="submit" class="btn btn-primary">
        Register
    </button>
</div>
