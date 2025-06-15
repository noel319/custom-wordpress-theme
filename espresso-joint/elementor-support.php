<?php
/**
 * Elementor Support and Integration
 */

// Add to functions.php or create as separate file and include

// Elementor Theme Support
function espresso_joint_elementor_theme_support() {
    add_theme_support('elementor');
    add_theme_support('elementor-page-title');
    add_theme_support('elementor-header-footer');
    
    // Add custom Elementor locations
    add_action('elementor/theme/register_locations', function($elementor_theme_manager) {
        $elementor_theme_manager->register_location('hero');
        $elementor_theme_manager->register_location('about');
        $elementor_theme_manager->register_location('menu');
        $elementor_theme_manager->register_location('contact');
    });
}
add_action('after_setup_theme', 'espresso_joint_elementor_theme_support');

// Custom Elementor Widgets for Coffee Shop
class Espresso_Joint_Menu_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'espresso_joint_menu';
    }
    
    public function get_title() {
        return __('Coffee Menu', 'espresso-joint');
    }
    
    public function get_icon() {
        return 'eicon-posts-grid';
    }
    
    public function get_categories() {
        return ['espresso-joint'];
    }
    
    protected function _register_controls() {
        
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'espresso-joint'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'menu_category',
            [
                'label' => __('Menu Category', 'espresso-joint'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'all',
                'options' => $this->get_menu_categories(),
            ]
        );
        
        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Number of Items', 'espresso-joint'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 8,
                'min' => 1,
                'max' => 20,
            ]
        );
        
        $this->add_control(
            'columns',
            [
                'label' => __('Columns', 'espresso-joint'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '2' => __('2 Columns', 'espresso-joint'),
                    '3' => __('3 Columns', 'espresso-joint'),
                    '4' => __('4 Columns', 'espresso-joint'),
                ],
            ]
        );
        
        $this->add_control(
            'show_price',
            [
                'label' => __('Show Price', 'espresso-joint'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'espresso-joint'),
                'label_off' => __('No', 'espresso-joint'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'show_description',
            [
                'label' => __('Show Description', 'espresso-joint'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'espresso-joint'),
                'label_off' => __('No', 'espresso-joint'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->end_controls_section();
        
        // Style Controls
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'espresso-joint'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'espresso-joint'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#111827',
                'selectors' => [
                    '{{WRAPPER}} .menu-item h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'price_color',
            [
                'label' => __('Price Color', 'espresso-joint'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#dc2626',
                'selectors' => [
                    '{{WRAPPER}} .menu-item-price' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Title Typography', 'espresso-joint'),
                'selector' => '{{WRAPPER}} .menu-item h3',
            ]
        );
        
        $this->end_controls_section();
    }
    
    private function get_menu_categories() {
        $categories = ['all' => __('All Categories', 'espresso-joint')];
        $terms = get_terms(['taxonomy' => 'menu_category', 'hide_empty' => false]);
        
        if (!is_wp_error($terms)) {
            foreach ($terms as $term) {
                $categories[$term->slug] = $term->name;
            }
        }
        
        return $categories;
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $args = array(
            'post_type' => 'menu_item',
            'posts_per_page' => $settings['posts_per_page'],
            'post_status' => 'publish'
        );
        
        if ($settings['menu_category'] && $settings['menu_category'] !== 'all') {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'menu_category',
                    'field' => 'slug',
                    'terms' => $settings['menu_category']
                )
            );
        }
        
        $query = new WP_Query($args);
        
        if ($query->have_posts()) :
            echo '<div class="espresso-menu-grid" style="display: grid; grid-template-columns: repeat(' . esc_attr($settings['columns']) . ', 1fr); gap: 2rem;">';
            
            while ($query->have_posts()) : $query->the_post();
                ?>
                <div class="menu-item" style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    <?php if (has_post_thumbnail()) : ?>
                        <div style="margin-bottom: 1rem;">
                            <?php the_post_thumbnail('medium', array('style' => 'width: 100%; height: 200px; object-fit: cover; border-radius: 8px;')); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
                        <h3 style="margin: 0; font-size: 1.25rem; font-family: 'Playfair Display', serif;">
                            <?php the_title(); ?>
                        </h3>
                        <?php if ($settings['show_price'] === 'yes') :
                            $price = get_post_meta(get_the_ID(), '_menu_item_price', true);
                            if ($price) :
                        ?>
                            <span class="menu-item-price" style="font-weight: bold; font-size: 1.125rem;">
                                $<?php echo esc_html($price); ?>
                            </span>
                        <?php endif; endif; ?>
                    </div>
                    
                    <?php if ($settings['show_description'] === 'yes') :
                        $description = get_post_meta(get_the_ID(), '_menu_item_description', true);
                        if ($description) :
                    ?>
                        <p style="color: #6b7280; margin: 0; font-size: 0.875rem;">
                            <?php echo esc_html($description); ?>
                        </p>
                    <?php endif; endif; ?>
                </div>
                <?php
            endwhile;
            
            echo '</div>';
        endif;
        
        wp_reset_postdata();
    }
}

// Register Custom Elementor Widgets
function espresso_joint_register_elementor_widgets() {
    if (class_exists('\Elementor\Plugin')) {
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Espresso_Joint_Menu_Widget());
    }
}
add_action('elementor/widgets/widgets_registered', 'espresso_joint_register_elementor_widgets');

// Add Custom Elementor Category
function espresso_joint_add_elementor_widget_categories($elements_manager) {
    $elements_manager->add_category(
        'espresso-joint',
        [
            'title' => __('Espresso Joint', 'espresso-joint'),
            'icon' => 'fa fa-coffee',
        ]
    );
}
add_action('elementor/elements/categories_registered', 'espresso_joint_add_elementor_widget_categories');

// Elementor Canvas Template Support
function espresso_joint_elementor_canvas_styles() {
    if (is_page_template('elementor_canvas')) {
        wp_enqueue_style('espresso-joint-elementor-canvas', get_template_directory_uri() . '/assets/css/elementor-canvas.css');
    }
}
add_action('wp_enqueue_scripts', 'espresso_joint_elementor_canvas_styles');

// Theme Builder Support
function espresso_joint_elementor_theme_builder_support() {
    if (class_exists('\ElementorPro\Modules\ThemeBuilder\Module')) {
        add_action('elementor/theme/register_conditions', function($conditions_manager) {
            $conditions_manager->get_condition('general')->register_sub_condition(new \ElementorPro\Modules\ThemeBuilder\Conditions\Post_Type('menu_item'));
        });
    }
}
add_action('elementor/init', 'espresso_joint_elementor_theme_builder_support');

// Custom Elementor Controls
function espresso_joint_elementor_controls() {
    if (class_exists('\Elementor\Plugin')) {
        // Add custom controls here if needed
    }
}
add_action('elementor/controls/controls_registered', 'espresso_joint_elementor_controls');
?>