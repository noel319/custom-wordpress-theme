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
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'espresso-joint'),
    ));
}
add_action('after_setup_theme', 'espresso_joint_setup');

// Enqueue styles and scripts
function espresso_joint_scripts() {
    wp_enqueue_style('espresso-joint-style', get_stylesheet_uri());
    
    // Enqueue Font Awesome for icons
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
    
    // Enqueue Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;700&display=swap');
    
    // Enqueue JavaScript
    wp_enqueue_script('espresso-joint-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'espresso_joint_scripts');

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
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-food',
        'rewrite' => array('slug' => 'menu-items'),
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
    ?>
    <table class="form-table">
        <tr>
            <th><label for="menu_item_price"><?php _e('Price', 'espresso-joint'); ?></label></th>
            <td><input type="text" id="menu_item_price" name="menu_item_price" value="<?php echo esc_attr($price); ?>" /></td>
        </tr>
        <tr>
            <th><label for="menu_item_description"><?php _e('Short Description', 'espresso-joint'); ?></label></th>
            <td><textarea id="menu_item_description" name="menu_item_description" rows="3" cols="50"><?php echo esc_textarea($description); ?></textarea></td>
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
    
    if (isset($_POST['menu_item_price'])) {
        update_post_meta($post_id, '_menu_item_price', sanitize_text_field($_POST['menu_item_price']));
    }
    
    if (isset($_POST['menu_item_description'])) {
        update_post_meta($post_id, '_menu_item_description', sanitize_textarea_field($_POST['menu_item_description']));
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
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label' => __('Hero Title', 'espresso-joint'),
        'section' => 'hero_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hero_subtitle', array(
        'default' => 'Your neighborhood spot for the perfect espresso, breakfast & lunch experience.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label' => __('Hero Subtitle', 'espresso-joint'),
        'section' => 'hero_section',
        'type' => 'textarea',
    ));
    
    // About Section
    $wp_customize->add_section('about_section', array(
        'title' => __('About Section', 'espresso-joint'),
        'priority' => 31,
    ));
    
    $wp_customize->add_setting('about_title', array(
        'default' => 'Our Story',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('about_title', array(
        'label' => __('About Title', 'espresso-joint'),
        'section' => 'about_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('about_text', array(
        'default' => 'At Espresso Joint, we\'re passionate about crafting the perfect cup...',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('about_text', array(
        'label' => __('About Text', 'espresso-joint'),
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
    ));
    
    $wp_customize->add_control('contact_address', array(
        'label' => __('Address', 'espresso-joint'),
        'section' => 'contact_info',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('contact_phone', array(
        'default' => '(