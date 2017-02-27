var home = Vue.component('home', {
  template: '#home',
  data: function() {
    return {
      number: "+33000000000",
      message: "Hello world",
      token: "db6e2fd80cc11b01a6689a04e13cc468",
      sendingButton: "Send",
      submitDisabled: false,
      messageSent: false,
      messageNotSent: false,
    }
  },
  methods: {
    onSubmit: function() {
      this.submitDisabled = true;
      this.sendingButton = "Sending…";
      var formData = new FormData();
      formData.append('number', this.number);
      formData.append('message', this.message);
      formData.append('token', this.token);
      this.$http.post("api.php", formData)
      .then(response => {
        if (response.body[0].result == "success") {
          this.messageSent = true;
        } else {
          this.messageNotSent = true;
        }
        this.submitDisabled = false;
        this.sendingButton = "Send";
      }, response => {
        console.log(response)
        this.messageNotSent = true;
        this.submitDisabled = false;
        this.sendingButton = "Send";
      });
    }
  },
  components: {
    alert: VueStrap.alert
  }
})

new Vue({
  el: '#app',


  http: {
    emulateJSON: true,
    emulateHTTP: true
  }
});
