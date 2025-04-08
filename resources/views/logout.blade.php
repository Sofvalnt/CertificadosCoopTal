<li class="nav-item">
    <a href="/logout" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Cerrar sesión</p>
    </a>
    <form id="logout-form" action="/logout" method="POST" style="display: none;">
        @csrf <!-- Si usas Laravel, agrega el token CSRF -->
    </form>
</li>