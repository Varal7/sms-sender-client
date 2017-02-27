var home = Vue.component('home', {
  template: '#home',
  data: function() {
    return {
      number: "+33600000000",
      message: "Hello world",
      sendingButton: "Send",
      submitDisabled: false
    }
  },
  methods: {
    onSubmit: function() {
      this.submitDisabled = true;
      this.sendingButton = "Sending…";
      var message = this.message;
      var number = this.number;
      var formData = new FormData();
      formData.append('number', number);
      formData.append('message', message);
      this.$http.post("http://10.8.0.8/sms.php", formData)
      .then(response => {
        console.log(response.body[0].result)
        this.submitDisabled = false;
        this.sendingButton = "Send";
      }, respone => {
        console.log(response)
        this.submitDisabled = false;
        this.sendingButton = "Send";
      });
    }
  }
})

new Vue({
  el: '#app',

  http: {
    emulateJSON: true,
    emulateHTTP: true
  }
});
