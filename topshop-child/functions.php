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
    }
}

class Batel {
    public function addCustomizerOptions()
    {
        $options['batel-header-background-color'] = array(
            'id' => 'batel-header-background-color',
            'label'   => __( 'Batel header background Color', 'batel' ),
            'section' => 'topshop-styling',
            'type'    => 'color',
            'default' => '#90c962',
        );

        $customizer_library = Customizer_Library::Instance();
        $customizer_library->add_options( $options );
    }
}
$batel = new Batel();

add_action( 'init', [$batel, 'addCustomizerOptions'] );
add_action( 'after_setup_theme', 'batel_setup' );
add_action( 'batel_header', 'batel_site_branding', 20 );
?>