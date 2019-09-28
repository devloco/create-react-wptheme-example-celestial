<?php
$TEMPLATE_PATH = parse_url(get_template_directory_uri(), PHP_URL_PATH);

/**
 * The main template file
 *
 * @package WordPress
 * @subpackage Celestial
 * @since Celestial 1.0
 */
 ?> <!doctype html><html <?php language_attributes(); ?> class="no-js"><head><meta charset="<?php bloginfo( 'charset' ); ?>"><meta name="viewport" content="width=device-width"><link rel="profile" href="http://gmpg.org/xfn/11"><link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"><title>Celestial</title> <?php wp_head(); ?> <link href="/wordpress/wp-content/themes/celestial/static/css/main.chunk.css?9dcb7e137f07b6d0cf2a" rel="stylesheet"></head><body <?php body_class(); ?>><div id="page" class="hfeed site"><div id="content"><div class="loader-gif"><img src="<?php echo $TEMPLATE_PATH ?>/dist/images/loading-icon.gif" alt="Loader"></div></div> <?php wp_footer(); ?> </div><script src="/wordpress/wp-content/themes/celestial/static/js/bundle.js?9dcb7e137f07b6d0cf2a"></script><script src="/wordpress/wp-content/themes/celestial/static/js/2.chunk.js?9dcb7e137f07b6d0cf2a"></script><script src="/wordpress/wp-content/themes/celestial/static/js/main.chunk.js?9dcb7e137f07b6d0cf2a"></script></body></html>