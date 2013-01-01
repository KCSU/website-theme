<?php
    /**
     * KCSU website functions and definitions (can declare global variables here)
     *
     * @package KCSU
     * @file header.php
     * @author  Gideon Farrell <me@gideonfarrell.co.uk>
     * @license BSD 3-Clause
     *
     */
?>
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
                    <img src="<?php echo get_template_directory_uri(); ?>/img/kcsu-dark-small.png" alt="KCSU" />
                </a>
                <!-- collapsible menu -->
                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <li><a href="/" title="Home">Home</a></li>
                        <li><a href="#" title="News">Latest</a></li>
                        <li><a href="#" title="Events">Events</a></li>
                        <li><a href="#" title="The Exec">The Exec</a></li>
                        <?php // if not logged in ?>
                        <li><a href="#" title="Contact">Contact</a></li>
                        <?php // else if logged in ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" title="Settings">Settings</a></li>
                                <li><a href="#" title="Logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>