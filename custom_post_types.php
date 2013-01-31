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
                'all_items'     => __('the whole exec'),
                'add_new_item'  => __('new member'),
                'edit_item'     => __('edit profile'),
                'new_item'      => __('new profile'),
                'view_item'     => __('view profile')
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
                'singular_name' => __('event'),
                'all_items'     => __('all events'),
                'add_new_item'  => __('new event'),
                'edit_item'     => __('edit event'),
                'new_item'      => __('new event'),
                'view_item'     => __('view event')
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
                'singular_name' => __('item'),
                'all_items'     => __('all goods'),
                'add_new_item'  => __('new item'),
                'edit_item'     => __('edit item'),
                'new_item'      => __('new item'),
                'view_item'     => __('view item')
            ),
            'public'        => true,
            'heirarchical'  => false,
            'rewrite'       => array('slug' => 'marketplace'),
            'supports'      => array('title', 'editor', 'custom-fields')
        )
    );
}
?>