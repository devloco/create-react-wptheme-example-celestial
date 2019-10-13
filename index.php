<?php
$TEMPLATE_PATH = parse_url(get_template_directory_uri(), PHP_URL_PATH);

/**
 * The main template file
 *
 * @package WordPress
 * @subpackage Celestial
 * @since Celestial 1.0
 */
 ?>
 <!DOCTYPE html>

 <html <?php language_attributes(); ?> class="no-js">
    <head>
<?php $BRC_TEMPLATE_PATH = parse_url(get_template_directory_uri(), PHP_URL_PATH); ?>
<script src='<?php echo $BRC_TEMPLATE_PATH; ?>/react-src/node_modules/@devloco/react-scripts-wptheme-utils/wpThemeClient.js'></script>
<script src='<?php echo $BRC_TEMPLATE_PATH; ?>/react-src/node_modules/@devloco/react-scripts-wptheme-error-overlay/wpThemeErrorOverlay.js'></script>

<script> wpThemeClient.start("ws", "127.0.0.1", "8090"); </script>

        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <title>Celestial</title>
        <?php wp_head(); ?>
    <link href="/wordpress/wp-content/themes/celestial/static/css/main.chunk.css?be0e3bb88da42625f815" rel="stylesheet"></head>
    <body <?php body_class(); ?>>
        <div id="page" class="hfeed site">
            <div id="content">
                <div class="loader-gif">
                    <img src="<?php echo $TEMPLATE_PATH ?>/dist/images/loading-icon.gif" alt="Loader">
                </div>
            </div>
            <?php wp_footer(); ?>
        </div>
    <script src="/wordpress/wp-content/themes/celestial/static/js/bundle.js?be0e3bb88da42625f815"></script><script src="/wordpress/wp-content/themes/celestial/static/js/0.chunk.js?be0e3bb88da42625f815"></script><script src="/wordpress/wp-content/themes/celestial/static/js/main.chunk.js?be0e3bb88da42625f815"></script></body>
</html>
