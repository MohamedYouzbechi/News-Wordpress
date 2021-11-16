<?php

require_once('wp-bootstrap-navwalker.php');
add_theme_support('post-thumbnails'); // Add Featured Image Support

function youz_add_styles(){
	wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css');
	wp_enqueue_style('fontawesome-css', get_template_directory_uri() . '/css/fontawesome-all.min.css');
	wp_enqueue_style('main-css', get_template_directory_uri() . '/css/main.css');
}

function youz_add_scripts(){
	wp_deregister_script('jquery');
	wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), false, '', true);
	wp_enqueue_script('jquery');

	wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array(), false, true);
	wp_enqueue_script('main-js', get_template_directory_uri() . '/js/main.js', array(), false, true);
	
	wp_enqueue_script('html5shiv', get_template_directory_uri() . '/js/html5shiv.js');
	wp_script_add_data( 'html5shiv', 'conditional', 'if lt IE 9');
	wp_enqueue_script('respond', get_template_directory_uri() . '/js/respond.src.js');
	wp_script_add_data( 'respond', 'conditional', 'if lt IE 9');
}

add_action( 'wp_enqueue_scripts','youz_add_styles');
add_action( 'wp_enqueue_scripts','youz_add_scripts');

function youz_register_custom_menu(){
	register_nav_menus( array(
		'bootstrap-menu' => 'Navigation Bar',
		'footer-menu' 	 => 'Footer Menu'
	));
}

add_action( 'init','youz_register_custom_menu');

function youz_extend_excerpt_length(){
	if(is_author()){
		return 30;
	}elseif(is_category()){
		return 40;
	}else{
		return 50;
	}
}

function youz_excerpt_change_dots(){
	return ' ....';
}

add_filter( 'excerpt_length', 'youz_extend_excerpt_length');
add_filter( 'excerpt_more', 'youz_excerpt_change_dots');

function youz_bootstrap_menu(){
	wp_nav_menu(array(
		'theme_location'	=> 'bootstrap-menu',
		'menu_class'		=> 'nav navbar-nav navbar-right',
		'container'			=> false,
		'depth'				=> 2,
		'walker'			=> new wp_bootstrap_navwalker()
	));
}

function numbering_pagination(){
	global $wp_query; //Make wp_query global :(object) instanse of the wp_query Class
	$all_pages = $wp_query->max_num_pages; // Get number of pages
	$current_page = max(1, get_query_var('paged')); //get current page

	if ($all_pages > 1) { // chek if Total pages > 1 
		return paginate_links(array(
			'base'		=>	get_pagenum_link() . '%_%', // Retrive a link for a page number
			'format'	=>	'page/%#%', //format for link
			'current'	=>	$current_page,
			'mid_size'	=>	3,
			'end_size'	=>	3,
			'prev_text'	=> '<<',
			'next_text'	=> '>>'
		));
	}
}

// Register SideBar
function youz_main_sidebar(){
	register_sidebar(array(
		'name'	=> 'Main Sidebar',
		'id'	=> 'main-sidebar',
		'description'	=> 'Main Sidebar Appear Every Where',
		'class'	=> 'main-sidebar',
		'before_widget'	=> '<div class="widget-content">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>'
	));
}

add_action('widgets_init', 'youz_main_sidebar');

function youz_remove_paragraph($content){
	remove_filter('the_content', 'wpautop');
	return $content;
}

/*add_filter('the_content', 'youz_remove_paragraph', 0);*/