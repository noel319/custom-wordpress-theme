<?php
/**
 * Hero Section Template Part
 */

// Check if this section should be replaced by Elementor
if (is_active_sidebar('hero-section')) {
    echo '<section id="hero" class="hero-widget-area">';
    dynamic_sidebar('hero-section');
    echo '</section>';
    return;
}
?>

<section id="hero" class="hero">
    <div class="hero-content">
        <h1 class="font-display">
            Artisanal 
            <span class="styled-word" data-text="coffee">coffee</span> 
            and exceptional 
            <span class="styled-word" data-text="food">food</span>
        </h1>
        <div class="hero-divider"></div>
        <p>
            <?php echo esc_html(get_theme_mod('hero_subtitle', 'Your neighborhood spot for the perfect espresso, breakfast & lunch experience.')); ?>
        </p>
        <div class="hero-buttons">
            <a href="#menu" class="btn-hero-primary">
                <?php _e('Explore Menu', 'espresso-joint'); ?>
            </a>
            <a href="#contact" class="btn-hero-secondary">
                <?php _e('Find Us', 'espresso-joint'); ?>
            </a>
        </div>
    </div>
</section>