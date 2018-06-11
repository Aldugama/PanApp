@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1>Horno</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h4>Listar pedidos</h4>
                <span>Fecha: {{ date('d-m-y') }} </span>
            </div>
        </div>
            <div class="row">
                <div class="col justify-content-md-center">
                    <table border="1">
                        <tr>
                            <th>Descripcion</th>
                            <th>Boton impresión</th>
                        </tr>
                        <tr>
                            <td> Impresión productos(excepto pasteleria y bebida) </td>
                            <td>
                            <a class="btn btn-success btntodos" href="{{ route('central.all')}}" target="_blank">
                                    Imprimir
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td> Pedidos de cada tienda(todos los pedidos) </td>
                            <td>
                                <a class="btn btn-success btntodos" href="{{ route('central.shops')}}" target="_blank">
                                    Imprimir
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td> Pedidos pasteleria de cada tienda(todas las tiendas) </td>
                            <td>
                                <a class="btn btn-success btntodos" href="{{ route('central.category', 13)}}" target="_blank">
                                    Imprimir
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td> Pedidos bebidas de cada tienda </td>
                            <td>
                                <a class="btn btn-success btntodos" href="{{ route('central.category', 18)}}" target="_blank">
                                    Imprimir
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
    </div>
@stop