<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Jure_Minimal_Blog
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( '404', 'jure-minimal-blog' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'Oops! That page can&rsquo;t be found. It looks like nothing was found at this location. Maybe try a search?', 'jure-minimal-blog' ); ?></p>
					
					<div class="error-404-search">
						<?php get_search_form(); ?>
					</div>

					<div class="back-to-home">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Homepage', 'jure-minimal-blog' ); ?></a>
					</div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</div>
	</main><!-- #main -->

<?php
get_footer();
