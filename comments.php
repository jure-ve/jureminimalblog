<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jure_Minimal_Blog
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<style>
.comment-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.comment {
    background-color: var(--comment-bg);
    color: var(--text-color);
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Modern Comment Layout */
.comment-body {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    align-items: flex-start;
    position: relative;
    padding-bottom: 10px;
}

.comment-meta {
    display: flex;
    align-items: center;
    gap: 15px;
    width: 100%;
    margin-bottom: 15px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    /* Subtle separator */
    padding-bottom: 15px;
}

.comment-author {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 1.1rem;
    font-weight: 600;
}

.comment-author img.avatar {
    border-radius: 50%;
    /* Circular avatars */
    width: 40px;
    height: 40px;
    object-fit: cover;
    border: 2px solid var(--accent-color);
    /* Theme adjustment */
}

/* Metadata (Date/Edit) alignment */
.comment-metadata {
    margin-left: auto;
    /* Push to right */
    font-size: 0.85rem;
    color: var(--muted-text);
}

.comment-metadata a {
    color: var(--muted-text);
    text-decoration: none;
}

.comment-metadata a:hover {
    color: var(--accent-color);
}

.comment-content {
    width: 100%;
    font-size: 1rem;
    line-height: 1.7;
    padding-left: 5px;
    /* Slight offset */
}

.comment a {
    color: var(--accent-color);
    text-decoration: underline;
}

.comment a:hover {
    color: #6a9cbf;
}

.comment-respond {
    background-color: #383838;
    padding: 20px;
    margin: 20px 0;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.comment-respond label {
    color: var(--muted-text);
    font-size: 14px;
    margin-bottom: 5px;
    display: block;
}

.comment-respond input[type="text"],
.comment-respond input[type="email"],
.comment-respond input[type="url"],
.comment-respond textarea {
    background-color: var(--primary-color);
    color: var(--text-color);
    border: 1px solid var(--secondary-color);
    padding: 13px;
    width: 100%;
    box-sizing: border-box;
    border-radius: 3px;
    font-size: 16px;
}

.comment-respond input[type="text"]:focus,
.comment-respond input[type="email"]:focus,
.comment-respond input[type="url"]:focus,
.comment-respond textarea:focus {
    border-color: var(--accent-color);
    outline: none;
}

.comment-respond .form-submit input[type="submit"] {
    background-color: var(--accent-color);
    color: #1a1a1a;
    border: 1px solid var(--secondary-color);
    padding: 13px 25px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 3px;
}

.comment-respond .form-submit input[type="submit"]:hover {
    background-color: #6a9cbf;
}

.comment-respond p {
    margin-bottom: 15px;
}

.comment-form-cookies-consent {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.comment-form-cookies-consent input {
    width: 20px;
    height: 20px;
    flex-shrink: 0;
    margin-top: 2px;
}

.comment-form-cookies-consent label {
    display: inline;
    margin: 0;
    line-height: 1.4;
}
</style>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$jure_minimal_blog_comment_count = get_comments_number();
			if ( '1' === $jure_minimal_blog_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'jure-minimal-blog' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $jure_minimal_blog_comment_count, 'comments title', 'jure-minimal-blog' ) ),
					number_format_i18n( $jure_minimal_blog_comment_count ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'jure-minimal-blog' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form();
	?>

</div><!-- #comments -->
