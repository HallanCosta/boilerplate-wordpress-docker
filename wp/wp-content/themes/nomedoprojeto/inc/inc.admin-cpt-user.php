<?php


//prevent editor from deleting, editing, or creating an administrator
// only needed if the editor was given right to edit users
 
/* class ISA_User_Caps
{
    // Add our filters

    function __construct()
    {
        add_filter('editable_roles', array(&$this, 'editable_roles'));
        add_filter('map_meta_cap', array(&$this, 'map_meta_cap'), 10, 4);
    }

    // Remove 'Administrator' from the list of roles if the current user is not an admin

    function editable_roles($roles)
    {
        if( isset( $roles['administrator'] ) && !current_user_can('administrator') ) {
            unset( $roles['administrator'] );
        }

        return $roles;
    }

    // If someone is trying to edit or delete an
    // admin and that user isn't an admin, don't allow it

    function map_meta_cap( $caps, $cap, $user_id, $args )
    {
        switch ($cap)
        {
            case 'edit_user':

            case 'remove_user':

            case 'promote_user':

                if( isset($args[0]) && $args[0] == $user_id )
                    break;
                elseif( !isset($args[0]) )
                    $caps[] = 'do_not_allow';
                $other = new WP_User( absint($args[0]) );
                if( $other->has_cap( 'administrator' ) ){
                    if(!current_user_can('administrator')){
                        $caps[] = 'do_not_allow';
                    }
                }

                break;

            case 'delete_user':

            case 'delete_users':

                if( !isset($args[0]) )
                    break;
                $other = new WP_User( absint($args[0]) );
                if( $other->has_cap( 'administrator' ) ){
                    if(!current_user_can('administrator')){
                        $caps[] = 'do_not_allow';
                    }
                }

                break;

            default:

                break;

        }
        return $caps;
    }
}

$isa_user_caps = new ISA_User_Caps(); */



// Um editor consegue definir/alterar apenas o papel de EDITOR

function wdm_user_role_dropdown($all_roles)
{
    global $pagenow;

    if ( current_user_can('editor') )
    {
        if ( $pagenow == 'user-edit.php' || $pagenow == 'user-new.php' || $pagenow == 'users.php' )
        {
            // if current user is editor AND current page is edit user page
            unset($all_roles['subscriber']);
            unset($all_roles['author']);
            unset($all_roles['contributor']);
            unset($all_roles['administrator']);
        }
    }

    return $all_roles;
}

add_filter('editable_roles', 'wdm_user_role_dropdown');

/* function wdm_user_role_dropdown($all_roles) {

    global $pagenow;

    if( current_user_can('editor') && $pagenow == 'user-edit.php' ) {
        // if current user is editor AND current page is edit user page
        unset($all_roles['administrator']);
        unset($all_roles['editor']);
    }

    return $all_roles;
}
add_filter('editable_roles','wdm_user_role_dropdown'); */



// Mostra somente editores na lista de usuários do EDITOR

function isa_pre_user_query($user_search)
{
    //if ( is_user_logged_in() && !current_user_can('manage_options') )
    if ( is_user_logged_in() && current_user_can('editor') )
    {
        global $wpdb;

        $user_search->query_where = str_replace(
            'WHERE 1=1', 
            "WHERE 1=1 AND {$wpdb->users}.ID IN (
                SELECT {$wpdb->usermeta}.user_id FROM $wpdb->usermeta 
                WHERE {$wpdb->usermeta}.meta_key = '{$wpdb->prefix}capabilities'
                AND {$wpdb->usermeta}.meta_value NOT LIKE '%administrator%'
            )", 
            $user_search->query_where
        );
    }
}

add_action('pre_user_query', 'isa_pre_user_query');