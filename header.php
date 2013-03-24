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
<html class="no-js" lang="en">
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

    <!-- Some Fonts -->
    <!-- Our serif font, Donegal One -->
    <link href='http://fonts.googleapis.com/css?family=Donegal+One' rel='stylesheet' type='text/css'>

    <!-- Respond polyfill + modernizr -->
    <script src="<?php echo get_template_directory_uri(); ?>/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <?php wp_head(); ?>
</head>
<body>
    <div id="KCSUPageHeader" class="header">
        <?php
            // Now for the navigation
        ?>
        <div class="navbar main">
            <div class="navbar-inner">
                <div class="container">
                    <!-- Brand only visible on phones -->
                    <a class="brand visible-phone" href="/">
                        KCSU
                    </a>
                    <!-- collapse button for low resolution devices -->
                    <a class="expand-button btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        menu
                    </a>
                    <!-- Collapsible menu -->
                    <div class="nav-collapse collapse pull-right">
                    <?php
                        wp_nav_menu( array(
                            'theme_location'  => 'main_menu',
                            'menu'            => 'navbar', 
                            'container'       => false,
                            'menu_class'      => 'nav',
                            'depth'           => 2,
                            'walker'          =>  new twitter_bootstrap_nav_walker())
                        );
                    ?>
                    <!-- Account stuff -->
                    <ul class="nav">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Account <b class="caret"></b></a>

                            <ul class="dropdown-menu">
                                <li><a href="/wp-admin/index.php"><i class="icon-dashboard"></i> Dashboard</a></li>
                                <li><a href="<?php echo wp_login_url(); ?>"><i class="icon-signin"></i> Log in</a></li>
                                <li><a href="<?php echo wp_logout_url(); ?>"><i class="icon-signout"></i>  Log out</a></li>
                            </ul>
                        </li>    
                    </ul>

                    <!-- Search -->
                    <?php /* ?>
                    <form id="NavbarSearchForm" method="get" class="navbar-search pull-right" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input name="s" id="NavbarSearchField" type="text" class="search-query" placeholder="search" />
                    </form>
                    </div>
                    <?php */ ?>
                </div>
            </div>
        </div>
        <!-- Logo: hidden on phones -->
        <div class="logo hidden-phone">
            <img src="<?php echo get_template_directory_uri(); ?>/img/kcsu_full.png" alt="KCSU" />
        </div>
    </div>
    <!-- END HEADER -->