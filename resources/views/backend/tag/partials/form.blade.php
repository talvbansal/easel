<div class="form-group">
    <div class="fg-line">
        <label for="name" class="fg-label">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $data['name']) }}" placeholder="Name">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label for="title" class="fg-label">Slug</label>
        <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug', $data['slug']) }}" placeholder="Slug">
    </div>
</div>

 <br>