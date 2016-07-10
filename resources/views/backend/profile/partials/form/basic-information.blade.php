<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">First Name</label>
        <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $data['first_name'] }}" placeholder="First Name">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Last Name</label>
        <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $data['last_name'] }}" placeholder="Last Name">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Display Name</label>
        <input type="text" class="form-control" name="display_name" id="display_name" value="{{ $data['display_name'] }}" placeholder="Display Name">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Job</label>
        <input type="text" class="form-control" name="job" id="job" value="{{ $data['job'] }}" placeholder="Job">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Gender</label>
        <select name="gender" id="gender" class="selectpicker">
            <option @if ($data['gender'] === 'Male') selected @endif value="Male">Male</option>
            <option @if ($data['gender'] === 'Female') selected @endif value="Female">Female</option>
        </select>
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
      <label class="fg-label">Birthday</label>
      <input type="text" class="form-control" name="birthday" id="birthday" value="{{ $data['birthday'] }}" placeholder="YYYY-MM-DD" data-mask="0000-00-00">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Relationship Status</label>
        <select name="relationship" id="relationship" class="selectpicker">
            <option @if ($data['relationship'] === null) selected @endif value="">Please select one</option>
            <option @if ($data['relationship'] === 'Single') selected @endif value="Single">Single</option>
            <option @if ($data['relationship'] === 'In a relationship') selected @endif value="In a relationship">In a relationship</option>
            <option @if ($data['relationship'] === 'Engaged') selected @endif value="Engaged">Engaged</option>
            <option @if ($data['relationship'] === 'Married') selected @endif value="Married">Married</option>
            <option @if ($data['relationship'] === 'It\'s complicated') selected @endif value="It's complicated">It's complicated</option>
            <option @if ($data['relationship'] === 'In an open relationship') selected @endif value="In an open relationship">In an open relationship</option>
            <option @if ($data['relationship'] === 'Widowed') selected @endif value="Widowed">Widowed</option>
            <option @if ($data['relationship'] === 'Separated') selected @endif value="Separated">Separated</option>
            <option @if ($data['relationship'] === 'Divorced') selected @endif value="Divorced">Divorced</option>
            <option @if ($data['relationship'] === 'In a civil union') selected @endif value="In a civil union">In a civil union</option>
            <option @if ($data['relationship'] === 'In a domestic partnership') selected @endif value="In a domestic partnership">In a domestic partnership</option>
        </select>
    </div>
</div>
