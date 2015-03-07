<?php

if ( ! function_exists( 'batel_site_branding' ) ) {
    /**
     * Display Site Branding
     * @since  1.0.0
     * @return void
     */
    function batel_site_branding() {
        if ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
            jetpack_the_site_logo();
        } else { ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
        <?php }
    }
}

if ( ! function_exists( 'batel_setup' ) ) {
    function batel_setup() {
        add_theme_support( 'site-logo' );
        load_child_theme_textdomain( 'batel', get_stylesheet_directory() . '/languages' );
    }
}

class Batel {
    public function addCustomizerOptions($wpCustomizer)
    {
//        require_once dirname( __FILE__ ) . '/customizer/controls/layout.php';
//        $options['batel-header-background-color'] = array(
//            'id' => 'batel-header-background-color',
//            'label'   => __( 'Batel header background Color', 'batel' ),
//            'section' => 'topshop-styling',
//            'type'    => 'color',
//            'default' => '#90c962',
//        );
//
//        $wpCustomizer->add_control( new LayoutPickerBatelControl( $wpCustomizer, 'batel_layout', array(
//            'label'    => __( 'General layout', 'batel' ),
//            'section'  => 'batel_layout',
//            'settings' => 'topshop-social',
//            'priority' => 100,
//        ) ) );

        $wpCustomizer->add_section( 'storefront_layout' , array(
            'title'      	=> __( 'Layout', 'storefront' ),
            'priority'   	=> 50,
        ) );

        $wpCustomizer->add_setting( 'storefront_layout', array(
            'default'    		=> 'right',
            'sanitize_callback' => 'storefront_sanitize_layout',
        ) );

        $wpCustomizer->add_control( new LayoutPickerBatelControl( $wpCustomizer, 'storefront_layout', array(
            'label'    => __( 'General layout', 'storefront' ),
            'section'  => 'storefront_layout',
            'settings' => 'storefront_layout',
            'priority' => 1,
        ) ) );
//
//        $wp_customize->add_control( new Arbitrary_Storefront_Control( $wp_customize, 'storefront_divider', array(
//            'section'  	=> 'storefront_layout',
//            'type' 		=> 'divider',
//            'priority' 	=> 2,
//        ) ) );
        $customizer_library = Customizer_Library::Instance();
        $customizer_library->add_options( $options );

    }

    public function customizerBuildStyles()
    {
        $color = 'batel-header-background-color';
        $bgcolormod = get_theme_mod( $color, customizer_library_get_default( $color ) );


        $sancolor = sanitize_hex_color( $bgcolormod );

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
                '#masthead',
                '.site-top-bar .site-container',
                '.topshop-header-layout-standard .site-top-bar-left',
                '.topshop-header-layout-standard .site-top-bar-right',
            ),
            'declarations' => array(
                'background-color' => $sancolor
            )
        ) );

    }
}
$batel = new Batel();

//add_action( 'init', array( $batel, 'addCustomizerOptions' ) );

add_action( 'customize_register', array( $batel, 'addCustomizerOptions') );
add_action( 'customizer_library_styles', array( $batel, 'customizerBuildStyles' ) );

add_action( 'after_setup_theme', 'batel_setup' );
add_action( 'batel_header', 'batel_site_branding', 20 );
?>