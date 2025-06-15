<?php
/**
 * Menu Section Template Part
 */
?>

<section id="menu" class="menu-section">
    <div class="container">
        <h2 class="font-display">
            <?php _e('Our Offerings', 'espresso-joint'); ?>
        </h2>
        
        <div class="menu-categories">
            <?php 
            $categories = espresso_joint_get_menu_categories();
            foreach ($categories as $category) : 
            ?>
                <div class="menu-category">
                    <div class="menu-category-icon">
                        <i class="<?php echo esc_attr($category['icon']); ?>"></i>
                    </div>
                    <h3><?php echo esc_html($category['name']); ?></h3>
                    <p><?php echo esc_html($category['description']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        
        <?php
        // Display actual menu items if they exist
        $menu_items = new WP_Query(array(
            'post_type' => 'menu_item',
            'posts_per_page' => 8,
            'post_status' => 'publish'
        ));
        
        if ($menu_items->have_posts()) :
        ?>
            <div style="margin-top: 4rem;">
                <h3 class="font-display text-center" style="font-size: 2rem; margin-bottom: 2rem;">
                    <?php _e('Featured Menu Items', 'espresso-joint'); ?>
                </h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                    <?php while ($menu_items->have_posts()) : $menu_items->the_post(); ?>
                        <div class="menu-item bg-white" style="padding: 1.5rem; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                            <?php if (has_post_thumbnail()) : ?>
                                <div style="margin-bottom: 1rem;">
                                    <?php the_post_thumbnail('medium', array('style' => 'width: 100%; height: 200px; object-fit: cover; border-radius: 0.5rem;')); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
                                <h4 style="margin: 0; font-size: 1.25rem; font-weight: 600;">
                                    <?php the_title(); ?>
                                </h4>
                                <?php 
                                $price = get_post_meta(get_the_ID(), '_menu_item_price', true);
                                if ($price) :
                                ?>
                                    <span style="color: var(--primary); font-weight: bold; font-size: 1.125rem;">
                                        $<?php echo esc_html($price); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <?php 
                            $description = get_post_meta(get_the_ID(), '_menu_item_description', true);
                            if ($description) :
                            ?>
                                <p style="color: var(--gray-600); margin: 0; font-size: 0.875rem;">
                                    <?php echo esc_html($description); ?>
                                </p>
                            <?php endif; ?>
                            
                            <?php
                            $categories = get_the_terms(get_the_ID(), 'menu_category');
                            if ($categories && !is_wp_error($categories)) :
                            ?>
                                <div style="margin-top: 0.75rem;">
                                    <?php foreach ($categories as $category) : ?>
                                        <span style="background-color: var(--gray-100); color: var(--gray-700); padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem; margin-right: 0.5rem;">
                                            <?php echo esc_html($category->name); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php 
        endif;
        wp_reset_postdata();
        ?>
    </div>
</section>