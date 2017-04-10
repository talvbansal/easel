<tag-editor inline-template>
    <div>
        <div class="form-group">
            <div class="fg-line">
                <label for="name" class="fg-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" v-model="title" @keyup="slugify()" placeholder="Name">
            </div>
        </div>

        <br>

        <div class="form-group">
            <div class="fg-line">
                <label for="title" class="fg-label">Slug</label>
                <input type="text" class="form-control" name="slug" id="slug" v-model="slug" placeholder="Slug">
            </div>
        </div>

        <br>
    </div>
</tag-editor>