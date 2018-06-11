@extends('admin.admin') 
@section('main')
<!-- Contenido Principal -->
<main class="main">
    <!-- Breadcrumb. Indice de rutas-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Mantenimiento</a></li>
        <li class="breadcrumb-item activo"><a href="{{route('usuario.index')}}">Usuario</a></li>
    </ol>
    <div class="container-fluid">
        @include('admin.partials.infoDataControl')
        @include('admin.partials.errors')
        <div id="messages"></div>
        <div class="card">
            <div class="card-header">
            <a style="text-decoration:none;color:black;" href="{{ route('usuario.index') }}">
                <i class="fa fa-align-justify"></i> Usuarios</a>
                <button type="button"
                        class="btn btn-secondary"
                        data-toggle="modal"
                        data-target="#modalNuevo">
                    <i class="icon-plus"></i>&nbsp;Nuevo
            </button>
            </div>
            <div class="card-body">
                <form action="{{route('usuario.search')}}">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3"
                                        id="opcion"
                                        name="option">
                                    <option value="name">Nombre</option>
                                    <option value="role">Rol</option>
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
                @if(isset($users))
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>    
                                <button type="button"
                                        class="btn btn-warning btn-sm"
                                        data-toggle="modal"
                                        data-target="#modalActualizar"
                                        onclick="actualizar(this)"
                                        value="{{$user->id}}"
                                        >
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button"
                                        class="btn btn-danger btn-sm"
                                        data-toggle="modal"
                                        data-target="#modalEliminar"
                                        onclick="eliminar(this)"
                                        value="{{$user->id}}"
                                        >
                                <i class="icon-trash"></i>
                                </button>
                            </td>
                            <td>{{ $user->name }}</td>
                            @if(count($user->role()->get())>0)
                                <td>
                                    <span class="badge badge-success">{{ $user->role->name }}</span>
                                </td>
                            @else
                                <td>
                                    <span>Este usuario no tiene rol</span>    
                                </td>    
                            @endif
                            <td>
                                <span class="badge badge-success">Activo</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <nav>
                    @if(isset($query))
                        @if(count($users) <= 0)
                            <div class="alert alert-danger">
                                Ningún resultado con la búsqueda especificada
                            </div>                                    
                        @endif
                            {{ $users->appends($_GET)->links() }}                            
                    @else
                        {{$users->links()}}
                    @endif
                </nav>
                @else
                    <div class="alert alert-danger">Ningún usuario encontrado</div>
                @endif
                
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregarr-->
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
                    <h4 class="modal-title">Agregar usuario</h4>
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('usuario.store') }}"
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
                                            placeholder="Nombre"
                                            type="text">
                                    <span class="help-block">(*) Ingrese el nombre del usuario</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label"
                                        for="text-input">E-mail</label>
                                <div class="col-md-9">
                                    <input id="email"
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
                                <div class="col-md-9">
                                    <select id="role"
                                            name="role"
                                            class="form-control">
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
                                    class="btn btn-secondary"
                                    data-dismiss="modal">Cerrar</button>
                            <button type="submit"
                                    id="btnCrear"
                                    class="btn btn-primary" />Guardar</button>
                        </div>
                    </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
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
                    <h4 class="modal-title">Eliminar usuario</h4>
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <p>Estas seguro de eliminar el usuario?</p>
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
                    <h4 class="modal-title">Modificar usuario</h4>
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
                                    placeholder="Nombre usuario"
                                    type="text"
                                    required>
                            <span class="help-block">(*) Ingrese el nombre del usuario</span>
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
<!-- /Fin del contenido principal -->
<script>
    let nameShow;
    let emailShow;
    let roleShow;

    function checkForm(form)
    {
        form.btnCrear.disabled = true;
        return true;
    }

    function actualizar(e){
        $('#formSpan').remove();

        let id = {id : e.value};

        axios.get(route('usuario.show', id))
        .then(response => {
            nameShow = response.data.user.name;
            emailShow = response.data.user.email;
            roleShow = response.data.role;
            $('#nombreActualizar').attr('value', nameShow);
            $('#emailActualizar').attr('value', emailShow);
            if(roleShow !== "")
                $('#form').append("<span id='formSpan' class='form-control alert alert-warning'>Actualemente este usuario tiene el rol "  + roleShow + "</span>");
        })
        .catch(error => console.log(error));
        

        $('#btnActualizar').click(() => {
            $('#btnActualizar').attr('disabled', true);                        
            let name = $('#nombreActualizar').val();
            let email = $('#emailActualizar').val();
            let role = $('#roleActualizar').val();
            
            if(name == "")
                name = nameShow;

            if(email == "" ) 
                email = emailShow;

            if(role == "")
                role = roleShow;

            axios.put(route('usuario.update', id), {
                'name' : name,
                'email': email,
                'role' : role
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
            formBorrar.action = route('usuario.destroy', id);
            formBorrar.submit();
        })
    }
</script>
@stop