<?php get_header(); ?>

            <main id="primary" class="site-main">
                <div class="container">
                    <?php if ( have_posts() ) : ?>
						<hr/>
                        <?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'list-post' ); ?>>
							<div class="header">
								<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>                
								<span class="date"><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></span>
							</div>
						</article>
						<hr/>
						<?php endwhile; ?>

                        <?php the_posts_pagination(); ?>

                    <?php else : ?>
                        <p><?php esc_html_e( 'No posts available.', 'jure-minimal-blog' ); ?></p>
                    <?php endif; ?>
                </div>
            </main>

<?php get_footer(); ?>