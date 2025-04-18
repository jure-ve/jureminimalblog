<?php get_header(); ?>

            <main>
                <div class="container">
                    <?php if ( have_posts() ) : ?>
						<hr/>
                        <?php while ( have_posts() ) : the_post(); ?>
						<article class="list-post">
							<div class="header">
								<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>                
								<span class="date"><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></span>
							</div>
						</article>
						<hr/>
						<?php endwhile; ?>

                        <?php the_posts_pagination(); ?>

                    <?php else : ?>
                        <p><?php esc_html_e( 'No hay entradas disponibles.', 'mi-blog-minimalista' ); ?></p>
                    <?php endif; ?>
                </div>
            </main>

<?php get_footer(); ?>