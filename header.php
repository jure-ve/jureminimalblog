<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'jure-minimal-blog' ); ?></a>

    <div class="container">
        <header>
            <nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary-menu',
					'menu_id'        => 'primary-menu',
					'fallback_cb'    => 'jure_minimal_blog_fallback_menu',
				) );
				?>
			</nav>
			
			<!-- Search Toggle Button -->
			<button class="search-toggle" aria-label="<?php esc_attr_e( 'Toggle search', 'jure-minimal-blog' ); ?>" aria-expanded="false">
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
					<circle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="2"/>
					<path d="M12.5 12.5L17 17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
				</svg>
			</button>
			
			<!-- Search Form (hidden by default) -->
			<div class="header-search-form">
				<?php get_search_form(); ?>
			</div>
			
			<?php if ( is_home() || is_front_page() ) : ?>
				<h1 class="site-description"><?php bloginfo( 'description' ); ?></h1>
			<?php endif; ?>
        </header>