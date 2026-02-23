<?php get_header(); ?>

            <main id="primary" class="site-main">
                <div class="container">
                    <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class( 'article' ); ?>>
                                <h1 class="article-title"><?php the_title(); ?></h1>
                                <span class="article-date"><?php echo esc_html( get_the_date() ); ?></span>
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
                                        /* translators: %s: list of categories */
                                        printf( '<p class="post-categories">' . esc_html__( 'Categories: %s', 'jure-minimal-blog' ) . '</p>', wp_kses_post( $categories ) ); // WPCS: XSS OK.
                                    }

                                    $tags = get_the_tag_list( '', ', ' );
                                    if ( $tags ) {
                                        /* translators: %s: list of tags */
                                        printf( '<p class="post-tags">' . esc_html__( 'Tags: %s', 'jure-minimal-blog' ) . '</p>', wp_kses_post( $tags ) ); // WPCS: XSS OK.
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

                            <?php
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                            ?>

                        <?php endwhile; ?>
                    <?php else : ?>
                        <p><?php esc_html_e( 'Article not found.', 'jure-minimal-blog' ); ?></p>
                    <?php endif; ?>
                </div>
            </main>

<?php get_footer(); ?>