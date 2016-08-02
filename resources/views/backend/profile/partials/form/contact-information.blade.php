<br>

<div class="form-group">
    <div class="fg-line">
      <label class="fg-label">Mobile Phone</label>
      <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}" placeholder="Mobile Phone">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
      <label class="fg-label">Email Address</label>
      <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" placeholder="Email Address">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
      <label class="fg-label">Twitter</label>
      <input type="text" class="form-control" name="social_media[twitter]" id="twitter" value="{{ (isset($user->social_media->twitter ))? $user->social_media->twitter : null }}" placeholder="Twitter Url">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
      <label class="fg-label">Facebook</label>
      <input type="text" class="form-control" name="social_media[facebook]" id="facebook" value="{{ (isset($user->social_media->facebook ))? $user->social_media->facebook : null }}" placeholder="Facebook Url">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
      <label class="fg-label">GitHub</label>
      <input type="text" class="form-control" name="social_media[github]" id="github" value="{{ (isset($user->social_media->github ))? $user->social_media->github : null }}" placeholder="GitHub Url">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
      <label class="fg-label">Instagram</label>
      <input type="text" class="form-control" name="social_media[instagram]" id="instagram" value="{{ (isset($user->social_media->instagram ))? $user->social_media->instagram : null }}" placeholder="Instagram Url">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
      <label class="fg-label">Address</label>
      <input type="text" class="form-control" name="address" id="address" value="{{ $user->address }}" placeholder="Address">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
      <label class="fg-label">City</label>
      <input type="text" class="form-control" name="city" id="city" value="{{ $user->city }}" placeholder="City">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
      <label class="fg-label">Country</label>
      <input type="text" class="form-control" name="country" id="country" value="{{ $user->country }}" placeholder="Country">
    </div>
</div>
