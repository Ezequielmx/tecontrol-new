<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion_pedido',
        'descripcion_cotizacion',
        'proveedor_id',
        'moneda_id',
        'categoria_id',
        'precio_compra',
        'precio_venta',
        'punto_pedido',
        'stock_inicial',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function moneda()
    {
        return $this->belongsTo(Currency::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('descripcion_pedido', 'LIKE', '%'.$searchTerm.'%')
            ->orWhere('descripcion_cotizacion', 'LIKE', '%'.$searchTerm.'%');
    }
}