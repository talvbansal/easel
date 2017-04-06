<blog-post-editor inline-template>
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    @include('easel::shared.breadcrumbs', ['links' => [
                        'Home' => url('/admin'),
                        'Posts' => url('/admin/post'),
                        ((Route::is('admin.post.edit'))? 'Edit' : 'Create') . ' Post' => '',
                    ]])

                    @if( Route::is('admin.post.edit'))
                        <h2>
                            Edit <em>{{ $title }}</em>
                            <small>Last edited on {{ $updated_at->format('M d, Y') }} at {{ $updated_at->format('g:i A') }}</small>
                        </h2>
                    @else
                        <h2>Create a New Post</h2>
                    @endif

                </div>

                <div class="card-body card-padding">

                    @include('easel::shared.errors')
                    @include('easel::shared.success')

                    {{ csrf_field() }}
                    <input type="hidden" name="author_id" value="{!! auth()->user()->id!!}"/>

                    @if( Route::is('admin.post.edit'))
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="author_id" value="{!! $author_id !!}"/>
                    @endif


                    <div>
                        <div class="form-group">
                            <div class="fg-line">
                                <input type="text" class="form-control" name="title" id="title" placeholder="Title" v-model="title" @keyup="slugify()
                            "/>
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
                                <textarea id="editor" name="content" placeholder="Content">{{ $content }}</textarea>
                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <div class="fg-line">
                                <textarea class="form-control auto-size" name="meta_description" id="meta_description" style="resize: vertical" placeholder="Meta Description">{{ $meta_description }}</textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2>Publishing</h2>
                    <hr>
                </div>
                <div class="card-body card-padding">

                    <div class="form-group">
                        <div class="fg-line">
                            <label for="published_at">Published at</label>
                            <input type="text" class="form-control date-time-picker" name="published_at" id="published_at" placeholder="Published At" data-mask="00/00/0000 00:00:00" v-model="published_at"/>
                        </div>
                    </div>

                    <br>

                    <div class="form-group">
                        <div class="toggle-switch">
                            <label for="ts1" class="ts-label">Draft?</label>
                            <input id="ts1" type="checkbox" hidden="hidden" name="is_draft" {{ checked($is_draft) }} >
                            <label for="ts1" class="ts-helper"></label>
                        </div>
                    </div>

                    <br>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-icon-text" name="action" value="continue">
                            <i class="zmdi zmdi-floppy"></i> Save
                        </button>

                        @if(Route::is('admin.post.edit'))
                            <button type="button" class="btn btn-danger btn-icon-text" data-toggle="modal" data-target="#modal-delete">
                                <i class="zmdi zmdi-delete"></i> Delete
                            </button>
                        @else
                            <a href="{{ route('admin.post.index') }}">
                                <button type="button" class="btn btn-link">Cancel</button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Featured Image</h2>
                    <hr>
                </div>
                <div class="card-body card-padding">
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
                        <img v-if="pageImage" class="img img-responsive" id="page-image-preview" style="margin-top: 3px; max-height:250px;" :src="pageImage"/>
                        <span v-else class="text-muted small">No Image Selected</span>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Category & Tags</h2>
                    <hr>
                </div>
                <div class="card-body card-padding">
                    <div class="form-group">
                        <div class="form-group">
                            <div class="fg-line">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach ($allCategories as $cat_id => $cat_name )
                                        <option @if ($cat_id == $category_id) selected @endif value="{{ $cat_id }}">{{ $cat_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <br>

                        <div class="fg-line">
                            <label for="tags[]">Tags</label>
                            <select name="tags[]" id="tags" class="form-control selectpicker" multiple>
                                @foreach ($allTags as $tag_id => $tag_name )
                                    <option @if (in_array($tag_name, $tags)) selected @endif value="{{ $tag_id }}">{{ $tag_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
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
    </div>
</blog-post-editor>