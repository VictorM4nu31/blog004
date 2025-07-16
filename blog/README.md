# 📝 Blog Interactivo con CodeIgniter 4

<div align="center">
    
🚀 **¡Bienvenido a tu próximo blog favorito!** 🚀

*Un blog moderno construido con CodeIgniter 4, Shield Auth y Tailwind CSS*

[![PHP](https://img.shields.io/badge/PHP-8.1%2B-blue.svg)](https://php.net)
[![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4.x-red.svg)](https://codeigniter.com)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4.x-38B2AC.svg)](https://tailwindcss.com)
[![Shield](https://img.shields.io/badge/Shield-Auth-green.svg)](https://shield.codeigniter.com)

</div>

---

## 🎯 ¿Qué es este proyecto?

Este es un **blog completo y funcional** que incluye:

- ✨ **Sistema de autenticación** con roles de usuario
- 📚 **Gestión de posts** con categorías
- 🔐 **Panel de administración** protegido
- 🎨 **Diseño responsivo** con Tailwind CSS
- 👥 **Dashboard de usuario** personalizado
- 📱 **Interfaz moderna** e intuitiva

---

## 🛠️ Requisitos del Sistema

Antes de comenzar, asegúrate de tener instalado:

### 📋 Requisitos Obligatorios
- **PHP 8.1+** (¡Imprescindible!)
- **Composer** (Gestor de dependencias PHP)
- **Node.js & npm** (Para Tailwind CSS)
- **MySQL/MariaDB** (Base de datos)
- **Servidor web** (Apache/Nginx) o **PHP Built-in Server**

### 📦 Extensiones PHP Necesarias
- `intl` - Para internacionalización
- `mbstring` - Para manejo de strings multibyte
- `json` - Para manejo de JSON
- `mysqlnd` - Para conexión a MySQL
- `libcurl` - Para peticiones HTTP

> ⚠️ **Nota importante**: PHP 7.4 y 8.0 ya no tienen soporte. ¡Actualiza a PHP 8.1 o superior!

---

## 🚀 Instalación Rápida

### Opción 1: Clonación del Repositorio

```bash
# 1. Clona el repositorio
git clone <tu-repositorio-url>
cd blog

# 2. Instala las dependencias de PHP
composer install

# 3. Instala las dependencias de Node.js
npm install

# 4. Configura el entorno
cp env .env

# 5. Configura la base de datos en .env
# (Ver sección "Configuración de Base de Datos")

# 6. Ejecuta las migraciones
php spark migrate

# 7. Ejecuta los seeders
php spark db:seed RoleSeeder

# 8. ¡Listo! Ejecuta el servidor
npm run serve
```

### Opción 2: Desde Cero con Composer

```bash
# 1. Crea un nuevo proyecto
composer create-project codeigniter4/appstarter mi-blog
cd mi-blog

# 2. Instala Shield para autenticación
composer require codeigniter4/shield

# 3. Continúa con los pasos del 3 al 8 de la Opción 1
```

---

## ⚙️ Configuración de Base de Datos

Edita el archivo `.env` con tus credenciales de base de datos:

```env
# Database
database.default.hostname = localhost
database.default.database = blog_db
database.default.username = tu_usuario
database.default.password = tu_contraseña
database.default.DBDriver = MySQLi
database.default.DBPrefix = 

# App
app.baseURL = 'http://localhost:8080/'
app.forceGlobalSecureRequests = false

# Session
session.driver = 'CodeIgniter\Session\Handlers\FileHandler'
session.savePath = null
```

---

## 🎨 Comandos de Desarrollo

### 🔥 Desarrollo (Recomendado)
```bash
# Inicia el servidor con hot-reload de CSS
npm run serve
```

### 🖥️ Solo Servidor
```bash
# Solo el servidor CodeIgniter
php spark serve
```

### 💅 Solo CSS
```bash
# Solo compilación de Tailwind en modo watch
npm run dev
```

### 📦 Producción
```bash
# Compila CSS minificado para producción
npm run build
```

---

## 🌟 Características del Blog

### 🏠 **Página Principal**
- Lista de posts paginada
- Filtro por categorías
- Diseño responsive
- Navegación intuitiva

### 🔐 **Sistema de Autenticación**
- Registro de usuarios
- Inicio de sesión
- Recuperación de contraseña
- Roles y permisos

### 👤 **Dashboard de Usuario**
- Panel personalizado
- Gestión de perfil
- Historial de actividades

### 🛡️ **Panel de Administración**
- Gestión de posts (CRUD)
- Gestión de categorías
- Administración de usuarios
- Estadísticas del blog

---

## 📱 Rutas Principales

| Ruta | Descripción | Acceso |
|------|-------------|--------|
| `/` | Página principal del blog | Público |
| `/auth/login` | Página de inicio de sesión | Público |
| `/auth/register` | Página de registro | Público |
| `/user/dashboard` | Dashboard de usuario | Usuario |
| `/admin/posts` | Gestión de posts | Admin |
| `/admin/categories` | Gestión de categorías | Admin |

---

## 🎯 Primeros Pasos Después de la Instalación

1. **Crea tu primera cuenta de administrador:**
   - Ve a `/auth/register`
   - Regístrate con tus datos
   - Asigna rol de admin en la base de datos

2. **Crea tu primera categoría:**
   - Ve a `/admin/categories`
   - Crea categorías como "Tecnología", "Viajes", etc.

3. **Escribe tu primer post:**
   - Ve a `/admin/posts`
   - Crea un post de bienvenida

4. **Personaliza el diseño:**
   - Modifica `app/Views/css/input.css`
   - Ejecuta `npm run dev` para ver cambios

---

## 🔧 Solución de Problemas

### ❌ Error: "No se puede conectar a la base de datos"
```bash
# Verifica que MySQL esté corriendo
sudo systemctl status mysql
# o en Windows con XAMPP/WAMP
```

### ❌ Error: "Comando 'php spark' no encontrado"
```bash
# Asegúrate de estar en la carpeta correcta
cd blog
# Verifica que PHP esté en el PATH
php --version
```

### ❌ Error: "npm no encontrado"
```bash
# Instala Node.js desde https://nodejs.org
# Verifica la instalación
node --version
npm --version
```

---

## 🤝 Contribución

¡Las contribuciones son bienvenidas! Si encuentras un bug o tienes una idea:

1. 🍴 Haz un fork del proyecto
2. 🌿 Crea una nueva rama (`git checkout -b feature/nueva-funcionalidad`)
3. 💾 Haz commit de tus cambios (`git commit -am 'Añade nueva funcionalidad'`)
4. 📤 Sube los cambios (`git push origin feature/nueva-funcionalidad`)
5. 🔄 Abre un Pull Request

---

## 📚 Recursos Útiles

- 📖 [Documentación de CodeIgniter 4](https://codeigniter.com/user_guide/)
- 🛡️ [Documentación de Shield](https://shield.codeigniter.com/)
- 🎨 [Documentación de Tailwind CSS](https://tailwindcss.com/docs)
- 🐛 [Foro de CodeIgniter](https://forum.codeigniter.com/)

---

## 📄 Licencia

Este proyecto está bajo la licencia MIT. Consulta el archivo `LICENSE` para más detalles.

---

<div align="center">

**¡Gracias por usar nuestro blog! 🎉**

*Si te gusta el proyecto, no olvides darle una ⭐ en GitHub*

**¡Feliz blogging! 🚀**

</div>
