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

            <form action="<?= route_to('register') ?>" method="post" class="space-y-6" id="registerForm">
                <?= csrf_field() ?>
                
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Nombre de Usuario</label>
                    <input type="text" id="username" name="username" value="<?= old('username') ?>" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <div id="username-error" class="text-red-500 text-sm mt-1 hidden"></div>
                </div>

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

                <div>
                    <label for="password_confirm" class="block text-sm font-medium text-gray-700 mb-1">Confirmar Contraseña</label>
                    <input type="password" id="password_confirm" name="password_confirm" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <div id="password_confirm-error" class="text-red-500 text-sm mt-1 hidden"></div>
                </div>

                <button type="submit" id="submitBtn" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition font-semibold disabled:bg-gray-400 disabled:cursor-not-allowed">
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

<script>
// Elementos del formulario
const form = document.getElementById('registerForm');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const passwordConfirm = document.getElementById('password_confirm');
const submitBtn = document.getElementById('submitBtn');

// Elementos de error
const usernameError = document.getElementById('username-error');
const emailError = document.getElementById('email-error');
const passwordError = document.getElementById('password-error');
const passwordConfirmError = document.getElementById('password_confirm-error');

// Estado de validación
let isValid = {
    username: false,
    email: false,
    password: false,
    passwordConfirm: false
};

// Función para mostrar error
function showError(element, message) {
    element.textContent = message;
    element.classList.remove('hidden');
    element.previousElementSibling.classList.add('border-red-500');
    element.previousElementSibling.classList.remove('border-gray-300');
}

// Función para ocultar error
function hideError(element) {
    element.classList.add('hidden');
    element.previousElementSibling.classList.remove('border-red-500');
    element.previousElementSibling.classList.add('border-gray-300');
}

// Función para validar email
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Función para actualizar el estado del botón
function updateSubmitButton() {
    const allValid = Object.values(isValid).every(valid => valid);
    submitBtn.disabled = !allValid;
}

// Validación de username
username.addEventListener('input', function() {
    const value = this.value.trim();
    
    if (value.length === 0) {
        showError(usernameError, 'El nombre de usuario es requerido');
        isValid.username = false;
    } else if (value.length < 3) {
        showError(usernameError, 'El nombre de usuario debe tener al menos 3 caracteres');
        isValid.username = false;
    } else {
        hideError(usernameError);
        isValid.username = true;
    }
    
    updateSubmitButton();
});

// Validación de email
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

// Validación de password
password.addEventListener('input', function() {
    const value = this.value;
    
    if (value.length === 0) {
        showError(passwordError, 'La contraseña es requerida');
        isValid.password = false;
    } else if (value.length < 6) {
        showError(passwordError, 'La contraseña debe tener al menos 6 caracteres');
        isValid.password = false;
    } else {
        hideError(passwordError);
        isValid.password = true;
    }
    
    // Revalidar confirmación de contraseña
    if (passwordConfirm.value.length > 0) {
        passwordConfirm.dispatchEvent(new Event('input'));
    }
    
    updateSubmitButton();
});

// Validación de confirmación de password
passwordConfirm.addEventListener('input', function() {
    const value = this.value;
    const passwordValue = password.value;
    
    if (value.length === 0) {
        showError(passwordConfirmError, 'Por favor confirma tu contraseña');
        isValid.passwordConfirm = false;
    } else if (value !== passwordValue) {
        showError(passwordConfirmError, 'Las contraseñas no coinciden');
        isValid.passwordConfirm = false;
    } else {
        hideError(passwordConfirmError);
        isValid.passwordConfirm = true;
    }
    
    updateSubmitButton();
});

// Validación inicial al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    // Si hay valores preexistentes (por ejemplo, después de un error del servidor)
    if (username.value) username.dispatchEvent(new Event('input'));   if (email.value) email.dispatchEvent(new Event('input'));
    if (password.value) password.dispatchEvent(new Event('input'));
    if (passwordConfirm.value) passwordConfirm.dispatchEvent(new Event('input'));
});
</script>

<?= $this->endSection() ?>
