<template>
    <div>
        <textarea
        class="input"
        :value="value"
        v-on="listeners"
        ></textarea>
    </div>
</template>

<script>
export default {
    name: "MessageBodyText",
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
                input: event => this.$emit('textarea', event.target.value)
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
