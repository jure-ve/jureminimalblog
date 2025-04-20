<?php get_header(); ?>

            <main>
                <div class="container">
                    <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <article class="article">
                                <h1 class="article-title"><?php the_title(); ?></h1>
                                <span class="article-date"><?php echo get_the_date(); ?></span>
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'large', array( 'class' => 'article-image' ) ); ?>
                                <?php endif; ?>
                                <div class="article-content">
                                    <?php the_content(); ?>
                                </div>
                                <div class="article-meta">
                                    <?php
                                    $categories = get_the_category_list( ', ' );
                                    if ( $categories ) {
                                        echo '<p class="post-categories">Categorías: ' . $categories . '</p>';
                                    }

                                    $tags = get_the_tag_list( '', ', ' );
                                    if ( $tags ) {
                                        echo '<p class="post-tags">Etiquetas: ' . $tags . '</p>';
                                    }
                                    ?>
                                </div>
                            </article>
                    
                            <nav class="post-navigation">
                                <div class="nav-previous">
                                    <?php previous_post_link( '%link', '%title' ); ?>
                                </div>
                                <div class="nav-next">
                                    <?php next_post_link( '%link', '%title' ); ?>
                                </div>
                            </nav>

                            <?php comments_template(); ?>

                        <?php endwhile; ?>
                    <?php else : ?>
                        <p><?php esc_html_e( 'No se encontró el artículo.', 'mi-blog-minimalista' ); ?></p>
                    <?php endif; ?>
                </div>
            </main>

<?php get_footer(); ?>