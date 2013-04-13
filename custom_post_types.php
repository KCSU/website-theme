<?php
/**
 * Register custom post types
 */
add_action( 'init', 'create_post_types' );
function create_post_types() {
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
    register_post_type('marketplace',
        array(
            'labels' => array(
                'name'          => __('Goods'),
                'singular_name' => __('Item'),
                'all_items'     => __('All Goods'),
                'add_new_item'  => __('New Item'),
                'edit_item'     => __('Edit Item'),
                'new_item'      => __('New Item'),
                'view_item'     => __('View Item')
            ),
            'public'        => true,
            'heirarchical'  => false,
            'rewrite'       => array('slug' => 'marketplace'),
            'supports'      => array('title', 'editor', 'custom-fields')
        )
    );
}
?>