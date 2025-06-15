<?php
/**
 * About Section Template Part
 */

// Check if this section should be replaced by Elementor
if (is_active_sidebar('about-section')) {
    echo '<section id="about" class="about-widget-area">';
    dynamic_sidebar('about-section');
    echo '</section>';
    return;
}
?>

<section id="about" class="about-section">
    <div class="container">
        <div class="about-content">
            <div class="about-text">
                <div>
                    <h2 class="font-display">
                        <?php echo esc_html(get_theme_mod('about_title', 'Our Story')); ?>
                    </h2>
                    <div class="about-divider"></div>
                    <p>
                        <?php echo esc_html(get_theme_mod('about_text_1', 'At Espresso Joint, we\'re passionate about crafting the perfect cup. Our expert baristas bring years of experience to every espresso shot, cappuccino, and cold brew we serve. We believe in quality, consistency, and creating a welcoming space for coffee lovers.')); ?>
                    </p>
                    <p>
                        <?php echo esc_html(get_theme_mod('about_text_2', 'Every bean is carefully sourced from sustainable farms, roasted to perfection, and brewed with precision. Whether you\'re starting your day or taking an afternoon break, we\'re here to make your coffee moment special.')); ?>
                    </p>
                </div>
                <div style="margin-top: 32px;">
                    <img 
                        src="https://images.unsplash.com/photo-1541014741259-de529411b96a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                        alt="<?php _e('Fresh chicken bowl with vegetables', 'espresso-joint'); ?>"
                        style="max-width: 384px; margin: 0 auto; display: block; border-radius: 8px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);"
                    />
                </div>
            </div>
            <div class="about-image">
                <img 
                    src="https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80"
                    alt="<?php _e('Barista making coffee', 'espresso-joint'); ?>"
                />
            </div>
        </div>
    </div>
</section>