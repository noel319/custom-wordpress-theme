<?php
/**
 * Contact Section Template Part
 */
?>

<section id="contact" class="contact-section">
    <div class="container">
        <h2 class="font-display">
            <?php _e('Get In Touch', 'espresso-joint'); ?>
        </h2>
        
        <div class="contact-content">
            <!-- Contact Form -->
            <div class="contact-form">
                <h3><?php _e('Send us a message', 'espresso-joint'); ?></h3>
                
                <?php
                // Display success/error messages
                if (isset($_GET['contact'])) {
                    if ($_GET['contact'] === 'success') {
                        echo '<div style="background-color: #d4edda; color: #155724; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">';
                        _e('Thank you! Your message has been sent successfully.', 'espresso-joint');
                        echo '</div>';
                    } elseif ($_GET['contact'] === 'error') {
                        echo '<div style="background-color: #f8d7da; color: #721c24; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">';
                        _e('Sorry, there was an error sending your message. Please try again.', 'espresso-joint');
                        echo '</div>';
                    }
                }
                ?>
                
                <form method="post" action="">
                    <?php wp_nonce_field('espresso_joint_contact_form', 'contact_nonce'); ?>
                    <div class="form-group">
                        <input 
                            type="text" 
                            name="contact_name"
                            placeholder="<?php _e('Your Name', 'espresso-joint'); ?>" 
                            required 
                            class="form-control"
                        />
                    </div>
                    <div class="form-group">
                        <input 
                            type="email" 
                            name="contact_email"
                            placeholder="<?php _e('Email Address', 'espresso-joint'); ?>" 
                            required 
                            class="form-control"
                        />
                    </div>
                    <div class="form-group">
                        <textarea 
                            rows="5" 
                            name="contact_message"
                            placeholder="<?php _e('Your Message', 'espresso-joint'); ?>" 
                            required 
                            class="form-control"
                        ></textarea>
                    </div>
                    <button 
                        type="submit" 
                        name="contact_form_submit"
                        class="btn-submit"
                    >
                        <?php _e('Send Message', 'espresso-joint'); ?>
                    </button>
                </form>
            </div>

            <!-- Map and Contact Info -->
            <div class="contact-info">
                <div class="info-card">
                    <h3><?php _e('Our Location', 'espresso-joint'); ?></h3>
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3573.573111554045!2d-80.09353268496504!3d26.36312308336935!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d91c6b9a2f4b5d%3A0x9b5e6b9e5c8b5f1e!2s125%20Via%20Naranjas%2C%20Boca%20Raton%2C%20FL%2033432!5e0!3m2!1sen!2sus!4v1620000000000!5m2!1sen!2sus" 
                        class="contact-map"
                        allowfullscreen="" 
                        loading="lazy"
                        title="<?php _e('Espresso Joint Location', 'espresso-joint'); ?>"
                    ></iframe>
                    
                    <div class="contact-details">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-item-content">
                                <p><?php _e('Visit Us', 'espresso-joint'); ?></p>
                                <p><?php echo esc_html(get_theme_mod('contact_address', '125 Via Naranjas, Boca Raton, FL 33432')); ?></p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-item-content">
                                <p><?php _e('Call Us', 'espresso-joint'); ?></p>
                                <p><?php echo esc_html(get_theme_mod('contact_phone', '(555) 123-4567')); ?></p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-item-content">
                                <p><?php _e('Email Us', 'espresso-joint'); ?></p>
                                <p><?php echo esc_html(get_theme_mod('contact_email', 'hello@espressojoint.com')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="info-card">
                    <h3><?php _e('Hours', 'espresso-joint'); ?></h3>
                    <div class="hours-list">
                        <div class="hours-item">
                            <span><?php _e('Monday - Friday', 'espresso-joint'); ?></span>
                            <span><?php echo esc_html(get_theme_mod('hours_monday_friday', '7:00 AM - 8:00 PM')); ?></span>
                        </div>
                        <div class="hours-item">
                            <span><?php _e('Saturday', 'espresso-joint'); ?></span>
                            <span><?php echo esc_html(get_theme_mod('hours_saturday', '8:00 AM - 8:00 PM')); ?></span>
                        </div>
                        <div class="hours-item">
                            <span><?php _e('Sunday', 'espresso-joint'); ?></span>
                            <span><?php echo esc_html(get_theme_mod('hours_sunday', '8:00 AM - 6:00 PM')); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
