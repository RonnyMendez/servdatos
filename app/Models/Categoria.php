<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'idcategoria';
    public $timestamps = false;

    protected $fillable = ['descripcion', 'estado'];

    // Relación con productos (1 categoria tiene muchos productos)
    public function productos()
    {
        return $this->hasMany(Producto::class, 'idcategoria', 'idcategoria');
    }
}
