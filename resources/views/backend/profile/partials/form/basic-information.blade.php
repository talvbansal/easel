<?php
$relationships = [
    '' => 'Please select one',
    'Single' =>  'Single',
    'In a relationship' =>  'In a relationship',
    'Engaged' =>  'Engaged',
    'Married' =>  'Married',
    'It\'s complicated' =>  'It\'s complicated',
    'In an open relationship' =>  'In an open relationship',
    'Widowed' => 'Widowed',
    'Separated' => 'Separated',
    'Divorced' => 'Divorced',
    'In a civil union' => 'In a civil union',
    'In a domestic partnership' => 'In a domestic partnership',
];

$genders = [
    'Male' => 'Male',
    'Female' => 'Female'
];

?>

<br>


<div class="form-group">
    <div class="fg-line">
        <label for="first_name" class="fg-label">First Name</label>
        <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $user->first_name }}" placeholder="First Name">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label for="last_name" class="fg-label">Last Name</label>
        <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $user->last_name }}" placeholder="Last Name">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label for="display_name" class="fg-label">Display Name</label>
        <input type="text" class="form-control" name="display_name" id="display_name" value="{{ $user->display_name }}" placeholder="Display Name">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label for="job" class="fg-label">Job</label>
        <input type="text" class="form-control" name="job" id="job" value="{{ $user->job }}" placeholder="Job">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label for="gender" class="fg-label">Gender</label>
        {!! Form::select('gender', $genders, $user->gender, ['class' => 'selectpicker']) !!}
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
      <label for="birthday" class="fg-label">Birthday</label>
      <input type="text" class="form-control date-picker" name="birthday" id="birthday" value="{{ $user->birthday->format('d/m/Y') }}" placeholder="DD-MM-YYYY" data-mask="00-00-0000">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label for="relationship" class="fg-label">Relationship Status</label>
        {!! Form::select('relationship', $relationships, $user->relationship ,['class' => 'selectpicker']) !!}

    </div>
</div>
