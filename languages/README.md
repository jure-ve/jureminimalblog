# Jure Minimal Blog Theme - Translation Files

This directory contains translation files for the Jure Minimal Blog WordPress theme.

## Available Languages

- **English** (Default): Built into the theme code
- **Spanish (es_ES)**: Full translation available

## Files Structure

- `jure-minimal-blog.pot` - Translation template (all translatable strings)
- `es_ES.po` - Spanish translation (human-readable)
- `es_ES.mo` - Spanish translation (compiled, used by WordPress)

## How to Add a New Translation

### Option 1: Using Poedit (Recommended for non-developers)

1. Download and install [Poedit](https://poedit.net/)
2. Open the `jure-minimal-blog.pot` file in Poedit
3. Create a new translation and select your language
4. Translate all strings
5. Save the file (it will automatically create both `.po` and `.mo` files)
6. Name the files using the WordPress locale format (e.g., `fr_FR.po` for French)

### Option 2: Using WP-CLI (For developers)

```bash
# From the theme directory
wp i18n make-po languages/jure-minimal-blog.pot languages/fr_FR.po
# Edit the .po file with your translations
wp i18n make-mo languages/
```

### Option 3: Using Loco Translate Plugin

1. Install the Loco Translate plugin in WordPress
2. Go to `Loco Translate > Themes > Jure Minimal Blog`
3. Click "New language" and select your language
4. Translate strings in the web interface
5. Save and sync

## Text Domain

The theme uses the text domain: `jure-minimal-blog`

## Testing Your Translation

1. Go to WordPress Admin > Settings > General
2. Change "Site Language" to your target language
3. Visit your site to see the translation in action

## Contributing Translations

If you've created a translation for this theme, please consider contributing it back:

1. Fork the repository at https://github.com/jure-ve/jureminimalblog
2. Add your `.po` and `.mo` files to the `/languages` directory
3. Submit a pull request

## Need Help?

For support with translations, please visit:
- Theme Support: https://wordpress.org/support/theme/jureminimalblog
- Author Website: https://juredev.com

---

**Note**: After updating theme code, remember to regenerate the `.pot` file:
```bash
wp i18n make-pot . languages/jure-minimal-blog.pot --domain=jure-minimal-blog
```
