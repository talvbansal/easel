<blog-post-editor inline-template>
    <div>
        <div class="form-group">
            <div class="fg-line">
                <input type="text" class="form-control" name="title" id="title" placeholder="Title" v-model="title" @keyup="slugify()">
            </div>
        </div>

        <br>

        <div class="form-group">
            <div class="fg-line">
                <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" v-model="slug"/>
            </div>
        </div>

        <br>

        <div class="form-group">
            <div class="fg-line">
                <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="Subtitle" v-model="subtitle" maxlength="254"/>
            </div>
        </div>

        <br>


            <div class="form-group">
                <div class="fg-line">
                    <div class="input-group">
                        <input type="text" class="form-control" name="page_image" id="page_image" alt="Image thumbnail" placeholder="Page Image" v-model="pageImage">
                        <span class="input-group-btn" style="margin-bottom: 11px">
                        <button style="margin-bottom: -3px" type="button" class="btn btn-primary waves-effect" @click="openFromPageImage()">Select Image</button>
                    </span>
                    </div>
                </div>
            </div>
            <div class="visible-sm space-10"></div>
            <div>
                <img v-if="pageImage" class="img img-responsive" id="page-image-preview" style="margin-top: 3px; max-height:100px;" :src="pageImage">
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
                <input type="text" class="form-control date-time-picker" name="published_at" id="published_at" placeholder="Published At" data-mask="00/00/0000 00:00:00" v-model="published_at"/>
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
                <select name="category_id" id="category_id" class="form-control">
                    @foreach ($allCategories as $cat_id => $cat_name )
                        <option @if ($cat_id == $category_id) selected @endif value="{{ $cat_id }}">{{ $cat_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>

        <div class="form-group">
            <div class="fg-line">
                <select name="tags[]" id="tags" class="form-control selectpicker" multiple>
                    @foreach ($allTags as $tag)
                        <option @if (in_array($tag, $tags)) selected @endif value="{{ $tag }}">{{ $tag }}</option>
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

        <media-modal v-if="showMediaManager" @close="showMediaManager = false">
            <media-manager
                :is-modal="true"
                :selected-event-name="selectedEventName"
                @close="showMediaManager = false"
            >
            </media-manager>
        </media-modal>

    </div>

</blog-post-editor>