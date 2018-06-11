@extends('admin.admin') 
@section('main')
<!-- Contenido Principal -->
<main class="main">
    <!-- Breadcrumb. Indice de rutas-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Mantenimiento</a></li>
        <li class="breadcrumb-item activo"><a href="{{route('producto.index')}}">Productos</a></li>
    </ol>
    <div class="container-fluid">
        @include('admin.partials.infoDataControl')
        @include('admin.partials.errors')
        <div id="messages"></div>   

        <div id="messages"></div>
        <div class="card">
            <div class="card-header">
            <a style="text-decoration:none;color:black;" href="{{ route('producto.index') }}">
                <i class="fa fa-align-justify"></i> Productos</a>
                <button type="button"
                        class="btn btn-secondary"
                        data-toggle="modal"
                        data-target="#modalNuevo">
                    <i class="icon-plus"></i>&nbsp;Nuevo
            </button>
            </div>
            <div class="card-body">
                <form action="{{route('producto.search')}}">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3"
                                        id="opcion"
                                        name="option">
                                        <option value="name">Nombre</option>
                                        <option value="category_id">Categoria</option>
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
                @if(isset($products))
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Referencia</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>    
                                    <button type="button"
                                            class="btn btn-warning btn-sm"
                                            data-toggle="modal"
                                            data-target="#modalActualizar"
                                            onclick="actualizar(this)"
                                            value="{{$product->id}}"
                                            >
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <button type="button"
                                            class="btn btn-danger btn-sm"
                                            data-toggle="modal"
                                            data-target="#modalEliminar"
                                            onclick="eliminar(this)"
                                            value="{{$product->id}}"
                                            >
                                    <i class="icon-trash"></i>
                                    </button>
                                </td>
                                <td>{{ $product->name }}</td>
                                @if(count($product->category()->get())>0)
                                    <td>{{ $product->category->name }}</td>
                                @else
                                    <td>Sin categoría</td>
                                @endif
                                <td>{{ $product->reference }}</td>
                                <td>
                                    <span class="badge badge-success">Activo</span>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
                <nav>
                    @if(isset($query))
                        @if(count($products) <= 0)
                            <div class="alert alert-danger">
                                Ningún resultado con la búsqueda especificada
                            </div>                                    
                        @endif
                            {{$products->appends($_GET)->links()}}
                    @else
                        {{ $products->links() }}
                    @endif
                </nav>
                @endif
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
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
                    <h4 class="modal-title">Agregar producto</h4>
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('producto.store') }}"
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
                                    <span class="help-block">(*) Ingrese el nombre del producto</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label"
                                        for="text-input">Referencia</label>
                                <div class="col-md-9">
                                    <input id="referencia"
                                            name="reference"
                                            class="form-control"
                                            placeholder="Referencia"
                                            type="text">
                                </div>
                            </div>
                            @if(isset($categories))
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label"
                                        for="text-input">Categoria</label>
                                <div class="col-md-9">
                                    <select id="categoria"
                                            name="category"
                                            class="form-control">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                    <h4 class="modal-title">Eliminar Categoría</h4>
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <p>Estas seguro de eliminar la categoría?</p>
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
                    <h4 class="modal-title">Modificar producto</h4>
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
                                    placeholder="Nombre producto"
                                    type="text"
                                    required>
                            <span class="help-block">(*) Ingrese el nombre del producto</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label"
                                for="text-input">Referencia</label>
                        <div class="col-md-9">
                            <input id="referenciaActualizar"
                                    name="reference"
                                    class="form-control"
                                    placeholder="Referencia"
                                    type="text">
                        </div>
                    </div>
                    @if(isset($categories))
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label"
                                for="text-input">Categoria</label>
                        <div class="col-md-9">
                            <select id="categoriaActualizar"
                                    name="category"
                                    class="form-control"
                                    required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
<!-- /Fin del contenido principal -->
<script>
    let nameShow;
    let referenceShow;
    let categoryShow;

    function checkForm(form)
    {
        form.btnCrear.disabled = true;
        return true;
    }

    function actualizar(e){
        $('#formSpan').remove();

        let id = {id : e.value};
        
        axios.get(route('producto.show', id))
        .then(response => {
            nameShow = response.data.product.name;
            referenceShow = response.data.product.reference;
            categoryShow = response.data.category;
            $('#nombreActualizar').attr('value', nameShow);
            $('#referenciaActualizar').attr('value', referenceShow);
            if(categoryShow !== "")
                $('#form').append("<span id='formSpan' class='form-control alert alert-warning'>Actualemente este producto tiene la categoría "  + categoryShow + "</span>");
        })
        .catch(error => console.log(error));


        $('#btnActualizar').click(() => {
            $('#btnActualizar').attr('disabled', true);            
            let name = $('#nombreActualizar').val();
            let reference = $('#referenciaActualizar').val();
            let category = $('#categoriaActualizar').val();
            
            if(name == "")
                name = nameShow;

            if(reference == "" ) 
                reference = referenceShow;

            if(category == "")
                category = categoryShow;

            axios.put(route('producto.update', id), {
                'name' : name,
                'reference': reference,
                'category' : category
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
        let id = {id : e.value};
        $('#btnBorrar').click(e => {
            formBorrar.action = route('producto.destroy', id);
            formBorrar.submit();
        })
    }
</script>
@stop