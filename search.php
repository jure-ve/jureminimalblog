<?php get_header(); ?>

            <main id="primary" class="site-main">
                <div class="container">
                    <header class="archive-header">
                        <?php if ( have_posts() ) : ?>
                            <h1 class="archive-title">
                                <?php
                                /* translators: %s: search query */
                                printf( esc_html__( 'Search results for: %s', 'jure-minimal-blog' ), '<span>' . get_search_query() . '</span>' );
                                ?>
                            </h1>
                        <?php endif; ?>
                    </header>

                    <?php if ( have_posts() ) : ?>
                        <hr/>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class( 'list-post' ); ?>>
                                <div class="header">
                                    <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>                
                                    <span class="date"><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></span>
                                </div>
                                <div class="content">
                                    <?php the_excerpt(); ?>
                                    <p><a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e( 'Read more', 'jure-minimal-blog' ); ?></a></p>
                                </div>
                            </article>
                            <hr/>
                        <?php endwhile; ?>

                        <?php the_posts_pagination(); ?>

                    <?php else : ?>
                        <div class="search-no-results">
                            <p><?php esc_html_e( 'No results found.', 'jure-minimal-blog' ); ?></p>
                            <p><?php esc_html_e( 'Try searching with different keywords.', 'jure-minimal-blog' ); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </main>

<?php get_footer(); ?>
