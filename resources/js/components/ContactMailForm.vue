<template>
  <div class="">


<!-- {{data}} -->
    <form class="" action="index.html" method="post" @submit="sendMail">
    <!-- <form class="" action="./send-mail" method="get"> -->
      <p>{{this.title}}</p>

    <div class="row">
        <div class="col-6">
          <input type="text" name="to" :value="this.to" hidden>
          <div class="" v-if="this.product">

          <input  type="text" name="product" :value="JSON.stringify(this.product)" hidden>
          <h5>Product Title</h5>
          <p>{{this.product.title_es}}</p>
          <h5>Product Code</h5>
          <p>
            {{this.product.product_code}}
          </p>
        </div>
          <div class="form-group">
            <label for="email">User Email *</label><br>
            <input id="user_email" type="email" name="from" v-model="email" class="form-control">
          </div>
        </div>
        <div v-if="this.product" class="col-6">
          <div v-if="images.length>0"  class="">
            <img v-for="image in images" :src="$root.baseUrl+'/storage/product_images/'+image.file_path" alt="" width="100%">
          </div>
          <div v-else>
            <img :src="$root.baseUrl+'/images/default.jpeg'" alt="" width="100%">
          </div>
        </div>

      </div>
      <input type="text" name="locale" :value="$root.local" hidden>

      <div v-if="!$root.authuser" class="">
        <div class="form-group">
          <label for="country" class="">Pais</label><br>
          <input id="country" type="text" name="country" value="" class="form-control">
        </div>
        <div class="form-group">
          <label for="city">Ciudad *</label><br>
          <input id="city" type="text" name="city" required value="" class="form-control">
        </div>
      </div>

      <div class="form-group">
        <label for="email">{{$t('Consultas adicionales')}}</label><br>
        <textarea class="form-control" name="textArea" rows="6" ></textarea>
      </div>
      <input type="submit" class="btn btn-primary" name="Enviar" value="Enviar" >



    </form>







    <div class="vld-parent">
      <loading :active.sync="isLoading"
      :can-cancel="false"
      :on-cancel="onCancel"
      :is-full-page="fullPage"></loading>
    </div>

  </div>
</template>
<style media="screen">

textarea
{
  border:1px solid #999999;
  width:100%;
  margin:5px 0;
  padding:3px;
}

</style>

<script>

// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';


export default {
  props: ['product', 'to', 'images', 'title', 'modal'],
  data(){
    return  {
      email: this.$root.authuser ? this.$root.authuser.email : '',
      contactUrl:this.$root.local+'/send-mail',
      isLoading: false,
      fullPage: true,
      user:this.$root.authuser
    }
  },
  components: {
    Loading
  },
  methods:{
    sendMail:function(event){
      event.preventDefault();
      // console.log(this.validateEmail(this.email));
      // return
      if(!this.validateEmail(this.email)){
        this.$swal({
          type: 'warning',
          title: 'Hubo un error',
          text: 'Email requerido'
        });
        return
      }
      var formData = new FormData(event.target);
      this.isLoading = true;
      axios.post(this.contactUrl,formData).then((response) => {
        console.log(response);
        this.isLoading = false;
        if (response.data.status == "error") {
          this.$swal({
            type: 'warning',
            title: 'Hubo un error',
            text: JSON.stringify(response.data.errors)
          });
        }
        if (response.status == "200") {
          this.$swal(response.data.message);
          this.$bvModal.hide(this.modal);
        }
      });

    },
    validateEmail: function(email) {
      if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email))
       {
         return (true)
       }
         return (false)
    },

    onCancel: function() {
      console.log('User cancelled the loader.')
    }
  },
  mounted() {
    // console.log(this.images.length);
  }
}
</script>
