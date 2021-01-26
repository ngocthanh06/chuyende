import axios from "axios";
import fire from '../../config/fire';

export default {
    state: {
        contacts: [],
        messages: []
    },

    getters: {
        getContacts: state => state.contacts,
        getMessages: state => state.messages
    },

    actions: {
        contactsList(context) {
            axios.get('/api/contacts').then(contacts => {
                context.commit('commitContacts', contacts.data);
            });
        },

        handleMessages(context, userId) {
            axios.get(`/api/conversation/${userId}`).then(messages => {
                context.commit('commitMessages', messages.data);
            });
        },

        saveNewMessage(context, data) {
            axios.post('/api/conversation/new', data);
        },

        destroyNoticeMessages(context, userId) {
            fire.database()
                .ref(`chat/to_user_${userId}/chat/content`)
                .remove();
        }
    },

    mutations: {
        commitContacts(state, data) {
            state.contacts = data;
        },

        commitMessages(state, data) {
            state.messages = data;
        },
    }
}
