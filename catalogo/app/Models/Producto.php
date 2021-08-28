<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    //métodos de ralación
    public function getMarca()
    {
        return $this->belongsTo(
                        Marca::class,
                        'idMarca',
                        'idMarca'
        );
    }
}
