<template>
<input
    type="text"
    class="input"
    :value="value"
    v-on="listeners"
>
</template>

<script>
export default {
    name: "ToAddressInputText",
    props: {
        value: {
            type: String,
            default: '',
        }
    },
    computed: {
        listeners () {
            return {
                ...this.$listeners,
                input: event => this.$emit('input', event.target.value)
            }
        }
    }
}
</script>

<style scoped>
.input {
    width: 99%;
    padding: 8px 10px;
    border: 1px solid black;
}

</style>
