---

# 🎉 ¡Crea un Blog Épico con CodeIgniter 4! 🚀

<div align="center">

**¡Bienvenido al blog que hará que tus ideas brillen!** 🌟  
*Un proyecto moderno, dinámico y súper cool con CodeIgniter 4, Shield Auth y Tailwind CSS*

[![PHP](https://img.shields.io/badge/PHP-8.1%2B-blue.svg)](https://php.net)
[![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4.x-red.svg)](https://codeigniter.com)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4.x-38B2AC.svg)](https://tailwindcss.com)
[![Shield](https://img.shields.io/badge/Shield-Auth-green.svg)](https://shield.codeigniter.com)

</div>

---

## 🤩 ¿Qué hace este proyecto tan genial?

Este no es un blog cualquiera, ¡es un **BLOG SÚPER PODEROSO**! 🦸‍♂️ Aquí tienes lo que incluye:

- 🔐 **Autenticación de lujo** con roles de usuario (¡siente el poder del admin!)
- 📝 **Gestión de posts y categorías** para compartir tus historias
- 🎨 **Diseño moderno y responsivo** gracias a Tailwind CSS
- 👤 **Dashboard personalizado** para cada usuario
- 🛡️ **Panel de administración** protegido para los jefes del blog
- 📱 **Interfaz intuitiva** que se ve increíble en cualquier dispositivo

---

## 🛠️ ¿Qué necesitas para empezar?

Antes de lanzarte a la aventura, asegúrate de tener estas herramientas listas:

### 📋 Requisitos imprescindibles
- **PHP 8.1+** (¡sin esto, no hay fiesta!)
- **Composer** (el mago que instala dependencias PHP)
- **Node.js & npm** (para que Tailwind brille)
- **MySQL/MariaDB** (donde guardaremos las historias)
- **Servidor web** (Apache, Nginx o el servidor integrado de PHP)

### 🧩 Extensiones PHP que no pueden faltar
- `intl` - Para que el mundo entero entienda tu blog
- `mbstring` - Para manejar textos como pro
- `json` - Porque JSON es vida
- `mysqlnd` - Para conectar con la base de datos
- `libcurl` - Para hacer peticiones HTTP como ninja

> ⚠️ **Ojo al dato**: PHP 7.4 y 8.0 están fuera de juego. ¡Sube a PHP 8.1 o más!

---

## 🚀 ¡Instala tu blog en 5 minutos! ⏱️

### Opción 1: Clona y arranca como cohete 🚀

```bash
# 1. Clona el repositorio
git clone <tu-repositorio-url>
cd blog

# 2. Instala las dependencias PHP
composer install

# 3. Instala las dependencias de Tailwind
npm install

# 4. Configura tu entorno
cp env .env

# 5. Configura la base de datos (mira abajo 👇)

# 6. Crea las tablas con migraciones
php spark migrate

# 7. Llena la base con datos iniciales
php spark db:seed RoleSeeder

# 8. ¡Enciende el motor!
npm run serve
```

> 🎯 **Tip**: El seeder `RoleSeeder` crea roles y permisos básicos. ¡No te lo saltes!

### Opción 2: Empieza desde cero como un valiente 🛠️

```bash
# 1. Crea un proyecto nuevo
composer create-project codeigniter4/appstarter mi-blog
cd mi-blog

# 2. Añade Shield para autenticación
composer require codeigniter4/shield

# 3. Sigue los pasos 3 al 8 de la Opción 1
```

---

## ⚙️ Configura tu base de datos

Abre el archivo `.env` y pon tus credenciales como si fueran los ingredientes de tu receta favorita:

```env
# Base de datos
database.default.hostname = localhost
database.default.database = blog_db
database.default.username = tu_usuario
database.default.password = tu_contraseña
database.default.DBDriver = MySQLi
database.default.DBPrefix = 

# Configuración de la app
app.baseURL = 'http://localhost:8080/'
app.forceGlobalSecureRequests = false

# Sesiones
session.driver = 'CodeIgniter\Session\Handlers\FileHandler'
session.savePath = null
```

---

## 🎮 Comandos para dominar el desarrollo

### 🔥 Modo desarrollo (¡el favorito!)
```bash
# Inicia el servidor con recarga automática de CSS
npm run serve
```

### 🖥️ Solo el servidor PHP
```bash
# Para los puristas de CodeIgniter
php spark serve
```

### 💅 Solo los estilos
```bash
# Compila Tailwind CSS en tiempo real
npm run dev
```

### 📦 Listo para producción
```bash
# Genera CSS minificado para el gran debut
npm run build
```

---

## 🌟 Lo que hace brillar a este blog

### 🏠 **Página principal**
- Lista de posts con paginación
- Filtros por categorías
- Diseño que se adapta a móviles, tablets y más
- Navegación súper fluida

### 🔐 **Autenticación de nivel pro**
- Registro e inicio de sesión
- Recuperación de contraseñas
- Roles y permisos para controlar todo

### 👤 **Dashboard de usuario**
- Panel personalizado para cada usuario
- Edita tu perfil como quieras
- Revisa tu historial de actividades

### 🛡️ **Panel de administración**
- Crea, edita y elimina posts (¡tú mandas!)
- Gestiona categorías
- Controla los usuarios
- Mira estadísticas chulas del blog

---

## 📱 Rutas clave para explorar

| Ruta | Qué hace | ¿Quién puede entrar? |
|------|----------|--------------------|
| `/` | Página principal del blog | Todos |
| `/auth/login` | Iniciar sesión | Todos |
| `/auth/register` | Registro de usuarios | Todos |
| `/user/dashboard` | Tu panel personal | Usuarios |
| `/admin/posts` | Gestionar posts | Admins |
| `/admin/categories` | Gestionar categorías | Admins |

---

## 🎯 ¡Primeros pasos para brillar!

1. **Conviértete en el jefe (admin):**
   - Ve a `/auth/register` y crea una cuenta
   - Asigna el rol de admin en la base de datos
   - Ejecuta el seeder para roles:
     ```bash
     php spark db:seed RoleSeeder
     ```

2. **Crea categorías molonas:**
   - Ve a `/admin/categories`
   - Añade categorías como "Aventuras", "Tech", o "Comida"

3. **Escribe tu primer post épico:**
   - Ve a `/admin/posts`
   - Publica algo que sorprenda al mundo

4. **Personaliza el estilo:**
   - Edita `app/Views/css/input.css`
   - Corre `npm run dev` para ver los cambios en vivo

---

## 🛠️ ¿Problemas? ¡No te preocupes!

### ❌ "No conecta con la base de datos"
```bash
# Asegúrate de que MySQL está activo
sudo systemctl status mysql
# En Windows, revisa XAMPP/WAMP
```

### ❌ "No encuentra 'php spark'"
```bash
# Confirma que estás en la carpeta del proyecto
cd blog
# Verifica que PHP esté bien instalado
php --version
```

### ❌ "npm no funciona"
```bash
# Instala Node.js desde https://nodejs.org
# Comprueba que todo esté OK
node --version
npm --version
```

---

## 📄 Licencia

Este proyecto usa la licencia MIT. Echa un ojo al archivo `LICENSE` para los detalles.

---

<div align="center">

**¡Gracias por elegir este blog! 🎉**  

</div>

---
