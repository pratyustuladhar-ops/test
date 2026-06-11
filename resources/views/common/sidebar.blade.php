<div class="bg-dark text-white p-3" style="min-height: 100vh; width: 250px;">

    <h4 class="text-center mb-4">POS Menu</h4>

    <ul class="nav flex-column">


        @foreach ($menus as $menu)
            <li class="nav-item">
                <a class="nav-link text-white" href="/{{ $menu->slug }}">{{ $menu->name }}</a>
            </li>
        @endforeach
    </ul>

</div>