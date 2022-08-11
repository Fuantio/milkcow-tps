<?php

namespace App\Http\Controllers;

use App\InventarioLecheModel;
use Illuminate\Http\Request;

class InventarioLecheController extends Controller
{
    public function index(){

        $leche = InventarioLecheModel::all();

        return view("paginas.leche",array("leche"=>$leche));
    }


}


    