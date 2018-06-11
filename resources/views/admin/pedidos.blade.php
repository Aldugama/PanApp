@extends('admin.admin') 
@section('main')
<!-- Contenido Principal -->
<main class="main">
    <!-- Breadcrumb. Indice de rutas-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Mantenimiento</a></li>
        <li class="breadcrumb-item activo"><a href="{{route('pedido.index')}}">Pedidos</a></li>
    </ol>
    <div class="container-fluid">
        @include('admin.partials.infoDataControl')
        @include('admin.partials.errors')
        <div id="messages"></div>
        <div class="card">
            <div class="card-header">
            <a style="text-decoration:none;color:black;" href="{{ route('pedido.index') }}"><i class="fa fa-align-justify"></i> Pedidos</a>
            </div>
            <div class="card-body">
                <form action="{{route('pedido.search')}}">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3"
                                        id="opcion"
                                        name="option">
                                    <option value="status">Estado</option>
                                </select>
                                <input id="query"
                                    name="query"
                                    class="form-control"
                                    placeholder="Texto a buscar"
                                    type="text">
                                <button type="submit"
                                        class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                </form> 
                @if(isset($orders))
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Identificador</th>
                            <th>Usuario</th>
                            <th>Fecha de expedición</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>    
                                <button type="button"
                                        class="btn btn-warning btn-sm"
                                        data-toggle="modal"
                                        data-target="#modalActualizar"
                                        onclick="actualizar(this)"
                                        value="{{$order->id}}"
                                        >
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button"
                                        class="btn btn-danger btn-sm"
                                        data-toggle="modal"
                                        data-target="#modalEliminar"
                                        onclick="eliminar(this)"
                                        value="{{$order->id}}"
                                        >
                                <i class="icon-trash"></i>
                                </button>
                            </td>
                            <td>{{$order->id}}</td>
                            @if(count($order->user()->get()) > 0)
                                <td>{{ $order->user->name }}</td>
                            @else
                                <td>Este pedido no tiene usuarios</td>
                            @endif
                            <td>
                                {{ $order->updated_at }}
                            </td>
                            <td> 
                                <span class="badge badge-success">
                                    {{ $order->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <nav>
                    @if(isset($query))
                        @if(count($orders) <= 0)
                            <div class="alert alert-danger">
                                Ningún resultado con la búsqueda especificada
                            </div>
                        @endif
                            {{ $orders->appends($_GET)->links() }}
                    @else
                        {{ $orders->links() }}
                    @endif
                </nav>
                @else
                    <div class="alert alert-danger">
                        Ningún pedido encontrado
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Inicio del modal Eliminar -->
    <div class="modal fade"
         id="modalEliminar"
         tabindex="-1"
         role="dialog"
         aria-labelledby="myModalLabel"
         style="display: none;"
         aria-hidden="true">
        <div class="modal-dialog modal-danger"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar pedido</h4>
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <p>Estas seguro de eliminar el pedido?</p>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">Cerrar</button>
                    <form action="" method="POST" id="formBorrar">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit"
                                id="btnBorrar"
                                class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Inicio del modal Actualizar -->
    <div class="modal fade"
         id="modalActualizar"
         tabindex="-1"
         role="dialog"
         aria-labelledby="myModalLabel"
         style="display: none;"
         aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modificar pedido</h4>
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form id="form">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label"
                                for="text-input">Estado</label>
                        <div class="col-md-9">
                            <select name="status" class="form-control" id="statusActualizar">
                                @foreach($states as $state)
                                    <option value="{{$state}}">{{$state}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            id="btnClose"
                            class="btn btn-secondary"
                            data-dismiss="modal">Cerrar</button>
                    <button type="submit"
                            id="btnActualizar"
                            class="btn btn-primary" />Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</main>

<script>
    let statusShow;

    function actualizar(e){
        $('#formSpan').remove();

        let id = {id : e.value};

        axios.get(route('pedido.show', id))
        .then(response => {
            statusShow = response.data.status;
            $('#statusActualizar').attr('value', statusShow);
            if(statusShow !== "")
                $('#form').append("<span id='formSpan' class='form-control alert alert-warning'>Actualemente este pedido está: "  + statusShow + "</span>");
        })
        .catch(error => console.log(error));
        

        $('#btnActualizar').click(() => {
            $('#btnActualizar').attr('disabled', true);                        
            let status = $('#statusActualizar').val();
            
            if(status == "")
                status = statusShow;

            axios.put(route('pedido.update', id), {
                'status' : status,
            })
            .then(response => {
                btnClose.click();
                let message = response.data.message;
                $('#messages').addClass('alert alert-success');
                $('#messages').text(message);
                setTimeout(() => {
                    location.reload(true);                            
                }, 1000);
            })
            .catch(error => console.log(error));
        });
    }

    //Peligroso, esto hay que mejorarlo
    function eliminar(e) {
        let id = {id : e.value};
        $('#btnBorrar').click(e => {
            formBorrar.action = route('pedido.destroy', id);
            formBorrar.submit();
        })
    }
</script>
@stop