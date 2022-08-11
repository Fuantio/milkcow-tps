<?php

namespace App\Http\Controllers;

use App\InventarioLecheModel;
use Illuminate\Http\Request;

use App\ProduccionModel;
use App\VacaModel;
use App\User;
class ProduccionController extends Controller
{
    public function index (){

      //  $producciones = ProduccionModel::all();

       // return view("paginas.produccion", array("producciones"=>$producciones));

       return view("paginas.produccion");
    }

    public function show($ID_Produccion){
        $vacas = VacaModel::all();
        $usuarios = User::all();
        $producciones = ProduccionModel::where("ID_Produccion", $ID_Produccion)->get();
        if(count($producciones) != 0){
            return view("paginas.editarProduccion", array("producciones"=>$producciones, "vacas"=>$vacas, "usuarios"=>$usuarios));
        }else{
        return view("paginas.editarProduccion", array("estatus"=>404));   
        }
}
    public function update($ID_Produccion, request $request){

        $datos = array(

            "vaca"          => $request->input("vaca"),
            "cantidad"      => $request->input("cantidad"),
            "responsable"   => $request->input("responsable"),
            "jornada"       => $request->input("jornada"),
            "fecha"         => $request->input("fecha")

        );

        if(!empty($datos)){

            $produccion = ProduccionModel::where('ID_Produccion', $ID_Produccion)->update($datos);

            return redirect("/produccion");
        }

       
    }
    public function destroy($ID_Produccion, Request $request){

        return $produccion = ProduccionModel::where("ID_Produccion", $ID_Produccion)->delete();
    }
    public function store(Request $request){

        $datos = array(

            "vaca"          => $request->input("vaca"),
            "cantidad"      => $request->input("cantidad"),
            "responsable"   => $request->input("responsable"),
            "jornada"       => $request->input("jornada"),
            "fecha"         => $request->input("fecha")
        );

        

        if(!empty($datos)){

            $id_produccion = ProduccionModel::insertGetId($datos);
            //consultar el ultimo registro de la tabla inventario leche y obtener la cantidad de ese registro
            $inventarioLeche = InventarioLecheModel::latest('id_leche')->first();
            //crear nueva variable que se llame nuevaCantidad y hacerla igual a la cantidad que llega del formulario más la cantidad del registro de leche 
            $nuevaCantidad = $inventarioLeche['existencias'] + $request->input("cantidad");
            //crear un nuevo registro en la tabla leche con la nuevaCantidad
            //debo crear un arreglo con los datos de la tabla inventarioLeche y ahí si ejecutar el insert

            $datosInventario = array(

                "existencias" => $nuevaCantidad, 
                "movimiento"  => "entrada",
                "id_producción" => $id_produccion


            );


            $inventarioLeche = InventarioLecheModel::insert($datosInventario);

            return redirect("/produccion");
        }
    }
    public function agregar(){
        $vacas = VacaModel::all();
        $usuarios = User::all();
        return view("paginas.produccionAgregar", array("vacas"=>$vacas, "usuarios"=>$usuarios));
    }
    public function buscarProduccion($textoProduccion, Request $request){


        if($request->ajax()){

            if($textoProduccion === '-'){

                $produccion = ProduccionModel::join('vaca','producción.vaca','=', 'vaca.Id_animal')
                ->join('users', 'producción.responsable','=', 'users.id')
                ->orderBy('producción.ID_Produccion', 'desc')
                ->get();

                return $produccion;
            }else{

                $produccion = ProduccionModel::where('fecha', $textoProduccion)
                ->join('vaca','producción.vaca','=', 'vaca.Id_animal')
                ->join('users', 'producción.responsable','=', 'users.id')
                ->orderBy('producción.ID_Produccion', 'desc')
                ->get();

                return $produccion;
            }

        }
    }
    public function buscarVaca($textoVaca, Request $request){

        if($request->ajax()){

            if($textoVaca === '-'){

                $produccion = ProduccionModel::join('vaca','producción.vaca','=', 'vaca.Id_animal')
                ->join('users', 'producción.responsable','=', 'users.id')
                ->orderBy('producción.ID_Produccion', 'desc')
                ->get();

                return $produccion;
            }else{

                $produccion = ProduccionModel::where('vaca.nombre', 'like', '%' .$textoVaca. '%')
                ->join('vaca', 'producción.vaca', '=', 'vaca.Id_animal')
                ->join('users', 'producción.responsable','=', 'users.id')
                ->orderBy('producción.ID_Produccion', 'desc')
                ->get();

                return $produccion;
            }

        }
    }
    public function contarProduccion(){

        $cantidadProduccion = ProduccionModel::count();

        return $cantidadProduccion;
    }

    public function buscarMonthYear($graficarProduccion, Request $request){

        if($request->ajax()){
    
            if($graficarProduccion != ''){
    
                $produccion = ProduccionModel::where('fecha', 'like',  $graficarProduccion.'%')
                ->orderBy('fecha', 'DESC')
                ->get();
    
                return $produccion;
            }
    
        }
    }
}

