<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="/">Mi Blog</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <?php if (isset($user) && $user): ?>
                <?php if ($user->inGroup('admin')): ?>
                    <li class="nav-item"><a class="nav-link" href="/admin/posts">Panel Admin</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/categories">Categorías</a></li>
                <?php elseif ($user->inGroup('user')): ?>
                    <li class="nav-item"><a class="nav-link" href="/user/dashboard">Mi Panel</a></li>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link" href="/logout">Salir</a></li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="/register">Registro</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav> 