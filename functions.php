<?php
/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Register Custom Navigation Walker
require_once get_template_directory() . '/inc/wp-bootstrap-navwalker.php';

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

	if (!isset($content_width))
	{
		$content_width = 900;
	}

	if (function_exists('add_theme_support'))
	{
		// Add Menu Support
		add_theme_support('menus');
		// Add Thumbnail Theme Support
		add_theme_support('post-thumbnails');
		add_image_size('large', 700, '', true); // Large Thumbnail
		add_image_size('medium', 300, '', true); // Medium Thumbnail
		add_image_size('small', 150, '', true); // Small Thumbnail
		add_image_size('thumbnail', 150, 150, true); // Small Thumbnail
	}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// Collado navigation
function collado_nav()
{
	wp_nav_menu( array(
		'theme_location'  => 'header-menu',
		'depth'           => 2,
		'container'       => 'div',
		'container_class' => 'collapse navbar-collapse',
		'menu_class'      => 'navbar-nav ml-auto',
		'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
		'walker'          => new WP_Bootstrap_Navwalker()
	) );
}

// Register Collado Navigation
function register_collado_menu()
{
	register_nav_menus(	array(
		'header-menu' => __('Header Menu', 'collado'), // Main Navigation
		'sidebar-menu' => __('Sidebar Menu', 'collado'), // Sidebar Navigation
	));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
	$args['container'] = false;
	return $args;
}

// Load styles
function collado_styles()
{	
	wp_register_style('collado_styles', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0', 'all');
	wp_enqueue_style('collado_styles'); 
}

// Load scripts
function collado_header_scripts()
{
	if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('collado_scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), '1.0.0', true);
		wp_enqueue_script('collado_scripts');
	}
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
	return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
	return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class
function add_slug_to_body_class($classes)
{
	global $post;

	if (is_home()) {
		$key = array_search('blog', $classes);
		if ($key > -1) {
			unset($classes[$key]);
		}
	} elseif (is_page()) {
		$classes[] = sanitize_html_class($post->post_name);
	} elseif (is_singular()) {
		$classes[] = sanitize_html_class($post->post_name);
	}

	return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
	/*
	// Define Sidebar Widget Area 1
	register_sidebar(array(
		'name' 			=> __('Sidebar', 'collado'),
		'description' 	=> __('Sidebar', 'collado'),
		'id' 			=> 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' 	=> '</div>',
		'before_title' 	=> '<h3>',
		'after_title' 	=> '</h3>'
	));
	*/
	// Define Footer Widget Area 1
	register_sidebar(array(
		'name' 			=> 'Footer Widget 1',
		'description' 	=> 'Footer widget 1',
		'id'			=> 'footer-widget-1',
		'before_widget' => '<div id="%1$s" class="col-12 col-sm-6 col-lg-3 footer-block" %2$s">',
		'after_widget' 	=> '</div>',
		'before_title' 	=> '<h4 class="footer-title">',
		'after_title' 	=> '</h4>'
	));
	// Define Footer Widget Area 2
	register_sidebar(array(
		'name' 			=> 'Footer Widget 2',
		'description' 	=> 'Footer widget 2',
		'id' 			=> 'footer-widget-2',
		'before_widget' => '<div id="%1$s" class="col-12 col-sm-6 col-lg-3 footer-block" %2$s">',
		'after_widget' 	=> '</div>',
		'before_title' 	=> '<h4 class="footer-title">',
		'after_title' 	=> '</h4>'
	));
	// Define Footer Widget Area 3
	register_sidebar(array(
		'name' 			=> 'Footer Widget 3',
		'description' 	=> 'Footer widget 3',
		'id' 			=> 'footer-widget-3',
		'before_widget' => '<div id="%1$s" class="col-12 col-sm-6 col-lg-3 footer-block" %2$s">',
		'after_widget' 	=> '</div>',
		'before_title' 	=> '<h4 class="footer-title">',
		'after_title' 	=> '</h4>'
	));
	// Define Footer Widget Area 4
	register_sidebar(array(
		'name' 			=> 'Footer Widget 4',
		'description' 	=> 'Footer widget 4',
		'id' 			=> 'footer-widget-4',
		'before_widget' => '<div id="%1$s" class="col-12 col-sm-6 col-lg-3" %2$s">',
		'after_widget' 	=> '</div>',
		'before_title' 	=> '<h4 class="footer-title">',
		'after_title' 	=> '</h4>'
	));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
	global $wp_widget_factory;

	remove_action('wp_head', array(
		$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
		'recent_comments_style'
	));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function collado_pagination()
{
	global $wp_query;

	$big = 999999999;
	$args = array(
		'base'		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' 	=> 'category/blog/page/%#%',
		'current' 	=> max( 1, get_query_var('paged') ),
		'numberposts'=> 3,
		'total' 	=> $wp_query->max_num_pages,
		'type'  	=> 'array',
		'prev_next' => true,
		'prev_text' => __('« Prev'),
		'next_text' => __('Next »'),
	);

	$pages = paginate_links($args);

	if(is_array( $pages)) {
		foreach ($pages as $page) {
			$pagination .= '<li class="page-item">' . str_replace('page-numbers','page-link', $page) . '</li>';
		}
		echo $pagination;
	}
}

// Create the Custom Excerpts callback
function collado_excerpt($more_callback = false)
{
	global $post;

	if($more_callback){
		add_filter('excerpt_more', 'collado_view_project');
	}
	else{
		add_filter( 'excerpt_more', 'collado_read_more' );
	}

	$output = get_the_excerpt();
	$output = apply_filters('wptexturize', $output);
	$output = apply_filters('convert_chars', $output);
	$output = '<p>' . $output . '</p>';
	echo $output;
}

// Custom View Article link to Post
function collado_view_project($more)
{
	return '...
	<div class="text-right mt-2"> 
		<a class="btn btn-custom" href="' . get_permalink() . '"> View Project <i class="fas fa-chevron-right"></i></a> 
	</div>';
}
function collado_read_more() {
	return '...
	<div class="text-right mt-2"> 
		<a class="btn btn-custom" href="' . get_permalink() . '"> Read More <i class="fas fa-chevron-right"></i></a> 
	</div>';
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
	$html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
	return $html;
}

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'collado_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'collado_styles'); // Add Theme Stylesheet
add_action('init', 'register_collado_menu'); // Add Menu
add_action('init', 'create_post_type_collado'); // Add Custom Post Type
add_action('init', 'collado_pagination'); // Add Pagination
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()


// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
// Remove emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Add Filters
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
add_filter('auto_update_plugin', '__return_true'); // Automatic updates 


/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create Custom Post Type Projects
function create_post_type_collado()
{
	$labels = array(
		'name'                           => 'Project Types',
		'singular_name'                  => 'Project',
		'search_items'                   => 'Search categories',
		'all_items'                      => 'All categories',
		'edit_item'                      => 'Edit Project Type',
		'update_item'                    => 'Update Project Type',
		'add_new_item'                   => 'Add New Project Type',
		'new_item_name'                  => 'New Project Type Name',
		'menu_name'                      => 'Project Type',
		'view_item'                      => 'View Project Type',
		'popular_items'                  => 'Popular Project Type',
		'separate_items_with_commas'     => 'Separate categories with commas',
		'add_or_remove_items'            => 'Add or remove categories',
		'choose_from_most_used'          => 'Choose from the most used categories',
		'not_found'                      => 'No categories found'
	);
	// Register taxonomy category for custom post type projects
	register_taxonomy('project-category', 'projects',
		array(
			'label' => __('Projects'),
			'hierarchical' => true,
			'labels' => $labels
		)
	); 

	register_post_type('projects',
		array(
			'labels' => array(
				'name' => __('Projects', 'collado'), // Rename these to suit
				'singular_name' => __('Project', 'collado'),
				'add_new' => __('Add New', 'collado'),
				'add_new_item' => __('Add New Project', 'collado'),
				'edit' => __('Edit', 'collado'),
				'edit_item' => __('Edit Project', 'collado'),
				'new_item' => __('New Project', 'collado'),
				'view' => __('View Project', 'collado'),
				'view_item' => __('View Project', 'collado'),
				'search_items' => __('Search Project', 'collado'),
				'not_found' => __('No Projects found', 'collado'),
				'not_found_in_trash' => __('No Projects found in Trash', 'collado')
			),
			'menu_icon' => 'dashicons-admin-appearance',
			'public' => true,
			'hierarchical' => true,
			'has_archive' => true,
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail'
			), 
			'taxonomies' => array()
		)
	);
}
