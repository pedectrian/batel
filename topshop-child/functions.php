<?php

if ( ! function_exists( 'batel_site_branding' ) ) {
    /**
     * Display Site Branding
     * @since  1.0.0
     * @return void
     */
    function batel_site_branding() {
        if ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) { ?>
            <a href="http://batel-store.ru/" class="site-logo-link" rel="home" itemprop="url">
                <img width="199" height="131" src="http://batel-store.ru/wp-content/uploads/2015/04/white-logo-v21.png" class="site-logo attachment-full" alt="white-logo-v2" data-size="full" itemprop="logo">
            </a>
       <?php } else { ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
        <?php }
    }
}

if ( ! function_exists( 'batel_setup' ) ) {
    function batel_setup() {
        add_theme_support( 'site-logo', 150, 150, 0 );
        load_child_theme_textdomain( 'batel', get_stylesheet_directory() . '/languages' );
    }
}

function batel_sanitize_layout( $input ) {
    $valid = array(
        'right' => 'Right',
        'left'  => 'Left',
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

function batel_layout_class( $classes ) {
    $layout = get_theme_mod( 'batel_layout' );

    if ( '' == $layout ) {
        $layout = 'right';
    }

    $classes[] = $layout . '-sidebar';

    return $classes;
}

class Batel {
    public function addCustomizerOptions($wp_customize)
    {
        require_once dirname( __FILE__ ) . '/customizer/controls/layout.php';
        require_once dirname( __FILE__ ) . '/customizer/controls/arbitrary.php';
//        $options['batel-header-background-color'] = array(
//            'id' => 'batel-header-background-color',
//            'label'   => __( 'Batel header background Color', 'batel' ),
//            'section' => 'topshop-styling',
//            'type'    => 'color',
//            'default' => '#90c962',
//        );
//

        $wp_customize->add_section( 'batel_layout' , array(
            'title'      	=> __( 'Layout', 'batel' ),
            'priority'   	=> 50,
        ) );

        $wp_customize->add_setting( 'batel_layout', array(
            'default'    		=> 'right',
            'sanitize_callback' => 'batel_sanitize_layout',
        ) );

        $wp_customize->add_control( new LayoutPickerBatelControl( $wp_customize, 'batel_layout', array(
            'label'    => __( 'General layout', 'batel' ),
            'section'  => 'batel_layout',
            'settings' => 'batel_layout',
            'priority' => 1,
        ) ) );

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
add_filter( 'body_class', 'batel_layout_class' );
?>