<?php
/**
 *  Install Add-ons
 *  
 *  The following code will include all 4 premium Add-Ons in your theme.
 *  Please do not attempt to include a file which does not exist. This will produce an error.
 *  
 *  All fields must be included during the 'acf/register_fields' action.
 *  Other types of Add-ons (like the options page) can be included outside of this action.
 *  
 *  The following code assumes you have a folder 'add-ons' inside your theme.
 *
 *  IMPORTANT
 *  Add-ons may be included in a premium theme as outlined in the terms and conditions.
 *  However, they are NOT to be included in a premium / free plugin.
 *  For more information, please read http://www.advancedcustomfields.com/terms-conditions/
 */ 

// Include ACF in lite mode
global $acf;
 
if( !$acf )
{
    define( 'ACF_LITE' , true );
    include_once(dirname(__file__) . '/lib/advanced-custom-fields/acf.php');
}

/**
 *  Register Field Groups
 *
 *  The register_field_group function accepts 1 array which holds the relevant data to register a field group
 *  You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 */

if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_exec',
        'title' => 'Exec',
        'fields' => array (
            array (
                'key' => 'field_51608cfeb490f',
                'label' => 'email address',
                'name' => 'email_address',
                'type' => 'email',
                'instructions' => 'Exec email address (@kcsu.org.uk)',
                'required' => 1,
                'default_value' => '',
            ),
            array (
                'key' => 'field_516b0e3016d27',
                'label' => 'incumbent(s)',
                'name' => 'incumbent',
                'type' => 'text',
                'instructions' => 'The CRSID of the current incumbent, separate with commas if there are multiple incumbents',
                'required' => 1,
                'default_value' => '',
                'formatting' => 'none',
            )
        ),
        'location' => array (
            'rules' => array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'exec',
                    'order_no' => 0,
                ),
            ),
            'allorany' => 'all',
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
                0 => 'author',
                1 => 'categories',
                2 => 'tags',
                3 => 'custom_fields',
				4 => 'discussion',
				5 => 'comments',
				6 => 'revisions',
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_events',
        'title' => 'Events',
        'fields' => array (
            array (
                'key' => 'field_51608c7f4f268',
                'label' => 'Location',
                'name' => 'location',
                'type' => 'text',
                'instructions' => 'Where is the event going to be?',
                'required' => 1,
                'default_value' => '',
                'formatting' => 'none',
            ),
            array (
                'key' => 'field_5161a7adcd414',
                'label' => 'Date',
                'name' => 'date',
                'type' => 'date_picker',
                'instructions' => 'When is the event going to be?',
                'required' => 1,
                'date_format' => 'yymmdd',
                'display_format' => 'dd/mm/yy',
            ),
            array (
                'key' => 'field_5161a7cfcd415',
                'label' => 'Time',
                'name' => 'time',
                'type' => 'text',
                'instructions' => 'What time is the event going to be at? (HH:MM)',
                'required' => 1,
                'default_value' => '',
                'formatting' => 'none',
            ),
        ),
        'location' => array (
            'rules' => array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'event',
                    'order_no' => 0,
                ),
            ),
            'allorany' => 'all',
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
                0 => 'author',
                1 => 'categories',
                2 => 'tags',
                3 => 'custom_fields',
				4 => 'discussion',
				5 => 'comments',
				6 => 'revisions',
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_external_events',
        'title' => 'External Events',
        'fields' => array (
            array (
                'key' => 'field_516563cd57468',
                'label' => 'Location',
                'name' => 'location',
                'type' => 'text',
                'instructions' => 'Where is the event going to be?',
                'required' => 1,
                'default_value' => '',
                'formatting' => 'none',
            ),
            array (
                'key' => 'field_5164bca25661d',
                'label' => 'Date',
                'name' => 'date',
                'type' => 'date_picker',
                'instructions' => 'When is the event going to be?',
                'required' => 1,
                'date_format' => 'yymmdd',
                'display_format' => 'dd/mm/yy',
            ),
            array (
                'key' => 'field_51636dfeac371',
                'label' => 'Time',
                'name' => 'time',
                'type' => 'text',
                'instructions' => 'What time is the event going to be at? (HH:MM)',
                'required' => 1,
                'default_value' => '',
                'formatting' => 'none',
            ),
        ),
        'location' => array (
            'rules' => array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'external-event',
                    'order_no' => 0,
                ),
            ),
            'allorany' => 'all',
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
                0 => 'author',
                1 => 'categories',
                2 => 'tags',
                3 => 'custom_fields',
				4 => 'discussion',
				5 => 'comments',
				6 => 'revisions',
            ),
        ),
        'menu_order' => 0,
    ));
	register_field_group(array (
		'id' => 'acf_marketplace',
		'title' => 'Marketplace',
		'fields' => array (
			array (
				'key' => 'field_55bb952cdd413',
				'label' => 'Information',
				'name' => '',
				'type' => 'message',
				'instructions' => 'This will be automatically set to two weeks after publishing your ad.',
				'message' => 'Your ad will expire two weeks after the publish date. If you want to extend this, come back and edit the published date accordingly.
	
	You can use the content editor at the bottom to add a description and pictures.',
			),
			array (
				'key' => 'field_55bb8de5bd12f',
				'label' => 'Ad Type',
				'name' => 'ad_type',
				'type' => 'radio',
				'required' => 1,
				'choices' => array (
					'Offering' => 'Offering',
					'Wanted' => 'Wanted',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'Offering',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_55bb8e99bd130',
				'label' => 'Category',
				'name' => 'category',
				'type' => 'select',
				'required' => 1,
				'choices' => array (
					'Books' => 'Books',
					'Clothes' => 'Clothes',
					'Formal Tickets' => 'Formal Tickets',
					'Bikes' => 'Bikes',
					'Room Decor' => 'Room Decor',
					'Kitchen' => 'Kitchen',
					'Other' => 'Other',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_55bb9467dd410',
				'label' => 'Swap or Sell',
				'name' => 'swap_or_sell',
				'type' => 'radio',
				'required' => 1,
				'choices' => array (
					'Swap' => 'Swap',
					'Sell' => 'Sell',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'Sell',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_55bb948cdd411',
				'label' => 'Asking price',
				'name' => 'asking_price',
				'type' => 'text',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55bb9467dd410',
							'operator' => '==',
							'value' => 'Sell',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55bb94dadd412',
				'label' => 'Swap for',
				'name' => 'swap_for',
				'type' => 'text',
				'instructions' => 'Suggestions of what you\'d like to swap for',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55bb9467dd410',
							'operator' => '==',
							'value' => 'Swap',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55bb973cdd415',
				'label' => 'Sold',
				'name' => 'sold',
				'type' => 'checkbox',
				'instructions' => 'Tick once a swap or sale has been agreed to hide your ad.',
				'choices' => array (
					'My item has been swapped or sold' => 'My item has been swapped or sold',
				),
				'default_value' => '',
				'layout' => 'vertical',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'classified',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'excerpt',
				2 => 'custom_fields',
				3 => 'discussion',
				4 => 'comments',
				5 => 'revisions',
				6 => 'slug',
				7 => 'author',
				8 => 'format',
				9 => 'featured_image',
				10 => 'categories',
				11 => 'tags',
				12 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}
?>
