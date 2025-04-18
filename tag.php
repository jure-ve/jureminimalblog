<?php get_header(); ?>

<main>
    <div class="container">
        <header class="archive-header">
            <?php
            $current_tag = get_queried_object();
            if ( $current_tag ) :
                ?>
                <h1 class="archive-title">Etiqueta: <?php single_tag_title(); ?></h1>
                <?php if ( $current_tag->description ) : ?>
                    <div class="archive-description"><?php echo wp_kses_post( $current_tag->description ); ?></div>
                <?php endif; ?>
            <?php endif; ?>
        </header>
		<?php if ( have_posts() ) : ?>
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
            <p><?php esc_html_e( 'No hay entradas disponibles con esta etiqueta.', 'mi-blog-minimalista' ); ?></p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>