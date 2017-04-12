<template>
	<div>
		<multiselect v-model="value"
					 tag-placeholder="Add this as new tag"
					 placeholder="Search or add a tag"
					 label="name"
					 track-by="name"
					 :options="options"
					 :multiple="true"
					 :taggable="true"
					 @tag="addTag"
					 :id="name"
		></multiselect>

		<input v-for="item in value" type="hidden" :name="name" :value="item.name" />

	</div>
</template>

<script>
    import Multiselect from 'vue-multiselect'
    export default {
        components: { Multiselect },
        props:['options', 'value', 'name'],
        methods: {
            addTag (newTag) {
                const tag = {
                    name: newTag,
                }
                this.options.push(tag)
                this.value.push(tag)
            }
        }
    }
</script>
