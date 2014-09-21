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
    include_once('/lib/advanced-custom-fields/acf.php');
}

// Fields 
add_action('acf/register_fields', 'my_register_fields');

function my_register_fields()
{
    //include_once('add-ons/acf-repeater/repeater.php');
    //include_once('add-ons/acf-gallery/gallery.php');
    //include_once('add-ons/acf-flexible-content/flexible-content.php');
}

// Options Page 
//include_once( 'add-ons/acf-options-page/acf-options-page.php' );


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
            ),
        ),
        'menu_order' => 0,
    ));
}
?>
