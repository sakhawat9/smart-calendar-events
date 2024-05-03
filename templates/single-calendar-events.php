<?php
/**
 * The template for displaying single events.
 *
 * @package Smart_Calendar_Events
 */

get_header();

// Start the loop.
while (have_posts()) :
    the_post();
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php the_content(); ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <?php
            // Display event date
            $event_date = get_post_meta(get_the_ID(), 'event_date', true);
            if (!empty($event_date)) {
                echo '<p><strong>' . __('Event Date:', 'your-text-domain') . '</strong> ' . esc_html($event_date) . '</p>';
            }
            ?>
        </footer><!-- .entry-footer -->
    </article><!-- #post-<?php the_ID(); ?> -->

    <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;

// End of the loop.
endwhile;

get_footer();

