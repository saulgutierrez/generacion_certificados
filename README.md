# 🏆 Sistema de Generación de Certificados y Diplomas para Cursos en Línea

## 📘 Descripción general
Este sistema permite la **gestión completa de certificados y diplomas** emitidos a usuarios que completan cursos en línea. Está desarrollado en **PHP**, **MySQL** y **JavaScript**, siguiendo el patrón **MVC**, y tiene como objetivo **automatizar la emisión, personalización y administración de certificados** digitales para instituciones educativas o plataformas de capacitación.

El sistema integra funcionalidades de control de acceso por roles, manejo de usuarios, cursos, instructores y categorías, además de un generador dinámico de certificados en formato imprimible (PDF).

---

## 🧩 Características principales

### 👑 Rol Administrador
- CRUD completo de **usuarios**, **cursos**, **categorías** e **instructores**.
- **Edición de formato de certificados** personalizados.
- **Asignación de certificados** a usuarios por curso.
- **Revocación de certificados** emitidos.
- **Gestión de perfil personal** (datos de identificación, contraseña).
- **Generación de reportes** imprimibles (usuarios, instructores, cursos, certificados emitidos).
- **Control de acceso** (inicio y cierre de sesión seguro).
- **Consulta de certificados de forma externa**

### 👤 Rol Usuario común
- Inicio y cierre de sesión.
- Visualización de **certificados disponibles**.
- Descarga de certificados en formato **PDF** o versión lista para impresión.
- Edición básica del perfil (nombre, correo, contraseña).
- Consulta de certificados de forma externa

---

## 🎯 Objetivos del sistema
- **Automatizar** la generación y administración de certificados.
- **Reducir errores** y tiempos de emisión manual.
- **Garantizar autenticidad** y trazabilidad mediante códigos únicos por certificado.
- **Mejorar la experiencia** tanto del administrador como del usuario final.

---

## ⚙️ Estructura del sistema
El sistema sigue el patrón **Modelo - Vista - Controlador (MVC)**:
- **Modelo:** Manejo de la lógica de negocio y consultas a la base de datos (MySQL).
- **Vista:** Interfaz gráfica en HTML, CSS y JavaScript, haciendo uso del Template Bracket.
- **Controlador:** Comunicación entre vistas y modelos en PHP.

---

## 🧱 Módulos principales
| Módulo | Descripción |
|--------|--------------|
| Gestión de usuarios | CRUD de usuarios, roles, y acceso. |
| Gestión de cursos | Alta, edición y baja de cursos. |
| Gestión de instructores | Registro y edición de instructores. |
| Gestión de categorías | Clasificación de cursos por área o tipo. |
| Certificados | Emisión, personalización y descarga de certificados. |
| Reportes | Exportación de listas (usuarios, instructores, certificados). |

---

## 🧠 Requerimientos funcionales destacados
1. Autenticación y autorización por roles.
2. Emisión de certificados.
3. Personalización de certificados con plantillas editables.
4. Registro y revocación de certificados.
5. Descarga e impresión de certificados.
6. Reportes administrativos imprimibles.
7. Validación de datos de usuario e instructor.
8. Persistencia de registros de emisión y actividad.

---

## 🖥️ Requerimientos técnicos

### 🔧 Software
- **Servidor web:** Apache 2.4+
- **Lenguaje backend:** PHP 8.0+
- **Base de datos:** MySQL 5.7+ o MariaDB equivalente
- **Frontend:** HTML5, CSS3, JavaScript (AJAX, JQuery), Template Bracket
- **Librerías:**
  - DomPDF / TCPDF (para generación de certificados PDF)
  - Bootstrap (para interfaz responsiva)
  - Popper.js
  - DataTables.js
  - FontAwesome
  - IonicIcons
  - perfect-scrollbar
  
### 💻 Hardware (mínimo)
- CPU: 2 núcleos
- RAM: 4 GB
- Espacio en disco: 100 MB
- Navegador: Chrome, Firefox, Edge (últimas versiones)

---

## ⚡ Instalación y configuración

1. **Clona el repositorio:**
   ```bash
   git clone https://github.com/saulgutierrez/generacion_certificados.git
2. **Copia el proyecto en tu servidor local o hosting**
    ```bash
   C:\xampp\htdocs\generacion-certificados
3. **Importa la base de datos**
- Abre phpMyAdmin
- Crea una base de datos, llamada diplomas_certificados
- Importa el archivo SQL que se encuentra en:
   ```bash
   /docs/diplomas_certificados.sql
4. **Configura la conexión a base de datos:**
- Edita el archivo:
   ```bash
   /config/conexion.php
- Y ajusta tus credenciales:
  ```bash
  new PDO("mysql:local=localhost;dbname=diplomas_certificados","root","");
5. Incie el servicio Apache y MySQL
6. Inicie sesión como administrador:
   - Usuario: admin@admin.com
   - Contraseña: admin
---

## 🧑‍💻 Roles de usuario
| Rol | Permisos principales |
|--------|--------------|
| Administrador | CRUDs completos, emisión y revocación de certificados, edición de plantillas y reportes. |
| Usuario común | Visualización y descarga de certificados, edición de perfil |
---

## 📊 Diagrama general del sistema
Administrador ─┬─> Gestionar usuarios <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├─> Gestionar cursos <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├─> Gestionar instructores <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├─> Emitir certificados <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├─> Editar plantillas <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└─> Generar reportes <br>
Usuario ───────> Ver y descargar certificados
--

## 🔒 Seguridad
- Validación de sesión en todas las páginas protegidas.
- Filtrado de entrada de datos (evitando inyección SQL).
- Roles y permisos controlados desde base de datos.
