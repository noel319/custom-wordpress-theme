<?php
/**
 * Menu Item Card Template Part
 * Used for AJAX loading and Elementor widgets
 */

$price = get_post_meta(get_the_ID(), '_menu_item_price', true);
$description = get_post_meta(get_the_ID(), '_menu_item_description', true);
$ingredients = get_post_meta(get_the_ID(), '_menu_item_ingredients', true);
$calories = get_post_meta(get_the_ID(), '_menu_item_calories', true);
$featured = get_post_meta(get_the_ID(), '_menu_item_featured', true);
$categories = get_the_terms(get_the_ID(), 'menu_category');
?>

<div class="menu-item-card" style="background-color: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); overflow: hidden; transition: transform 0.3s ease;">
    <?php if (has_post_thumbnail()) : ?>
        <div class="menu-item-image" style="height: 250px; overflow: hidden;">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium', array(
                    'style' => 'width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;',
                    'alt' => get_the_title()
                )); ?>
            </a>
        </div>
    <?php endif; ?>
    
    <div class="menu-item-content" style="padding: 24px;">
        <?php if ($featured) : ?>
            <div class="featured-badge" style="background-color: var(--primary); color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600; text-transform: uppercase; margin-bottom: 12px; display: inline-block;">
                <?php _e('Featured', 'espresso-joint'); ?>
            </div>
        <?php endif; ?>
        
        <div class="menu-item-header" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
            <h3 class="menu-item-title" style="margin: 0; font-size: 24px; font-weight: 600; color: var(--gray-900); font-family: 'Playfair Display', serif;">
                <a href="<?php the_permalink(); ?>" style="color: inherit; text-decoration: none;">
                    <?php the_title(); ?>
                </a>
            </h3>
            <?php if ($price) : ?>
                <span class="menu-item-price" style="color: var(--primary); font-weight: bold; font-size: 20px; margin-left: 16px;">
                    $<?php echo esc_html($price); ?>
                </span>
            <?php endif; ?>
        </div>
        
        <?php if ($description) : ?>
            <p class="menu-item-description" style="color: var(--gray-600); margin-bottom: 16px; line-height: 1.5; font-size: 16px;">
                <?php echo esc_html($description); ?>
            </p>
        <?php endif; ?>
        
        <?php if ($ingredients) : ?>
            <div class="menu-item-ingredients" style="margin-bottom: 12px;">
                <strong style="color: var(--gray-700); font-size: 14px;"><?php _e('Ingredients:', 'espresso-joint'); ?></strong>
                <span style="color: var(--gray-600); font-size: 14px; margin-left: 8px;"><?php echo esc_html($ingredients); ?></span>
            </div>
        <?php endif; ?>
        
        <?php if ($calories) : ?>
            <div class="menu-item-calories" style="margin-bottom: 16px;">
                <span style="background-color: var(--gray-100); color: var(--gray-700); padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">
                    <?php echo esc_html($calories); ?> <?php _e('cal', 'espresso-joint'); ?>
                </span>
            </div>
        <?php endif; ?>
        
        <?php if ($categories && !is_wp_error($categories)) : ?>
            <div class="menu-item-categories" style="margin-bottom: 16px;">
                <?php foreach ($categories as $category) : ?>
                    <span class="category-tag" style="background-color: var(--gray-100); color: var(--gray-700); padding: 4px 8px; border-radius: 16px; font-size: 12px; margin-right: 8px; margin-bottom: 4px; display: inline-block;">
                        <?php echo esc_html($category->name); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <div class="menu-item-actions" style="display: flex; justify-content: space-between; align-items: center;">
            <a href="<?php the_permalink(); ?>" class="btn-view-details" style="background-color: var(--primary); color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 500; transition: background-color 0.3s ease;">
                <?php _e('View Details', 'espresso-joint'); ?>
            </a>
            
            <button class="btn-add-to-cart" style="background-color: transparent; border: 2px solid var(--primary); color: var(--primary); padding: 6px 14px; border-radius: 6px; font-size: 14px; font-weight: 500; cursor: pointer; transition: all 0.3s ease;" data-product-id="<?php echo get_the_ID(); ?>">
                <?php _e('Add to Cart', 'espresso-joint'); ?>
            </button>
        </div>
    </div>
</div>

<style>
.menu-item-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
}

.menu-item-card:hover .menu-item-image img {
    transform: scale(1.05);
}

.btn-view-details:hover {
    background-color: var(--primary-hover);
    text-decoration: none;
    color: white;
}

.btn-add-to-cart:hover {
    background-color: var(--primary);
    color: white;
}

@media (max-width: 768px) {
    .menu-item-header {
        flex-direction: column;
        align-items: flex-start !important;
    }
    
    .menu-item-price {
        margin-left: 0 !important;
        margin-top: 8px;
    }
    
    .menu-item-actions {
        flex-direction: column;
        gap: 12px;
    }
    
    .btn-view-details,
    .btn-add-to-cart {
        width: 100%;
        text-align: center;
    }
}
</style>