<script type="text/javascript">
    $(document).ready(function () {
        $('.publish_date').mask('00/00/0000 00:00:00');

        var simpleMde = new SimpleMDE({
            element: $("#editor")[0],
            toolbar: [
                "bold", "italic", "heading", "|",
                "quote", "unordered-list", "ordered-list", "|",
                "link", "image",
                "|",
                "preview", "side-by-side", "fullscreen", "|"
            ]
        });

    });
</script>
