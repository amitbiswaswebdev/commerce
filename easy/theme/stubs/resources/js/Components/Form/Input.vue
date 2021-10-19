<template>
    <div>
        <easy-label :for="id" :value="label" />
        <input
            :id="id"
            :type="type"
            :value="modelValue"
            :required="required"
            :disabled="disabled"
            :autofocus="autofocus"
            :class="inputClass"
            class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            @input="$emit('update:modelValue', $event.target.value)"
            ref="input" >
        <easy-input-error v-if="error" :message="error"/>
    </div>
</template>

<script>
import EasyLabel from '@/Components/Form/Label.vue'
import EasyInputError from '@/Components/Form/InputError.vue'
export default {
    name: "EasyInputField",
    components:{
        EasyLabel,
        EasyInputError
    },
    props: {
        modelValue: String|Number,
        inputClass:{
            type: String,
            required: false,
            default: ''
        },
        required:{
            type: Boolean,
            required: false,
            default: false
        },
        autofocus:{
            type: Boolean,
            required: false,
            default: false
        },
        disabled:{
            type: Boolean,
            required: false,
            default: false
        },
        label: {
            type: String,
            required: true
        },
        error: {
            type: String,
            required: false,
            default: null
        },
        id: {
            type: String,
            required: true
        },
        type: {
            type: String,
            required: true
        },
    },
    emits: ['update:modelValue'],
    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
}
</script>
