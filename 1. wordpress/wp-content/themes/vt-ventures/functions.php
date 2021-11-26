<?php
require_once get_template_directory() . '/core/init.php';

function dntheme_setup() {

    load_theme_textdomain( 'dntheme' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    add_theme_support( 'title-tag' );

    add_post_type_support( 'page', 'excerpt' );

    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1600, 9999 );

    // Set the default content width.
    $GLOBALS['content_width'] = 1600;

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus( array(
        'primary'            => __( 'Main Menu' ),
        'footer_nav'            => __( 'Footer Menu' )
    ) );

    add_theme_support( 'html5', array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script'
        // 'style'
    ) );

}
add_action( 'after_setup_theme', 'dntheme_setup' );

/**
 * Register widget area.
 */
function dntheme_widgets_init() {

    register_sidebar( array(
        'name'          => __( 'Blog Sidebar', 'dntheme' ),
        'id'            => 'blog',
        'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'dntheme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<p class="widget-title">',
        'after_title'   => '</p>',
    ) );

}
add_action( 'widgets_init', 'dntheme_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 */
function dntheme_excerpt_more( $link ) {
    return ' [&hellip;] ';
}
add_filter( 'excerpt_more', 'dntheme_excerpt_more' );

function custom_excerpt_length( $length ) {
    return 300;
}
// add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Custom the_excerpt
function dn_excerpt($limit = 450,$echo= true,$more=' [&hellip;]') {
    if ( has_excerpt( get_the_ID() ) ) {
        the_excerpt();
    } else {
        if($echo) echo wp_html_excerpt( get_the_excerpt(), $limit, $more );
        else return wp_html_excerpt( get_the_excerpt(), $limit, $more );
    }
}

function dn_excerpt_words($limit = 25,$more=' [&hellip;]')
{
    if ( has_excerpt( get_the_ID() ) ) {
        the_excerpt();
    } else {
        echo wp_trim_words(  get_the_excerpt(), $limit, $more ) ;
    }
}
//Check post thumbnail
function dn_thumbnail_html_null( $html ) {

    if ( empty( $html ) )
        $html = '<img src="' . get_theme_file_uri() . '/assets/img/not-images.png" class="img-fluid" alt="Error Image" />';
    return $html;
}
add_filter( 'post_thumbnail_html', 'dn_thumbnail_html_null' );
//
function dn_get_attachment_image_src_null($image) {
    if ( empty( $image ) ) {
        $image[] = get_theme_file_uri() . '/assets/img/not-images.png';
        $image[] = 512; // width
        $image[] = 512; //height
    }
    return $image;
}
add_filter( 'wp_get_attachment_image_src', 'dn_get_attachment_image_src_null');


/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since dntheme
 */
function dntheme_javascript_detection() {
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'dntheme_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 */
function dntheme_scripts() {

    wp_deregister_script('jquery');
    wp_register_script('jquery', get_theme_file_uri( '/assets/js/jquery-3.6.0.min.js' ));
    wp_enqueue_script('jquery');

    // bootstrap
    wp_enqueue_script('bootstrap', get_theme_file_uri( '/assets/libs/bootstrap/js/bootstrap.bundle.js'), array(), '', true );
    wp_enqueue_script('wow',get_theme_file_uri('/assets/js/wow.min.js'), array(), '', true );


    wp_enqueue_style('slick', get_theme_file_uri('/assets/libs/slick/slick.css'), array(), '' );
    wp_enqueue_script('slick',get_theme_file_uri('/assets/libs/slick/slick.min.js'), array(), '', true );

    wp_enqueue_script('dnmain',get_theme_file_uri('/assets/js/main.js'), array(), '', true );

    // Call defaul js
    // wp_localize_script( 'dnmain', 'dntheme_params', array(
    //     'dntheme_nonce' => wp_create_nonce( 'dntheme_nonce' ), // Create nonce which we later will use to verify AJAX request
    //     'ajax_url' => admin_url( 'admin-ajax.php' ),
    //     )
    // );

    // Theme stylesheet.
    wp_enqueue_style( 'dn-style', get_theme_file_uri('/assets/css/main.css') );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'dntheme_scripts' );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since dntheme
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function dntheme_front_page_template( $template ) {
    return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'dntheme_front_page_template' );


/**
 * Funtion include
 */
require get_parent_theme_file_path( '/inc/functions.php' );
require get_parent_theme_file_path( '/inc/template-tags.php' );
require get_parent_theme_file_path( '/inc/dn-boostspeed.php' );
require get_parent_theme_file_path( '/inc/dn-helpers.php' );

/**
 * Thiết lập mặc định khi upload trong bài viết
 * @author Đoàn Nguyễn
 */
function wps_attachment_display_settings() {
    update_option( 'image_default_align', 'center' );
    // update_option( 'image_default_link_type', 'file' );
    update_option( 'image_default_size', 'full' );
}
add_action( 'after_setup_theme', 'wps_attachment_display_settings' );

/**
 * Attach a class to linked images' parent anchors
 * Works for existing content
 */
function give_linked_images_class($content) {

  $classes = 'img'; // separate classes by spaces - 'img image-link'

  // check if there are already a class property assigned to the anchor
  if ( preg_match('/<a.*? class=".*?"><img/', $content) ) {
    // If there is, simply add the class
    $content = preg_replace('/(<a.*? class=".*?)(".*?><img)/', '$1 ' . $classes . '$2', $content);
  } else {
    // If there is not an existing class, create a class property
    $content = preg_replace('/(<a.*?)><img/', '$1 class="' . $classes . '" data-fancybox="single-gallery"><img', $content);
  }
  return $content;
}

// add_filter('acf_the_content','give_linked_images_class');

/**
 * Filters the default archive titles.
 */
function dntheme_get_the_archive_title() {
    if ( is_category() ) {
        $title = '<h1 class="page-title">' . single_term_title( '', false ) . '</h1>';
    } elseif ( is_tag() ) {
        $title = '<span class="page-description">' . single_term_title( '', false ) . '</span>';
    } elseif ( is_author() ) {
        $title = '<span class="page-description">' . get_the_author_meta( 'display_name' ) . '</span>';
    } elseif ( is_year() ) {
        $title = '<span class="page-description">' . get_the_date( _x( 'Y', 'yearly archives date format', 'dntheme' ) ) . '</span>';
    } elseif ( is_month() ) {
        $title = '<span class="page-description">' . get_the_date( _x( 'F Y', 'monthly archives date format', 'dntheme' ) ) . '</span>';
    } elseif ( is_day() ) {
        $title = '<span class="page-description">' . get_the_date() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = '<h1 class="page-title">' . post_type_archive_title( '', false ) . '</h1>';
    } elseif ( is_tax() ) {
        // $tax = get_taxonomy( get_queried_object()->taxonomy );
        /* translators: %s: Taxonomy singular name */
        $title = '<h1 class="page-title">' .sprintf( esc_html__( '%s', 'dntheme' ), single_term_title( '', false ) ). '</h1>';
    } else {
        $title = __( 'Archives:', 'dntheme' );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'dntheme_get_the_archive_title' );


/**
 * Get name menu
 * @author Đoàn Nguyễn
 */
function dntheme_get_nav_name($location) {
    if(empty($location)) return false;

    $locations = get_nav_menu_locations();
    if(!isset($locations[$location])) return false;

    $menu_obj  = get_term( $locations[$location], 'nav_menu' );
    $menu_name = esc_html($menu_obj->name);

    return $menu_name;
}

/**
 * Header
 * @author Đoàn Nguyễn
 */
function dntheme_theme_header() {
    global $dn_options;
    echo (isset($dn_options[ 'header_scripts'])?$dn_options[ 'header_scripts']:'');
}
add_action( 'wp_head', 'dntheme_theme_header' );
/**
 * After Body tag
 */
function custom_body_open_code() {
    global $dn_options;
    echo (isset($dn_options[ 'header_scripts_after'])?$dn_options[ 'header_scripts_after']:'');
}
add_action( 'wp_body_open', 'custom_body_open_code' );

/**
 * Footer
 * @author Đoàn Nguyễn
 */
function dntheme_theme_footer() {
    global $dn_options;
    echo (isset($dn_options[ 'footer_scripts'])?$dn_options[ 'footer_scripts']:'');
?>
<?php }
add_action( 'wp_footer', 'dntheme_theme_footer' );


add_action('wp_ajax_loadmore', 'get_post_loadmore');
add_action('wp_ajax_nopriv_loadmore', 'get_post_loadmore');
function get_post_loadmore() {
    $offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0; // lấy dữ liệu phái client gởi
    $catid = isset($_POST['catid']) ? (int)$_POST['catid'] : 0; // lấy dữ liệu phái client gởi

    $args = array(
      'post_type' => 'post',
      'posts_per_page' => 12,
      'cat' => $catid,
      'offset' => $offset,

    );
    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) :

    while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <div class="col-md-6 d-md-flex">
            <?php get_template_part( 'template-parts/content','archive'); ?>
        </div>
    <?php endwhile;
    wp_reset_postdata();
    endif;

    die();
}
