<?php
// Theme setup
function espresso_joint_setup() {
    // Add theme support for various features
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Add Elementor support
    add_theme_support('elementor');
    add_theme_support('post-formats', array('video', 'gallery', 'audio'));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'espresso-joint'),
    ));
    
    // Add image sizes
    add_image_size('menu-item-thumb', 400, 300, true);
    add_image_size('hero-image', 1920, 800, true);
}
add_action('after_setup_theme', 'espresso_joint_setup');

// Enqueue styles and scripts
function espresso_joint_scripts() {
    wp_enqueue_style('espresso-joint-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue Font Awesome for icons
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    
    // Enqueue Google Fonts - Exact match from React
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800;900&display=swap', array(), null);
    
    // Enqueue JavaScript
    wp_enqueue_script('espresso-joint-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('espresso-joint-script', 'espresso_joint_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('espresso_joint_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'espresso_joint_scripts');

// Elementor compatibility
function espresso_joint_elementor_support() {
    // Add Elementor theme support
    add_post_type_support('elementor_library', 'thumbnail');
    
    // Remove theme CSS from Elementor canvas template
    if (class_exists('\Elementor\Plugin')) {
        add_action('elementor/frontend/after_enqueue_styles', function() {
            if (\Elementor\Plugin::$instance->preview->is_preview_mode()) {
                wp_dequeue_style('espresso-joint-style');
            }
        });
    }
}
add_action('after_setup_theme', 'espresso_joint_elementor_support');

// Register widget areas
function espresso_joint_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'espresso-joint'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in your footer.', 'espresso-joint'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // Hero Section Widget Area
    register_sidebar(array(
        'name'          => __('Hero Section', 'espresso-joint'),
        'id'            => 'hero-section',
        'description'   => __('Add widgets or Elementor templates here for the hero section.', 'espresso-joint'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    // About Section Widget Area
    register_sidebar(array(
        'name'          => __('About Section', 'espresso-joint'),
        'id'            => 'about-section',
        'description'   => __('Add widgets or Elementor templates here for the about section.', 'espresso-joint'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'espresso_joint_widgets_init');

// Custom post types
function espresso_joint_custom_post_types() {
    // Menu Items Post Type
    register_post_type('menu_item', array(
        'labels' => array(
            'name' => __('Menu Items', 'espresso-joint'),
            'singular_name' => __('Menu Item', 'espresso-joint'),
            'add_new' => __('Add New Menu Item', 'espresso-joint'),
            'add_new_item' => __('Add New Menu Item', 'espresso-joint'),
            'edit_item' => __('Edit Menu Item', 'espresso-joint'),
            'new_item' => __('New Menu Item', 'espresso-joint'),
            'view_item' => __('View Menu Item', 'espresso-joint'),
            'search_items' => __('Search Menu Items', 'espresso-joint'),
            'not_found' => __('No menu items found', 'espresso-joint'),
            'not_found_in_trash' => __('No menu items found in trash', 'espresso-joint'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'elementor'),
        'menu_icon' => 'dashicons-food',
        'rewrite' => array('slug' => 'menu-items'),
        'show_in_rest' => true,
    ));
    
    // Testimonials Post Type
    register_post_type('testimonial', array(
        'labels' => array(
            'name' => __('Testimonials', 'espresso-joint'),
            'singular_name' => __('Testimonial', 'espresso-joint'),
            'add_new' => __('Add New Testimonial', 'espresso-joint'),
            'add_new_item' => __('Add New Testimonial', 'espresso-joint'),
            'edit_item' => __('Edit Testimonial', 'espresso-joint'),
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'elementor'),
        'menu_icon' => 'dashicons-testimonial',
        'show_in_rest' => true,
    ));
    
    // Menu Categories Taxonomy
    register_taxonomy('menu_category', 'menu_item', array(
        'labels' => array(
            'name' => __('Menu Categories', 'espresso-joint'),
            'singular_name' => __('Menu Category', 'espresso-joint'),
            'search_items' => __('Search Menu Categories', 'espresso-joint'),
            'all_items' => __('All Menu Categories', 'espresso-joint'),
            'edit_item' => __('Edit Menu Category', 'espresso-joint'),
            'update_item' => __('Update Menu Category', 'espresso-joint'),
            'add_new_item' => __('Add New Menu Category', 'espresso-joint'),
            'new_item_name' => __('New Menu Category Name', 'espresso-joint'),
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'menu-category'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'espresso_joint_custom_post_types');

// Add custom fields for menu items
function espresso_joint_add_menu_item_meta_boxes() {
    add_meta_box(
        'menu_item_details',
        __('Menu Item Details', 'espresso-joint'),
        'espresso_joint_menu_item_meta_box_callback',
        'menu_item',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'espresso_joint_add_menu_item_meta_boxes');

function espresso_joint_menu_item_meta_box_callback($post) {
    wp_nonce_field('espresso_joint_save_menu_item_meta', 'espresso_joint_menu_item_nonce');
    
    $price = get_post_meta($post->ID, '_menu_item_price', true);
    $description = get_post_meta($post->ID, '_menu_item_description', true);
    $ingredients = get_post_meta($post->ID, '_menu_item_ingredients', true);
    $calories = get_post_meta($post->ID, '_menu_item_calories', true);
    $featured = get_post_meta($post->ID, '_menu_item_featured', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="menu_item_price"><?php _e('Price', 'espresso-joint'); ?></label></th>
            <td><input type="text" id="menu_item_price" name="menu_item_price" value="<?php echo esc_attr($price); ?>" placeholder="9.99" /></td>
        </tr>
        <tr>
            <th><label for="menu_item_description"><?php _e('Short Description', 'espresso-joint'); ?></label></th>
            <td><textarea id="menu_item_description" name="menu_item_description" rows="3" cols="50" placeholder="Brief description of the menu item"><?php echo esc_textarea($description); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="menu_item_ingredients"><?php _e('Ingredients', 'espresso-joint'); ?></label></th>
            <td><textarea id="menu_item_ingredients" name="menu_item_ingredients" rows="2" cols="50" placeholder="List main ingredients"><?php echo esc_textarea($ingredients); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="menu_item_calories"><?php _e('Calories', 'espresso-joint'); ?></label></th>
            <td><input type="number" id="menu_item_calories" name="menu_item_calories" value="<?php echo esc_attr($calories); ?>" placeholder="250" /></td>
        </tr>
        <tr>
            <th><label for="menu_item_featured"><?php _e('Featured Item', 'espresso-joint'); ?></label></th>
            <td><input type="checkbox" id="menu_item_featured" name="menu_item_featured" value="1" <?php checked($featured, '1'); ?> /> <label for="menu_item_featured"><?php _e('Mark as featured item', 'espresso-joint'); ?></label></td>
        </tr>
    </table>
    <?php
}

function espresso_joint_save_menu_item_meta($post_id) {
    if (!isset($_POST['espresso_joint_menu_item_nonce']) || !wp_verify_nonce($_POST['espresso_joint_menu_item_nonce'], 'espresso_joint_save_menu_item_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $fields = array('menu_item_price', 'menu_item_description', 'menu_item_ingredients', 'menu_item_calories', 'menu_item_featured');
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            if ($field === 'menu_item_featured') {
                update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
            } elseif ($field === 'menu_item_calories') {
                update_post_meta($post_id, '_' . $field, absint($_POST[$field]));
            } else {
                update_post_meta($post_id, '_' . $field, sanitize_textarea_field($_POST[$field]));
            }
        } else {
            delete_post_meta($post_id, '_' . $field);
        }
    }
}
add_action('save_post', 'espresso_joint_save_menu_item_meta');

// Customizer options
function espresso_joint_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('hero_section', array(
        'title' => __('Hero Section', 'espresso-joint'),
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('hero_title', array(
        'default' => 'Artisanal coffee and exceptional food',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label' => __('Hero Title', 'espresso-joint'),
        'section' => 'hero_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hero_subtitle', array(
        'default' => 'Your neighborhood spot for the perfect espresso, breakfast & lunch experience.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label' => __('Hero Subtitle', 'espresso-joint'),
        'section' => 'hero_section',
        'type' => 'textarea',
    ));
    
    $wp_customize->add_setting('hero_background_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_background_image', array(
        'label' => __('Hero Background Image', 'espresso-joint'),
        'section' => 'hero_section',
    )));
    
    // About Section
    $wp_customize->add_section('about_section', array(
        'title' => __('About Section', 'espresso-joint'),
        'priority' => 31,
    ));
    
    $wp_customize->add_setting('about_title', array(
        'default' => 'Our Story',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('about_title', array(
        'label' => __('About Title', 'espresso-joint'),
        'section' => 'about_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('about_text_1', array(
        'default' => 'At Espresso Joint, we\'re passionate about crafting the perfect cup. Our expert baristas bring years of experience to every espresso shot, cappuccino, and cold brew we serve. We believe in quality, consistency, and creating a welcoming space for coffee lovers.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('about_text_1', array(
        'label' => __('About Text (First Paragraph)', 'espresso-joint'),
        'section' => 'about_section',
        'type' => 'textarea',
    ));
    
    $wp_customize->add_setting('about_text_2', array(
        'default' => 'Every bean is carefully sourced from sustainable farms, roasted to perfection, and brewed with precision. Whether you\'re starting your day or taking an afternoon break, we\'re here to make your coffee moment special.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('about_text_2', array(
        'label' => __('About Text (Second Paragraph)', 'espresso-joint'),
        'section' => 'about_section',
        'type' => 'textarea',
    ));
    
    // Contact Information
    $wp_customize->add_section('contact_info', array(
        'title' => __('Contact Information', 'espresso-joint'),
        'priority' => 32,
    ));
    
    $wp_customize->add_setting('contact_address', array(
        'default' => '125 Via Naranjas, Boca Raton, FL 33432',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('contact_address', array(
        'label' => __('Address', 'espresso-joint'),
        'section' => 'contact_info',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('contact_phone', array(
        'default' => '(555) 123-4567',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('contact_phone', array(
        'label' => __('Phone Number', 'espresso-joint'),
        'section' => 'contact_info',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('contact_email', array(
        'default' => 'hello@espressojoint.com',
        'sanitize_callback' => 'sanitize_email',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('contact_email', array(
        'label' => __('Email Address', 'espresso-joint'),
        'section' => 'contact_info',
        'type' => 'email',
    ));
    
    // Business Hours
    $wp_customize->add_setting('hours_monday_friday', array(
        'default' => '7:00 AM - 8:00 PM',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('hours_monday_friday', array(
        'label' => __('Monday - Friday Hours', 'espresso-joint'),
        'section' => 'contact_info',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hours_saturday', array(
        'default' => '8:00 AM - 8:00 PM',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('hours_saturday', array(
        'label' => __('Saturday Hours', 'espresso-joint'),
        'section' => 'contact_info',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hours_sunday', array(
        'default' => '8:00 AM - 6:00 PM',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('hours_sunday', array(
        'label' => __('Sunday Hours', 'espresso-joint'),
        'section' => 'contact_info',
        'type' => 'text',
    ));
    
    // Social Media
    $wp_customize->add_section('social_media', array(
        'title' => __('Social Media', 'espresso-joint'),
        'priority' => 33,
    ));
    
    $social_platforms = array(
        'facebook' => __('Facebook URL', 'espresso-joint'),
        'instagram' => __('Instagram URL', 'espresso-joint'),
        'twitter' => __('Twitter URL', 'espresso-joint'),
        'yelp' => __('Yelp URL', 'espresso-joint'),
    );
    
    foreach ($social_platforms as $platform => $label) {
        $wp_customize->add_setting('social_' . $platform, array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control('social_' . $platform, array(
            'label' => $label,
            'section' => 'social_media',
            'type' => 'url',
        ));
    }
}
add_action('customize_register', 'espresso_joint_customize_register');

// Helper function to get menu categories with icons
function espresso_joint_get_menu_categories() {
    $categories = array(
        array(
            'name' => 'Coffee',
            'icon' => 'fas fa-coffee',
            'description' => 'Freshly brewed & specialty drinks'
        ),
        array(
            'name' => 'Cold Press Juice',
            'icon' => 'fas fa-glass-whiskey',
            'description' => 'Fresh, cold-pressed juices'
        ),
        array(
            'name' => 'Smoothie',
            'icon' => 'fas fa-apple-alt',
            'description' => 'Creamy & refreshing blends'
        ),
        array(
            'name' => 'Acai',
            'icon' => 'fas fa-leaf',
            'description' => 'Nutrient-rich bowls'
        ),
        array(
            'name' => 'Salads',
            'icon' => 'fas fa-seedling',
            'description' => 'Fresh & healthy options'
        ),
        array(
            'name' => 'Healthy Bowls',
            'icon' => 'fas fa-bowl-food',
            'description' => 'Wholesome & satisfying'
        ),
        array(
            'name' => 'Paninis',
            'icon' => 'fas fa-hamburger',
            'description' => 'Grilled to perfection'
        ),
        array(
            'name' => 'Breakfast Sandwiches',
            'icon' => 'fas fa-bread-slice',
            'description' => 'Morning favorites all day'
        ),
    );
    
    return apply_filters('espresso_joint_menu_categories', $categories);
}

// Contact form handler with better validation
function espresso_joint_handle_contact_form() {
    if (isset($_POST['contact_form_submit'])) {
        // Verify nonce for security
        if (!wp_verify_nonce($_POST['contact_nonce'], 'espresso_joint_contact_form')) {
            wp_redirect(add_query_arg('contact', 'error', wp_get_referer()));
            exit;
        }
        
        $name = sanitize_text_field($_POST['contact_name']);
        $email = sanitize_email($_POST['contact_email']);
        $message = sanitize_textarea_field($_POST['contact_message']);
        
        // Enhanced validation
        $errors = array();
        
        if (empty($name)) {
            $errors[] = __('Name is required', 'espresso-joint');
        }
        
        if (empty($email) || !is_email($email)) {
            $errors[] = __('Valid email is required', 'espresso-joint');
        }
        
        if (empty($message)) {
            $errors[] = __('Message is required', 'espresso-joint');
        }
        
        if (!empty($errors)) {
            wp_redirect(add_query_arg('contact', 'error', wp_get_referer()));
            exit;
        }
        
        // Send email
        $to = get_option('admin_email');
        $subject = sprintf(__('New Contact Form Submission from %s', 'espresso-joint'), $name);
        $body = sprintf(
            __("Name: %s\nEmail: %s\n\nMessage:\n%s", 'espresso-joint'),
            $name,
            $email,
            $message
        );
        
        $headers = array(
            'Content-Type: text/plain; charset=UTF-8',
            'Reply-To: ' . $name . ' <' . $email . '>'
        );
        
        if (wp_mail($to, $subject, $body, $headers)) {
            wp_redirect(add_query_arg('contact', 'success', wp_get_referer()));
        } else {
            wp_redirect(add_query_arg('contact', 'error', wp_get_referer()));
        }
        exit;
    }
}
add_action('wp_loaded', 'espresso_joint_handle_contact_form');

// Add custom body classes
function espresso_joint_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'home-page';
    }
    
    if (class_exists('\Elementor\Plugin') && \Elementor\Plugin::$instance->preview->is_preview_mode()) {
        $classes[] = 'elementor-preview';
    }
    
    return $classes;
}
add_filter('body_class', 'espresso_joint_body_classes');

// Add Elementor custom CSS for theme compatibility
function espresso_joint_elementor_custom_css() {
    if (class_exists('\Elementor\Plugin')) {
        ?>
        <style>
        .elementor-section-wrap {
            min-height: auto;
        }
        
        .elementor-widget-container h1,
        .elementor-widget-container h2,
        .elementor-widget-container h3,
        .elementor-widget-container h4,
        .elementor-widget-container h5,
        .elementor-widget-container h6 {
            font-family: 'Playfair Display', Georgia, serif;
        }
        
        .elementor-widget-container p,
        .elementor-widget-container span,
        .elementor-widget-container div {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        </style>
        <?php
    }
}
add_action('wp_head', 'espresso_joint_elementor_custom_css');

// Admin customizations
function espresso_joint_admin_styles() {
    echo '<style>
        .post-type-menu_item .wp-list-table .column-thumbnail { width: 80px; }
        .post-type-menu_item .wp-list-table .column-price { width: 80px; }
        .post-type-menu_item .wp-list-table .column-category { width: 150px; }
    </style>';
}
add_action('admin_head', 'espresso_joint_admin_styles');

// Add custom columns to menu items admin
function espresso_joint_menu_item_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['thumbnail'] = __('Image', 'espresso-joint');
    $new_columns['title'] = $columns['title'];
    $new_columns['price'] = __('Price', 'espresso-joint');
    $new_columns['category'] = __('Category', 'espresso-joint');
    $new_columns['featured'] = __('Featured', 'espresso-joint');
    $new_columns['date'] = $columns['date'];
    
    return $new_columns;
}
add_filter('manage_menu_item_posts_columns', 'espresso_joint_menu_item_columns');

function espresso_joint_menu_item_column_content($column, $post_id) {
    switch ($column) {
        case 'thumbnail':
            if (has_post_thumbnail($post_id)) {
                echo get_the_post_thumbnail($post_id, array(60, 60));
            } else {
                echo '<span class="dashicons dashicons-format-image" style="font-size: 40px; color: #ddd;"></span>';
            }
            break;
            
        case 'price':
            $price = get_post_meta($post_id, '_menu_item_price', true);
            echo $price ? '$' . esc_html($price) : '—';
            break;
            
        case 'category':
            $terms = get_the_terms($post_id, 'menu_category');
            if ($terms && !is_wp_error($terms)) {
                $term_names = array();
                foreach ($terms as $term) {
                    $term_names[] = $term->name;
                }
                echo implode(', ', $term_names);
            } else {
                echo '—';
            }
            break;
            
        case 'featured':
            $featured = get_post_meta($post_id, '_menu_item_featured', true);
            echo $featured ? '<span class="dashicons dashicons-star-filled" style="color: #f39c12;"></span>' : '—';
            break;
    }
}
add_action('manage_menu_item_posts_custom_column', 'espresso_joint_menu_item_column_content', 10, 2);

// AJAX handlers for dynamic content
function espresso_joint_load_menu_items() {
    check_ajax_referer('espresso_joint_nonce', 'nonce');
    
    $category = sanitize_text_field($_POST['category']);
    $args = array(
        'post_type' => 'menu_item',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    );
    
    if ($category && $category !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'menu_category',
                'field' => 'slug',
                'terms' => $category
            )
        );
    }
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            // Return menu item HTML
            include get_template_directory() . '/template-parts/menu-item-card.php';
        }
    }
    
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_load_menu_items', 'espresso_joint_load_menu_items');
add_action('wp_ajax_nopriv_load_menu_items', 'espresso_joint_load_menu_items');
?>