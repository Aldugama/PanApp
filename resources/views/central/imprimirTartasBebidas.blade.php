
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h1 class="text-secondary" style="text-align:center;">Todos los pedidos por tienda</h1>
        @foreach($result as $tienda)
            @if(count($tienda['pedidos'])>0)
                <div class="details-tienda">
                    <h4>Tienda: {{ $tienda['usuario_nombre'] }}</h4>
                </div>
                <span>Pedidos: </span>   
                @foreach($tienda['pedidos'] as $pedido)
                    <div class="details-pedido">
                        <h4>Fecha: {{ $pedido['pedido_fecha'] }}</h4>
                    </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-dark">
                                    <th>Categoria</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Detalles</th>
                                </thead>
                                <tbody>
                                    @foreach($pedido['productos'] as $producto)
                                    <tr> 
                                        <td>{{ $producto['categoria'] }}</td>
                                        <td>{{ $producto['nombre_producto'] }}</td>
                                        <td>{{ $producto['cantidad_producto'] }}</td>
                                        @if($producto['categoria'] === "Pasteleria")
                                            <td>{{ $producto['detalles_producto'] }}</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                @endforeach
            @endif
        @endforeach
    </div>
    <style>
        table {
            margin-top: 25px;
            margin-bottom: 40px;
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
@stop
