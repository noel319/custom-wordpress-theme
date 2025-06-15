<?php
/**
 * Single Menu Item Template
 */

get_header(); ?>

<main class="container" style="padding-top: 120px; padding-bottom: 60px;">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div style="max-width: 800px; margin: 0 auto;">
                
                <?php if (has_post_thumbnail()) : ?>
                    <div style="margin-bottom: 2rem;">
                        <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: 400px; object-fit: cover; border-radius: 0.75rem;')); ?>
                    </div>
                <?php endif; ?>
                
                <header class="entry-header" style="margin-bottom: 2rem;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                        <h1 class="entry-title font-display" style="margin: 0; font-size: 2.5rem;">
                            <?php the_title(); ?>
                        </h1>
                        <?php 
                        $price = get_post_meta(get_the_ID(), '_menu_item_price', true);
                        if ($price) :
                        ?>
                            <span style="color: var(--primary); font-weight: bold; font-size: 2rem;">
                                $<?php echo esc_html($price); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <?php
                    $categories = get_the_terms(get_the_ID(), 'menu_category');
                    if ($categories && !is_wp_error($categories)) :
                    ?>
                        <div style="margin-bottom: 1rem;">
                            <?php foreach ($categories as $category) : ?>
                                <span style="background-color: var(--primary); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; margin-right: 0.5rem;">
                                    <?php echo esc_html($category->name); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php 
                    $description = get_post_meta(get_the_ID(), '_menu_item_description', true);
                    if ($description) :
                    ?>
                        <p style="font-size: 1.25rem; color: var(--gray-600); margin: 0;">
                            <?php echo esc_html($description); ?>
                        </p>
                    <?php endif; ?>
                </header>
                
                <div class="entry-content" style="font-size: 1.125rem; line-height: 1.7;">
                    <?php the_content(); ?>
                </div>
                
                <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--gray-200);">
                    <a href="<?php echo home_url('/#menu'); ?>" class="btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-arrow-left"></i>
                        <?php _e('Back to Menu', 'espresso-joint'); ?>
                    </a>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>