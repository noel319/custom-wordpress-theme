<?php
/**
 * The main template file
 */

get_header(); ?>

<?php if (is_front_page()) : ?>
    <?php get_template_part('template-parts/hero'); ?>
    <?php get_template_part('template-parts/loyalty-section'); ?>
    <?php get_template_part('template-parts/about'); ?>
    <?php get_template_part('template-parts/menu'); ?>
    <?php get_template_part('template-parts/contact'); ?>
<?php else : ?>
    <main class="container" style="padding-top: 120px; padding-bottom: 60px;">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <p><?php _e('Sorry, no posts matched your criteria.', 'espresso-joint'); ?></p>
        <?php endif; ?>
    </main>
<?php endif; ?>

<?php get_footer(); ?>