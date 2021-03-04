<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Aula;
class Computadora extends Model
{
    protected $table = 'table_computador';
    protected $fillable = [
        'nombre','alumno_asignado','aula_destinada'];
    public function Alumno()
    {
        return $this->belongsTo('App\Alumno');
    }
    public function Aula()
    {
        return $this->belongsTo(Aula::class,'aula_destinada','id');
    }
}
