@extends('shop.shop')
@section('content')

<div class="pedido-main">
    
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(count(Auth::user()->orders()->whereIn('status', ['activo', 'pending'])->get()) > 0)
        @foreach($orders as $order)
            <div id="messages"></div>
            
            <div class="estado">
                @if(session()->has('order_id'))
                    @if(session()->get('order_id') === $order->id)
                        <h4>Pedido: {{ $order->updated_at }} 
                            @if($order->drinks)  -  BEBIDAS SEMANALES @endif
                        </h4>
                        <h6 class="text text-success">
                            Estado: {{ $order->status }}   
                        </h6>
                    @else
                        <h4>Pedido: {{ $order->updated_at }} 
                            @if($order->drinks)  -  BEBIDAS SEMANALES @endif
                        </h4>
                        <h6>Estado: {{ $order->status }}</h6> 
                    @endif
                @endif
            </div>
            <form action="{{route('carro.update', $order->id)}}" method="post">
                @csrf 
                    <input type="hidden" name="_method" value="PUT"/>
                    <table class="table-bordered">
                        <thead>
                            <th>Categoria</th>
                            <th>Producto</th>
                            <th>Detalles</th>
                            <th>Cantidad</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @if(count($order->products) > 0)
                                @foreach($order->products as $product)
                                    <tr>
                                        <input type="hidden" name="products[]" value="{{ $product->id }}">
                                        <td>{{ $product->category->name }}</td>
                                        <td><span>{{ $product->name }}</span></td>
                                    @if($product->category->name == "Pasteleria" || 
                                        $product->pivot->details != null || 
                                        strlen($product->pivot->details) > 3)
                                        <td>
                                            <textarea 
                                                type="text" 
                                                name="details[]"
                                                value=""
                                                class="form-control"
                                                rows="1">{{ $product->pivot->details }}</textarea>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                        <td>
                                            <input 
                                                type="text" 
                                                class="form-control quantity" 
                                                name="quantity[]" 
                                                value="{{ $product->pivot->quantity }}"/>
                                            </td>
                                        <td>
                                            <div class="acciones">
                                                <button class="btn btn-info btn-sm btnPlus">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                                <button class="btn btn-warning btn-sm btnMinus">
                                                    <i class="fas fa-minus"></i>
                                                </button>

                                                <button class="btn btn-danger btn-sm btnDelete" 
                                                        value="{{ $product->id }}">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>                            
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <p>
                                    Este pedido aún no tiene productos, por favor vaya al
                                        <a 
                                            href="{{ route('catalogo.index') }}"
                                            target="_blank">
                                            catalogo de productos
                                        </a> para pedir
                                </p>
                            @endif
                        </tbody>
                    </table>
                    <div class="botones">
                        <button type="submit" class="btn btn-success">Guardar Pedido</button>
                </form>
                <form action="{{ route('carro.cancelar', $order->id) }}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <button type="submit" class="btn btn-secondary">Cancelar Pedido</button>
                </form>
            </div>
        @endforeach
    @else
        <div class="alerta-no-pedidos alert alert-dark" style="width: 30vw;">
            <h5>No tienes pedidos en activo ni en trámite
                <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </h5>
            <a href="{{ route('catalogo.index') }}" class="btn btn-info">Ir al Catalogo</a>
        </div>
    @endif
</div>
<script src="/js/app.js"></script>
<script>
    $('.btnDelete').click( e => {
        e.preventDefault();
        let elemento = "";

        if(e.target.tagName === "I") {
            elemento = e.target.parentNode.value;
        }
        else {
            elemento = e.target.value;
        }

        axios.post(route('remove.item', elemento))
        .then(
            response => {
                let message = response.data.message;
                $('#messages').addClass('alert alert-danger');
                $('#messages').text(message);
                setTimeout(() => {
                    location.reload(true);
                }, 1200);
            }
        )
        .catch(error => console.log(error))
    });

</script>
@endsection