<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
    <a class="navbar-brand" href="#">RMS</a>

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="/">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('research.create') ? 'active' : '' }}" href="{{ route('research.create') }}">Add Research</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('research.index') ? 'active' : '' }}" href="{{ route('research.index') }}">View</a>
        </li>
    </ul>
</div>
</nav>