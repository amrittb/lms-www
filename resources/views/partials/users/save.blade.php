{{ csrf_field() }}

<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
    <label for="first-name" class="col-md-4 control-label">First Name</label>

    <div class="col-md-6">
        <input id="first-name" type="text" class="form-control" name="first_name" value="{{ (old('first_name')?:(isset($user)?$user->first_name:"")) }}">

        @if ($errors->has('first_name'))
            <span class="help-block">
                <strong>{{ $errors->first('first_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('middle_name') ? ' has-error' : '' }}">
    <label for="middle-name" class="col-md-4 control-label">Middle Name</label>

    <div class="col-md-6">
        <input id="middle-name" type="text" class="form-control" name="middle_name" value="{{ (old('middle_name')?:(isset($user)?$user->middle_name:"")) }}">

        @if ($errors->has('middle_name'))
            <span class="help-block">
                <strong>{{ $errors->first('middle_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
    <label for="last-name" class="col-md-4 control-label">Last Name</label>

    <div class="col-md-6">
        <input id="last-name" type="text" class="form-control" name="last_name" value="{{ (old('last_name')?:(isset($user)?$user->last_name:"")) }}">

        @if ($errors->has('last_name'))
            <span class="help-block">
                <strong>{{ $errors->first('last_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control" name="email" value="{{ (old('email')?:(isset($user)?$user->email:"")) }}">

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

    {!! isset($user)?'<p class="text--center"><small>Keep Password fields empty if you don\'t want to change them</small></p>':"" !!}

    <br>
    <label for="password" class="col-md-4 control-label">Password</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control" name="password">

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
    </div>
</div>

@if( ! isset($user))
    <div class="form-group{{ $errors->has('expires_at') ? ' has-error' : '' }}">
        <label for="expires-at" class="col-md-4 control-label">Expires At</label>

        <div class="col-md-6">
            <date-picker name="expires_at" id="expires-at" date-time="{{ \Carbon\Carbon::parse(old('expires_at')?:(isset($user)?$user->expires_at:\Carbon\Carbon::now()->addYears(2)->toDateTimeString()))->format('M d, Y G:i') }}" ></date-picker>

            @if ($errors->has('expires_at'))
                <span class="help-block">
                    <strong>{{ $errors->first('expires_at') }}</strong>
                </span>
            @endif
        </div>
    </div>
@else
    <input type="hidden" name="expires_at" value="{{ $user->expires_at }}">
@endif

@if( ! isset($user))
    <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
        <label for="user-role" class="col-md-4 control-label">Role</label>

        <div class="col-md-6">
            <select name="role_id" id="user-role" class="form-control">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}"
                        {{ (isset($user) && $user->role_id == $role->id)?"selected":"" }}
                    >{{ $role->role_name }}</option>
                @endforeach
            </select>

            @if ($errors->has('role_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('role_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
@else
    <input type="hidden" name="role_id" value="{{ $user->role_id }}">
@endif