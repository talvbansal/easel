<script>
    Vue.component('blog-post-editor', {

        data: function () {
            return {
                pageImage: '{{ $page_image }}',
                selectedEventName: null,
                showMediaManager: false,
                simpleMde: null,
                slug: '{{ old('slug', $slug) }}',
                title: '{{ old('title', $title) }}',
                subtitle: '{{ old('subtitle', $subtitle) }}',
                published_at: '{{ old('published_at', $published_at) }}'

            };
        },
        mounted: function () {

            this.simpleMde = new simpleMde({
                element: document.getElementById("editor"),
                toolbar: [
                    "bold", "italic", "heading", "|",
                    "quote", "unordered-list", "ordered-list", "|",
                    'link', 'image',
                    {
                        name: 'insertImage',
                        action: function (editor) {
                            this.openFromEditor();


                        }.bind(this),
                        className: "zmdi zmdi-collection-image-o",
                        title: "Insert Media Browser Image"
                    },
                    "|",
                    "preview", "side-by-side", "fullscreen", "|"
                ]
            });

            $('.publish_date').mask('00/00/0000 00:00:00');

            window.eventHub.$on('media-manager-selected-page-image', function (file) {
                this.pageImage = file.relativePath;
                this.showMediaManager = false;
            }.bind(this));

            window.eventHub.$on('media-manager-selected-editor', function (file) {
                var cm = this.simpleMde.codemirror;
                var output = '[' + file.name + '](' + file.relativePath + ')';
                if (this.isImage(file)) {
                    output = '!' + output;
                }
                cm.replaceSelection(output);
                this.showMediaManager = false;
            }.bind(this));

            window.eventHub.$on('media-manager-notification', function (message, type, time) {
                $.notify({
                    message: message
                }, {
                    type: 'inverse',
                    allow_dismiss: false,
                    label: 'Cancel',
                    className: 'btn-xs btn-inverse',
                    placement: {
                        from: 'top',
                        align: 'right'
                    },
                    z_index: 9999,
                    delay: time,
                    animate: {
                        enter: 'animated fadeInRight',
                        exit: 'animated fadeOutRight'
                    },
                    offset: {
                        x: 20,
                        y: 85
                    }
                });
            });
        },

        methods: {
            slugify: function () {
                this.slug = this.title.toLowerCase()
                    .trim()
                    .replace(/ /g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-');
            },
            openFromEditor: function () {
                this.showMediaManager = true;
                this.selectedEventName = 'editor';
            },
            openFromPageImage: function () {
                this.showMediaManager = true;
                this.selectedEventName = 'page-image';
            }
        }
    });

</script>
