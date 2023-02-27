<?php

function remove_media_tab( $strings )
{
    //if( current_user_can( 'editor' ) ) {
        $strings["createGalleryTitle"] = "";
        $strings["setFeaturedImageTitle"] = "";
        //$strings["insertFromUrlTitle"] = "";
        $strings['createPlaylistTitle'] = "";
        $strings['createVideoPlaylistTitle'] = "";
    //}
    return $strings;
}

add_filter( 'media_view_strings', 'remove_media_tab' );

add_filter( 'media_library_show_audio_playlist', function(){ 
    return false; 
}, 10, 1 );

add_filter( 'media_library_show_video_playlist', function(){ 
    return false; 
}, 10, 1 );
