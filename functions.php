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
     * Enable auto-updates
     */
    define( 'WP_AUTO_UPDATE_CORE', true );
    
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
    // Note: Need to do this after setup to stop clashes with other installed ACF.
    function register_kcsu_acf() {
        require_once('custom_fields.php');
    }
    add_action('after_setup_theme', 'register_kcsu_acf');
     
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
              $u = get_user_by('login', trim($incumbent));
              if (empty($u->ID))
              {
                  $u = get_user_by('login', 'Exec');
              }
              if(function_exists('get_wp_user_avatar')) {
                $avatar_full = get_wp_user_avatar( $u->ID, $size = '100' );
              } else {
                $avatar_full = get_avatar( $u->ID, $size = '100' );
              }
              $avatar_image_src = "";
              if(!empty($avatar_full)){
                  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $avatar_full, $matches, PREG_SET_ORDER);
                  $avatar_image_src = !empty($matches) ? $matches [0] [1] : "";
              }
              $avatar = '<img class="profile-pic" src="'.$avatar_image_src.'" alt="" />';
              $member['user'][] = array(
                                        'ID'            => $u->ID,
                                        'login'         => $u->user_login,
                                        'nicename'      => $u->user_nicename,
                                        'email'         => $u->user_email,
                                        'display_name'  => $u->first_name . ' ' . $u->last_name,
                                        'avatar'        => $avatar
                                        );
            }

            // Display the users nicely
            $member['users_display'] = implode(', ', PhpLib\Set::extract($member, 'user.*.display_name'));
            // and their avatars
            $member['users_avatars'] = implode('', PhpLib\Set::extract($member, 'user.*.avatar'));

            $the_exec[] = $member;
        }
        
        wp_reset_postdata(); // Reset global post data
        
        return $the_exec;
    }
    
    /**
     * Returns a single exec member by their postname (e.g. president)
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
              $u = get_user_by('login', trim($incumbent));
              if (empty($u->ID))
              {
                  $u = get_user_by('login', 'Exec');
              }
              if(function_exists('get_wp_user_avatar')) {
                $avatar_full = get_wp_user_avatar( $u->ID, $size = '100' );
              } else {
                $avatar_full = get_avatar( $u->ID, $size = '100' );
              }
              $avatar_image_src = "";
              if(!empty($avatar_full)){
                  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $avatar_full, $matches, PREG_SET_ORDER);
                  $avatar_image_src = !empty($matches) ? $matches [0] [1] : "";
              }
              $avatar = '<img class="profile-pic" src="'.$avatar_image_src.'" alt="" />';
              $exec_member['user'][] = array(
                                        'ID'            => $u->ID,
                                        'login'         => $u->user_login,
                                        'nicename'      => $u->user_nicename,
                                        'email'         => $u->user_email,
                                        'display_name'  => $u->first_name . ' ' . $u->last_name,
                                        'avatar'        => $avatar
                                        );
            }

            // Display the users nicely
            $exec_member['users_display'] = implode(', ', PhpLib\Set::extract($exec_member, 'user.*.display_name'));
            // and their avatars
            $exec_member['users_avatars'] = implode('', PhpLib\Set::extract($exec_member, 'user.*.avatar'));
        }
        
        wp_reset_postdata(); // Reset global post data
        
        return $exec_member;
        
    }
    
    /**
     * Returns all events happening before specified date, or in the next week if not supplied. Defaults to internal events, but can return external (type=1) or all events (type=22) too.
     */
    function kcsu_get_upcoming_events($time_limit = '', $type = 0)
    {
        $events = array();
        
        if ($time_limit == '')
            $time_limit = date('Ymd', strtotime('+7 days'));
        
        $today = date('Ymd', time());
        
        switch ($type) {
            case 0:
                $post_type_query = array('event');
                break;
            case 1:
                $post_type_query = array('external-event');
                break;
            case 2:
                $post_type_query = array('event', 'external-event');
                break;
            default:
                $post_type_query = array('event');
                break;
        }
        
        $args = array(
                      'post_type'       => $post_type_query,
                      'posts_per_page'  => 50,
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
    
    // Add our widgets
    /**
     * Register our sidebars and widgetized areas.
     *
     */
    function kcsu_widgets_init() {
        
        register_sidebar( array(
                                'name'          => 'Home sidebar before menu',
                                'id'            => 'home_right_1',
                                'before_widget' => '<div>',
                                'after_widget'  => '</div>',
                                'before_title'  => '<h2>',
                                'after_title'   => '</h2>',
                                ) );
        
        register_sidebar( array(
                                'name'          => 'Home sidebar after menu',
                                'id'            => 'home_right_2',
                                'before_widget' => '<div>',
                                'after_widget'  => '</div>',
                                'before_title'  => '<h2>',
                                'after_title'   => '</h2>',
                                ) );
    }
    add_action( 'widgets_init', 'kcsu_widgets_init' );
    require_once('custom_widgets.php');
    
?>