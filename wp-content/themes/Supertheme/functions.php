<?php

require_once __DIR__.'/app/bootstrap.php';

require_once __DIR__.'/src/functions.php';



add_filter('timber/context', function($data){

    // logos

    $data['menu'] = new Timber\Menu('primary_menu');



    return $data;

});



add_action('wp_enqueue_scripts', function(){

    $SP = [];

    $SP['settings'] = [

        "analyticsID" => get_field("google_analytics_id", "option"),

        "universalAnalytics" => true,

    ];

    wp_localize_script( 'app', 'SP', $SP);

});



if(function_exists('acf_add_local_field_group')){

    $parser = new \Symfony\Component\Yaml\Parser();

    $fields = $parser->parse(file_get_contents(__DIR__.'/app/config/header.yml'));

    acf_add_local_field_group($fields);

    $fields = $parser->parse(file_get_contents(__DIR__.'/app/config/page_builder.yml'));

    acf_add_local_field_group($fields);

    $fields = $parser->parse(file_get_contents(__DIR__.'/app/config/success_stories.yml'));

    acf_add_local_field_group($fields);

}



// global timber context

add_filter('timber/context', function($data) {

    $data['phone_numbers'] = get_field('phone_numbers', 'option');

    $data['linkedin'] = get_field('linkedin', 'option');

    $data['talent_page'] = get_field('talent_page', 'option');

    $data['prev'] = get_previous_post_link("%link", "");

    $data['next'] = get_next_post_link("%link", "");

    $data['form_background'] = get_field("footer_form_background", "option");
    
    $data['footer_form_id'] = get_field("footer_form_id", "option");

    $data['theme_url'] = get_stylesheet_directory_uri();

    $data['success_stories_url'] = get_post_type_archive_link('success_stories');

    $data['show_form'] = !get_field("footer_contact_form");
    
    return $data;

});

//extend timber

add_filter('get_twig', function ($twig) {

    $twig->addExtension(new \Supertheme\WordPress\Twig\Extension\PregExtension());

    return $twig;

});



// hide posts in admin menu

/*
add_action('admin_menu', function () {

    remove_menu_page('edit.php');

});
*/



// add taxonomy to success stories

add_action('init', function () {

    register_taxonomy_for_object_type('category', 'success_stories');

    register_taxonomy(

        'success_category',

        'success_stories',

        array(

            'labels' => ['name' =>__( 'Categories' ), 'singular_name' => __( 'Category' )],

            'rewrite' => array( 'slug' => 'success-categories' ),

            'show_ui' => true,

        )

    );

    unregister_taxonomy_for_object_type( 'category', 'success_stories' );

});



// Filter menu items as needed and set a custom class etc....
function set_current_menu_class($classes) {
	global $post;
	
	
	if( is_author() || is_category() || is_singular( 'post' ) ) {
		
		$classes = array_filter($classes, "remove_parent_classes");
		
		if ( in_array('menu-item-323', $classes ) )
			$classes[] = 'current-menu-item';
	}
			
	return $classes;
}

add_filter('nav_menu_css_class', 'set_current_menu_class',1,2); 


// check for current page classes, return false if they exist.
function remove_parent_classes($class){
  return in_array( $class, array( 'current_page_item', 'current_page_parent', 'current_page_ancestor', 'current-menu-item' ) )  ? FALSE : TRUE;
}


add_action( 'wp_footer', 'as_add_cta_form' );

function as_add_cta_form() {
    
    
?>
    <div id="lets-talk" class="lets-talk-lightbox" style="display: none;">
        <div class="row">
            <div class="small-12 columns">
                <?php
                echo do_shortcode( '[gravityform id="5" title="false" description="false" ajax="true" tabindex="993"]' );
                ?>
            </div>
        </div>
    </div>   
    <?php
}