@if(Session::has('success'))
    <div class="alert alert-success"
            role="alert">{{ Session::get('success') }} añadido con éxito</div>
@endif @if (Session::has('deleted'))
    <div class="alert alert-warning"
        role="alert"> {{ Session::get('name') }} borrado con éxito, si desea deshacer el cambio <a href="{{ route($element.'.restore', [Session::get('deleted')]) }}">Click aqui</a>            </div>
@endif @if (Session::has('restored'))
    <div class="alert alert-success"
        role="alert"> {{ Session::get('restored') }} restaurado con éxito</div>
@endif @if (Session::has('error'))
    <div class="alert alert-danger"
        role="alert"> {{ Session::get('error') }}</div>
@endif