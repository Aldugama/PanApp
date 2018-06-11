<div class="header-menu">
    <form action="{{ route('logout') }}" 
          id="form"
          method="POST">
          @csrf
    <ul class="ul-base">
        <li>
            <a href="{{ route('carro.index') }}">
                <i class="fa fa-shopping-cart"></i>
            </a>
        </li>
        <li><a href="{{route('catalogo.index')}}"><i class="fas fa-archive"></i></a></li>
        <li>
            <a href="#"><i class="fas fa-sign-out-alt" id="logout"></i></a>
        </li>
    </ul>
</form>
</div>

<script>
    logout.addEventListener('click', e => {
        e.preventDefault();
        form.submit();
    })
</script>