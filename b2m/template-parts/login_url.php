<?php
	
add_action('login_form','redirect_wp_admin'); 
function redirect_wp_admin(){
$redirect_to = $_SERVER['REQUEST_URI']; 
 if(count($_REQUEST)> 0 && array_key_exists('redirect_to', $_REQUEST)){
    $redirect_to = $_REQUEST['redirect_to'];
    $check_wp_admin = stristr($redirect_to, 'wp-admin');    
    if($check_wp_admin){
        wp_safe_redirect( 'http://192.168.6.20/b2m/' );
    }
 }
}
add_action( 'init', 'force_404', 1 );
function force_404() {
    $requested_uri = $_SERVER["REQUEST_URI"];
    $login =  $requested_uri. '/wp-login.php';
    if (strpos( $requested_uri, '/wp-login.php') !== false ) {
        if($login){            
         wp_safe_redirect( 'http://192.168.6.20/b2m/' );
        }
        // The redirect code
//        status_header( 404 );
//        nocache_headers();
//        include( get_query_template( '404' ) );
//        die();
    }
}


