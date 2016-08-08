<script type="text/javascript">
    $(document).ready(function () {
        $('.publish_date').mask('00/00/0000 00:00:00');

        var toggleImagePicker = function () {
            $('#image-picker').modal('show');
        };

        var simpleMde = new SimpleMDE({
            element: $("#editor")[0],
            toolbar: [
                "bold", "italic", "heading", "|",
                "quote", "unordered-list", "ordered-list", "|",
                "link", /*"image",*/
                {
                    name: 'insertImage',
                    action: function (editor) {
                        toggleImagePicker();
                        simpleMde.drawImage(editor);
                    },
                    className: "fa fa-image",
                    title: "Insert Image"
                },
                "|",
                "preview", "side-by-side", "fullscreen", "|"
            ]
        });

    });
</script>

@include('easel::backend.post.partials.modals.image-picker');