<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function detalle(){
        return $this->hasMany(DetalleFactura::class);
    }

    public function timbrado(){
        return $this->belongsTo(Timbrado::class);
    }
}
