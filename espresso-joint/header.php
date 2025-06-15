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
    <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
        <!-- Logo -->
        <div class="logo">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <div class="logo-icon">EJ</div>
                <span class="logo-text">
                    <?php bloginfo('name'); ?>
                </span>
            <?php endif; ?>
        </div>
        
        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Toggle menu">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Navigation Menu -->
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_class' => 'nav-menu',
            'container' => false,
            'fallback_cb' => 'espresso_joint_default_menu',
        ));
        ?>
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