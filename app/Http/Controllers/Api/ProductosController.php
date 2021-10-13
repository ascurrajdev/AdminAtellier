<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Models\Producto;

class ProductosController extends Controller
{
    use ResponseTrait;
    public function index(){
        $productos = Producto::all();
        return $this->success($productos);
    }
}
