<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Computadora;
class Aula extends Model
{
    protected $table = 'aula';
    protected $fillable = [
        'nombre',];
    public function Computadoras()
    {
        return $this->hasMany(Computadora::class,'aula_destinada','id');
    }
}
