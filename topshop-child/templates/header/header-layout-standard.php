<?php global $woocommerce; ?>

<?php if( get_theme_mod( 'topshop-show-header-top-bar', true ) ) : ?>
    
    <div class="site-top-bar border-bottom">
        <div class="site-container">
            
            <div class="site-top-bar-left">
                
                <?php wp_nav_menu( array( 'theme_location' => 'top-bar', 'fallback_cb' => false, 'depth'  => 1 ) ); ?>
                
            </div>
            <div class="site-top-bar-right">
                
                <?php if ( topshop_is_woocommerce_activated() ) : ?>
                    <div class="site-top-bar-left-text"><?php echo wp_kses_post( get_theme_mod( 'topshop-header-info-text', false ) ) ?></div>
                <?php endif; ?>
                
                <?php if( get_theme_mod( 'topshop-header-search', false ) ) : ?>
                    <i class="fa fa-search search-btn"></i>
                <?php endif; ?>
                
            </div>
            <div class="clearboth"></div>
            
            <?php if( get_theme_mod( 'topshop-header-search', false ) ) : ?>
                <div class="search-block">
                    <?php get_search_form(); ?>
                </div>
            <?php endif; ?>
            
        </div>
        
    </div>

<?php endif; ?>

<div class="site-container">

    <div class="site-header-left">
        <?php do_action( 'batel_header' ); ?>
    </div><!-- .site-branding -->
    
    <div class="site-header-right">
        
        <?php
        if ( topshop_is_woocommerce_activated() ) { ?>
        
            <?php if ( is_user_logged_in() ) { ?>
                <div class="site-header-right-link"><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','topshop'); ?>"><?php _e('My Account','topshop'); ?></a></div>
            <?php } else { ?>
                <div class="site-header-right-link"><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login','topshop'); ?>"><?php _e('Sign In / Register','topshop'); ?></a></div>
            <?php } ?>
            <div class="header-cart">
                <a class="header-cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'topshop'); ?>">
                    <span class="header-cart-amount">
                        <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'topshop'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?>
                    </span>
                    <span class="header-cart-checkout<?php echo ( $woocommerce->cart->cart_contents_count > 0 ) ? ' cart-has-items' : ''; ?>">
                        <span><?php _e('Checkout', 'topshop'); ?></span> <i class="fa fa-shopping-cart"></i>
                    </span>
                </a>
            </div>
            
        <?php
        } else { ?>
            
            <div class="site-top-bar-left-text"><?php echo wp_kses_post( get_theme_mod( 'topshop-header-info-text', false ) ) ?></div>
            
        <?php
        } ?>
        
    </div>
    <div class="clearboth"></div>
    
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.product-categories > .cat-item > .count').each(function(){
            var type = 'open';
            if (
               $(this).parent().hasClass('current-cat-parent') ||
               $(this).parent().hasClass('current-cat')
            ) {
                type='close';
            }

            $(this).after('<div class="' + type + '"><div class="plus">+</div><div class="minus">-</div></div>');
        });

        $('.product-categories > .cat-item > .open').on('click', function(){
            if ($(this).parent().hasClass('current-cat-parent')) {
                $(this).parent().toggleClass('current-cat-parent');
            } else {
                $(this).parent().toggleClass('current-cat');
            }
            $(this).toggleClass('open');
            $(this).toggleClass('close');
        });

        $('.product-categories > .cat-item > .close').on('click', function(){
            $(this).parent().toggleClass('current-cat');
            $(this).toggleClass('open');
            $(this).toggleClass('close');
        })
    })
</script>
<nav id="site-navigation" class="main-navigation nav-load<?php echo ( get_theme_mod( 'topshop-sticky-header', false ) ) ? ' header-stick' : ''; ?>" role="navigation">
    
    <div class="site-container">
        
        <button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( 'Menu', 'topshop' ); ?></button>
        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        
    </div>
    
</nav><!-- #site-navigation -->