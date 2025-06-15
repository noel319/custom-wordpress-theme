<?php
/**
 * About Section Template Part
 */
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
                        <?php echo esc_html(get_theme_mod('about_text', 'At Espresso Joint, we\'re passionate about crafting the perfect cup. Our expert baristas bring years of experience to every espresso shot, cappuccino, and cold brew we serve. We believe in quality, consistency, and creating a welcoming space for coffee lovers.')); ?>
                    </p>
                    <p>
                        <?php _e('Every bean is carefully sourced from sustainable farms, roasted to perfection, and brewed with precision. Whether you\'re starting your day or taking an afternoon break, we\'re here to make your coffee moment special.', 'espresso-joint'); ?>
                    </p>
                </div>
                <div style="margin-top: 2rem;">
                    <img 
                        src="https://images.unsplash.com/photo-1541014741259-de529411b96a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                        alt="<?php _e('Fresh chicken bowl with vegetables', 'espresso-joint'); ?>"
                        style="max-width: 24rem; margin: 0 auto; display: block;"
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