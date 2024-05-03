<?php
/**
 * The admin class
 *
 * @package smart-calendar-events
 */

namespace Fixolab\SmartCalendarEvents;


class Admin {
    /**
	 * Constructor
	 */
	public function __construct() {		
		new Admin\Menu();
		new Admin\Post_Type();
    }    
}