<template>
    <div>
        <label>To:</label>
        <ToAddressInputText
            v-model="recipientText"
            placeholder=""
            @keydown.enter="alert()"
        ></ToAddressInputText>
        <label>Subject:</label>
        <ToAddressInputText
            v-model="subjectText"
            placeholder=""
            @keydown.enter="alert()"
        ></ToAddressInputText>
        <label>Message</label>
        <MessageBodyText
            v-model="messageText"
            @keydown.enter="alert()"
        ></MessageBodyText>
        <buttonInput
            @send="sendMail"
        >
        </buttonInput>
    </div>
</template>
<script>
import ToAddressInputText from "../js/ToAddressInputText";
import MessageBodyText from "../js/MessageBodyText";
import buttonInput from "../js/buttonInput";
const default_layout = "default";


export default {
    components: {
        ToAddressInputText, MessageBodyText, buttonInput
    },
    computed: {},
    data() {
        return {
            recipientText:'',
            subjectText:'',
            messageText:'',
        }
    },
    methods: {
        sendMail () {
            console.log(this.recipientText);
            console.log(this.subjectText);
            console.log(this.messageText);
        }
    }
};
</script>
