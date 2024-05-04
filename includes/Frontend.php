<?php

/**
 * The Frontend class
 *
 * @package smart-calendar-events
 */

namespace Fixolab\SmartCalendarEvents;

class Frontend
{
    /**
     * Constructor
     */
    public function __construct()
    {
        add_filter('template_include', [$this, 'load_event_template']);
        
        new Frontend\Shortcode();
    }

    public function load_event_template($template)
    {
        if (is_singular('calendar-events')) {
            $custom_template = SCE_DIR_PATH_TEMPLATES . 'single-calendar-events.php';
            if (file_exists($custom_template)) {
                return $custom_template;
            }
        }
        if (is_post_type_archive('calendar-events')) {
            return SCE_DIR_PATH_TEMPLATES . 'archive-calendar-events.php';
        }
        return $template;
    }
}
