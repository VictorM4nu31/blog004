<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="text-center">
                <div class="mb-6">
                    <h1 class="text-4xl font-bold text-blue-600 mb-2">Mi Blog</h1>
                    <p class="text-gray-500">Crea tu cuenta</p>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Registro de Usuario</h2>
            </div>
            
            <?php if (session()->has('error')) : ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?= session('error') ?>
                </div>
            <?php endif ?>

            <?php if (session()->has('errors')) : ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        <?php foreach (session('errors') as $error) : ?>
                            <li><?= $error ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <?php if (session()->has('message')) : ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?= session('message') ?>
                </div>
            <?php endif ?>

            <form action="<?= route_to('register') ?>" method="post" class="space-y-6">
                <?= csrf_field() ?>
                
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Nombre de Usuario</label>
                    <input type="text" id="username" name="username" value="<?= old('username') ?>" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="<?= old('email') ?>" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label for="password_confirm" class="block text-sm font-medium text-gray-700 mb-1">Confirmar Contraseña</label>
                    <input type="password" id="password_confirm" name="password_confirm" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition font-semibold">
                    Registrarse
                </button>
            </form>

            <div class="text-center mt-6">
                <p class="text-gray-600">¿Ya tienes una cuenta? 
                    <a href="<?= route_to('login') ?>" class="text-blue-600 hover:text-blue-500 font-medium">Inicia sesión aquí</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
