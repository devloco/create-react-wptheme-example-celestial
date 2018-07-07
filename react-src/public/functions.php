<?php
/**
 * Enqueue scripts and styles.
 *
 * @since Celestial 1.0
 */

function celestial_scripts() {

	// Load our main stylesheet.
	wp_enqueue_style( 'bootstrap-style', 'http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css' );
	wp_enqueue_style( 'celestial-style-dist', get_stylesheet_directory_uri() . '/dist/style.css');
	wp_enqueue_style( 'celestial-style', get_stylesheet_uri() );

    // Load scripts
	wp_enqueue_script( 'jquery', 'http://code.jquery.com/jquery-3.2.1.slim.min.js', '20171006', false );
	wp_enqueue_script( 'scrollmagic', 'http://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js' , array( 'jquery' ), '1.0', false );
	wp_enqueue_script( 'popper', 'http://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js', array( 'jquery' ), '20171006', false );
    wp_enqueue_script( 'bootstrap-script', 'http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js', array( 'jquery' ), '20171006', false );

    wp_enqueue_script( 'celestial-script', get_stylesheet_directory_uri() . '/dist/app.js' , array(), '1.0', true );

	$url = trailingslashit( home_url() );
	$path = trailingslashit( parse_url( $url, PHP_URL_PATH ) );

	wp_scripts()->add_data( 'celestial-script', 'data', sprintf( 'var CelestialSettings = %s;', wp_json_encode( array(
		'title' => get_bloginfo( 'name', 'display' ),
		'path' => $path,
		'URL' => array(
			'api' => esc_url_raw( get_rest_url( null, '/wp/v2' ) ),
			'root' => esc_url_raw( $url ),
		),
		'woo' => array(
			'url' => esc_url_raw( 'http://localhost/wordpress/wp-json/wc/v2/' ),
			'consumer_key' => 'ck_803bcdcaa73d3a406a0f107041b07ef6217e05b9',
			'consumer_secret' => 'cs_c50ba3a77cc88c3bf46ebac49bbc96de3a543f03'
		),
	) ) ) );
}
add_action( 'wp_enqueue_scripts', 'celestial_scripts' );

// Add various fields to the JSON output
function celestial_register_fields() {
	// Add Author Name
	register_rest_field( 'post',
		'author_name',
		array(
			'get_callback'		=> 'celestial_get_author_name',
			'update_callback'	=> null,
			'schema'			=> null
		)
	);
	// Add Featured Image
	register_rest_field( 'post',
		'featured_image_src',
		array(
			'get_callback'		=> 'celestial_get_image_src',
			'update_callback'	=> null,
			'schema'			=> null
		)
    );
    // Add Published Date
	register_rest_field( 'post',
        'published_date',
        array(
            'get_callback'		=> 'celestial_published_date',
            'update_callback'	=> null,
            'schema'			=> null
        )
	);
}
add_action( 'rest_api_init', 'celestial_register_fields' );

function celestial_get_author_name( $object, $field_name, $request ) {
	return get_the_author_meta( 'display_name' );
}
function celestial_get_image_src( $object, $field_name, $request ) {
    if($object[ 'featured_media' ] == 0) {
        return $object[ 'featured_media' ];
    }
	$feat_img_array = wp_get_attachment_image_src( $object[ 'featured_media' ], 'thumbnail', true );
    return $feat_img_array[0];
}
function celestial_published_date( $object, $field_name, $request ) {
	return get_the_time('F j, Y');
}

function celestial_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'celestial_excerpt_length' );
