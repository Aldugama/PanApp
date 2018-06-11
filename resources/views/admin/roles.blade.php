@extends('admin.admin') @section('main')
<!-- Contenido Principal -->
<main class="main">
    <!-- Breadcrumb. Indice de rutas-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Mantenimiento</a></li>
        <li class="breadcrumb-item activo"><a href="{{route('rol.index')}}">Roles</a></li>
    </ol>
    <div class="container-fluid">
        @include('admin.partials.infoDataControl')
        @include('admin.partials.errors')
        <div id="messages"></div>           
        <div class="card">
            <div class="card-header">
                <a style="text-decoration:none;color:black;"
                   href="{{ route('rol.index') }}"><i class="fa fa-align-justify"></i>Roles</a>
                <button type="button"
                        class="btn btn-secondary"
                        data-toggle="modal"
                        data-target="#modalNuevo">
                    <i class="icon-plus"></i>&nbsp;Nuevo
            </button>
            </div>
            <div class="card-body">
                <form action="{{route('rol.search')}}">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3"
                                        id="opcion"
                                        name="option">
                                    <option value="nombre">Nombre</option>
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
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($roles)) @foreach($roles as $rol)
                        <tr>
                            <td>
                                <button type="button"
                                        class="btn btn-warning btn-sm"
                                        data-toggle="modal"
                                        data-target="#modalActualizar"
                                        onclick="actualizar(this)"
                                        value="{{$rol->id}}">
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                <button type="button"
                                        class="btn btn-danger btn-sm"
                                        data-toggle="modal"
                                        data-target="#modalEliminar"
                                        onclick="eliminar(this)"
                                        value="{{$rol->id}}">
                                    <i class="icon-trash"></i>
                                    </button>
                            </td>
                            <td>{{ $rol->name }}</td>
                            <td>{{ $rol->description }}</td>
                            <td>
                                <span class="badge badge-success">Activo</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <nav>
                    @if(isset($query))
                        @if(count($roles) <= 0)
                            <div class="alert alert-danger">Ningún resultado con la búsqueda especificada</div>        
                        @endif
                            {{ $roles->appends($_GET)->links() }}
                    @else
                        {{ $roles->links() }}
                    @endif
                </nav>
                @else
                    <div class="alert alert-danger">Ningún producto encontrado</div>
                @endif
            </div>
        </div>
    </div>

    <!--Inicio del modal agregar-->
    <div class="modal fade"
         id="modalNuevo"
         tabindex="-1"
         role="dialog"
         aria-labelledby="myModalLabel"
         style="display: none;"
         aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar rol</h4>
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('rol.store') }}"
                          method="post"
                          enctype="multipart/form-data"
                          class="form-horizontal"
                          onsubmit="checkForm(this)">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label"
                                   for="text-input">Nombre</label>
                            <div class="col-md-9">
                                <input id="nombre"
                                       name="name"
                                       class="form-control"
                                       placeholder="Nombre de rol"
                                       type="text">
                                <span class="help-block">(*) Ingrese el nombre del rol</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label"
                                   for="text-input">Descripción</label>
                            <div class="col-md-9">
                                <input id="description"
                                       name="description"
                                       class="form-control"
                                       placeholder="Descripción"
                                       type="text">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">Cerrar</button>
                    <button type="submit"
                            id="btnCrear"
                            class="btn btn-primary" />Guardar</button>
                </div>
                    </form>
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
                        <h4 class="modal-title">Eliminar rol</h4>
                        <button type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <p>Estas seguro de eliminar el rol?</p>
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

    </div>
<!-- Fin del modal Eliminar -->

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
                    <h4 class="modal-title">Modificar rol</h4>
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
                                    placeholder="Nombre categoria"
                                    type="text">
                            <span class="help-block">(*) Ingrese el nombre del rol</span>
                        </div>
                    </div>
                    <div class="form-group row">
                            <label class="col-md-3 form-control-label"
                                for="text-input">Descripción</label>
                            <div class="col-md-9">
                                <input id="descripcionActualizar"
                                    name="description"
                                    class="form-control"
                                    placeholder="Descripción"
                                    type="text">
                            </div>
                        </div>
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
        </div>
    </div>

</main>

<script>

    function checkForm(form)
    {
        form.btnCrear.disabled = true;
        return true;
    }
    
    function actualizar(e) {

        let id = {
            id: e.value
        };

        //Para placeholder dinámico
        axios.get(route('rol.show', id))
            .then(response => {
                $('#nombreActualizar').attr('value', response.data.name);
                $('#descripcionActualizar').attr('value', response.data.description)
            })
            .catch(error => console.log(error));

        $('#btnActualizar').click(() => {
            $('#btnActualizar').attr('disabled', true);                        
            let name = $('#nombreActualizar').val();
            let description = $('#descripcionActualizar').val();
            axios.put(route('rol.update', id), {
                    'name': name,
                    'description' : description
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

    function eliminar(e) {
        let id = {
            id: e.value
        };
        $('#btnBorrar').click(e => {
            formBorrar.action = route('rol.destroy', id);
            formBorrar.submit();
        })
    }
</script>
@stop