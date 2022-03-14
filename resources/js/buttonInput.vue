<template>
    <div>
        <button @click="$emit('send')">
            Send
        </button>
    </div>
</template>

<script>
export default {
    name: "buttonInput",

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
