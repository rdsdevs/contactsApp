<!-- @format -->

# 🚀 ContactsApp

ContactsApp es una aplicación WEB que permite gestionar los contactos de un usuario.

## 📋 Tabla de Contenidos

1. [Descripción](#descripción)
2. [Instrucciones de Instalación](#instrucciones-de-instalación)
3. [Guía de Uso](#guía-de-uso)
4. [Contribución](#contribución)
5. [Licencia](#licencia)
6. [Estructura de carpetas del proyecto](#estructura-de-carpetas-del-proyecto)

## 📝 Descripción

ContactsApp permite gestionar los contactos de un usuario, con ContactsApp podras (listar, agregar, editar y eliminar contactos).

## 💻 Instrucciones de Instalación

A continuación, se detallan los pasos necesarios para instalar y configurar el proyecto en un entorno de desarrollo local.

1. Abre una terminal 👨🏿‍💻 y ubicate dentro de la carpeta raíz de tu servidor local (**www** para laragon o **htdocs** para xampp).
2. Luego ejecuta el comando `git clone https://github.com/ltoncelDev/contactsApp.git`, para clonar el repositorio.
3. Ubica la carpeta **db** y ejecuta el script de creación de la base de datos que esta dentro del archivo **db.sql**.
4. Abre :earth_americas: tu navagador de preferencia y en la barra de navegación escribe: **localhost** o **127.0.0.1**.
5. Ubica en el listado de directorios uno con el nombre del proyecto **contactsApp**.

## 📘 Guía de Uso

Al iniciar la aplicación debes registrarte para tener acceso a la gestión de contactos la cual permite (listar, agregar, editar y eliminar contactos).

## 🤝 Contribución

¡Gracias por considerar contribuir a ContactsApp! Aquí hay algunas pautas para comenzar:

1. Forkea el repositorio y clónalo localmente.
2. Crea una nueva rama para tu contribución.
3. Realiza tus cambios y asegúrate de que el código funcione correctamente.
4. Haz commit de tus cambios y envía un pull request.
5. Espera la revisión y feedback del mantenedor del proyecto.
6. Una vez aprobado, tus cambios serán fusionados en la rama principal.

¡Gracias de nuevo por estar interesad@ en contribuir a ContactsApp!

## 📄 Licencia

Licencia Pública General de GNU (GPL)
Versión 3, 29 de junio de 2007
Puede ver más información en el archivo **LICENSE**.

---

## 📂 Estructura de carpetas del proyecto

1. "**.vscode**": En esta carpeta se encuentra el archivo **settings.json** el cual contiene la configuración del IDE (Entorno de Desarrollo Integrado) y el archivo **extension.json** que contiene expensiones recomendadas para trabajar con PHP en **visual studio code**.

2. "**db**": Contiene el script de creación de la base de datos del proyecto.
   Archivos contenidos:
   **db.sql**

3. "**partials**": Esta carpeta contiene archivos con fragmentos de código HTML que se incluyen en todas las páginas.
   Archivos contenidos:
   **footer.php**
   **header.php**
   **navbar.php**

4. "**static**": La carpeta static, contiene archivos estáticos, como archivos de estilo CSS, scripts JavaScript JS, imágenes, fuentes y otros recursos que no requieren procesamiento del servidor antes de ser entregados al cliente.
   Archivos contenidos:
   **/css/index.css**
   **/img/background.jpg**
   **/img/logo.png**
   **/js/welcome.js**

## QUE hace el archivo /js/welcome.js

1. Selecciona elementos del DOM (Documento de Objetos del Modelo) usando el método `document.querySelector` para obtener referencias a los elementos HTML con las clases .navbar y .welcome, así como al elemento con el ID #navbarNav.

2. Define una función llamada **resizeBackgroundImg** que calcula la altura disponible para la imagen de fondo dentro del elemento con la clase **.welcome**.
   Esto se hace restando la altura del elemento **.navbar** al alto de la ventana (`window.innerHeight`).
   Luego, actualiza la altura del elemento **.welcome** con el valor calculado.

3. Asigna la función **resizeBackgroundImg** a varios eventos. Cuando estos eventos ocurren, la función se ejecutará para ajustar la altura de la imagen de fondo según sea necesario.
   Los eventos incluyen:
   A. **ontransitionend** y **ontransitionstart** del elemento **navbarToggle**: Estos eventos se activan cuando se completa o comienza una transición en el elemento **navbarToggle**.
   La transición esta relacionada con el comportamiento de cambio de la barra de navegación.

   B. **onresize** de la ventana (**window**): Este evento se activa cada vez que se redimensiona la ventana del navegador.

   C. **onload** de la ventana (**window**): Este evento se activa una vez que se ha cargado completamente el contenido de la ventana del navegador.

El código se encarga de ajustar dinámicamente la altura de la imagen de fondo de un elemento con la clase **.welcome** según el tamaño de la ventana del navegador y el comportamiento de transición de la barra de navegación, asegurando que la imagen se vea correctamente en diferentes tamaños de pantalla y durante las transiciones de la barra de navegación.
