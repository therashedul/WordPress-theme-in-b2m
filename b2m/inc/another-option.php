
<?php
    /**********************************************************************
 *            Theme settings
 ********************************************************************/
class My_Cool_Theme_Customize {
    public static function register ( $wp_customize ) {
        // Define a new section for the Appearance -> Customize page
        $wp_customize->add_section( 'ts_company_details',
            array(
                'title'       => __( 'Company Details', 'my_cool_theme' ),
                'priority'    => 1, // Determines what order this appears in (1 = top)
                'capability'  => 'edit_theme_options', // Capability needed to tweak
                'description' => __('Set your company details.', 'my_cool_theme'),
            )
        );
 
        // 2.0 Register the new "company_name" setting
        $wp_customize->add_setting( 'company_name', // id of the setting, no need to prefix when using 'theme_mod' as type
            array(
                'default'    => '', // Default setting/value to save
                'type'       => 'theme_mod', // 'theme_mod' or 'option'. [print-theme-settings] only supports theme related settings (theme_mod)
                'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
                'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant).
            )
        );
 
        // 2.1 Define an input for the "company_name" setting
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            'ts_company_name_control', // unique ID for the control
            array(
                'label'      => __( 'Company Name', 'my_cool_theme' ),
                'settings'   => 'company_name', // id of previously created setting "company_name"
                'type'       => 'text',
                'section'    => 'ts_company_details', // ID of our "Company Details" section
            )
        ) );
 
        // 3.0 Register another setting, "company_address"
        $wp_customize->add_setting( 'company_address',
            array(
                'default'    => '',
                'type'       => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport'  => 'refresh',
            )
        );
 
        // 3.1 Define an input for the new "company_address" setting
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            'ts_company_address_control',
            array(
                'label'      => __( 'Company Address', 'mytheme' ),
                'settings'   => 'company_address',
                'type'       => 'textarea',
                'section'    => 'ts_company_details',
            )
        ) );
 
        // 4.0 Register another setting, "company_logo"
        $wp_customize->add_setting( 'company_logo',
            array(
                'default'    => '',
                'type'       => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport'  => 'refresh',
            )
        );
        // 4.1 Define an image selector input for the "company_logo" setting
        $wp_customize->add_control( new WP_Customize_Image_Control( // <- Important: to use image selector we use WP_Customize_Image_Control() instead of WP_Customize_Control()
            $wp_customize,
            'ts_company_logo_control',
            array(
                'label'      => __( 'Upload a logo', 'theme_name' ),
                'settings'   => 'company_logo',
                'section'    => 'ts_company_details',
            )
        ) );
    }
}
 
//  Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'My_Cool_Theme_Customize' , 'register' ) );
 
//  Register shortcode: [print-theme-setting id="id of the setting" default="(optional) value to show if setting has no value"]
add_shortcode( 'print-theme-setting', 'shortcode_print_theme_setting' );
 
if( ! function_exists( 'shortcode_print_theme_setting') ) {
    function shortcode_print_theme_setting( $attributes ) {
        $setting = shortcode_atts(
            array(
                'id' => false,
                'default' => ''
            ), $attributes, 'print_theme_option' );
 
        if( ! $setting['id'] ) {
            //  no setting ID set, return default value
            return $setting['default'];
        }
 
        $stored = get_theme_mod( $setting['id'] );
 
        if( ! $stored || empty( $stored ) ) {
            // return default as no value is stored
            return $setting['default'];
        }
 
        //  return the setting value
        return nl2br( $stored );
    }
}