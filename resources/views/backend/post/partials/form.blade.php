<br>

<div class="form-group">
    <div class="fg-line">
        <label for="title" class="fg-label">Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Title" v-model="title" @keyup="slugify()">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label for="slug" class="fg-label">Slug</label>
        <input type="text" class="form-control" name="slug" id="slug" placeholder="slug" v-model="slug"/>
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label for="subtitle" class="fg-label">Subtitle</label>
        <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="slug" v-model="slug"/>
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label for="page_image" class="fg-label">Page Image</label>
        <input type="text" class="form-control" name="page_image" id="page_image" placeholder="Page Image" v-model="pageImage"/>
    </div>
</div>

<div class="visible-sm space-10"></div>

<div>
    <img v-if="pageImage" class="img img_responsive" id="page-image-preview" style="max-height:100px" :src="pageImage">
    <span v-else class="text-muted small">No Image Selected</span>
</div>

<br>
<br>

<div class="form-group">
    <div class="fg-line">
        <textarea id="editor" name="content" placeholder="Content">{{ $content }}</textarea>
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label for="published_at" class="fg-label">Publish Date / Time</label>
        <input type="text" class="form-control date-time-picker" name="published_at" id="published_at" placeholder="Page Image" data-mask="00/00/0000 00:00:00"/>
    </div>
</div>

<br>

<div class="checkbox m-b-15">
    <label>
        <input {{ checked($is_draft) }} type="checkbox" name="is_draft">
        <i class="input-helper"></i>
        Draft?
    </label>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label for="tags[]" class="fg-label">Tags</label>
        <select name="tags[]" id="tags" class="selectpicker" multiple>
            @foreach ($allTags as $tag)
                <option @if (in_array($tag, $tags)) selected @endif value="{{ $tag }}">{{ $tag }}</option>
            @endforeach
        </select>
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label for="layout" class="fg-label">Layout</label>
        <select name="layout" id="layout" class="form-control">
            @foreach($layouts as $key => $value)
                @if( $value == $layout)
                    <option value="{{ $key }}" selected>{{ $value }}</option>
                @else
                    <option value="{{ $key }}">{{ $value }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <textarea class="form-control auto-size" name="meta_description" id="meta_description" style="resize: vertical" placeholder="Meta Description">{{ $meta_description }}</textarea>
    </div>
</div>
