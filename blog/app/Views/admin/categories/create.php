<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="max-w-xl mx-auto mt-10">
  <div class="bg-gradient-to-r from-blue-50 to-green-50 rounded-xl shadow-xl p-8">
    <h1 class="text-3xl font-bold mb-6 text-blue-700">Nueva Categoría</h1>
    <?php if (session('errors')): ?>
      <div class="bg-red-100 text-red-800 p-2 mb-4 rounded shadow">
        <ul class="list-disc pl-5">
          <?php foreach (session('errors') as $error): ?>
            <li><?= esc($error) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <form id="categoryCreateForm" class="space-y-6">
      <div>
        <label class="block mb-1 font-semibold text-blue-700">Nombre</label>
        <input type="text" name="name" id="name" class="w-full border-2 border-blue-300 px-3 py-2 rounded focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" required value="<?= old('name') ?>">
        <div id="name-error" class="text-red-500 text-sm mt-1 hidden"></div>
      </div>
      <div class="flex justify-end gap-4">
        <a href="/admin/categories" class="bg-gray-200 text-gray-700 px-5 py-2 rounded-full hover:bg-gray-300 transition font-semibold shadow">Cancelar</a>
        <button type="submit" id="submitBtn" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition font-semibold shadow disabled:bg-gray-400 disabled:cursor-not-allowed">Guardar</button>
      </div>
    </form>
  </div>
</div>

<script>
const categoryForm = document.getElementById('categoryCreateForm');
const name = document.getElementById('name');
const submitBtn = document.getElementById('submitBtn');
const nameError = document.getElementById('name-error');
let isValid = { name: false };

// Función para mostrar notificaciones
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${type === 'success' ? 'bg-green-50 text-white' : 'bg-red-50 text-white'}`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Auto-remover después de 3 segundos
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

function showError(element, message) {
    element.textContent = message;
    element.classList.remove('hidden');
    element.previousElementSibling.classList.add('border-red-500');
    element.previousElementSibling.classList.remove('border-blue-300');
}

function hideError(element) {
    element.classList.add('hidden');
    element.previousElementSibling.classList.remove('border-red-500');
    element.previousElementSibling.classList.add('border-blue-300');
}

function updateSubmitButton() {
    submitBtn.disabled = !isValid.name;
}

name.addEventListener('input', function() {
    const value = this.value.trim();
    if (value.length === 0) {
        showError(nameError, 'El nombre es requerido');
        isValid.name = false;
    } else if (value.length < 3) {
        showError(nameError, 'El nombre debe tener al menos 3 caracteres');
        isValid.name = false;
    } else {
        hideError(nameError);
        isValid.name = true;
    }
    updateSubmitButton();
});

// Envío del formulario con AJAX
categoryForm.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    if (!isValid.name) {
        showNotification('Por favor corrige los errores antes de enviar', 'error');
        return;
    }
    
    submitBtn.disabled = true;
    submitBtn.textContent = 'Guardando...';
    try {
        const formData = new FormData();
        formData.append('name', name.value.trim());
        
        const response = await fetch('/admin/categories/store', {
            method: 'POST',
            body: formData,
            headers: {
               'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        const data = await response.json();
        
        if (response.ok && data.success) {
            showNotification('Categoría creada exitosamente', 'success');
            // Redirigir después de un breve delay
            setTimeout(() => {
                window.location.href = '/admin/categories';
            }, 1500);
        } else {
            showNotification(data.message || 'Error al crear la categoría', 'error');
            submitBtn.disabled = false;
            submitBtn.textContent = 'Guardar';    
        }
    } catch (error) {
        console.error(error);
        showNotification('Error al crear la categoría', 'error');
        submitBtn.disabled = false;
        submitBtn.textContent = 'Guardar';
    }
});

document.addEventListener('DOMContentLoaded', function() {
    if (name.value) name.dispatchEvent(new Event('input'));
});
</script>

<?= $this->endSection() ?> 