<input type="hidden" name="_token" value="{!! csrf_token() !!}">

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">First Name</label>
        <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name', $data->first_name) }}" placeholder="First Name">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Last Name</label>
        <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name', $data->last_name) }}" placeholder="Last Name">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Display Name</label>
        <input class="form-control" id="display_name" name="display_name" placeholder="Display Name" value="{{ old('display_name', $data->display_name) }}">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Email</label>
        <input type="text" class="form-control" name="email" id="email" value="{{ old('email', $data->email) }}" placeholder="Email">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" placeholder="Password">
    </div>
</div>

<br>