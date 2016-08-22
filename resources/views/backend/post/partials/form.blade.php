<br>

<div class="form-group">
    <div class="fg-line">
        {!! Form::label('title', 'Title', ['class' => 'fg-label']) !!}
        {!! Form::text('title', $title, ['class' => 'form-control', 'placeholder' => 'Title', 'v-model' => 'title', '@keyup' => 'slugify()']) !!}
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        {!! Form::label('slug', 'Slug', ['class' => 'fg-label']) !!}
        {!! Form::text('slug', $slug, ['class' => 'form-control', 'placeholder' => 'Slug', 'v-model' => 'slug']) !!}
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        {!! Form::label('subtitle', 'Subtitle', ['class' => 'fg-label']) !!}
        {!! Form::text('subtitle', $subtitle, ['class' => 'form-control', 'placeholder' => 'Subtitle']) !!}
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        {!! Form::label('page_image', 'Page Image', ['class' => 'fg-label']) !!}
        {!! Form::text('page_image', $page_image, ['class' => 'form-control', 'placeholder' => 'Page Image', 'alt' => "Image thumbnail", 'v-model' => "pageImage", 'data-toggle' => "modal", 'href' => "#easel-file-picker"]) !!}
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
        {!! Form::label('published_at', 'Publish Date / Time', ['class' => 'fg-label']) !!}
        {!! Form::text('published_at', $published_at, ['class' => 'form-control date-time-picker', 'id' => 'published_at', 'placeholder' => 'DD/MM/YYYY HH:MM:SS', 'data-mask' => '"00/00/0000 00:00:00"']) !!}
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
        {!! Form::label('tags[]', 'Tags', ['class' => 'fg-label']) !!}
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
        {!! Form::label('layout', 'Layout', ['class' => 'fg-label']) !!}
        {!! Form::select('layout', $layouts, $layout, ['class' => 'form-control']) !!}
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <textarea class="form-control auto-size" name="meta_description" id="meta_description" style="resize: vertical" placeholder="Meta Description">{{ $meta_description }}</textarea>
    </div>
</div>
