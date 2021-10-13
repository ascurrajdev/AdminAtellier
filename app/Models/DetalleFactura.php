<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function producto(){
        return $this->belongsTo(Producto::class);
    }
}
