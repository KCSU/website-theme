<?php
/**
 * KCSU website functions and definitions (can declare global variables here)
 *
 * @package KCSU
 * @file functions.php
 * @author Conor Burgess <Burgess.Conor@gmail.com>
 * @license BSD 3-Clause
 *
 */
    
    add_action( 'after_setup_theme', 'kcsu_setup' );

    if ( ! function_exists( 'kcsu_setup' ) ):

        function kcsu_setup() {

        }
    
    endif; // twentyeleven_setup

    /**
     * Sets the post excerpt length to 40 words
     */
    function kcsu_excerpt_length( $length ) {
        return 40;
    }
    add_filter( 'excerpt_length', 'kcsu_excerpt_length' );

    /**
     * Returns a "Continue Reading" link for excerpts
     */
    function kcsu_continue_reading_link() {
        return ' <a href="'. esc_url( get_permalink() ) . '">' . 'Continue reading <span class="meta-nav">&rarr;</span>' . '</a>';
    }

    /**
     * Replaces "[...]" (appended to automatically generated excerpts) with an 
     * ellipsis and kcsu_continue_reading_link().
     *
     */
    function kcsu_auto_excerpt_more( $more ) {
        return ' &hellip;' . kcsu_continue_reading_link();
    }
    add_filter( 'excerpt_more', 'kcsu_auto_excerpt_more' );

    /**
     * Adds a pretty "Continue Reading" link to custom post excerpts.
     *
     * To override this link in a child theme, remove the filter and add your own
     * function tied to the get_the_excerpt filter hook.
     */
    function kcsu_custom_excerpt_more( $output ) {
        if ( has_excerpt() && ! is_attachment() ) {
            $output .= kcsu_continue_reading_link();
        }
        return $output;
    }
    add_filter( 'get_the_excerpt', 'kcsu_custom_excerpt_more' );

    /**
     * Register our sidebars and widgetized areas. 
     */
    function kcsu_widgets_init() {
        
        register_sidebar( array(
            'name' => 'Main Sidebar',
            'id' => 'sidebar-1',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );
    }
    add_action( 'widgets_init', 'kcsu_widgets_init' );


    if ( ! function_exists( 'kcsu_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     * Create your own twentyeleven_posted_on to override in a child theme
     *
     * @since Twenty Eleven 1.0
     */
    function kcsu_posted_on() {
        printf( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>',
            esc_url( get_permalink() ),
            esc_attr( get_the_time() ),
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() ),
            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
            esc_attr( sprintf('View all posts by %s', get_the_author() ) ),
            get_the_author()
        );
    }
    endif;

    /**
     * Register and configure menus
     */
    
    require_once('lib/twitter_bootstrap_nav_walker.php');
    function register_menus() {
        // The main navbar (top menu)
        register_nav_menus(array(
            'navbar'     =>  __('Navigation Menu'),
            'home-other' =>  __('Other Links')
        ));
    }
    add_action('init', 'register_menus');

