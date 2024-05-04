<div class="wrap">
    <h1 class="text-2xl font-bold mb-4"><?php echo esc_html__('Calendar Events', 'smart-calendar-events'); ?></h1>
    <header class="flex justify-between items-center py-4 px-6 border border-gray-200">
        <h1 id="calendarMonth" class="text-lg font-bold"><time><?php echo date('F Y', mktime(0, 0, 0, $current_month, 1, $current_year)); ?></time></h1>
        <div class="flex items-center space-x-4">
            <button id="prevMonth" type="button" class="flex items-center space-x-1 px-2 py-1 rounded-md border border-gray-300 bg-white text-sm text-gray-700 hover:bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd"></path>
                </svg>
            </button>
            <button id="nextMonth" type="button" class="flex items-center space-x-1 px-2 py-1 rounded-md border border-gray-300 bg-white text-sm text-gray-700 hover:bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd"></path>
                </svg>
            </button>
            <button type="button" class="px-4 py-2 rounded-md bg-blue-500 text-white text-sm font-semibold hover:bg-blue-600">Add event</button>
        </div>
    </header>
    <div id="calendar" data-current-month="<?php echo $current_month; ?>" data-current-year="<?php echo $current_year; ?>">
        <table class="event-calendar border border-gray-200 w-full">
            <thead class="border-b border-gray-200">
                <tr>
                    <th class="px-4 py-2 border border-gray-200"><?php echo esc_html__('Sunday', 'smart-calendar-events'); ?></th>
                    <th class="px-4 py-2 border border-gray-200"><?php echo esc_html__('Monday', 'smart-calendar-events'); ?></th>
                    <th class="px-4 py-2 border border-gray-200"><?php echo esc_html__('Tuesday', 'smart-calendar-events'); ?></th>
                    <th class="px-4 py-2 border border-gray-200"><?php echo esc_html__('Wednesday', 'smart-calendar-events'); ?></th>
                    <th class="px-4 py-2 border border-gray-200"><?php echo esc_html__('Thursday', 'smart-calendar-events'); ?></th>
                    <th class="px-4 py-2 border border-gray-200"><?php echo esc_html__('Friday', 'smart-calendar-events'); ?></th>
                    <th class="px-4 py-2 border border-gray-200"><?php echo esc_html__('Saturday', 'smart-calendar-events'); ?></th>
                </tr>
            </thead>
            <tbody>
                <!-- Calendar Loop -->
                <tr>
                    <?php
                    $day_of_week = date('w', mktime(0, 0, 0, $current_month, 1, $current_year));
                    for ($i = 0; $i < $day_of_week; $i++) {
                        echo '<td class="px-4 py-2 border border-gray-200"></td>';
                    }

                    for ($day = 1; $day <= $num_days; $day++) {
                        $date = mktime(0, 0, 0, $current_month, $day, $current_year);
                        $event_date = date('Y-m-d', $date);
                        $event_titles = $this->get_event_titles_for_date($current_month_events, $event_date);

                        echo '<td class="px-4 py-2 border border-gray-200">';
                        echo '<strong>' . $day . '</strong><br>';
                        if (!empty($event_titles)) {
                            echo '<ul>';
                            foreach ($event_titles as $event) {
                                $event_url = get_permalink($event->ID);
                                echo '<li><a href="' . esc_url($event_url) . '">' . esc_html($event->post_title) . '</a></li>';
                            }
                            echo '</ul>';
                        }
                        echo '</td>';

                        if (date('w', $date) == 6) {
                            echo '</tr><tr>';
                        }
                    }
                    ?>
                </tr>
                <!-- End Calendar Loop -->
            </tbody>
        </table>
    </div>
</div>