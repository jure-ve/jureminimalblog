# Jure Minimal Blog

Un tema de WordPress que va directo al grano: **tu contenido es lo más importante**.

Creado para bloggers que valoran la simplicidad, la velocidad y un diseño que no distrae. Sin trucos, sin efectos innecesarios, solo tu escritura brillando como debe ser.

## ¿Por qué este tema?

Porque no todos los blogs necesitan 47 sliders, 3 sidebars y un reproductor de música de fondo. A veces solo necesitas:

- 📝 **Texto legible** - Tipografía cuidada que no cansa la vista
- ⚡ **Carga rápida** - Sin scripts pesados ni frameworks innecesarios  
- 🌍 **Multilingüe** - Disponible en inglés y español (y el idioma que quieras añadir)
- ♿ **Accesible** - Funciona con lectores de pantalla y navegación por teclado
- 🎨 **Personalizable** - Variables CSS para cambiar colores sin tocar el código
- 🔒 **Seguro** - Código limpio que sigue las mejores prácticas de WordPress

## Instalación (3 pasos, así de simple)

1. Descarga el tema y súbelo a `/wp-content/themes/`
2. Actívalo desde **Apariencia → Temas** en tu WordPress
3. ¡Listo! Ya puedes empezar a escribir

**Extra**: Configura tu menú en **Apariencia → Menús** si quieres personalizar la navegación.

## Idiomas disponibles

El tema habla inglés por defecto, pero incluye traducción completa al **español**. 

¿Necesitas otro idioma? Revisa la carpeta `/languages` donde encontrarás instrucciones para añadir el tuyo. Es más fácil de lo que piensas.

## Personalización sin complicarte la vida

Abre `style.css` y busca las variables al inicio. Cambia los colores a tu gusto:

```css
:root {
    --primary-color: #2a2a2a;    /* Color de fondo principal */
    --accent-color: #5a829b;      /* Color de enlaces */
    --text-color: #e8e8e8;        /* Color del texto */
    /* ... hay más, pero estas son las importantes */
}
```

Guarda, refresca tu navegador, y voilà.

## Lo que hay dentro

```
jureminimalblog/
├── style.css          → Aquí están tus estilos y las variables
├── functions.php      → La magia de WordPress
├── header.php         → Cabecera del sitio
├── footer.php         → Pie de página
├── index.php          → Lista de posts
├── single.php         → Vista individual de cada post
├── category.php       → Archivo de categorías
├── tag.php            → Archivo de etiquetas
├── inc/seo.php        → Módulo SEO & UX opcional
├── assets/            → Scripts del tema
└── languages/         → Traducciones (¡aporta la tuya!)
```

## Características técnicas (para los curiosos)

- ✅ HTML5 semántico
- ✅ Módulo SEO opcional (Open Graph, Twitter Cards, JSON-LD Schema)
- ✅ Imagen social configurable por post o global (sin plugins externos)
- ✅ Imágenes destacadas listas para usar
- ✅ Escapado de datos riguroso (seguridad primero)
- ✅ Compatible con WordPress.org
- ✅ Comentarios incluidos (pero puedes desactivarlos si prefieres)
- ✅ Responsive design (se ve bien en móviles, tablets, lo que sea)

## Versión actual: 1.4

**Novedades en esta versión**:
- 🖼️ **Imagen social por post**: Meta box "Social Media Image" en el editor para configurar `og:image` y `twitter:image` por artículo.
- 🌐 **Imagen social por defecto**: Nuevo campo en el Customizer para definir una imagen fallback global.
- 🔄 **Fallback inteligente de imagen OG**: Prioridad: imagen por post → featured image → imagen por defecto.
- 🃏 **Twitter Card adaptativo**: Usa `summary_large_image` cuando hay imagen, `summary` cuando no.
- 🐛 **Fix CSS `<code>` inline**: Los bloques de código inline ya no rompen el flujo del texto.
- 🔧 Reactivación de `meta description` en el módulo SEO.

## Historial de versiones

### Versión 1.3
- ✨ Nueva página 404 personalizada con buscador integrado.
- 🖼️ Agregado screenshot del tema para previsualización.
- 🔍 Mejoras SEO: Optimización de títulos en resultados de búsqueda.
- 🐛 Corrección visual: Descripción del blog ahora visible en resultados.
- 🌍 Actualización de traducciones.

### Versión 1.2
- 🌍 Soporte multilingüe completo (inglés/español)
- 🔄 Código fuente en inglés (estándar WordPress)
- 📚 Documentación mejorada para traductores
- ✨ Mejoras de accesibilidad

## ¿Encontraste un bug? ¿Tienes ideas?

Abre un issue en el repositorio o escríbeme directamente. Siempre estoy buscando formas de mejorar este tema sin perder su esencia minimalista.

## Licencia

GPL v2 o posterior. Úsalo, modifícalo, compártelo. Es libre.

## Hecho con ☕ por

**Jure** - [juredev.com](https://juredev.com)

---

*"Menos es más" no es solo un cliché, es una filosofía de diseño.*

