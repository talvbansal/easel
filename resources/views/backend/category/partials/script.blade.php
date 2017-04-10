<script>
    Vue.component('category-editor',{
        data: function () {
            return {
                slug: '{{ old('slug', $data['slug']) }}',
                title: '{{ old('name', $data['name']) }}',
            }
        },

        methods: {
            slugify: function () {
                this.slug = this.title.toLowerCase()
                    .trim()
                    .replace(/ /g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-');
            }
        }
    });
</script>