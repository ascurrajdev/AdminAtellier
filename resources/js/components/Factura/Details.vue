<template>
    <div>
        <input name="detalle" :value="JSON.stringify(detalle)" type="hidden"/>
        <input name="pagos" :value="JSON.stringify(detalleFormaPago)" type="hidden"/>
        <multiselect v-model="productoSeleccionado" placeholder="Seleccione el producto" label="Descripcion" track-by="id" :options="productos"/>
        <div class="form-group">
            <label>Cantidad</label>
            <input type="number" class="form-control" placeholder="Ej: 2" v-model="cantidad"/>
        </div>
        <button @click.prevent="handleSelectProductoAndInsertToDetail" class="btn mt-3 btn-success btn-block btn-lg">Agregar producto al detalle <i class="fas fa-plus"></i></button>
        <table v-if="detalle.length > 0" class="table mt-3 table-borderless table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Cantidad</th>
                    <th>Descripcion</th>
                    <th>Precio Unit</th>
                    <th>Precio Total</th>
                    <th>IVA</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(value,key) in detalle" :key="key">
                    <td>{{key + 1}}</td>
                    <td>{{value.cantidad}}</td>
                    <td>{{value.descripcion}}</td>
                    <td>Gs. {{new Intl.NumberFormat("de-DE").format(value.precioUnit)}}</td>
                    <td>Gs. {{new Intl.NumberFormat("de-DE").format(value.precioTotal)}}</td>
                    <td>Gs. {{new Intl.NumberFormat("de-DE").format(value.iva)}}</td>
                </tr>
            </tbody>
        </table>
        <multiselect v-if="totalPagar > 0" v-model="formaPagoSeleccionada" placeholder="Seleecione la forma de pago" label="forma" :options="formaPagos"/>
        <div class="form-group" v-if="totalPagar > 0">
            <label>Monto a pagar</label>
            <input v-model="montoAPagarSeleccionado" class="form-control" type="number"/>
            <h3 class="text-success">{{new Intl.NumberFormat("de-DE").format(montoAPagarSeleccionado)}}</h3>
        </div>
        <button @click.prevent="handleRegisterDetallePagos" v-if="totalPagar > 0" class="btn btn-primary btn-block btn-lg">Agregar forma de pago <i class="fas fa-plus"></i></button>
        <table v-if="detalleFormaPago.length > 0" class="mt-3 table table-borderless table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Forma de pago</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(detalle,item) in detalleFormaPago" :key="item">
                    <td>{{item + 1}}</td>
                    <td>{{detalle.forma}}</td>
                    <td>Gs. {{new Intl.NumberFormat("de-DE").format(detalle.monto)}}</td>
                </tr>
            </tbody>
        </table>
        <h2 class="text-danger mt-5" v-if="totalPagar > 0">Total pagado: GS. {{new Intl.NumberFormat("de-DE").format(totalPagado)}}</h2>
        <h2 class="text-success mt-3" v-if="totalPagar > 0">Total a pagar: GS. {{new Intl.NumberFormat("de-DE").format(totalPagar)}}</h2>
        <button type="submit" v-if="(totalPagar - totalPagado) == 0 && totalPagar != 0" class="btn btn-primary btn-block btn-lg">Registrar factura <i class="fas fa-save"></i></button>
        <sweet-modal icon="error" ref="errorValidation">
            {{mensajeValidacion}}
        </sweet-modal>
    </div>
</template>
<script>
import Multiselect from 'vue-multiselect'
import { SweetModal } from 'sweet-modal-vue'
import {has,isEmpty} from 'lodash'
import axios from 'axios'
export default {
    data:function(){
        return{
            cantidad:null,
            productos:[],
            productoSeleccionado:null,
            detalle:[],
            mensajeValidacion:'',
            formaPagos:[],
            formaPagoSeleccionada:null,
            totalPagar:0,
            totalPagado:0,
            montoAPagarSeleccionado:0,
            detalleFormaPago:[]
        }
    },
    components:{
        Multiselect,
        SweetModal
    },
    mounted:function(){
        this.handleFetchAllProductos()
        this.handleFetchFormaPagos()
    },
    methods:{
        handleFetchFormaPagos:function(){
            axios.get('/api/forma-pagos').then((response) => {
                return response.data.data
            }).then((formaPagos) => {
                this.formaPagos = formaPagos
            })
        },
        handleFetchAllProductos:function(){
            axios.get('/api/productos').then((response)=>{
                return response.data.data
            }).then((productos) => {
                this.productos = productos
            })
        },
        handleRegisterDetallePagos:function(){
            if(!has(this.formaPagoSeleccionada,'id')){
                this.mensajeValidacion = "La forma de pago no esta seleccionada"
                this.$refs.errorValidation.open()
            }else if(isEmpty(this.montoAPagarSeleccionado)){
                this.mensajeValidacion = "Por favor introduzca el monto a pagar con esta forma de pago"
                this.$refs.errorValidation.open()
            }else{
                this.detalleFormaPago = [
                    ...this.detalleFormaPago,
                    {
                        monto:this.montoAPagarSeleccionado,
                        forma:this.formaPagoSeleccionada.forma,
                        formaId:this.formaPagoSeleccionada.id
                    }
                ]
                this.totalPagado = 0
                this.detalleFormaPago.forEach((value) => {
                    this.totalPagado += parseInt(value.monto)
                })
                this.handleResetFormaPago()
            }
        },
        handleSelectProductoAndInsertToDetail:function(){
            if(!has(this.productoSeleccionado,'id')){
                this.mensajeValidacion = "El producto no se ha seleccionado"
                this.$refs.errorValidation.open()
            }else if(isEmpty(this.cantidad)){
                this.mensajeValidacion = "Por favor introduzca la cantidad"
                this.$refs.errorValidation.open()
            }else{
                this.detalle = [
                    ...this.detalle,
                    {
                        productoId:this.productoSeleccionado.id,
                        cantidad:this.cantidad,
                        descripcion:this.productoSeleccionado.Descripcion,
                        precioTotal:this.productoSeleccionado.Precio * this.cantidad,
                        precioUnit:this.productoSeleccionado.Precio,
                        iva: parseInt((this.productoSeleccionado.Precio * this.cantidad) / 11)
                    }
                ]
                this.totalPagar = 0
                this.detalle.forEach((value) => {
                    this.totalPagar += parseInt(value.precioTotal)
                })
                this.handleResetValue()
            }
        },
        handleResetValue:function(){
            this.productoSeleccionado = null
            this.cantidad = null
        },
        handleResetFormaPago:function(){
            this.formaPagoSeleccionada = null
            this.montoAPagarSeleccionado = 0
        }
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>