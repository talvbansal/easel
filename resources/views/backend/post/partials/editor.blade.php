<media-modal :show.sync="showMediaManager">
    <media-manager
            :is-modal="true"
            :selected-event-name.sync="selectedEventName"
            :show.sync="showMediaManager"
    >
    </media-manager>
</media-modal>

<script type="text/javascript">
    $(document).ready(function () {
        var vm = new Vue({
            el: 'body',
            ready: function () {
                this.simpleMde = new SimpleMDE({
                    element: $("#news-content")[0],
                    toolbar: [
                        "bold", "italic", "heading", "|",
                        "quote", "unordered-list", "ordered-list", "|",
                        'link', 'image',
                        {
                            name: 'insertImage',
                            action: function (editor) {
                                this.openFromEditor();
                            }.bind(this),
                            className: "icon-image",
                            title: "Insert Media Browser Image"
                        },
                        "|",
                        "preview", "side-by-side", "fullscreen", "|"
                    ]
                });

                $('.publish_date').mask('00/00/0000 00:00:00');
            },

            data: {
                pageImage: null,
                selectedEventName: null,
                showMediaManager: false,
                simpleMde: null,
                slug: null,
                title: null
            },

            events: {
                'media-manager-selected-page-image': function (file) {
                    this.pageImage = file.relativePath;
                    this.showMediaManager = false;
                },

                'media-manager-selected-editor': function (file) {
                    var cm = this.simpleMde.codemirror;
                    var output = '[' + file.name + '](' + file.relativePath + ')';

                    if (this.isImage(file)) {
                        output = '!' + output;
                    }

                    cm.replaceSelection(output);
                    this.showMediaManager = false;
                },

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
                }
            }
        });
    });
</script>
