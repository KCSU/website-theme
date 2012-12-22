<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php
        /*
         * Print the <title> tag based on what is being viewed.
         */
        global $page, $paged;

        wp_title( '|', true, 'right' );

        // Add the blog name.
        bloginfo( 'name' );

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            echo " | $site_description";
    ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <style>
        body {
            padding-top: 60px;
            padding-bottom: 40px;
        }
    </style>

    <script src="<?php echo get_template_directory_uri(); ?>/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>

    <script src="<?php echo get_template_directory_uri(); ?>/js/require/require.js" data-main="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
    <?php wp_head(); ?>
</head>
<body>
    <?php
        // Now for the navigation
    ?>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <!-- collapse button for low resolution devices -->
                <a class="btn btn-navbar" data-toggle="collapse" data-target="nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <!-- the kcsu logo -->
                <a class="brand" href="/">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/kcsu-logo-header.png" alt="KCSU" />
                </a>
                <!-- collapsible menu -->
                <div class="nav-collapse collapse">
                
                </div>
            </div>
        </div>
    </div>