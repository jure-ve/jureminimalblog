<?php
/**
 * Basic SEO and UX features for Jure Minimal Blog.
 *
 * @package Jure_Minimal_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Jure_Minimal_Blog_SEO' ) ) :

	/**
	 * Class Jure_Minimal_Blog_SEO
	 */
	class Jure_Minimal_Blog_SEO {


		/**
		 * Instance
		 *
		 * @var Jure_Minimal_Blog_SEO
		 */
		private static $instance = null;

		/**
		 * Get instance
		 */
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		private function __construct() {
			add_action( 'customize_register', array( $this, 'register_controls' ) );

			add_action( 'wp', array( $this, 'maybe_boot_frontend' ) );

			add_action( 'add_meta_boxes', array( $this, 'add_og_image_meta_box' ) );
			add_action( 'save_post', array( $this, 'save_og_image_meta_box' ) );
		}

		/**
		 * Register Customizer Controls
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function register_controls( $wp_customize ) {
			$wp_customize->add_section(
				'jure_minimal_blog_seo_section',
				array(
					'title'    => esc_html__( 'Basic SEO & Performance', 'jure-minimal-blog' ),
					'priority' => 120,
				)
			);

			$wp_customize->add_setting(
				'jure_minimal_blog_enable_seo',
				array(
					'default'           => false,
					'sanitize_callback' => 'absint',
				)
			);
			$wp_customize->add_control(
				'jure_minimal_blog_enable_seo',
				array(
					'label'       => esc_html__( 'Enable Basic SEO & UX Enhancements', 'jure-minimal-blog' ),
					'description' => esc_html__( 'Adds lightweight SEO, performance, and UX enhancements for simple blogs. Disable if you use a full SEO plugin.', 'jure-minimal-blog' ),
					'section'     => 'jure_minimal_blog_seo_section',
					'type'        => 'checkbox',
				)
			);

			$wp_customize->add_setting(
				'jure_minimal_blog_social_github',
				array(
					'default'           => '',
					'sanitize_callback' => 'esc_url_raw',
				)
			);
			$wp_customize->add_control(
				'jure_minimal_blog_social_github',
				array(
					'label'   => esc_html__( 'GitHub URL', 'jure-minimal-blog' ),
					'section' => 'jure_minimal_blog_seo_section',
					'type'    => 'url',
				)
			);

			$wp_customize->add_setting(
				'jure_minimal_blog_social_linkedin',
				array(
					'default'           => '',
					'sanitize_callback' => 'esc_url_raw',
				)
			);
			$wp_customize->add_control(
				'jure_minimal_blog_social_linkedin',
				array(
					'label'   => esc_html__( 'LinkedIn URL', 'jure-minimal-blog' ),
					'section' => 'jure_minimal_blog_seo_section',
					'type'    => 'url',
				)
			);

			$wp_customize->add_setting(
				'jure_minimal_blog_enable_author_bio',
				array(
					'default'           => false,
					'sanitize_callback' => 'absint',
				)
			);
			$wp_customize->add_control(
				'jure_minimal_blog_enable_author_bio',
				array(
					'label'       => esc_html__( 'Include Author Bio in Schema', 'jure-minimal-blog' ),
					'section'     => 'jure_minimal_blog_seo_section',
					'type'        => 'checkbox',
				)
			);

			$wp_customize->add_setting(
				'jure_minimal_blog_enable_breadcrumbs_schema',
				array(
					'default'           => false,
					'sanitize_callback' => 'absint',
				)
			);
			$wp_customize->add_control(
				'jure_minimal_blog_enable_breadcrumbs_schema',
				array(
					'label'       => esc_html__( 'Enable Breadcrumbs Schema', 'jure-minimal-blog' ),
					'description' => esc_html__( 'Generates BreadcrumbList schema for single posts using the primary category.', 'jure-minimal-blog' ),
					'section'     => 'jure_minimal_blog_seo_section',
					'type'        => 'checkbox',
				)
			);

			$wp_customize->add_setting(
				'jure_minimal_blog_native_lazy_load',
				array(
					'default'           => true,
					'sanitize_callback' => 'absint',
				)
			);
			$wp_customize->add_control(
				'jure_minimal_blog_native_lazy_load',
				array(
					'label'       => esc_html__( 'Enable Native Lazy Loading', 'jure-minimal-blog' ),
					'section'     => 'jure_minimal_blog_seo_section',
					'type'        => 'checkbox',
				)
			);

			$wp_customize->add_setting(
				'jure_minimal_blog_enable_preconnect',
				array(
					'default'           => false,
					'sanitize_callback' => 'absint',
				)
			);
			$wp_customize->add_control(
				'jure_minimal_blog_enable_preconnect',
				array(
					'label'       => esc_html__( 'Preconnect to Google Fonts/CDN', 'jure-minimal-blog' ),
					'section'     => 'jure_minimal_blog_seo_section',
					'type'        => 'checkbox',
				)
			);

			$wp_customize->add_setting(
				'jure_minimal_blog_enable_scroll_top',
				array(
					'default'           => false,
					'sanitize_callback' => 'absint',
				)
			);
			$wp_customize->add_control(
				'jure_minimal_blog_enable_scroll_top',
				array(
					'label'       => esc_html__( 'Enable Scroll to Top Button', 'jure-minimal-blog' ),
					'section'     => 'jure_minimal_blog_seo_section',
					'type'        => 'checkbox',
				)
			);

			$wp_customize->add_setting(
				'jure_minimal_blog_noindex_attachments',
				array(
					'default'           => false,
					'sanitize_callback' => 'absint',
				)
			);
			$wp_customize->add_control(
				'jure_minimal_blog_noindex_attachments',
				array(
					'label'       => esc_html__( 'Noindex & Redirect Attachment Pages', 'jure-minimal-blog' ),
					'description' => esc_html__( 'Redirects attachment pages to their parent post.', 'jure-minimal-blog' ),
					'section'     => 'jure_minimal_blog_seo_section',
					'type'        => 'checkbox',
				)
			);

			$wp_customize->add_setting(
				'jure_minimal_blog_default_og_image',
				array(
					'default'           => '',
					'sanitize_callback' => 'esc_url_raw',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'jure_minimal_blog_default_og_image',
					array(
						'label'       => esc_html__( 'Default Social Image', 'jure-minimal-blog' ),
						'description' => esc_html__( 'Fallback image for Open Graph and Twitter Cards when a post has no custom or featured image. Recommended: 1200x630px.', 'jure-minimal-blog' ),
						'section'     => 'jure_minimal_blog_seo_section',
					)
				)
			);
		}

		/**
		 * Decide whether to register frontend hooks.
		 */
		public function maybe_boot_frontend() {
			if ( is_admin() ) {
				return;
			}

			$enabled = get_theme_mod( 'jure_minimal_blog_enable_seo', false );

			$enabled = apply_filters( 'jure_minimal_blog_enable_seo_frontend', $enabled );

			if ( (bool) $enabled ) {
				$this->add_frontend_hooks();
			}
		}

		/**
		 * Add all frontend hooks.
		 * Only called if module is enabled.
		 */
		private function add_frontend_hooks() {
			add_action( 'wp_head', array( $this, 'output_meta_tags' ), 1 );
			add_action( 'wp_head', array( $this, 'output_schema' ), 5 );
			add_filter( 'wp_robots', array( $this, 'check_robots' ) );
			add_action( 'wp_head', array( $this, 'resource_hints' ), 2 );
			add_action( 'wp_footer', array( $this, 'scroll_to_top_display' ) );
			add_action( 'template_redirect', array( $this, 'attachment_redirect' ) );
			add_filter( 'wp_lazy_loading_enabled', array( $this, 'control_lazy_load' ) );
			
			// Remove default WordPress canonical to avoid duplicates
			remove_action( 'wp_head', 'rel_canonical' );
		}

		/**
		 * Output Meta Tags
		 */
		public function output_meta_tags() {

			// Strictly restrict to main query to avoid "shop_order_placehold" and other secondary loop issues
			if ( ! is_main_query() ) {
				return;
			}

			// Check if we are on a valid post type to avoid "shop_order_placehold" notices
			if ( is_singular() && ! $this->is_valid_public_single() ) {
				return;
			}

			$title = wp_get_document_title();
			$url   = $this->get_canonical_url();
			$desc  = get_bloginfo( 'description' );

			if ( is_singular() && has_excerpt() ) {
				$desc = wp_strip_all_tags( get_the_excerpt() );
			} elseif ( is_singular() ) {
				$post = get_post();
				if ( $post ) {
					$text = wp_strip_all_tags( $post->post_content );
					$desc = wp_trim_words( $text, 25 );
				}
			} elseif ( is_category() || is_tag() || is_archive() ) {
				$desc = wp_strip_all_tags( get_the_archive_description() );
				if ( empty( $desc ) ) {
					$desc = get_bloginfo( 'description' );
				}
			}

			// Handle pagination in description
			$paged = max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );
			if ( $paged > 1 ) {
				$desc .= sprintf( ' - %s %d', esc_html__( 'Page', 'jure-minimal-blog' ), $paged );
			}

			$site_name = get_bloginfo( 'name' );

			// Canonical
			echo '<link rel="canonical" href="' . esc_url( $url ) . '" />' . "\n";

			// Basic Meta
			echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";

			// Open Graph
			echo '<meta property="og:title" content="' . esc_attr( $title ) . '" />' . "\n";
			echo '<meta property="og:description" content="' . esc_attr( $desc ) . '" />' . "\n";
			echo '<meta property="og:url" content="' . esc_url( $url ) . '" />' . "\n";
			echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '" />' . "\n";
			echo '<meta property="og:type" content="' . ( is_single() ? 'article' : 'website' ) . '" />' . "\n";
			echo '<meta property="og:locale" content="' . esc_attr( get_locale() ) . '" />' . "\n";

			$img = '';
			if ( is_singular() ) {
				$custom_og = get_post_meta( get_the_ID(), '_jure_og_image', true );
				if ( ! empty( $custom_og ) ) {
					$img = $custom_og;
				} elseif ( has_post_thumbnail() ) {
					$img = get_the_post_thumbnail_url( null, 'large' );
				}
			}
			if ( empty( $img ) ) {
				$img = get_theme_mod( 'jure_minimal_blog_default_og_image', '' );
			}
			if ( ! empty( $img ) ) {
				echo '<meta property="og:image" content="' . esc_url( $img ) . '" />' . "\n";
			}

			echo '<meta name="twitter:card" content="' . ( ! empty( $img ) ? 'summary_large_image' : 'summary' ) . '" />' . "\n";
			echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '" />' . "\n";
			echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '" />' . "\n";
			if ( ! empty( $img ) ) {
				echo '<meta name="twitter:image" content="' . esc_url( $img ) . '" />' . "\n";
			}
		}

		/**
		 * JSON-LD Schema
		 */
		public function output_schema() {
			
			if ( ! is_main_query() ) {
				return;
			}

			if ( ! $this->is_valid_public_single() ) {
				// but allow home/front page for website schema
				if ( ! ( is_home() || is_front_page() ) ) {
					return;
				}
			}

			$schema = array();

			if ( is_home() || is_front_page() ) {
				$website_data = array(
					'@context'    => 'https://schema.org',
					'@type'       => 'WebSite',
					'name'        => get_bloginfo( 'name' ),
					'url'         => home_url( '/' ),
					'inLanguage'  => get_bloginfo( 'language' ),
					'potentialAction' => array(
						'@type'       => 'SearchAction',
						'target'      => array(
							'@type'       => 'EntryPoint',
							'urlTemplate' => home_url( '/?s={search_term_string}' ),
						),
						'query-input' => 'required name=search_term_string',
					),
				);

				$site_description = get_bloginfo( 'description' );
				if ( ! empty( $site_description ) ) {
					$website_data['description'] = $site_description;
				}

				$schema['website'] = $website_data;

				// Add Blog Schema with posts for the homepage
				global $wp_query;
				if ( ! empty( $wp_query->posts ) ) {
					$blog_posts = array();
					foreach ( $wp_query->posts as $p ) {
						$blog_posts[] = array(
							'@type'         => 'BlogPosting',
							'headline'      => get_the_title( $p->ID ),
							'url'           => get_permalink( $p->ID ),
							'datePublished' => get_the_date( 'c', $p->ID ),
							'dateModified'  => get_post_modified_time( 'c', false, $p->ID ),
							'author'        => array(
								'@type' => 'Person',
								'name'  => get_the_author_meta( 'display_name', $p->post_author ),
							),
						);
					}
					$schema['blog'] = array(
						'@context' => 'https://schema.org',
						'@type'    => 'Blog',
						'name'     => get_bloginfo( 'name' ),
						'description' => $site_description,
						'blogPost' => $blog_posts,
					);
				}
			}

			if ( is_single() ) {
				$post_id = get_the_ID();
				$post = get_post( $post_id );
				
				$social_github = get_theme_mod( 'jure_minimal_blog_social_github' );
				$social_linkedin = get_theme_mod( 'jure_minimal_blog_social_linkedin' );
				$same_as = array_values( array_filter( array( $social_github, $social_linkedin ) ) );

				$author_name = get_the_author_meta( 'display_name', $post->post_author );
				if ( empty( $author_name ) ) {
					$author_name = get_bloginfo( 'name' );
				}

				$author_data = array(
					'@type' => 'Person',
					'name'  => $author_name,
					'url'   => get_author_posts_url( $post->post_author ),
				);

				if ( get_theme_mod( 'jure_minimal_blog_enable_author_bio' ) ) {
					$author_desc = get_the_author_meta( 'description', $post->post_author );
					if ( ! empty( $author_desc ) ) {
						$author_data['description'] = $author_desc;
					}
				}

				$publisher_logo_url = get_site_icon_url( 512 );
				if ( ! $publisher_logo_url ) {
					$publisher_logo_url = get_header_image();
				}

				$publisher_data = array(
					'@type' => 'Organization',
					'name'  => get_bloginfo( 'name' ),
				);

				if ( $publisher_logo_url ) {
					$publisher_data['logo'] = array(
						'@type' => 'ImageObject',
						'url'   => $publisher_logo_url,
					);
				}

				$article = array(
					'@context' => 'https://schema.org',
					'@type'    => 'BlogPosting',
					'mainEntityOfPage' => array(
						'@type' => 'WebPage',
						'@id'   => get_permalink()
					),
					'headline'      => get_the_title(),
					'inLanguage'    => get_bloginfo( 'language' ),
					'datePublished' => get_the_date( 'c' ), // ISO 8601
					'dateModified'  => get_the_modified_date( 'c' ), // ISO 8601
					'author'        => $author_data,
					'publisher'     => $publisher_data,
				);

				$schema_img = '';
				$custom_og  = get_post_meta( $post_id, '_jure_og_image', true );
				if ( ! empty( $custom_og ) ) {
					$schema_img = $custom_og;
				} elseif ( has_post_thumbnail( $post_id ) ) {
					$schema_img = get_the_post_thumbnail_url( $post_id, 'full' );
				} else {
					$schema_img = get_theme_mod( 'jure_minimal_blog_default_og_image', '' );
				}
				if ( ! empty( $schema_img ) ) {
					$article['image'] = $schema_img;
				}

				$content_raw = get_post_field( 'post_content', $post_id );
				if ( has_excerpt( $post_id ) ) {
					$article['description'] = wp_strip_all_tags( get_the_excerpt( $post_id ) );
				} elseif ( ! empty( $content_raw ) ) {
					$article['description'] = wp_trim_words( wp_strip_all_tags( $content_raw ), 25 );
				}

				if ( ! empty( $content_raw ) ) {
					$word_count = str_word_count( wp_strip_all_tags( $content_raw ) );
					if ( $word_count > 0 ) {
						$article['wordCount'] = $word_count;
					}
				}

				$post_categories = get_the_category( $post_id );
				if ( ! empty( $post_categories ) ) {
					$article['articleSection'] = $post_categories[0]->name;
				}

				$post_tags = get_the_tags( $post_id );
				if ( $post_tags ) {
					$article['keywords'] = array_map( function( $tag ) {
						return $tag->name;
					}, $post_tags );
				}

				if ( ! empty( $same_as ) ) {
					$article['author']['sameAs'] = $same_as;
				}

				$schema['article'] = $article;

				if ( get_theme_mod( 'jure_minimal_blog_enable_breadcrumbs_schema' ) ) {
					$categories = get_the_category();
					if ( ! empty( $categories ) ) {
						$items = array();
						$items[] = array(
							'@type' => 'ListItem',
							'position' => 1,
							'name' => esc_html__( 'Home', 'jure-minimal-blog' ),
							'item' => home_url( '/' )
						);
						
						$depth = 2;
						$cat = $categories[0];
						$items[] = array(
							'@type' => 'ListItem',
							'position' => $depth,
							'name' => $cat->name,
							'item' => get_category_link( $cat->term_id )
						);
						
						$items[] = array(
							'@type' => 'ListItem',
							'position' => $depth + 1,
							'name' => get_the_title(),
							'item' => get_permalink()
						);

						$schema['breadcrumb'] = array(
							'@context' => 'https://schema.org',
							'@type'    => 'BreadcrumbList',
							'itemListElement' => $items
						);
					}
				}
			}

			if ( ! empty( $schema ) ) {
				foreach ( $schema as $type => $data ) {
					echo '<script type="application/ld+json">' . wp_json_encode( $data ) . '</script>' . "\n";
				}
			}
		}

		/**
		 * Robots Logic
		 */
		public function check_robots( $robots ) {
			if ( get_theme_mod( 'jure_minimal_blog_noindex_attachments' ) && is_attachment() ) {
				$robots['noindex'] = true;
				$robots['follow'] = false;
			}
			return $robots;
		}

		/**
		 * Resource Hints
		 */
		public function resource_hints() {
			if ( get_theme_mod( 'jure_minimal_blog_enable_preconnect' ) ) {
				echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
				echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
			}
		}

		/**
		 * Attachment Redirect
		 */
		public function attachment_redirect() {
			if ( is_attachment() && get_theme_mod( 'jure_minimal_blog_noindex_attachments' ) ) {
				global $post;
				if ( $post && $post->post_parent ) {
					wp_safe_redirect( get_permalink( $post->post_parent ), 301 );
				} else {
					wp_safe_redirect( home_url( '/' ), 301 );
				}
				exit;
			}
		}

		/**
		 * Lazy Loading Control
		 */
		public function control_lazy_load( $enabled ) {
			if ( false === get_theme_mod( 'jure_minimal_blog_native_lazy_load', true ) ) {
				return false;
			}
			return $enabled;
		}

		/**
		 * Scroll to Top Display
		 */
		public function scroll_to_top_display() {
			if ( get_theme_mod( 'jure_minimal_blog_enable_scroll_top' ) ) :
				?>
				<button id="scroll-to-top" class="scroll-to-top-btn" aria-label="<?php esc_attr_e( 'Scroll to top', 'jure-minimal-blog' ); ?>">
					&uarr;
				</button>
				<script>
				document.addEventListener('DOMContentLoaded', function() {
					var btn = document.getElementById('scroll-to-top');
					var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
					
					function toggleButton() {
						if (window.scrollY > 300 || document.documentElement.scrollTop > 300) {
							btn.style.display = 'block';
						} else {
							btn.style.display = 'none';
						}
					}

					window.addEventListener('scroll', toggleButton, { passive: true });
					
					btn.onclick = function() {
						window.scrollTo({
							top: 0, 
							behavior: prefersReducedMotion ? 'auto' : 'smooth'
						});

					};
				});
				</script>
				<?php
			endif;
		}

		/**
		 * Register OG Image Meta Box
		 */
		public function add_og_image_meta_box() {
			add_meta_box(
				'jure_og_image_meta_box',
				esc_html__( 'Social Media Image', 'jure-minimal-blog' ),
				array( $this, 'render_og_image_meta_box' ),
				'post',
				'side',
				'low'
			);
		}

		/**
		 * Render OG Image Meta Box
		 *
		 * @param WP_Post $post Current post object.
		 */
		public function render_og_image_meta_box( $post ) {
			wp_nonce_field( 'jure_og_image_nonce_action', 'jure_og_image_nonce' );
			$og_image = get_post_meta( $post->ID, '_jure_og_image', true );
			?>
			<p>
				<label for="jure-og-image"><?php esc_html_e( 'Custom image for Open Graph and Twitter Cards.', 'jure-minimal-blog' ); ?></label>
			</p>
			<p>
				<input type="url" id="jure-og-image" name="jure_og_image" value="<?php echo esc_url( $og_image ); ?>" class="widefat" placeholder="https://" />
			</p>
			<p>
				<button type="button" class="button jure-og-image-upload"><?php esc_html_e( 'Select Image', 'jure-minimal-blog' ); ?></button>
				<?php if ( ! empty( $og_image ) ) : ?>
					<button type="button" class="button jure-og-image-remove"><?php esc_html_e( 'Remove', 'jure-minimal-blog' ); ?></button>
				<?php endif; ?>
			</p>
			<?php if ( ! empty( $og_image ) ) : ?>
				<p><img src="<?php echo esc_url( $og_image ); ?>" style="max-width:100%;height:auto;" alt="" /></p>
			<?php endif; ?>
			<script>
			jQuery(function($){
				$('.jure-og-image-upload').on('click', function(e){
					e.preventDefault();
					var frame = wp.media({title:'<?php esc_attr_e( 'Select Social Image', 'jure-minimal-blog' ); ?>',multiple:false,library:{type:'image'}});
					frame.on('select',function(){
						var url = frame.state().get('selection').first().toJSON().url;
						$('#jure-og-image').val(url);
					});
					frame.open();
				});
				$('.jure-og-image-remove').on('click', function(e){
					e.preventDefault();
					$('#jure-og-image').val('');
					$(this).hide();
				});
			});
			</script>
			<?php
		}

		/**
		 * Save OG Image Meta Box
		 *
		 * @param int $post_id Post ID.
		 */
		public function save_og_image_meta_box( $post_id ) {
			if ( ! isset( $_POST['jure_og_image_nonce'] ) || ! wp_verify_nonce( $_POST['jure_og_image_nonce'], 'jure_og_image_nonce_action' ) ) {
				return;
			}
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
			if ( isset( $_POST['jure_og_image'] ) ) {
				$url = esc_url_raw( wp_unslash( $_POST['jure_og_image'] ) );
				if ( ! empty( $url ) ) {
					update_post_meta( $post_id, '_jure_og_image', $url );
				} else {
					delete_post_meta( $post_id, '_jure_og_image' );
				}
			}
		}


	/**
	 * Helper: Check if current view is a valid public singular post.
	 * Prevents notices on internal WooCommerce placeholders.
	 */
	private function is_valid_public_single() {
		if ( ! is_singular() ) {
			return false;
		}
		$post_type = get_post_type();
		$post_type_obj = get_post_type_object( $post_type );
		if ( ! $post_type_obj || ! $post_type_obj->public ) {
			return false;
		}
		return true;
	}

	/**
	 * Helper: Get the current canonical URL.
	 */
	private function get_canonical_url() {
		global $wp;

		$paged = max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );

		if ( is_singular() ) {
			$url = get_permalink();
		} elseif ( is_front_page() || is_home() ) {
			$url = home_url( '/' );
		} elseif ( is_category() ) {
			$url = get_category_link( get_queried_object_id() );
		} elseif ( is_tag() ) {
			$url = get_tag_link( get_queried_object_id() );
		} elseif ( is_author() ) {
			$url = get_author_posts_url( get_queried_object_id() );
		} elseif ( is_post_type_archive() ) {
			$url = get_post_type_archive_link( get_post_type() );
		} elseif ( is_search() ) {
			$url = home_url( '/' );
			$url = add_query_arg( 's', get_search_query(), $url );
			if ( $paged > 1 ) {
				$url = add_query_arg( 'paged', $paged, $url );
			}
			return $url;
		} else {
			$url = home_url( $wp->request );
		}

		// Add pagination suffix if necessary (except for search which is handled above)
		if ( $paged > 1 ) {
			$url = user_trailingslashit( trailingslashit( $url ) . 'page/' . $paged );
		}

		return $url;
	}
}

endif;
