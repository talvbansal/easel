<script type="text/javascript">
    var simpleMde; //make this global so that the image selection modal can access the editor instance once its created
    $(document).ready(function () {

        simpleMde = new SimpleMDE({
            element: $("#editor")[0],
            toolbar: [
                "bold", "italic", "heading", "|",
                "quote", "unordered-list", "ordered-list", "|",
                'link',
                {
                    name: 'insertImage',
                    action: function (editor) {
                        $('#easel-file-picker').modal('show');
                    },
                    className: "fa fa-image",
                    title: "Insert Image"
                },
                "|",
                "preview", "side-by-side", "fullscreen", "|"
            ]
        });

        $('.publish_date').mask('00/00/0000 00:00:00');
    });
</script>

@include('easel::backend.post.partials.modals.image-picker');