<?php

// Loging logo images change
function my_login_logo() {
    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo-b2m.png);
            height:121px;
            width:320px;
            background-size: 320px 120px;
            background-repeat: no-repeat;
        }
    </style>
    <?php
}
add_action('login_enqueue_scripts', 'my_login_logo');
?>  
<!--Avatar images change-->
<?php
add_filter('get_avatar', 'my_custom_avatar', 1, 5);
function my_custom_avatar($avatar, $id_or_email, $size, $default, $alt) {
    $user = false;
    if (is_numeric($id_or_email)) {
        $id = (int) $id_or_email;
        $user = get_user_by('id', $id);
    } elseif (is_object($id_or_email)) {
        if (!empty($id_or_email->user_id)) {
            $id = (int) $id_or_email->user_id;
            $user = get_user_by('id', $id);
        }
    } else {
        $user = get_user_by('email', $id_or_email);
    }
    if ($user && is_object($user)) {
        if ($user->data->ID == '1') {
            $avatar = get_stylesheet_directory_uri() . '/img/logo-b2m.png';
            $avatar = "<img alt='{$alt}' src='{$avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
        }
    }
    return $avatar;
}
?> 
<?php

// Login logo Url change
function my_login_logo_url() {
    return home_url();
}

add_filter('login_headerurl', 'my_login_logo_url');
// Login logo title change
function my_login_logo_url_title() {
//    return 'B2M';
    return home_url('/');
}

add_filter('login_headertitle', 'my_login_logo_url_title');
// Change howdy to welcome
function wp_admin_bar_my_custom_account_menu($wp_admin_bar) {
    $user_id = get_current_user_id();
    $current_user = wp_get_current_user();
    $profile_url = get_edit_profile_url($user_id);
    if (0 != $user_id) {
        /* Add the "My Account" menu */
        $avatar = get_avatar($user_id, "");
        $howdy = sprintf(__('Welcome, %1$s'), $current_user->display_name);
        $class = empty($avatar) ? '' : 'with-avatar';
        $wp_admin_bar->add_menu(array(
            'id' => 'my-account',
            'parent' => 'top-secondary',
            'title' => $howdy . $avatar,
            'href' => $profile_url,
            'meta' => array(
                'class' => $class,
            ),
        ));
    }
}
add_action('admin_bar_menu', 'wp_admin_bar_my_custom_account_menu', 11);

