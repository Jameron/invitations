<div class="form-group">
    <label for="firstName">First name: *</label>
    <input type="text" class="form-control" name="first_name" value="{{ (old('first_name')) ? old('first_name') : (isset($invitation)) ? $invitation->first_name : null }}" id="firstName">
</div>
<div class="form-group">
    <label for="lastName">Last name: *</label>
    <input type="text" class="form-control" name="last_name" value="{{ (old('last_name')) ? old('last_name') : (isset($invitation)) ? $invitation->last_name : null }}" id="lastName">
</div>
<div class="form-group">
    <label for="email">Email: *</label>
    <input type="text" class="form-control" name="email" value="{{ (old('email')) ? old('email') : (isset($invitation)) ? $invitation->email : null }}" id="email">
</div>
@if(isset($roles))
<div class="form-group">
    <fieldset class="group">
        <legend>Select role(s)</legend>
        <ul class="unstyled">
            @if(count($roles))
                @foreach($roles as $role)
                    <div class="checkbox">
                    <label for="{{$role->id}}">
                        <input type="checkbox" name="roles[]" value="{{$role->id}}"  id="{{$role->id}}" {{ in_array($role->id, $array = isset($user) ? $user->roles->pluck('id')->toArray() : isset($invitation) ? $invitation->roles->pluck('id')->toArray() : []) ? 'checked' : ''}}>
                    {{ $role->name }}
                    </label>
                    </div>
                @endforeach
            @endif
        </ul>
    </fieldset>
</div>
@endif
@if(config('invitations.expires'))
<div class="form-group">
    <label for="email">Days until expires: *</label>
    <input type="text" class="form-control" name="days_until_expires" value="{{ (isset($invitation)) ? $invitation->expires_at->diffInDays(\Carbon\Carbon::now()) : null }}" id="email">
</div>
@endif
@if(Config::get('invitations.related'))
<div class="form-group">
    <label for="email">{{ ucfirst(Config::get('invitations.related.title')) }} *</label>
    <select name="related" class="form-control">
        <option>Select related {{ Config::get('invitations.related.title') }}</option>
        @foreach($invitables as $id => $invitable)
            <option value="{{ $id }}" {{ ($invitation->invitable->id==$id) ? 'selected' : '' }}>{{ $invitable }}</option>
        @endforeach
    </select>
</div>
@endif
<p class="button-group">
    <button type="submit" class="btn btn-primary">Save</button>
	<a href="{{ url(config('invitations.route')) }}" class="btn-alt">Cancel</a>
</p>
