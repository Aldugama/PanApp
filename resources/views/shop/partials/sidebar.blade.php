<nav class="sidebar">
    <span class="nav-link-title">Categorias</span>
    <div class="nav-separator"></div>
    <ul class="nav-categories ul-base">
        @if($categories)
            @foreach($categories as $category)
                <li>
                    <a href="{{ url('/tienda/categoria/'.$category->id) }}">{{ $category->name }}</a>
                </li>
            @endforeach
        @endif
    </ul>
</nav>