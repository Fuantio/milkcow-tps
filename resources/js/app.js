/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: Axios } = require('axios');
const { get } = require('lodash');

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const consultaCantidadProducciones = "http://127.0.0.1:8000/contarProduccion"
const app = new Vue({
    el: '#app',

    data: {
        // color: '',
        // numero1: 0,
        // numero2: 0,
        // resultado: 0,
        // operacion: '',
        textoProduccion: '',
        producciones: [],
        textoVaca: '',
        totalProduccion: 0,
        produccionPagina: 10,
        
        paginasProduccion: '',
        paginaActualProduccion: 1,
        desdeProduccion: '',
        hastaProduccion: '',
        ocultarMostrarAnteriorProduccion: '',
        ocultarMostrarSiguienteProduccion: '',
        botonesProduccion: [],
        graficarProduccion: '',
        produccionMonth: []
    },
    methods: {

        eliminarProduccion: function (ID_Produccion) {

            var eliminar = confirm("¿Esta seguro que quiere eliminar la produccion?");

            if (eliminar == true) {

                axios.delete('http://127.0.0.1:8000/produccion/' + ID_Produccion).then((respuesta) => {

                    console.log(respuesta);

                    window.location.href = "http://127.0.0.1:8000/produccion/";

                });
            }
        },

        calcular: function () {

            if (this.operacion == 'suma') {

                this.resultado = parseInt(this.numero1) + parseInt(this.numero2)

            }
            if (this.operacion == 'resta') {

                this.resultado = parseInt(this.numero1) - parseInt(this.numero2)

            }
            if (this.operacion == 'multi') {

                this.resultado = parseInt(this.numero1) * parseInt(this.numero2)

            }
            if (this.operacion == 'div') {

                this.resultado = parseInt(this.numero1) / parseInt(this.numero2)

            }

        },

        buscarProduccion: function () {

            var produccionMañana = 0
            var produccionTarde = 0



            if (this.textoProduccion.length > 0) {

                axios.get('http://127.0.0.1:8000/produccionBuscar/' + this.textoProduccion).then((respuesta) => {

                    this.producciones = respuesta.data;

                    this.producciones.forEach(element => {
                        if (element.jornada == "mañana") {

                            produccionMañana = produccionMañana + element.cantidad

                        } else {

                            produccionTarde = produccionTarde + element.cantidad

                        }
                    });
                    titulo="PRODUCCIÓN DIARIA (Litros)"
                    this.dibujarGrafico(produccionMañana, produccionTarde, titulo)

                    this.paginasProduccion = Math.ceil(this.producciones.length / this.produccionPagina);


                });

                return this.producciones

            } else {


                axios.get('http://127.0.0.1:8000/produccionBuscar/-').then((respuesta) => {
                    this.producciones = respuesta.data;

                    this.producciones.forEach(element => {
                        if (element.jornada == "mañana") {

                            produccionMañana = produccionMañana + element.cantidad

                        } else {

                            produccionTarde = produccionTarde + element.cantidad

                        }
                    });
                    titulo="PRODUCCIÓN TOTAL (Litros)"
                    this.dibujarGrafico(produccionMañana, produccionTarde, titulo)
                

                    this.paginasProduccion = Math.ceil(this.producciones.length / this.produccionPagina);


                });



                return this.producciones

            }



        },

        buscarVaca: function () {


            if (this.textoVaca.length > 0) {

                axios.get('http://127.0.0.1:8000/vacaBuscar/' + this.textoVaca).then((respuesta) => {
                    this.producciones = respuesta.data;
                    this.paginasProduccion = Math.ceil(this.producciones.length / this.produccionPagina);
                });

            } else {

                axios.get('http://127.0.0.1:8000/vacaBuscar/-').then((respuesta) => {
                    this.producciones = respuesta.data;
                    this.paginasProduccion = Math.ceil(this.producciones.length / this.produccionPagina);
                });
            }

        },
        consultaNumeroProducciones: function () {

            axios.get(consultaCantidadProducciones).then((respuesta) => {

                this.totalProduccion = respuesta.data
                this.paginasProduccion = Math.ceil(this.totalProduccion / this.produccionPagina);
            })

        },
        paginar: function (pagina) {
            this.paginaActualProduccion = pagina;
            this.desdeProduccion = ((this.paginaActualProduccion - 1) * this.produccionPagina);
            this.hastaProduccion = this.paginaActualProduccion * this.produccionPagina;

            if (this.paginaActualProduccion == 1) {

                this.ocultarMostrarAnteriorProduccion = "page-item disabled";

            } else {

                this.ocultarMostrarAnteriorProduccion = "page-item";
            }

            if (this.paginaActualProduccion == this.paginasProduccion) {

                this.ocultarMostrarSiguienteProduccion = "page-item disabled";

            } else {

                this.ocultarMostrarSiguienteProduccion = "page-item"

            }

            for (i = 0; i <= this.paginasProduccion; i++) {

                if ((i + 1) == this.paginaActualProduccion) {

                    this.botonesProduccion[i] = "page-item active"

                } else {

                    this.botonesProduccion[i] = "page-item"
                }
            }
        },
        anterior: function () {

            this.paginaActualProduccion = this.paginaActualProduccion - 1;
            this.paginar(this.paginaActualProduccion);
        },
        siguiente: function () {

            this.paginaActualProduccion = this.paginaActualProduccion + 1;
            this.paginar(this.paginaActualProduccion);
        },

        dibujarGrafico: function (produccionMañana, produccionTarde, titulo) {

            google.charts.load("current", { packages: ["corechart"] });
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ["Element", "Litros", { role: "style" }],
                    ["MAÑANA", produccionMañana, "cyan"],
                    ["TARDE", produccionTarde, "brown"],
                ]);

                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1,
                    {
                        calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"
                    },
                    2]);

                var options = {
                    title: titulo,
                    width: 480,
                    height: 300,
                    bar: { groupWidth: "95%" },
                    legend: { position: "none" },
                };
                var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
                chart.draw(view, options);
            }

        },

        buscarMonthYear: function () {


            if (this.graficarProduccion.length > 0) {


                axios.get('http://127.0.0.1:8000/buscarGraficoMonthYear/' + this.graficarProduccion).then((respuesta) => {
                    this.produccionMonth = respuesta.data;

                    //Debo crear un arreglo con la estructura que maneja google chart
                    //y enviarlo como parametro a la funcion del grafico

                    var datos = [
                        ["Element", "Litros", { role: "style" }]]

                        this.produccionMonth.forEach(element=>{

                            datos.push(
                                [element.fecha, element.cantidad, "orange, red"],
                              
                            )


                        })

                    console.log(datos)

                    this.dibujarGraficoMes(datos)

                });
            }
        },

        dibujarGraficoMes: function (datos) {

            google.charts.load("current", { packages: ["corechart"] });
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable(datos);

                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1,
                    {
                        calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"
                    },
                    2]);

                var options = {
                    title: "PRODUCCION MENSUAL",
                    width: 900,
                    height: 500,
                    bar: { groupWidth: "95%" },
                    legend: { position: "none" },
                };
                var chart = new google.visualization.BarChart(document.getElementById("barchart_month"));
                chart.draw(view, options);
            }

        },



    },



    mounted() {

        this.buscarProduccion()
        //this.buscarVaca()
        this.consultaNumeroProducciones()
        this.paginar(1)
        // this.dibujarGrafico()

    }


});
