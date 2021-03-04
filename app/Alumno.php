<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Computadora;
class Alumno extends Model
{
    protected $table = 'alumno';
    protected $fillable = [
        'nombre',];
    public function ComputadorasAsignadas()
    {
        return $this->hasMany(Computadora::class,"alumno_asignado","id");
    }
}
