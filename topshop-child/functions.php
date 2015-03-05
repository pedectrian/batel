<?php

namespace Pedectrian\Batel;

class Batel {
    public function __construct() {

        add_action( 'after_setup_theme', array( $this, 'batelSetup' ) );

        add_action( 'batel_header', array($this, 'batelSiteBranding', 20 ) );

        add_action( 'init', array( $this, 'addCustomizerOptions' ) );
        add_action( 'customizer_library_styles', array( $this, 'customizerBuildStyles' ) );
    }

    public function batelSetup() {
        add_theme_support( 'site-logo' );
    }

    public function batelSiteBranding() {
        if ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
            jetpack_the_site_logo();
        } else { ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
        <?php }
    }

    public function addCustomizerOptions()
    {
        $options['batel-header-background-color'] = array(
            'id' => 'batel-header-background-color',
            'label'   => __( 'Batel header background Color', 'batel' ),
            'section' => 'topshop-styling',
            'type'    => 'color',
            'default' => '#90c962',
        );

        $customizer_library = \Customizer_Library::Instance();
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
?>