
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="table-responsive">
            <h1 class="text-secondary" style="text-align:center;">Todos los pedidos(excepto bebidas y pastelería)</h1>
            <table class="table">
                <thead class="thead-dark">
                    <th>Tienda</th>
                    <th>Categoria</th>
                    <th>Referencia producto</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                </thead>
                <tbody>
                    @foreach($result as $i)
                    <tr> 
                        <td>{{ $i['usuario_nombre'] }}</td>
                        <td>{{ $i['categoria'] }}</td>
                        <td>{{ $i['referencia_producto'] }}</td>
                        <td>{{ $i['nombre_producto'] }}</td>
                        <td>{{ $i['cantidad'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
@stop
