<template>
    <div class="chat-app">
        <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
        <ContactsList :contacts="contacts" @selected="startConversationWith"/>
    </div>
</template>

<script>
    import Conversation from './Conversation';
    import ContactsList from './ContactsList';

    export default {
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: []
            };
        },
        mounted() {
            Echo.private(`messages.${this.user.id}`)
                .listen('NewMessage', (e) => {
                    if(this.selectedContact && e.message.from == this.selectedContact.id) {
                        this.saveNewMessage(e.message);   
                        return;
                    }
                    this.updateUnreadCount(e.message.from_contact, false);              
                })

            axios.get('contacts')
                .then((response) => {
                    this.contacts = response.data;
                });
        },
        methods: {
            startConversationWith(contact) {  
                this.updateUnreadCount(contact, true);              
                axios.get(`conversation/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    })
            }, 
            saveNewMessage(message)
            {
                this.messages.push(message);
            }, 
            updateUnreadCount(contact, reset) {
                this.contacts = this.contacts.map((single) => {
                    if(single.id != contact.id) {
                        return single;
                    }

                    if(reset)
                        single.unread = 0;
                    else
                        single.unread += 1;

                    return single;

                })

            }       
        },
        components: {Conversation, ContactsList}
    }
</script>


<style lang="scss" scoped>
.chat-app {
    display: flex;
}
</style>
