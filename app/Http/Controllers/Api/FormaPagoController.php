<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Models\FormaPago;

class FormaPagoController extends Controller
{
    use ResponseTrait;

    public function index(){
        $formaPagos = FormaPago::all();
        return $this->success($formaPagos);
    }
}
