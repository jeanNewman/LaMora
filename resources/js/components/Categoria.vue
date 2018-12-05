<template>
  <!-- Contenido Principal -->
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="container-fluid">

            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class=" d-flex align-items-center nav-item card-header">
                    <div class="mr-auto  fa fa-align-justify  "><span style="padding-left:10px">Categorías</span> </div>
                    <i @click.prevent="vista=0" class="p-2 fa fa-list fa-lg nav-link" ></i>
                    <i @click.prevent="vista=1" class="p-2 fa fa-th-large fa-lg nav-link"></i>
                </div>

                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                              <v-select
                               placeholder="Seleccionar Sección"
                                hint="Pick your favorite states"
                                  persistent-hint
                                :onChange="cambiaEdicion"
                                :options="arraySeccion"
                                v-model="codSeccion"
                                label="descSeccion"

                              ></v-select>


                            </div>
                        </div>
                    </div>

                    <div v-if="vista == 0">
                        <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Costo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="categoria in arrayCategoria" :key="categoria.codigo">
                                <td>
                                    <button type="button" @click="abrirModal('categoria','mostrar',categoria);listarCards(categoria.codigo)" class="btn btn-warning btn-sm" >
                                      <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar">
                                      <i class="icon-trash"></i>
                                    </button>
                                </td>
                                <td v-text="categoria.codigo"></td>
                                <td v-text="categoria.descripcion"></td>
                                <td v-text="categoria.costo"></td>

                            </tr>

                        </tbody>
                        </table>
                     </div>
                      <div v-if="vista > 0">

                             <v-container fluid grid-list-xl >
                                 <v-layout row justify-space-between>
                                  <div v-for="categoria in arrayCategoria" :key="categoria.codigo"  >
                                      {{  recorrida(categoria.codigo,pagination.current_page) }}
                                      <div v-for="kit in arrayKits" :key="kit.codigoKits"  >
                                        <b-row align-h="center">

                                            <div  >

                                                <b-col>
                                                <b-card-group deck>
                                                <b-card title="categoria.descripcion"
                                                            header-tag="header"
                                                            footer-tag="footer">
                                                        <h6 slot="header"
                                                            class="mb-0" v-text="categoria.descripcion"></h6>
                                                        <em slot="footer">Footer Slot</em>
                                                        <p class="card-text">Header and footers usas</p>
                                                         <v-container grid-list-md text-xs-center>
                                                          <v-layout row wrap>
                                                                  <b-container class="bv-example-row bg-info">
                                                                    <b-row>

                                                                            <b-col v-text="kit.codigoKits"></b-col>
                                                                            <b-col v-text="kit.descripcionKits"></b-col>
                                                                            <b-col v-text="kit.lineaKit"></b-col>

                                                                    </b-row>
                                                                </b-container>
                                                          </v-layout>
                                                         </v-container>

                                                    </b-card>
                                                </b-card-group>
                                                </b-col>
                                                </div>

                                            </b-row>
                                            </div>
                                         </div>
                                 </v-layout>
                               </v-container>



                     </div>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(1)">Pri</a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page -1)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page"  :class="[page == isActived ? 'active' : '']">
                                <a class="page-link" href="#"  @click.prevent="cambiarPagina(page)" v-text="page"></a>
                            </li>

                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)">Sig</a>
                            </li>
                              <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.last_page)">Ult</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade"  tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="tituloModal"></h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                    </div>
            <div class="modal-body">

                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Linea</th>
                            <th>Kit</th>
                            <th>Descripción</th>
                            <th>Medida</th>
                            <th>Precio</th>
                            <th>Total</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="kit in arrayKits" :key="kit.codigoKits">

                            <td v-text="kit.linea"></td>
                            <td v-text="kit.codigo_kit"></td>
                            <td v-text="kit.descripcion_kit"></td>
                            <td v-text="kit.unidadeskit"></td>
                            <td v-text="kit.precio"></td>
                            <td v-text="kit.totallinea"></td>

                        </tr>

                    </tbody>
                </table>

                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
        <!-- Inicio del modal Eliminar -->
        <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-danger" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Eliminar Categoría</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Estas seguro de eliminar la categoría?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- Fin del modal Eliminar -->

    </main>
    <!-- /Fin del contenido principal -->
</template>

<script>

   import Vue from 'vue'
   import Vuetify from 'vuetify'
   import BootstrapVue from 'bootstrap-vue'
    Vue.use(Vuetify)
    Vue.use(BootstrapVue);
    import vSelect from "vue-select";
    export default {

        data: function (){
          return {
            codigo: '',
            vista: 0,
            descripcion :'',
            costo: '',
            arrayCategoria:[],
            valorSelect:'',
            pagination : {
                'total' : 0,
                'current_page' : 0,
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to'   : 0 ,
            },
            offset: 3,
            ///////
            codSeccion:'',
            descSeccion:'',
            arraySeccion:[],
            codigo_kits:'',
            descripcion_kits:'',
            linea:'',
            modal:0,
            tituloModal:'',
            arrayKits:[]


          }
        },
        components: {
            vSelect
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function(){
                if(!this.pagination.to){
                    return[];
                }

                var from = this.pagination.current_page - this.offset;
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while(from <= to){
                    pagesArray.push(from);
                    from++
                }
                return pagesArray;
            }
        },
        methods : {
            prueba(){
                return(console.log("estoy dentro de la funcion"))
            },
            listarCategoria(val,page){
                let me = this;
                let valor = val == undefined?'':'&filtro='+val
                //no es necesario los ; ni se usa ya mas el var jean, usa la nomenclatura de ES6
                var url = '/admin/categoria?page=' + page+valor;
                axios.get(url).then(function (response) {
                        var x = 0;
                        var respuesta = response.data;
                        // handle success
                        //console.log(response);
                        me.arrayCategoria = respuesta.categorias.data;
                        me.arraySeccion = respuesta.secciones;
                        me.pagination = respuesta.pagination;
                        var len = me.arrayCategoria.length;
                        while (x<len){
                            //me.arrayCategoria[x].costo = me.arrayCategoria[x].costo.toFixed(2);x++;
                            me.arrayCategoria[x].costo = (parseFloat( me.arrayCategoria[x].costo).toFixed(2)).toString();x++;
                        };

                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });

            },
               listarCards(val){
                let me = this;
                let valor = val == undefined?'':'kit='+val
                var url = '/admin/categoria/listarCards?'+valor;
                axios.get(url).then(function (response) {

                        var respuesta = response.data;

                        me.arrayKits= respuesta;


                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });

            },
            cambiaEdicion(val,page){
                let me = this;
                me.valorSelect = val.codSeccion;
                if(me.vista==0)
                me.listarCategoria(me.valorSelect,page);
                else
                me.listarCards(me.valorSelect,page);
            },
            recorrida(val){
              let me = this;

              me.listarCards(me.codigoKits);

            },

            cambiarPagina(page){
                let me = this;
                me.pagination.current_page = page;
                if(me.vista==0)
                me.listarCategoria(me.valorSelect,page);
                else
                me.listarCards(me.valorSelect,page);
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
            },
            abrirModal(modelo,accion,data = []){
                switch(modelo){
                    case "categoria":
                     {
                         switch(accion){
                             case 'mostrar':
                             {
                                 this.modal = 1;
                                 this.tituloModal = 'Receta';
                                 this.codigo = data['codigo'];
                                 //this.listarCards(this.codigo);
                                 break;
                             }
                         }
                     }
                }
            }
        },
        mounted() {
           this.listarCategoria()


        }
    }
</script>
<style>
 .modal-content{
     width: 100% !important;
     position: absolute !important;
 }
 .mostrar{
     display: list-item !important;
     opacity: 1 !important;
     position: absolute !important;
     background-color: #3c29297a !important;
 }
</style>
