<?php
    /**
     * @package Integra Chagas Glaucodev Theme
     */
    if ( ! defined( 'ABSPATH' ) ) {
	    exit; // Exit if accessed directly.
    }

    $baseUrl = esc_url( get_template_directory_uri() );
    $siteUrl = esc_url( site_url() );
    $nonce = wp_create_nonce("wp_rest");
    $user_id = get_current_user_id();
?><!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    
  <meta charset="utf-8">
  <title>Integrachagasclient</title>
  <base href="/">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="favicon.ico">


    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    
  <app-root></app-root>


    <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/wp-customizer.service.js"></script>
    <script type="text/javascript">
        let isPage = <?php echo (get_post_type() == "page" ? "true" : "false"); ?>;
        let isPost = <?php echo (get_post_type() == "post" ? "true" : "false"); ?>;
        let isCustomizer = <?php if (is_customize_preview()) { ?>true<?php } else { ?>false<?php } ?>;

        let wpConfig = {
            siteUrl: '<?php echo $siteUrl; ?>',
            auth: {
                isAuthenticated: <?php if (is_user_logged_in() == 1 || is_user_logged_in() == true) { echo "true"; } else { echo "false"; } ?>,
                userId: <?php echo $user_id; ?>,
                nonce: '<?php echo $nonce; ?>'
            },
            isCustomizer,
            isPage,
            isPost,
            postOrPageId: isPage || isPost ? <?php echo get_the_ID(); ?> : null
        };

        if (isCustomizer) {
            // We'll use this service to allow theme's iframe to communicate with its parent (the customizer)
            window.wpCustomizer = WpCustomizerService();
            window.parent.wpCustomizer = window.wpCustomizer;
            wpConfig.customizerService = window.wpCustomizer;
        }

        window._wpConfiguration = wpConfig;
    </script>

    <script src="<?php echo $baseUrl; ?>/polyfills-LZBJRJJE.js" type="module"></script>
<script src="<?php echo $baseUrl; ?>/main-LFZZQQFZ.js" type="module"></script>

    <?php wp_footer(); ?>
</body>
</html>