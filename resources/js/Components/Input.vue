<template>
	<div :class="$attrs.class">

		<label :for="id">
			{{ label.text }}
		</label>

		<input :id="id" class="form-control"
			   v-bind="{ ...$attrs, class: input.class }"
			   :value="modelValue" @input="$emit('update:modelValue', proxyValue($event))">

		<div class="errors" v-if="error">{{ error }}</div>
	</div>
</template>

<script>

	let id = 0;

    export default {

        inheritAttrs: false,

        props: {
            modelValue: [String,Number],
			input: {
                type: Object,
				default: {}
			},
			label: Object,
			error: String
		},

		methods: {

            proxyValue(e) {

                return e.target.value != '' ? e.target.value : undefined;
			}
		},

        emits: ['update:modelValue'],

        data() {
            id += 1;

            return {
                id: `text-input-${id}`
            }
        },
    }
</script>

<style lang="scss">

	.text-input {


		.errors {
			margin-top: .25rem;
			font-size: .875em;
			color: #dc3545;
		}
	}

</style>
