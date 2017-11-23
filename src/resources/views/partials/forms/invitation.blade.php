<div class="form-group">
    <label>Name: *</label>
    <input type="text" class="form-control" name="name" value="@if(isset($invitation)){{$invitation->name}}@endif">
</div>
<div class="form-group">
    <label>Email: *</label>
    <input type="text" class="form-control" name="email" value="@if(isset($invitation)){{$invitation->email}}@endif">
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
                        <input type="checkbox" name="roles[]" value="{{$role->id}}"  id="{{$role->id}}" {{ in_array($role->id, $array = isset($user) ? $user->roles->pluck('id')->toArray() : []) ? 'checked' : ''}}>
                    {{ $role->name }}
                    </label>
                    </div>
                @endforeach
            @endif
        </ul>
    </fieldset>
</div>
@endif
@if(Config::get('invitations.related'))
<div class="form-group">
    <select name="related" class="form-control">
        <option>Select related {{ Config::get('related.title') }}</option>
        @foreach($invitables as $id => $invitable)
            <option value="{{ $id }}">{{ $invitable }}</option>
        @endforeach
    </select>
</div>
@endif
<p class="button-group">
    <button type="submit" class="btn btn-primary">Save</button>
	<a href="{{ url('admin/invitations') }}" class="btn-alt">Cancel</a>
</p>
