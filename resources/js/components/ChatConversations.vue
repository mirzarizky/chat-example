<template>
    <div class="" v-if="messages.length > 0">
        <ul>
            <li v-for="message in messages">
                <h6 class="font-weight-bolder">
                    {{message.sender.name}}
                </h6>
                <p>{{message.body}}</p>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
  props: ['id'],
  data: () => ({
    conversation: null,
    conversations: [],
      messages: []
  }),


  methods: {
      getMessages() {
          axios.get("/messages/" + this.id).then(response => {
              this.messages = response.data
          });
      },
      newMessage(message) {
          this.messages.push(message)
      }

  },

    mounted() {
        Echo.channel('laravel_database_conversation.'+this.id)
            .listen('MessageWasSent', (e) => {
                this.newMessage(e.message)
            });
    },

  created() {
    this.getMessages();
  }
};
</script>
