<br>

<div class="form-group">
    <div class="fg-line">
        {!! Form::label('title', 'Title', ['class' => 'fg-label']) !!}
        {!! Form::text('title', $title, ['class' => 'form-control', 'placeholder' => 'Title', 'v-model' => 'title']) !!}
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
      <label class="fg-label">Subtitle</label>
      <input type="text" class="form-control" name="subtitle" id="subtitle" value="{{ $subtitle }}" placeholder="Subtitle">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
      <label class="fg-label">Page Image</label>
      <input type="text" class="form-control" name="page_image" id="page_image" alt="Image thumbnail" placeholder="Page Image" v-model="pageImage.fullPath" data-toggle="modal" href="#easel-file-picker">
    </div>
</div>

<div class="visible-sm space-10"></div>

<div>
    <img v-if="pageImage.webPath.length > 0" class="img img_responsive" id="page-image-preview" style="max-height:100px" :src="pageImage.webPath">
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

@if (config('app.debug') )
    <br>
    <pre>@{{ $data | json }}</pre>
@endif