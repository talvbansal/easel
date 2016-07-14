<br>


<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">First Name</label>
        <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $user->first_name }}" placeholder="First Name">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Last Name</label>
        <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $user->last_name }}" placeholder="Last Name">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Display Name</label>
        <input type="text" class="form-control" name="display_name" id="display_name" value="{{ $user->display_name }}" placeholder="Display Name">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Job</label>
        <input type="text" class="form-control" name="job" id="job" value="{{ $user->job }}" placeholder="Job">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Gender</label>
        <select name="gender" id="gender" class="selectpicker">
            <option @if ($user->gender === 'Male') selected @endif value="Male">Male</option>
            <option @if ($user->gender === 'Female') selected @endif value="Female">Female</option>
        </select>
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
      <label class="fg-label">Birthday</label>
      <input type="text" class="form-control" name="birthday" id="birthday" value="{{ $user->birthday }}" placeholder="YYYY-MM-DD" data-mask="0000-00-00">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Relationship Status</label>
        <select name="relationship" id="relationship" class="selectpicker">
            <option @if ($user->relationship === null) selected @endif value="">Please select one</option>
            <option @if ($user->relationship === 'Single') selected @endif value="Single">Single</option>
            <option @if ($user->relationship === 'In a relationship') selected @endif value="In a relationship">In a relationship</option>
            <option @if ($user->relationship === 'Engaged') selected @endif value="Engaged">Engaged</option>
            <option @if ($user->relationship === 'Married') selected @endif value="Married">Married</option>
            <option @if ($user->relationship === 'It\'s complicated') selected @endif value="It's complicated">It's complicated</option>
            <option @if ($user->relationship === 'In an open relationship') selected @endif value="In an open relationship">In an open relationship</option>
            <option @if ($user->relationship === 'Widowed') selected @endif value="Widowed">Widowed</option>
            <option @if ($user->relationship === 'Separated') selected @endif value="Separated">Separated</option>
            <option @if ($user->relationship === 'Divorced') selected @endif value="Divorced">Divorced</option>
            <option @if ($user->relationship === 'In a civil union') selected @endif value="In a civil union">In a civil union</option>
            <option @if ($user->relationship === 'In a domestic partnership') selected @endif value="In a domestic partnership">In a domestic partnership</option>
        </select>
    </div>
</div>
