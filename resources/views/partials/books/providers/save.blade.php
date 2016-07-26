<h3 class="text--center">Save a Book Provider</h3>

{{ csrf_field() }}

<div class="row form-group{{ $errors->has('provider_name') ? ' has-error' : '' }}">
    <label for="provider-name" class="col-md-4 control-label">Provider Name</label>

    <div class="col-md-6">
        <input id="provider-name" type="text" placeholder="Name of the provider (Person or Organization)" class="form-control" name="provider_name" value="{{ old('provider_name')?:(isset($provider)?$provider->provider_name:'') }}">

        @if ($errors->has('provider_name'))
            <span class="help-block">
                <strong>{{ $errors->first('provider_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="row form-group{{ $errors->has('contact_no') ? ' has-error' : '' }}">
    <label for="contact-no" class="col-md-4 control-label">Contact No.</label>

    <div class="col-md-6">
        <input id="contact-no" type="text" placeholder="Contact no. for the provider" class="form-control" name="contact_no" value="{{ old('contact_no')?:(isset($provider)?$provider->contact_no:'') }}">

        @if ($errors->has('contact_no'))
            <span class="help-block">
                <strong>{{ $errors->first('contact_no') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="row form-group{{ $errors->has('contact_pname') ? ' has-error' : '' }}">
    <label for="contact-person-name" class="col-md-4 control-label">Name of the contact person</label>

    <div class="col-md-6">
        <input id="contact-person-name" type="text" placeholder="Name of the contact person" class="form-control" name="contact_pname" value="{{ old('contact_pname')?:(isset($provider)?$provider->contact_pname:'') }}">

        @if ($errors->has('contact_pname'))
            <span class="help-block">
                <strong>{{ $errors->first('contact_pname') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            Save Book Provider
        </button>
    </div>
</div>