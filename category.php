<?php get_header(); ?>

            <main>
                <div class="container">
                    <header class="archive-header">
                        <?php
                        $current_category = get_queried_object();
                        if ( $current_category ) :
                            ?>
                            <h1 class="archive-title"><?php single_cat_title(); ?></h1>
                            <?php if ( $current_category->description ) : ?>
                                <div class="archive-description"><?php echo wp_kses_post( $current_category->description ); ?></div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </header><?php if ( have_posts() ) : ?>

                        <?php while ( have_posts() ) : the_post(); ?>
                        <article class="list-post">
                            <div class="header">
                                <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>                
                                <span class="date"><?php echo get_the_date(); ?></span>
                            </div>        
                            <div class="content">
                                <?php the_excerpt(); ?>
                                <p><a href="<?php the_permalink(); ?>" class="read-more">Leer más</a></p>
                            </div>
                        </article>
                        <hr/>
                        <?php endwhile; ?>
                        <?php the_posts_pagination(); ?>
                    <?php else : ?>
                        <p><?php esc_html_e( 'No hay entradas disponibles en esta categoría.', 'mi-blog-minimalista' ); ?></p>
                    <?php endif; ?>
                </div>
            </main>

<?php get_footer(); ?>