<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComputadoraPorAula extends Model
{
    protected $table = 'computadora_por_aulas';
    protected $fillable = [
        'id_computadora','aula_asignada',];

}
