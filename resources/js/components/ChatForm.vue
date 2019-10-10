<template>
  <div class="input-group">
      <input
          id="btn-input"
          type="text"
          name="message"
          class="form-control input-sm"
          placeholder="Type your message here..."
          required
          v-model="message"
          @keyup.enter="sendMessage"
          :disabled="disableForm"
      >
      &nbsp;&nbsp;
      <span class="input-group-btn">
        <button type="submit" class="btn btn-primary" :disabled="message == ''" @click="sendMessage">Send</button>
    </span>
  </div>
</template>

<script>
export default {
  props: ["id"],

  data() {
    return {
      message: "",
        disableForm: false
    };
  },

  methods: {
    sendMessage() {
        if (this.message) {
            this.disableForm = true;
          axios
            .post(`/message/${this.id}`, {
              message: this.message
            })
            .then(response => {
              this.message = "";
            }).finally(() => this.disableForm = false);
        }
    }
  }
};
</script>
