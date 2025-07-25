<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="text-center">
                <div class="mb-6">
                    <h1 class="text-4xl font-bold text-blue-600 mb-2">Mi Blog</h1>
                    <p class="text-gray-500">Bienvenido de vuelta</p>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Iniciar Sesión</h2>
            </div>
            
            <?php if (session()->has('error')) : ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?= session('error') ?>
                </div>
            <?php endif ?>

            <?php if (session()->has('message')) : ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?= session('message') ?>
                </div>
            <?php endif ?>

            <form action="<?= route_to('login') ?>" method="post" class="space-y-6" id="loginForm">
                <?= csrf_field() ?>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="<?= old('email') ?>" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <div id="email-error" class="text-red-500 text-sm mt-1 hidden"></div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <div id="password-error" class="text-red-500 text-sm mt-1 hidden"></div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="mr-2">
                    <label for="remember" class="text-sm text-gray-600">Recordarme</label>
                </div>

                <button type="submit" id="submitBtn" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition font-semibold disabled:bg-gray-400 disabled:cursor-not-allowed">
                    Iniciar Sesión
                </button>
            </form>

            <div class="text-center mt-6">
                <p class="text-gray-600">¿No tienes una cuenta? 
                    <a href="<?= route_to('register') ?>" class="text-blue-600 hover:text-blue-500 font-medium">Regístrate aquí</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<script>
const loginForm = document.getElementById('loginForm');
const email = document.getElementById('email');
const password = document.getElementById('password');
const submitBtn = document.getElementById('submitBtn');
const emailError = document.getElementById('email-error');
const passwordError = document.getElementById('password-error');
let isValid = { email: false, password: false };
function showError(element, message) {
    element.textContent = message;
    element.classList.remove('hidden');
    element.previousElementSibling.classList.add('border-red-500');
    element.previousElementSibling.classList.remove('border-gray-300');
}
function hideError(element) {
    element.classList.add('hidden');
    element.previousElementSibling.classList.remove('border-red-500');
    element.previousElementSibling.classList.add('border-gray-300');
}
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
function updateSubmitButton() {
    const allValid = Object.values(isValid).every(valid => valid);
    submitBtn.disabled = !allValid;
}
email.addEventListener('input', function() {
    const value = this.value.trim();
    if (value.length === 0) {
        showError(emailError, 'El email es requerido');
        isValid.email = false;
    } else if (!isValidEmail(value)) {
        showError(emailError, 'Por favor ingresa un email válido');
        isValid.email = false;
    } else {
        hideError(emailError);
        isValid.email = true;
    }
    updateSubmitButton();
});
password.addEventListener('input', function() {
    const value = this.value;
    if (value.length === 0) {
        showError(passwordError, 'La contraseña es requerida');
        isValid.password = false;
    } else {
        hideError(passwordError);
        isValid.password = true;
    }
    updateSubmitButton();
});
document.addEventListener('DOMContentLoaded', function() {
    if (email.value) email.dispatchEvent(new Event('input'));
    if (password.value) password.dispatchEvent(new Event('input'));
});
</script>
