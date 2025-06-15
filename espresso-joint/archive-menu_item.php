<?php
/**
 * Menu Items Archive Template
 */

get_header(); ?>

<main class="container" style="padding-top: 120px; padding-bottom: 60px;">
    <header class="page-header text-center" style="margin-bottom: 3rem;">
        <h1 class="page-title font-display" style="font-size: 3rem; margin-bottom: 1rem;">
            <?php _e('Our Full Menu', 'espresso-joint'); ?>
        </h1>
        <p style="font-size: 1.25rem; color: var(--gray-600);">
            <?php _e('Discover all our delicious offerings', 'espresso-joint'); ?>
        </p>
    </header>
    
    <?php
    // Get all menu categories for filtering
    $menu_categories = get_terms(array(
        'taxonomy' => 'menu_category',
        'hide_empty' => true,
    ));
    
    if ($menu_categories && !is_wp_error($menu_categories)) :
    ?>
        <div class="menu-filter" style="margin-bottom: 3rem; text-align: center;">
            <button class="filter-btn active" data-filter="all" style="background-color: var(--primary); color: white; border: none; padding: 0.5rem 1rem; border-radius: 9999px; margin: 0 0.25rem; cursor: pointer;">
                <?php _e('All', 'espresso-joint'); ?>
            </button>
            <?php foreach ($menu_categories as $category) : ?>
                <button class="filter-btn" data-filter="<?php echo esc_attr($category->slug); ?>" style="background-color: transparent; color: var(--gray-700); border: 1px solid var(--gray-300); padding: 0.5rem 1rem; border-radius: 9999px; margin: 0 0.25rem; cursor: pointer;">
                    <?php echo esc_html($category->name); ?>
                </button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <?php if (have_posts()) : ?>
        <div class="menu-items-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem;">
            <?php while (have_posts()) : the_post(); ?>
                <?php
                $categories = get_the_terms(get_the_ID(), 'menu_category');
                $category_classes = '';
                if ($categories && !is_wp_error($categories)) {
                    $category_classes = implode(' ', array_map(function($cat) {
                        return 'category-' . $cat->slug;
                    }, $categories));
                }
                ?>
                
                <article class="menu-item <?php echo esc_attr($category_classes); ?>" style="background-color: white; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); overflow: hidden; transition: transform 0.3s ease;">
                    <?php if (has_post_thumbnail()) : ?>
                        <div style="height: 250px; overflow: hidden;">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', array('style' => 'width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;')); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div style="padding: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
                            <h2 style="margin: 0; font-size: 1.5rem; font-weight: 600;">
                                <a href="<?php the_permalink(); ?>" style="color: var(--gray-900); text-decoration: none;">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <?php 
                            $price = get_post_meta(get_the_ID(), '_menu_item_price', true);
                            if ($price) :
                            ?>
                                <span style="color: var(--primary); font-weight: bold; font-size: 1.25rem;">
                                    $<?php echo esc_html($price); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <?php 
                        $description = get_post_meta(get_the_ID(), '_menu_item_description', true);
                        if ($description) :
                        ?>
                            <p style="color: var(--gray-600); margin-bottom: 1rem; line-height: 1.5;">
                                <?php echo esc_html($description); ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php if ($categories && !is_wp_error($categories)) : ?>
                            <div style="margin-bottom: 1rem;">
                                <?php foreach ($categories as $category) : ?>
                                    <span style="background-color: var(--gray-100); color: var(--gray-700); padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem; margin-right: 0.5rem;">
                                        <?php echo esc_html($category->name); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                        <a href="<?php the_permalink(); ?>" class="btn-primary" style="display: inline-block; font-size: 0.875rem;">
                            <?php _e('View Details', 'espresso-joint'); ?>
                        </a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
        
        <?php
        // Pagination
        the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => '<i class="fas fa-arrow-left"></i> ' . __('Previous', 'espresso-joint'),
            'next_text' => __('Next', 'espresso-joint') . ' <i class="fas fa-arrow-right"></i>',
        ));
        ?>
        
    <?php else : ?>
        <div class="text-center" style="padding: 3rem;">
            <h2><?php _e('No menu items found', 'espresso-joint'); ?></h2>
            <p><?php _e('Please check back soon for our delicious offerings!', 'espresso-joint'); ?></p>
        </div>
    <?php endif; ?>
</main>

<script>
// Menu filtering functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const menuItems = document.querySelectorAll('.menu-item');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterBtns.forEach(b => {
                b.classList.remove('active');
                b.style.backgroundColor = 'transparent';
                b.style.color = 'var(--gray-700)';
            });
            this.classList.add('active');
            this.style.backgroundColor = 'var(--primary)';
            this.style.color = 'white';
            
            // Filter menu items
            menuItems.forEach(item => {
                if (filter === 'all' || item.classList.contains('category-' + filter)) {
                    item.style.display = 'block';
                    item.style.animation = 'fadeIn 0.3s ease';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
    // Add hover effects to menu items
    menuItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            const img = this.querySelector('img');
            if (img) {
                img.style.transform = 'scale(1.05)';
            }
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            const img = this.querySelector('img');
            if (img) {
                img.style.transform = 'scale(1)';
            }
        });
    });
});
</script>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.filter-btn:hover {
    background-color: var(--primary) !important;
    color: white !important;
}

.pagination {
    display: flex;
    justify-content: center;
    margin-top: 3rem;
    gap: 0.5rem;
}

.pagination a,
.pagination span {
    padding: 0.75rem 1rem;
    border: 1px solid var(--gray-300);
    border-radius: 0.5rem;
    text-decoration: none;
    color: var(--gray-700);
    transition: all 0.3s ease;
}

.pagination a:hover {
    background-color: var(--primary);
    color: white;
    border-color: var(--primary);
}

.pagination .current {
    background-color: var(--primary);
    color: white;
    border-color: var(--primary);
}
</style>

<?php get_footer(); ?>