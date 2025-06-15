<?php
/**
 * Default Page Template
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
                
                <header class="entry-header" style="margin-bottom: 2rem; text-align: center;">
                    <h1 class="entry-title font-display" style="font-size: 3rem; margin-bottom: 1rem; color: var(--gray-900);">
                        <?php the_title(); ?>
                    </h1>
                    <div style="width: 4rem; height: 4px; background-color: var(--primary); margin: 0 auto;"></div>
                </header>
                
                <div class="entry-content" style="font-size: 1.125rem; line-height: 1.7; color: var(--gray-700);">
                    <?php the_content(); ?>
                    
                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links" style="margin-top: 2rem; text-align: center;">',
                        'after'  => '</div>',
                        'link_before' => '<span style="display: inline-block; padding: 0.5rem 1rem; margin: 0 0.25rem; background-color: var(--primary); color: white; border-radius: 0.5rem; text-decoration: none;">',
                        'link_after'  => '</span>',
                    ));
                    ?>
                </div>
                
                <?php if (comments_open() || get_comments_number()) : ?>
                    <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--gray-200);">
                        <?php comments_template(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>