/*
Theme Name:
Theme URI: https://shakirahmad.com
Author: Shakir Ahmad
Author URI: https://shakirahmad.com
Description:
Version: 0.0.1
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain:
Tags: one-column, two-columns, right-sidebar, flexible-header, accessibility-ready, custom-colors, custom-header, custom-menu, custom-logo, editor-style, featured-images, footer-widgets, post-formats, rtl-language-support, sticky-post, theme-options, threaded-comments, translation-ready
*/

<html <?php language_attributes(); ?>>
<meta charset="<?php bloginfo( 'charset' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div <?php post_class(); ?>>

	<?php wp_footer(); ?>
</body>

<?php bloginfo( 'name' ); ?>
<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
<?php bloginfo( 'description' ); ?>

<?php the_title(); ?>
<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
<?php the_author(); ?>
<?php echo get_the_date(); ?>

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

<?php the_posts_pagination( array(
	'screen_reader_text' => ' ',
	'prev_text'          => 'New Posts',
	'next_text'          => 'Old Posts'
) ); ?>

<?php if ( comments_open() ): ?>
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
		'id'            => 'sidebar-1',
		'description'   => __( 'Right Sidebar', 'alpha' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'alpha_sidebar' );
?>

<?php
if ( is_active_sidebar( 'sidebar-1' ) ) {
	dynamic_sidebar( 'sidebar-1' );
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
function alpha_bootstrapping() {
	load_theme_textdomain( "alpha" );
	add_theme_support( "post-thumbnails" );
	add_theme_support( "title-tag" );
	$alpha_custom_header_details = array(
		'header-text'        => true,
		'default-text-color' => '#222',
		'width'              => 1200,
		'height'             => 600,
		'flex-height'        => true,
		'flex-width'         => true
	);
	add_theme_support( "custom-header", $alpha_custom_header_details );

	$alpha_custom_logo_defaults = array(
		"width"  => '100',
		"height" => '100'
	);
	add_theme_support( "custom-logo", $alpha_custom_logo_defaults );
	add_theme_support( 'custom-background' );
	register_nav_menu( "topmenu", __( "Top Menu", "alpha" ) );
	register_nav_menu( "footermenu", __( "Footer Menu", "alpha" ) );

	add_theme_support( "post-formats", array( "image", "quote", "video", "audio", "link" ) );
}

add_action( "after_setup_theme", "alpha_bootstrapping" );
?>

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