# Plan de Implementación: Módulo SEO & UX Nativo

**Proyecto**: Jure Minimal Blog

## Objetivo
Proporcionar un conjunto básico, seguro y de bajo impacto de mejoras de SEO, rendimiento y experiencia de usuario directamente en el tema. Estas opciones funcionan como un "plus" opcional y no pretenden reemplazar plugins dedicados.

## Principios de Diseño
1. **Opcionalidad Estricta**: Las funcionalidades vienen **desactivadas por defecto**.
2. **Responsabilidad del Administrador**: Es el usuario quien decide activar estas funciones. No se incluye lógica automática de desactivación ("Kill Switch") para mantener el código lo más ligero y predecible posible.
3. **Internacionalización (I18n)**: Todo el texto visible debe ser traducible.
4. **Cero Impacto**: Si la opción no está marcada, el código no se ejecuta.

---

## Estrategia de Implementación

### Fase 1: Estructura de Archivos
#### [NEW] `inc/seo.php`
Crear la clase `Jure_Minimal_Blog_SEO` (Singleton).
- **Responsabilidades**:
    - Registro de opciones del Customizer.
    - Lógica de activación condicional basada exclusivamente en la opción del usuario.
    - Renderizado de etiquetas y JSON-LD.

#### [MODIFY] `functions.php`
Añadir `require` directo:
```php
require get_template_directory() . '/inc/seo.php';
Jure_Minimal_Blog_SEO::get_instance();
```

---

### Fase 2: Configuración (Customizer) con I18n
Crear sección `jure_minimal_blog_seo_section` en el Customizer. Todas las cadenas deben usar `esc_html__` o `esc_attr__` bajo el dominio `jure-minimal-blog`.

**Controles:**
1.  **Global Switch**: "Enable Basic SEO & UX Enhancements" (Default: False).
2.  **Social**: GitHub & LinkedIn URLs.
3.  **Schema**: "Include Author Bio", "Enable Breadcrumbs Schema".
4.  **Performance**: "Enable Native Lazy Loading", "Enable Scroll to Top", "Noindex Attachment Pages".
5.  **Default Social Image**: Imagen fallback para Open Graph y Twitter Cards (WP_Customize_Image_Control). ✅ *Implementado en v1.4*

---

### Fase 3: Internacionalización (Idiomas)
**Riesgo de Implementación**: Introducir cadenas sin traducir puede degradar la calidad del tema.

**Plan de Acción:**
1.  **Regeneración de POT**: Ejecutar herramientas de i18n para escanear `inc/seo.php`.
2.  **Actualización de Traducciones**: Actualizar `languages/es_ES.po` y recompilar `.mo`.
3.  **Verificación**: Confirmar que los textos del Customizer cambian según el idioma del sitio.

---

### Fase 4: Lógica Frontend
La lógica se ejecuta **únicamente** si el checkbox del Customizer es `true`. No se realizan comprobaciones adicionales de plugins externos para evitar overhead.

#### A. Meta Tags
Generación limpia de `og:title`, `og:description`, etc.

#### B. JSON-LD Schema
Generación de estructuras con `wp_json_encode` para garantizar JSON válido.

#### C. Gestión de Adjuntos
Redirección 301 en `template_redirect` controlada por opción de usuario.

#### D. Imagen OG con Fallback (v1.4)
Cadena de prioridad para `og:image` y `twitter:image`:
1. Imagen personalizada por post (meta box `_jure_og_image`).
2. Featured image del post.
3. Imagen por defecto del Customizer (`jure_minimal_blog_default_og_image`).

**Meta Box**: Panel "Social Media Image" en la sidebar del editor de posts. Usa `wp.media` para seleccionar imagen desde la biblioteca de medios. Protegido con nonce y `current_user_can()`.

**Twitter Card inteligente**: `summary_large_image` cuando hay imagen, `summary` cuando no.

---

## Análisis de Riesgos de Implementación (Cambios en Código)

Este análisis se centra en evitar que los cambios en el código rompan la funcionalidad actual del tema.

| Área de Riesgo | Riesgo Potencial | Estrategia de Mitigación |
| :--- | :--- | :--- |
| **functions.php** | Error de sintaxis o ruta al hacer `require`. Pantalla blanca (WSOD). | Usar `get_template_directory()` robusto. Probar carga en local antes de commit. El archivo incluido debe tener `if ( ! defined( 'ABSPATH' ) ) exit;`. |
| **Estabilidad Frontend** | Inyección de HTML invalido en `wp_head` que rompa el layout o scripts JS. | Validar que todo output esté correctamente escapado (`esc_attr`). Asegurar que JSON-LD esté en un bloque `<script>` válido. |
| **Conflicto de Nombres** | Colisión de nombres de función o clase con otros plugins o Child Themes. | Usar prefijos únicos (`Jure_Minimal_Blog_SEO`) y encapsular en clase. Usar `function_exists` wrappers si fuera necesario exponer funciones globales. |
| **Regresión en Traducciones** | Que la actualización del `.pot` borre traducciones existentes o rompa la carga de idiomas. | Hacer backup de `.po` existentes. Usar herramientas estándar (`wp i18n make-pot`) y verificar "diff" del archivo PO antes de compilar. |
| **Performance (Ineficacia)** | Cargar lógica innecesaria cuando la opción está APAGADA. | Estructurar la clase para que el `add_action( 'wp_head' ... )` solo ocurra DENTRO del condicional `if ( option_active )`. Si está apagado, solo se carga la clase, cero hooks. |

---

## Plan de Verificación (Checklist)

1.  [x] **Verificación de Sintaxis**: Linting completo de los archivos nuevos y modificados.
2.  [x] **Prueba de "Cero Cambios"**: Con el código implementado pero la opción **DESACTIVADA**, el código fuente del sitio debe ser idéntico byte por byte (excepto quizás espacios en blanco) al original.
3.  [x] **Prueba de Activación**: Al activar, verificar que solo se añade lo esperado.
4.  [x] **Validación HTML/JSON**: Pasar el código fuente por validadores para asegurar que no rompimos el `<head>`.
5.  [x] **Revisión de Textos**: Verificar que todas las nuevas opciones aparecen traducidas en español.
6.  [x] **Prueba de OG Image Fallback**: Verificar cadena de prioridad (meta box → featured → default).
7.  [x] **Prueba sin imagen**: Verificar que `twitter:card` cambia a `summary` y no se emite `og:image`.

## Roadmap
- **v1.3**: Módulo SEO base implementado (meta tags, JSON-LD, schema, attachment redirect, scroll-to-top).
- **v1.4** ✅: Imagen OG con fallback (Customizer + Meta Box por post). Fix CSS `<code>` inline. Reactivación de `meta description`.
- **v1.5** (futuro): Detección automática de plugins SEO populares para evitar conflictos. Localización de Google Fonts.
