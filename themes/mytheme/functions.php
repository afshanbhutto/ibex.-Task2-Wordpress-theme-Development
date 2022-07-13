<?php


//Load CSS

function load_css()
{
	wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all');
	wp_enqueue_style('bootstrap');


	wp_register_style('main', get_template_directory_uri() . '/css/main.css', array(), false, 'all');
	wp_enqueue_style('main');
} 
add_action('wp_enqueue_scripts', 'load_css');


//Load JS

function load_js()
{
	wp_enqueue_script('jquery');
	wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery', false, true);
	wp_enqueue_style('bootstrap');
} 
add_action('wp_enqueue_scripts', 'load_js');

// Theme options
add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support('widgets');

//Menus

register_nav_menus(
		array(
			'top-menu' => 'Top Menu Location',
			'mobile-menu' => 'Mobile Menu Location',
			'footer-menu' => 'Footer Menu Location',
		)

);

// custom Image Sizes

add_image_size('blog-large', 1000, 600 , false);
add_image_size('blog-small', 300, 200 , true);


//Register siddebar

function my_sidebar(){

	register_sidebar(
		array(
			'name' => 'Page Sidebar',
			'id' => 'page-sidebar',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>'
		)
	);

	register_sidebar(
		array(
			'name' => 'Blog Sidebar',
			'id' => 'blog-sidebar',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>'
		)
	);

}
add_action('widgets_init', 'my_sidebar');



// custom post types


function my_first_post_type(){

	$args = array(
		'labels' => array(
			'name' =>'Cars',
			'singular_name' => 'Car',
		),
		'hireraechical' => true,
		'public' => true,
		'has_archive' => true,
		'menu_icon' =>'dashicons-car',
		'supports' => array('title' , 'editor' ,'thumbnail', 'custom-fields'),
		// 'rewite' => array('slug'=> 'cars')
	);
	register_post_type('cars', $args);
}
add_action('init', 'my_first_post_type');


// for taxanomy 
function my_first_taxonomy(){

		$args = array(
			'labels' => array(
				'name' =>'Brands',
				'singular_name' => 'Brand',
			),

		'public' => true,
		'hireraechical' => true,
	);

	register_taxonomy('brands', array('cars'), $args);
}
add_action('init', 'my_first_taxonomy');



add_action('wp_ajax_enquiry', 'enquiry_form');
add_action('wp_ajax_nopriv_enquiry', 'enquiry_form');

function enquiry_form()
{

	if( !wp_verify_nonce( $_POST['nonce'], 'ajax-nonce') ){
		wp_send_json_error('Nonce is Incorrect', 401);
		die();
	}
	$formdata = [];
	// it will convert the serialize data into php array
	wp_parse_str($_POST['enquiry'], $formdata);

	//admin email
	$admin_email = get_option('admin_email');

	//Email headers
	$headers[] = 'Conetnt-Type: text/html; charset=UTF-8';
	$headers[] = 'From: My website <' . $admin_email . '>';
	$headers[] = 'Reply-to:' . $formdata['email'];

	//who are we sending the email to?
	$send_to = $admin_email;

	// subject
	$subject = "Enquiry from" . $formdata['fname'] . ' ' . $formdata['lname'];
	// Message
	$message = '';
	foreach($formdata as $index => $field)
	{
		$message .= '<strong>' . $index . '</strong>:' . $field . '<br />';

	}

	try{
		if(wp_mail($send_to, $subject, $message, $headers) )
		{
			wp_send_json_success('Email Sent');
		}
		else{
			wp_send_json_error("Email Error");
		}
	}catch(Exception $e)
	{
		wp_send_json_error($e->getMessage());
	}
	wp_send_json_success($formdata['fname']);
}

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

// add_action('phpmailer_init', 'custom_mailer');
// function custom_mailer(PHPMailer $phpmailer){

// 	$phpmailer->SetFrom(;)
// }