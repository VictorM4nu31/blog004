<nav class="bg-gray-900 text-white shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <a class="font-bold text-xl" href="/">Mi Blog</a>
            <div class="hidden md:flex space-x-6">
                <?php if (isset($user) && $user): ?>
                    <?php if ($user->inGroup('admin')): ?>
                        <a class="hover:text-blue-400 transition" href="/admin/posts">Panel Admin</a>
                        <a class="hover:text-blue-400 transition" href="/admin/categories">Categorías</a>
                    <?php elseif ($user->inGroup('user')): ?>
                        <a class="hover:text-blue-400 transition" href="/user/dashboard">Mi Panel</a>
                    <?php endif; ?>
                    <a class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded transition" href="/logout">Salir</a>
                <?php else: ?>
                    <a class="hover:text-blue-400 transition" href="/login">Login</a>
                    <a class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded transition" href="/register">Registro</a>
                <?php endif; ?>
            </div>
            <!-- Mobile menu button -->
            <button class="md:hidden" onclick="toggleMobileMenu()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        <!-- Mobile menu -->
        <div id="mobileMenu" class="md:hidden hidden pb-4">
            <?php if (isset($user) && $user): ?>
                <?php if ($user->inGroup('admin')): ?>
                    <a class="block py-2 hover:text-blue-400 transition" href="/admin/posts">Panel Admin</a>
                    <a class="block py-2 hover:text-blue-400 transition" href="/admin/categories">Categorías</a>
                <?php elseif ($user->inGroup('user')): ?>
                    <a class="block py-2 hover:text-blue-400 transition" href="/user/dashboard">Mi Panel</a>
                <?php endif; ?>
                <a class="block py-2 text-red-400 hover:text-red-300 transition" href="/logout">Salir</a>
            <?php else: ?>
                <a class="block py-2 hover:text-blue-400 transition" href="/login">Login</a>
                <a class="block py-2 hover:text-blue-400 transition" href="/register">Registro</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden');
}
</script>
