@extends('layouts.app')

@section('content')
<div id="home" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Menu principal</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-primary">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if(Auth::check())
                    <h6 style="text-align: center;">Hola <b>{{ Auth::user()->name }}</b>, has iniciado sesión con <b>{{Auth::user()->email}}</b></h6>
                    <div class="botones-sesion" style="display:flex;justify-content: space-around;">
                        @if(Auth::user()->hasRole('admin'))
                            <a href="{{url('admin')}}" class="btn btn-info">Menu admin</a>
                        @elseif(Auth::user()->hasRole('tienda'))
                            <a href="{{url('tienda')}}" class="btn btn-info">Menu tienda</a>
                        @elseif(Auth::user()->hasRole('horno'))
                            <a href="{{url('central')}}" class="btn btn-info">Menu horno central</a>
                        @endif
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <input type="submit" value="Cerrar sesión" class="btn btn-warning">
                        </form>
                    </div>
                    @else
                    <h2>Acisa Panaderias</h2>
                    <h6>Necesita iniciar sesión para comenzar</h6>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
