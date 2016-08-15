<br>

<div class="form-group">
    <div class="fg-line">
        {!! Form::label('title', 'Title', ['class' => 'fg-label']) !!}
        {!! Form::text('title', $title, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
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
    <img v-if="webPathToPostImage.length > 0" class="img img_responsive" id="page-image-preview" style="max-height:100px" :src="webPathToPostImage">
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
      <label class="fg-label">Publish Date / Time</label>
      <input class="form-control date-time-picker" name="published_at" id="published_at" type="text" value="{{ $published_at }}" placeholder="DD/MM/YYYY HH:MM:SS" data-mask="00/00/0000 00:00:00">
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
      <label class="fg-label">Tags</label>
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