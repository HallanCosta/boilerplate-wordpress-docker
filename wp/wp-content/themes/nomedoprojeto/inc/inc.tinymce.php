<?php

/* @link https://anythinggraphic.net/paste-as-text-by-default-in-wordpress
/* Use Paste As Text by default in the editor
----------------------------------------------------------------------------------------*/
add_filter('tiny_mce_before_init', 'ag_tinymce_paste_as_text');
function ag_tinymce_paste_as_text( $init ) {
	$init['paste_as_text'] = true;
	return $init;
}



// Customize Tiny mce editor font sizes for WordPress

if ( ! function_exists( 'am_tiny_mce_font_size' ) ) {
    function am_tiny_mce_font_size( $initArray ){
        $initArray['fontsize_formats'] = "16px 18px 21px 24px 28px 32px 36px";// Add as needed
        return $initArray;
    }
}

add_filter( 'tiny_mce_before_init', 'am_tiny_mce_font_size' );



// TinyMCE: First line toolbar customizations

if( !function_exists('base_extended_editor_mce_buttons') )
{
    function base_extended_editor_mce_buttons($buttons)
    {
        /* wp_die(
            var_export($buttons, true)
        ); */

        return [
            'fontsizeselect',
            'bold',
            'italic',
            'strikethrough',
            'underline',
            'bullist',
            'numlist',
            //'blockquote',
            'alignleft',
            'aligncenter',
            'alignright',
            'link',
            'removeformat',
            //'spellchecker',
            //'dfw',
        ];
	}
	add_filter("mce_buttons", "base_extended_editor_mce_buttons", 0);
}



// TinyMCE: Second line toolbar customizations

/* if( !function_exists('base_extended_editor_mce_buttons_2') )
{
    function base_extended_editor_mce_buttons_2($buttons)
    {
        return [
            'strikethrough',
            'forecolor',
            'pastetext',
            'removeformat',
            'charmap',
            'outdent',
            'indent',
            'undo',
            'redo',
            'wp_help'
        ];
	}
	add_filter("mce_buttons_2", "base_extended_editor_mce_buttons_2", 0);
} */

function wpse41427_remove_quicktags( $qtInit ) {
    $qtInit['buttons'] = 'strong,link,del,img,ul,ol,li,spell,close';
    return $qtInit;
}

add_filter('quicktags_settings', 'wpse41427_remove_quicktags');












add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
function my_toolbars( $toolbars )
{
	// Uncomment to view format of $toolbars
	/*
	echo '< pre >';
		print_r($toolbars);
	echo '< /pre >';
	die;
	*/

	// Add a new toolbar called "Teste"
	// - this toolbar has only 1 row of buttons
	$toolbars['Teste' ] = array();
    $toolbars['Teste' ][1] = array('bold' , 'italic' , 'underline', 'removeformat' );

	$toolbars['TesteLink' ] = array();
	$toolbars['TesteLink' ][1] = array('bold' , 'italic' , 'underline', 'link', 'removeformat' );

	// Edit the "Full" toolbar and remove 'code'
	// - delet from array code from http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key
	if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
	{
	    unset( $toolbars['Full' ][2][$key] );
	}

	// remove the 'Basic' toolbar completely
	unset( $toolbars['Basic' ] );

	// return $toolbars - IMPORTANT!
	return $toolbars;
}