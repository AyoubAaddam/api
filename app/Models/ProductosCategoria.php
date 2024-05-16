<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCategoria extends Model
{
    use HasFactory;
    protected $table = 'producto_categorias';

    protected $fillable = [
        'id',
        'producto_id',
        'categoria_id',
        'producto_price',
        'producto_stock',
    ];
}
