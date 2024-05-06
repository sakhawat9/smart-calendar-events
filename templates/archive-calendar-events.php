<?php

/**
 * The template for displaying events archive.
 *
 * @package Smart_Calendar_Events
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <header class="page-header">
            <h1 class="page-title"><?php post_type_archive_title(); ?></h1>
        </header>
        <div class="event-archive">
            <?php
            $output = "";
            $output = '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">';
            if (have_posts()) : ?>
                <?php while (have_posts()) : the_post();

                    $event_date = get_post_meta(get_the_ID(), 'event_date', true);
                    $event_excerpt = wp_trim_words(get_the_excerpt(), 15);
                    $event_image = get_the_post_thumbnail(get_the_ID(), 'full');
                    $event_permalink = get_permalink();

                    $output .= '<div class="bg-white rounded-lg shadow-md overflow-hidden">';
                    if ($event_image) {
                        $output .= '<a href="' . esc_url($event_permalink) . '">' . $event_image . '</a>';
                    }
                    $output .= '<div class="p-4">';
                    $output .= '<h2 class="text-lg font-semibold mb-2"><a href="' . esc_url($event_permalink) . '">' . esc_html(get_the_title()) . '</a></h2>';
                    if (!empty($event_date)) {
                        $output .= '<p class="text-gray-600"><strong>' . __('Event Date:', 'smart-calendar-events') . '</strong> ' . esc_html($event_date) . '</p>';
                    }
                    $output .= '<div class="text-gray-700">' . wp_kses_post($event_excerpt) . '</div>';
                    $output .= '</div>';
                    $output .= '</div>';

                endwhile;
                $output .= '</div>';
                echo wp_kses_post($output);
                ?>
            <?php else : ?>
                <p><?php esc_html_e('No events found.', 'smart-calendar-events'); ?></p>
            <?php endif; ?>

        </div>

    </main>
</div>

<?php
get_footer();
