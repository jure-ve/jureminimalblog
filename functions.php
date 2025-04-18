<?php
# functions.php

function jure_minimal_blog_setup() {
    register_nav_menus(
        array(
            'primary-menu' => esc_html__( 'Menú Principal', 'jure-minimal-blog' ),
        )
    );
}
add_action( 'after_setup_theme', 'jure_minimal_blog_setup' );

// Función de fallback para el menú principal
function jure_minimal_blog_fallback_menu() {
    echo '<ul id="primary-menu" class="menu">';
    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Inicio', 'jure-minimal-blog' ) . '</a></li>';
    echo '</ul>';
}
?>