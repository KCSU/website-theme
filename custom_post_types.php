<?php
    
    /**
     * Register custom post types
     */
    
    function kcsu_create_post_types() {
        register_post_type('exec',
            array(
                'labels' => array(
                    'name'          => __('The Exec'),
                    'singular_name' => __('Exec'),
                    'all_items'     => __('The Whole Exec'),
                    'add_new_item'  => __('New Member'),
                    'edit_item'     => __('Edit Profile'),
                    'new_item'      => __('New Profile'),
                    'view_item'     => __('View Profile')
                ),
                'public'        => true,
                'heirarchical'  => false,
                'rewrite'       => array('slug' => 'exec'),
                'supports'      => array('title', 'thumbnail', 'editor', 'excerpt')
            )
        );
        register_post_type('event',
            array(
                'labels' => array(
                    'name'          => __('Events'),
                    'singular_name' => __('Event'),
                    'all_items'     => __('All Events'),
                    'add_new_item'  => __('New Event'),
                    'edit_item'     => __('Edit Event'),
                    'new_item'      => __('New Event'),
                    'view_item'     => __('View Event')
                ),
                'public'        => true,
                'heirarchical'  => false,
                'rewrite'       => array('slug' => 'events'),
                'supports'      => array('title', 'author', 'editor')
            )
        );
        register_post_type('external-event',
            array(
                'labels' => array(
                    'name'          => __('External Events'),
                    'singular_name' => __('External Event'),
                    'all_items'     => __('All External Events'),
                    'add_new_item'  => __('New External Event'),
                    'edit_item'     => __('Edit External Event'),
                    'new_item'      => __('New External Event'),
                    'view_item'     => __('View External Event')
                ),
                'public'        => true,
                'heirarchical'  => false,
                'rewrite'       => array('slug' => 'external-events'),
                'supports'      => array('title', 'author', 'editor')
            )
        );
        register_post_type('classified',
            array(
                'labels' => array(
                    'name'          => __('Marketplace Ads'),
                    'singular_name' => __('Marketplace Ad'),
                    'all_items'     => __('All Marketplace Ads'),
                    'add_new_item'  => __('New Marketplace Ad'),
                    'edit_item'     => __('Edit Marketplace Ad'),
                    'new_item'      => __('New Marketplace Ad'),
                    'view_item'     => __('View Marketplace Ad')
                ),
                'public'          => true,
                'heirarchical'    => false,
                'capability_type' => 'classified',
                'map_meta_cap'    => true,
                'rewrite'         => array('slug' => 'marketplace'),
                'supports'        => array('title', 'author', 'editor')
            )
        );
    }

    function kcsu_remove_menu_items() {
        if (!current_user_can( 'edit_posts' )) {
            remove_menu_page( 'edit.php?post_type=exec' );
            remove_menu_page( 'edit.php?post_type=event' );
            remove_menu_page( 'edit.php?post_type=external-event' );
        }
    }
    
    add_action( 'init', 'kcsu_create_post_types' );
    add_action( 'admin_menu', 'kcsu_remove_menu_items' );
    
?>