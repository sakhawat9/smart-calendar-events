<?php

/**
 * The template for displaying single events.
 *
 * @package Smart_Calendar_Events
 */

get_header();
?>

<div class="grid grid-cols-12  px-4 py-8">
    <div class="col-start-3 col-span-8">
        <?php
        while (have_posts()) :
            the_post();
        ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white shadow-lg rounded-lg overflow-hidden'); ?>>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="entry-thumbnail">
                        <?php the_post_thumbnail('large', ['class' => 'w-full h-auto']); ?>
                    </div>
                <?php endif; ?>
                <div class="entry-header px-4 py-6">
                    <?php the_title('<h1 class="entry-title text-3xl font-bold">', '</h1>'); ?>
                </div>
                <div class="entry-footer bg-gray-200 text-gray-800 px-4 py-6">
                    <?php
                    // Display event date
                    $event_date = get_post_meta(get_the_ID(), 'event_date', true);
                    if (!empty($event_date)) {
                        echo '<p><strong>' . esc_html__('Event Date:', 'smart-calendar-events') . '</strong> ' . esc_html($event_date) . '</p>';
                    }
                    ?>
                </div>
                <div class="entry-content px-4 py-6">
                    <?php the_content(); ?>
                </div>

                
            </article>

        <?php
        // End of the loop.
        endwhile;
        ?>

    </div>
</div>
<?php
get_footer();
