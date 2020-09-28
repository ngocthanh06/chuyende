<template>
    <div class="ContactList">
        <ul>
            <li v-for="(contact,index) in contacts" :key="contact.user_id" @click="selectContact(index, contact)" :class="{'selected':index == selected}">
                <div class="avatar">
                    <!-- <img :src="contact.user_image" :alt="contact.user_fullname"> -->
                </div>
                <div class="contact">
                    <p class="name">{{contact.user_fullname}}</p>
                    <!-- <p class="email">{{contact.email}}</p> -->
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
       props: {
           contacts: {
               type: Array,
               default: []
           }
       },
       data(){
           return {
               selected: 0
           }
       },
       methods: {
           selectContact(index, contact){
               this.selected = index,
               this.$emit('selected', contact)
           }
       }
    }
</script>
<style lang="scss">
    .ContactList {
        flex: 2;    
        max-height: 600px;
        overflow: scroll;
        border-left: 1px solid #a6a6a6;
        ul {
            list-style-type: none;
            padding-left: 0;
            li {
                display: flex;
                padding: 2px;
                border-bottom: 1px solid #aaaaaa;
                height: 80px;
                position: relative;
                cursor: pointer;

                &.selected {
                    background: #dfdfdf;
                }

                .avatar {
                    flex: 1;
                    display: flex;
                    align-items: center;

                    img {
                        width: 35px;
                        border-radius: 50%;
                        margin: 0 auto;
                    }
                }

                .contact {
                    flex: 3;
                    font-size: 13px;
                    overflow: hidden;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    p {
                        margin: 0;

                        &.name{
                            font-weight: bold;
                        }
                    }
                }
            }
        }
    }

</style>