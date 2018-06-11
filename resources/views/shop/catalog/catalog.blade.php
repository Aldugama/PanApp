@extends('shop.shop') 
@section('content')

<script src="/js/app.js"></script>

<?php
    if(session()->get('order_id') != null) {
        $order = App\Order::findOrFail(session()->get('order_id'));
    }
    else{
        if(count(Auth::user()->orders)<= 0) {
            return redirect('tienda');
        }
        if(Auth::user()->orders->where('status', 'activo')->whereIn('drinks', [null, false])->last() !== null)
            $order = Auth::user()->orders->where('status', 'activo')->whereIn('drinks', [null, false])->last()->id;
    }
?>

@if ($errors->any())
<div class="errores">
    <div class="alert alert-danger" style="margin-top:70px;">
        @if($errors->get('quantity'))
            {{ $errors->first('quantity') }}
        @endif
        @if($errors->get('details'))
            {{ $errors->first('details') }}
        @endif
        <button type="button"
                class="close"
                aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>  
    </div>
</div>
@endif
<div class="notificaciones">
@if(session()->has('success'))
    <div class="alert alert-success" style="margin-top:85px;">
        {{ session()->get('success') }}
        <button type="button"
                class="close"
                aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
</div>

<div class="productos">
    <div class="row">
        @if(count($products) > 0 && isset($products))
            @foreach($products as $product)
            <div class="col-6 col-sm-6">
                <div class="producto">
                    <div class="card">
                        <div class="card-header">
                            <span>{{$product->name}}</span>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                  action="{{ route('add.item', $product->id) }}"
                                  onsubmit="checkForm(this)"
                                  id="pedido">
                                @csrf
                                <div class="form-group">
                                    <span>Cantidad:</span>
                                    <input type="text"
                                        id="quantity"
                                        class="quantity form-control"
                                        name="quantity">
                                </div>
                                @if($order->products->where('id', $product->id)->first() != null)
                                    <div class="notificaciones">
                                        <div class="alert alert-success ">
                                            <button type="button"
                                                    class="close"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <span>Este producto está en la cesta</span>
                                        </div>
                                    </div>
                                    <script>quantity.value = {{ $order->products->where('id', $product->id)->first()->pivot->quantity }}</script>
                                @endif
                                @if($product->category === null)
                                    <div class="alert alert-danger">Producto sin categoria asignada. Pongase en contacto con el administrador</div>
                                @else
                                    @if($product->category->name === "Pasteleria")
                                        <span>Detalles pedido: </span>
                                        <div class="input_group-prepend">
                                            @if($order->products->where('id', $product->id)->first() != null)
                                            <div class="notificaciones">
                                                {{-- <div class="alert alert-success">
                                                    <button type="button"
                                                            class="close"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>                                
                                                    @if(strlen($product["pivot"]['details']) > 0)
                                                        <span>Detalles actuales: {{ $product["pivot"]['details'] }}</span>                                
                                                    @else
                                                        <span>No hay detalles especificados para este producto</span>                                
                                                    @endif
                                                </div> --}}
                                            </div>
                                            @endif
                                        <textarea class="form-control"
                                                aria-label="Detalles pedido"
                                                name="details"></textarea>
                                    </div>
                                    @endif
                                @endif
                                <div class="form-group"
                                    style="margin: 0 auto;">
                                    <button type="submit"
                                            id="btnAdd"
                                            class="btn btn-primary">Añadir</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="card-footer"></div>
        @if(isset($query)) 
            @if(count($products) <=0 )
                <div class="alert alert-danger">Ningún resultado encontrado</div>
                <a href="{{ route('catalogo.index') }}"
                class="btn btn-info">Pulse aquí para volver al inicio</a> 
            @endif 
                {{ $products->appends($_GET)->links()}} 
        @else 
            {{ $products->links() }} 
        @endif
    @else
        <div class="card text-white bg-primary mb-3" style="max-width: 30rem; margin: 0 auto;">
            <div class="card-header"><span>No se ha encontrado ningún resultado</span></div>
            <div class="card-body">
                <p style="text-align:center;">Pulse 
                    <a 
                        href="{{ route('catalogo.index') }}"
                        style="text-decoration:underline; color:white">aquí</a>
                     para seguir pidiendo</p>
            </div>
        </div>
@endif
</div>
@if(session()->has('cancelled') || session()->has('success') || session()->has('errors'))
<script>
    location.reload(true);  
</script>
@endif
<script>

    function checkForm(form)
    {
        form.btnAdd.disabled = true;
        return true;
    }
</script>
@stop