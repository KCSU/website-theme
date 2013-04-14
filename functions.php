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
    require_once('lib/string_format.php');
    require_once('lib/PhpLib/set.php');
   
    /**
     * Register and configure menus
     */
    
    require_once('lib/twitter_bootstrap_nav_walker.php');
    function register_menus() {
        // The main navbar (top menu)
        register_nav_menus(array(
                                 'navbar'         =>  __('Navigation Menu'),
                                 'home-side-menu' =>  __('Front page about menu')
                                 ));
    }
    add_action('after_setup_theme', 'register_menus');
    
    /**
     * Custom post types and custom fields.
     */
    
    require_once('custom_post_types.php');
    require_once('custom_fields.php');
    
    /**
     * Returns an array of exec members
     */
    function kcsu_get_exec()
    {
        
        $the_exec = array();
        
        $args = array(
                      'post_type'       => 'exec',
                      'posts_per_page'  => -1,
                      );
        $exec_query = new WP_Query( $args );
        
        while ( $exec_query->have_posts() )
        {
            $exec_query->the_post();
            $member = array(
              'id'            => get_the_ID(),
              'title'         => get_the_title(),
              'description'   => get_the_content(),
              'email'         => get_field('email_address'),
              'link'          => get_permalink(),
              'excerpt'       => get_the_excerpt(),
              'user'          => array()
            );

            // now fetch incumbent data
            $incumbents = explode(',', get_field('incumbent'));
            foreach($incumbents as $incumbent) {
              $u = get_userdatabylogin(trim($incumbent));
              $u = PhpLib\Set::select(
                      (array)$u->data,
                      array('ID', 'user_login', 'user_nicename', 'user_email', 'display_name')
                    );
              $member['user'][] = $u;
            }

            // Display the users nicely
            $member['users_display'] = implode(', ', PhpLib\Set::extract($member, 'user.*.display_name'));

            $the_exec[] = $member;
        }
        
        wp_reset_postdata(); // Reset global post data
        
        return $the_exec;
    }
    
    /**
     * Returns a single exec member by their postname (e.g. gideon-farrell)
     */
    function kcsu_get_exec_member($name)
    {
        $exec_member;
        
        $args = array(
                      'post_type'       => 'exec',
                      'exec'            => $name,
                      'posts_per_page'  => 1
                      );
        $exec_query = new WP_Query( $args );
        
        while ( $exec_query->have_posts() )
        {
            $exec_query->the_post();
            $exec_member = array(
                                 'id'            => get_the_ID(),
                                 'title'         => get_the_title(),
                                 'description'   => get_the_content(),
                                 'email'         => get_field('email_address'),
                                 'user'          => array(),
                                 'link'          => get_permalink(),
                                 'excerpt'       => get_the_excerpt()
                                 );
            
            // now fetch incumbent data
            $incumbents = explode(',', get_field('incumbent'));
            foreach($incumbents as $incumbent) {
              $u = get_userdatabylogin(trim($incumbent));
              $u = PhpLib\Set::select(
                      (array)$u->data,
                      array('ID', 'user_login', 'user_nicename', 'user_email', 'display_name')
                    );
              $exec_member['user'][] = $u;
            }

            // Display the users nicely
            $exec_member['users_display'] = implode(', ', PhpLib\Set::extract($exec_member, 'user.*.display_name'));
        }
        
        wp_reset_postdata(); // Reset global post data
        
        return $exec_member;
        
    }
    
    /**
     * Returns all events happening before specified date, or in the next week if not supplied.
     */
    function kcsu_get_upcoming_events($time_limit = '')
    {
        $events = array();
        
        if ($time_limit == '')
            $time_limit = date('Ymd', strtotime('+7 days'));
        
        $today = date('Ymd', time());
        
        $args = array(
                      'post_type'       => 'event',
                      'posts_per_page'  => 10,
                      'meta_key'        => 'date',
                      'orderby'         => 'meta_value_num',
                      'order'           => 'ASC',
                      'meta_query'      => array(
                                                'relation' => 'AND',
                                                array(
                                                      'key'     => 'date',
                                                      'value'   => $today,
                                                      'compare' => '>=',
                                                      'type'    => 'NUMERICAL',
                                                      ),
                                                array(
                                                      'key'     => 'date',
                                                      'value'   => $time_limit,
                                                      'compare' => '<=',
                                                      'type'    => 'NUMERICAL',
                                                      ),
                                                
                                                 ),
                      );
        $event_query = new WP_Query( $args );
        
        while ( $event_query->have_posts() )
        {
            $event_query->the_post();
            
            $date = DateTime::createFromFormat('Ymd', get_field('date'));
            
            $events[] = array(
                              'id'          => get_the_ID(),
                              'title'       => get_the_title(),
                              'description' => get_the_content(),
                              'location'    => get_field('location'),
                              'date'        => $date->format('d/m/Y'),
                              'time'        => get_field('time'),
                              'link'        => get_permalink(),
                              'excerpt'     => get_the_excerpt()
                              );
        }
        
        wp_reset_postdata(); // Reset global post data
        
        return $events;
    }
    
    /**
     * Sets the post excerpt length to 40 words
     */
    function kcsu_excerpt_length( $length ) {
        return 40;
    }
    add_filter( 'excerpt_length', 'kcsu_excerpt_length' );

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
