




<template>
  <div class="">
    <!-- <h1>{{ $t('Resultado') }}</h1> -->

  <!--  <p class="mt-2 mb-2">
      {{(category.get_top_categories['title_'+$root.local])?category.get_top_categories['title_'+$root.local]:category.get_top_categories['title_es']}}
    {{(category['title_'+$root.local])?category['title_'+$root.local]:category['title_es']}}</p>
  -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">{{(category.get_top_categories['title_'+$root.local])?category.get_top_categories['title_'+$root.local]:category.get_top_categories['title_es']}}</li>
      <li class="breadcrumb-item active" aria-current="page">{{(category['title_'+$root.local])?category['title_'+$root.local]:category['title_es']}}</li>
    </ol>
  </nav>

    <p class="">{{ $t("Productos Encontrados") }} : <span v-html="totalRows"></span> </p>

    <filter-menu @filter='filterProducts'
    :country="this.country"
    :category="this.category"
    :menudata="this.menuData"
    :filterAtts="this.filterAtts">
  </filter-menu>

  <div class="row">
    <product-component class="col-12 col-md-4 col-lg-3"  v-for="product in products"
    :product='product' :key='product.id'
    :product_route_view="product_route_view + product.id">
  </product-component>
</div>

<div class="" v-if="totalRows > perPage">
  <b-pagination
  @change="changePage"
  v-model="currentPage"
  align="center"
  limit="10"
  :total-rows="totalRows"
  :per-page="perPage"></b-pagination>
</div>

<div class="vld-parent">
  <loading :active.sync="isLoading"
  :can-cancel="false"
  :on-cancel="onCancel"
  :is-full-page="fullPage"></loading>
</div>

<!-- {{this.category.get_top_categories.id}} -->
<div class="bottomright bottomrightExtra">
  <b-button v-b-modal.modal-1>{{(this.category.get_top_categories.id==1)?($t("Consultar por otras carreras")):($t("Consultar por otros productos"))}}</b-button>
</div>
<!-- <img width="130"  class="d-inline-block align-center" :src="$root.baseUrl+'/images/logos/logo-micro-'+$root.local+'.jpg'" alt=""> -->
<b-modal v-if="this.category.get_top_categories.id==1" id="modal-1" title="Micro" :hide-footer="true" >
  <contact-mail-form
  :modal="'modal-1'"
  :title="$t('Consultar por otras carreras')"
  :images="''"
  :to="'Ingenieria'"
  :product="''"
  ></contact-mail-form>
</b-modal>
<b-modal v-else id="modal-1" title="Micro" :hide-footer="true" >
  <contact-mail-form
  :modal="'modal-1'"
  :title="$t('Consultar por otros productos')"
  :images="''"
  :to="'Ingenieria'"
  :product="''"
  ></contact-mail-form>
</b-modal>

</div>
</template>

<script>
// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
// import 'vue-loading-overlay/dist/vue-loading.css';

export default {
  props:['country', 'category'],
  data(){
    return  {
      products:{},
      perPage: 0,
      currentPage: 1,
      totalRows:'',
      filterAtts:'',
      menuData:'',
      isLoading: true,
      fullPage: true,
      currentProduct:'',
      product_route_view:this.$root.baseUrl + '/'+this.$root.local+'/prod/',
    }
  },
  components: {
    Loading
  },
  methods:{
    fetchProducts:function(){
      this.isLoading = true;
      axios.get('api/getProducts'+'?page='+this.currentPage,{
        params: {
          country: this.country.id,
          category: this.category.id,
          filterAtts: this.filterAtts
        }
      }).then((response) => {
        const menu = {attributes:[]}
        for (const property in response.data.menuData.attributes) {
          if (response.data.menuData.attributes[property]) {
            menu.attributes[response.data.menuData.attributes[property].order ] =  response.data.menuData.attributes[property]
          }
        }
        this.menuData = menu.attributes.filter(function (el) {return el != null;})
        // console.log(this.menuData);
        // this.menuData = response.data.menuData;
        this.products = response.data.products.data;
        this.perPage = response.data.products.per_page;
        this.totalRows = response.data.products.total;
        this.isLoading = false;
      });
    },
    changePage:function(value){
      this.currentPage=value;
      this.fetchProducts();
    },

    filterProducts:function(obj){
      this.currentPage=1;
      this.filterAtts=this.toJSONString(obj);
      this.fetchProducts();
    },
    toJSONString:function (form) {
      var obj ={} ;
      var elements = form.querySelectorAll( "input, select, textarea" );
      for( var i = 0; i < elements.length; ++i ) {
        var element = elements[i];
        var name = element.name;
        var value = element.value;
        if( name ) {
          obj[ name ] = value;
        }
      }
      return JSON.stringify(obj);
    },
    onCancel: function() {
      console.log('User cancelled the loader.')
    },

  },
  created() {
    // console.log('Component has been created!');
  },
  mounted() {
    this.fetchProducts();
  }

}
</script>
