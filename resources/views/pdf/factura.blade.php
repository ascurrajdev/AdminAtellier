<html>
    <head>
        <title>Factura</title>
        <style>
            .table{
                width: 100%;
                border-collapse: collapse;
            }
            .table thead tr th{
                background-color:darkcyan;
                color:white;
                padding:5px;
            }
            .text-right{
                text-align: right;
            }
            .text-left{
                text-align: left;
            }
            .mt-3{
                margin-top: 2em;
            }
            .text-center{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h2 class="text-center">Factura de compra</h2>
        <table class="table">
            <tbody>
                <tr>
                    <td class="text-left">
                        Fecha: {{$factura->created_at}}
                    </td>
                    <td class="text-right">
                        Timbrado: {{$factura->timbrado->nro_timbrado}}
                    </td>
                </tr>
                <tr>
                    <td class="text-left">
                        Razon social: {{$factura->razon_social}}
                    </td>
                    <td class="text-right" style="font-size:x-small;">
                        Desde: {{$factura->timbrado->inicio_vigencia}} Hasta: {{$factura->timbrado->fin_vigencia}}
                    </td>
                </tr>
                <tr>
                    <td class="text-left">
                        Ruc: {{$factura->ruc}}
                    </td>
                    <td class="text-right" style="font-size:x-large;">
                        001-001-{{str_pad($factura->nro_factura,7,"0", STR_PAD_LEFT)}}
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Cantidad</th>
                    <th>Descripcion</th>
                    <th>Precio Unit</th>
                    <th>Precio Total</th>
                    <th>IVA (10%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($factura->detalle as $item => $value)
                    <tr>
                        <td>{{$item + 1}}</td>
                        <td>{{$value->cantidad}}</td>
                        <td>{{$value->producto->Descripcion}}</td>
                        <td>Gs. {{number_format($value->producto->Precio)}}</td>
                        <td>Gs. {{number_format($value->monto_a_pagar)}}</td>
                        <td>Gs. {{number_format($value->monto_a_pagar / 11)}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3>Total a pagar: Gs. {{number_format($factura->total)}}</h3>
    </body>
</html>