@extends('admin.admin') 
@section('main')
<!-- Contenido Principal -->
<main class="main">
    <!-- Breadcrumb. Indice de rutas-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Mantenimiento</a></li>
        <li class="breadcrumb-item activo"><a href="{{route('carrito.index')}}">Pedidos</a></li>
        <li class="breadcrumb-item activo"><a href="{{route('carrito.index')}}">Productos del pedido</a></li>
    </ol>
    <div class="container-fluid">
        @include('admin.partials.infoDataControl')
        @include('admin.partials.errors')
        <div id="messages"></div>
        <div class="card">
            <div class="card-header">
            <a style="text-decoration:none;color:black;" href="{{ route('carrito.index') }}"><i class="fa fa-align-justify"></a></i> carritos
                <button type="button"
                        class="btn btn-secondary"
                        data-toggle="modal"
                        data-target="#modalNuevo">
                    <i class="icon-plus"></i>&nbsp;Nuevo
            </button>
            </div>
            <div class="card-body">
                <form action="{{route('carrito.search')}}">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3"
                                        id="opcion"
                                        name="option">
                                    <option value="name">Nombre</option>
                                    <option value="role">Rol</option>
                                    <option value="reference">Referencia</option>
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
                            <th>carrito</th>
                            <th>Fecha de expedición</th>
                            <th>Status</th>
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
                            @if(count($order->user()->get()) > 0)
                                <td>{{ $order->user->name }}</td>
                            @endif
                            <td>
                                {{ $order->date_exp }}
                            </td>
                            <td> 
                                <span class="badge badge-success">{{ $order->status }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <nav>
                    {{ $orders->links() }}
                </nav>
                @else
                    @if(isset($search))
                        @include('admin.partials.search')
                    @else
                        <div class="alert alert-danger">Ningún carrito encontrado</div>
                    @endif
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
                    <h4 class="modal-title">Eliminar carrito</h4>
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <p>Estas seguro de eliminar el carrito?</p>
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
                    <h4 class="modal-title">Modificar carrito</h4>
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label"
                                for="text-input">Nombre</label>
                        <div class="col-md-9">
                            <input  id="nombreActualizar"
                                    name="name"
                                    class="form-control"
                                    placeholder="Nombre carrito"
                                    type="text"
                                    required>
                            <span class="help-block">(*) Ingrese el nombre del carrito</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label"
                                for="text-input">E-mail</label>
                        <div class="col-md-9">
                            <input id="emailActualizar"
                                    name="email"
                                    class="form-control"
                                    placeholder="E-mail"
                                    type="text">
                        </div>
                    </div>
                    @if(isset($roles))
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label"
                                for="text-input">Rol</label>
                        <div class="col-md-9" id="form">
                            <select id="roleActualizar"
                                    name="role"
                                    class="form-control"
                                    required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
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
            statusShow = response.data.order.status;
            $('#statusActualizar').attr('value', statusShow);
            if(statusShow !== "")
                $('#form').append("<span id='formSpan' class='form-control alert alert-warning'>Actualemente este pedido está:"  + statusShow + "</span>");
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