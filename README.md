# Jure Minimal Blog Theme

Este es un tema minimalista para WordPress, basado en un template HTML y CSS personalizado.

## Descripción

Jure Minimal Blog es un tema de WordPress limpio y minimalista diseñado para enfocarse en el contenido. Cuenta con una estética sencilla, optimizada para la legibilidad y una navegación clara.

## Características

* Diseño minimalista y responsivo.
* Basado en CSS personalizado con variables para facilitar la personalización.
* Estructura de tema tradicional de WordPress (`header.php`, `index.php`, `single.php`, `footer.php`, etc.).
* Menú de navegación dinámico configurable desde el administrador de WordPress.
* Template específico para entradas individuales (`single.php`) mostrando contenido completo, categorías, etiquetas y comentarios.
* Templates específicos para archivos de categorías (`category.php`) y etiquetas (`tag.php`) con un diseño diferente al de la página principal.
* Estilos personalizados para la sección de comentarios y el formulario de comentarios.

## Instalación

1.  Descarga los archivos del tema.
2.  Sube la carpeta `jureminimalblog` al directorio `/wp-content/themes/` de tu instalación de WordPress.
3.  Ve a **Apariencia > Temas** en tu panel de administración de WordPress.
4.  Encuentra el tema "Jure Minimal Blog" en la lista de temas disponibles y haz clic en "Activar".
5.  (Opcional) Configura tu menú de navegación en **Apariencia > Menús** y asigna un menú a la ubicación "Menú Principal".

## Estructura del Tema

```
jureminimalblog/
├── style.css           (Hoja de estilos principal con información del tema)
├── index.php           (Plantilla para la página principal/archivo de posts)
├── single.php          (Plantilla para entradas individuales)
├── category.php        (Plantilla para archivos de categorías)
├── tag.php             (Plantilla para archivos de etiquetas)
├── header.php          (Plantilla para el encabezado del sitio)
├── footer.php          (Plantilla para el pie de página del sitio)
├── functions.php       (Funciones y configuraciones del tema, como registro de menús)
└── screenshot.png      (Captura de pantalla del tema - recomendado añadir una)
```

## Personalización

Puedes personalizar el tema editando el archivo `style.css` para ajustar colores, tipografías, espaciado, etc. El tema utiliza variables CSS definidas en `:root` para facilitar la modificación de los colores principales.

## Licencia

Este tema está bajo la Licencia Pública General GNU v2 o posterior. Consulta `http://www.gnu.org/licenses/gpl-2.0.html` para más detalles.

## Autor

Jure

## Contribuciones

Las contribuciones son bienvenidas. Si encuentras algún error o tienes sugerencias, por favor, abre un 'issue' o envía un 'pull request' en el repositorio.
