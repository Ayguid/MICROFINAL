<template>
  <div class="">

    <a v-if="can_edit" :href='can_edit_route' class="btn btn-primary">Edit product</a>
    <!-- {{product.files}} -->

    <b-tabs content-class="mt-3">
      <b-tab :title=" $t('Detalles')  " active>
        <div class="col-12 border border-top-0 pt-2 pb-2">
          <h5> {{(product['title_'+$root.local])?product['title_'+$root.local]:product['title_es']}} </h5>
          <h6>{{$t('Código')}} :   {{product.product_code}}</h6>

          <div class="row">
            <div class="col-12 col-md-4 col-lg-4">
              <!-- <div v-if="files.images.length > 0" class="">
              </div> -->
              <div  class="">
                <!-- <img v-if="$fileExists($root.baseUrl+'/storage/product_images/'+img.file_path)" v-for="img in files.images" width="100%" :src="$root.baseUrl+'/storage/product_images/'+img.file_path" alt=""> -->
                <img v-if="files.images.length>0" v-for="img in files.images" width="100%" :src="$root.baseUrl+'/storage/product_images/'+img.file_path" alt="">
                <img v-else class="productPic" width="100%" :src="$root.baseUrl+'/images/default.jpeg'" alt="">
              </div>
            </div>

            <div class="col-12 col-md-8 col-lg-8">
              <div class="row">
                <div class="col-12">
                  <strong>{{$t("Descripción")}}: </strong>
                  <h6> {{(product['desc_'+$root.local])?product['desc_'+$root.local]:product['desc_es']}}</h6>
                  <hr>
                </div>
              </div>

              <div class="row">

                <div v-for="att in product.attributes" v-if="att.attribute.filterable" class="col-12 col-md-6 col-lg-6">
                  <!-- <h6>  <strong> {{(att.attribute['name_'+$root.local])?att.attribute['name_'+$root.local]:att.attribute['name_es']}} </strong>  </h6> -->
                  <h6>  <strong> {{$t(att.attribute.name_es)}} </strong>  </h6>
                  <!-- <h6>{{(att['value_'+$root.local])?att['value_'+$root.local]:att['value_es']}}</h6> -->
                  <h6>{{$t(att.value_es)}}</h6>
                </div>

                <div v-for="att in product.attributes" v-if="!att.attribute.filterable" class="col-12 col-md-6 col-lg-6">
                  <!-- <h6>  <strong> {{(att.attribute['name_'+$root.local])?att.attribute['name_'+$root.local]:att.attribute['name_es']}} </strong>  </h6> -->
                  <h6><strong> {{$t(att.attribute.name_es)}} </strong>  </h6>
                  <h6>{{$t(att.value_es)}}</h6>
                </div>

              </div>

            </div>
          </div>
          <p>
            <b-button v-b-modal.modal-1>{{$t('Solicitar Presupuesto')}}</b-button>
            <b-modal id="modal-1" title="Micro" :hide-footer="true" >
              <contact-mail-form
              :modal="'modal-1'"
              :title="$t('Solicitar Presupuesto')"
              :images="this.files.images"
              :to="'Comercial'"
              :product="this.product"
              ></contact-mail-form>
            </b-modal>
          </p>
        </div>
      </b-tab>









      <b-tab :title=" $t('Visualizador') ">
        <div v-if="product.has_cad_3d && files.stls[0]" class="">
          <iframe class="mb-3" id="viewers" :src="$root.baseUrl+'/Online3DViewer-master/website/index.html'"  width="100%" height="500" frameborder="0" scrolling="no" allowfullscreen="allowfullscreen"></iframe>
        </div>
        <div v-else class="alert alert-info mt-3" role="alert">
          <p>{{$t('Visualizador 3D no disponible.')}}</p>
        </div>
        <div v-if="product.has_cad_2d && files.dxfs[0]" id="d_container">
          <!--
          <div id="tapador">
            <img width="130"  class="d-inline-block align-center" :src="$root.baseUrl+'/images/logos/logo-micro-'+$root.local+'.jpg'" alt="">
          </div>
        -->
          <!-- {{files.dxfs[0].file_path}} -->
          <iframe id="cadView" :src="'https://sharecad.org/cadframe/load?url=catalogo-micro.com/storage/dxfs/'+files.dxfs[0].file_path" width="100%" height="500" frameborder="0" scrolling="no" allowfullscreen="allowfullscreen"></iframe>
          <div id="tapadorBottom"></div>
        </div>
        <div v-else class="alert alert-info" role="alert">
          <p>{{$t('Visualizador 2D no disponible.')}}</p>
        </div>
      </b-tab>








      <b-tab :title=" $t('Descargas') ">
        <h4>{{$t('Hoja técnica')}}</h4>
        <div v-if="product.has_pdf" class="">
          <div v-for="pdf in files.pdfs" class="">
            <a target="_blank" class="btn file" role="button" :href="$root.baseUrl+'/storage/pdfs/'+pdf.file_path" >
              <i class="far fa-file-pdf bigIcon"></i>{{pdf.file_path}}</a>
            </div>
          </div>
          <div v-else class="">
            <p>
              {{$t('No contiene hoja técnica.')}}

            </p>
          </div>
          <h4 class="pt-3">{{$t('Archivos CAD 2D y 3D.')}}</h4>
          <div v-if="product.has_zip || product.has_cad_2d" class="">
            <div v-if="$root.authuser" class="">
              <div v-for="zip in files.zips" class="">
                <a download class="btn file" role="button" :href="$root.baseUrl+'/storage/zips/'+zip.file_path" >
                  <i class="far fa-file-archive bigIcon"></i>{{zip.file_path}}</a>
                </div>
              <div v-for="dxf in files.dxfs" class="">
                <a download class="btn file" role="button" :href="$root.baseUrl+'/storage/dxfs/'+dxf.file_path" >
                  <i class="far fa-file-archive bigIcon"></i>
                <!-- <img width="5%" :src="$root.baseUrl+'/icons/cad_logo.svg'" alt=""> -->
                  {{dxf.file_path}}</a>
                </div>
              </div>

              <div v-else class="">
                <br>
                <h5>{{$t('Iniciar sesión para descargar archivos')}}</h5>
              </div>
            </div>
            <div v-else class="">
              <p>{{$t('Archivos CAD 2D y 3D.')}}</p>
            </div>
            <br>
              <p>
                <!-- <b-button v-b-modal.modal-2>{{$t('Solicitar Archivos')}}</b-button> -->
                <b-modal id="modal-2" title="Micro" :hide-footer="true" >
                  <contact-mail-form
                  :modal="'modal-2'"
                  :title="$t('Solicitar Archivos')"
                  :images="this.files.images"
                  :to="'Ingenieria'"
                  :product="this.product"
                  ></contact-mail-form>
                </b-modal>
              </p>
              <div v-if="$root.authuser" class="">
                <div class="text-left my-3">
                  <!-- <b-button v-b-tooltip.hover title="Tooltip directive content">
                    Hover Me
                  </b-button> -->

                  <!-- <b-button id="tooltip-target-1">
                    Hover Me
                  </b-button> -->
                  <b-tooltip target="tooltip-target-1" triggers="hover" placement="right">
                    {{$t('Contacto')}}
                  </b-tooltip>
                  <h5>&nbsp; <i id="tooltip-target-1" class="far fa-envelope infobtn" aria-hidden="true" v-b-modal.modal-2></i></h5>
                </div>
              </div>
          </b-tab>
        </b-tabs>



      </div>
    </template>

    <script>
    export default {
      props:['product', 'can_edit', 'can_edit_route'],
      data(){
        return  {
          files:this.$sortFilesByType(this.product.files)
        }
      },
      methods:{

      },
      mounted() {
        if (this.product.has_cad_3d) {
          // window.location.hash=this.$root.baseUrl+'/storage/stls/'+this.files.stls[0].file_path;
          window.hash=this.$root.baseUrl+'/storage/stls/'+this.files.stls[0].file_path;
        }
      }
    }
    </script>
    <style media="screen">
      .infobtn{
        font-size: 30px;
        cursor: pointer;
      }
      .file:hover{
        background-color:rgb(209, 209, 209);
      }
    </style>
