<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(''); ?></title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="container">
        <header>
            <nav>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary-menu',
					'menu_id'        => 'primary-menu',
					'fallback_cb'    => 'jure_minimal_blog_fallback_menu', // Agregamos esta línea
				) );
				?>
			</nav>
			<?php if ( is_home() || is_front_page() ) : ?><h1 class="site-description"><?php bloginfo( 'description' ); ?></h1><?php endif; ?>
        </header>