<?php

namespace Fixolab\SmartCalendarEvents\Frontend;

/**
 * @package    Smart_Calendar_Events
 * @subpackage Smart_Calendar_Events/frontend
 */

class Shortcode
{
    public function __construct()
    {
        add_shortcode('smart-calendar-events', array($this, 'sce_shortcode_render'));
    }

    public function sce_shortcode_render($attributes)
    {
        $args = array(
            'post_type'      => 'calendar-events',
            'posts_per_page' => 6,
            'orderby' => 'meta_value',
            'meta_key' => 'event_date',
            'order' => 'ASC',
        );

        $events_query = new \WP_Query($args);
        $all_events = $events_query->posts;

        $output = '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">';
        foreach ($all_events as $event) {
            $event_date = get_post_meta($event->ID, 'event_date', true);
            $event_excerpt = wp_trim_words($event->post_excerpt, 15);
            $event_image = get_the_post_thumbnail_url($event->ID, 'full');
            $event_permalink = get_permalink($event->ID);

            $output .= '<div class="bg-white rounded-lg shadow-md overflow-hidden">';
            if ($event_image) {
                $output .= '<a href="' . esc_url($event_permalink) . '"><img src="' . esc_url($event_image) . '" alt="' . esc_attr($event->post_title) . '"></a>';
            }
            $output .= '<div class="p-4">';
            $output .= '<h2 class="text-lg font-semibold mb-2"><a href="' . esc_url($event_permalink) . '">' . esc_html($event->post_title) . '</a></h2>';
            if (!empty($event_date)) {
                $output .= '<p class="text-gray-600"><strong>' . __('Event Date:', 'smart-calendar-events') . '</strong> ' . esc_html($event_date) . '</p>';
            }
            $output .= '<div class="text-gray-700">' . wp_kses_post($event_excerpt) . '</div>';
            $output .= '</div>';
            $output .= '</div>';
        }
        $output .= '</div>';

        return $output;
    }
}
