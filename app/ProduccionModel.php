<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProduccionModel extends Model
{
    protected $table = 'producción';

    public function usuarios(){

        return $this->belongsTo('App\User', 'responsable', 'id');

    }
    public function vacas(){

        return $this->belongsTo('App\VacaModel', 'vaca', 'id_animal');

    }

}
