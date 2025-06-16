<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<nav class="navbar" id="navbar">
    <div class="navbar-container">
        <!-- Logo - LEFT SIDE -->
        <div class="logo-wrapper">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                    <div class="logo-icon">EJ</div>
                    <span class="logo-text">ESPRESSO JOINT</span>
                </a>
            <?php endif; ?>
        </div>
        
        <!-- Navigation Menu - RIGHT SIDE -->
        <div class="nav-menu-wrapper">
            <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Toggle menu">
                <i class="fas fa-bars"></i>
            </button>
            
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class' => 'nav-menu',
                'container' => false,
                'fallback_cb' => 'espresso_joint_default_menu',
            ));
            ?>
        </div>
    </div>
</nav>

<?php
// Default menu fallback
function espresso_joint_default_menu() {
    ?>
    <ul class="nav-menu">
        <li><a href="#about" class="nav-link"><?php _e('About', 'espresso-joint'); ?></a></li>
        <li><a href="#menu" class="nav-link"><?php _e('Menu', 'espresso-joint'); ?></a></li>
        <li><a href="#contact" class="nav-link"><?php _e('Contact', 'espresso-joint'); ?></a></li>
        <li><a href="#order" class="btn-primary"><?php _e('Order Online', 'espresso-joint'); ?></a></li>
    </ul>
    <?php
}
?>