
    <div id="calendar" data-current-month="<?php echo $current_month; ?>" data-current-year="<?php echo $current_year; ?>">
    <header class="flex justify-between items-center py-4 px-6 border border-gray-200">

<h1 id="calendarMonth" class="text-lg font-bold !p-0"><time><?php echo date('F Y', mktime(0, 0, 0, $current_month, 1, $current_year)); ?></time></h1>

</header>
        <table class="event-calendar border border-gray-200 w-full">
            <thead class="border-b border-gray-200">
                <tr>
                    <th class="px-4 py-2 border border-gray-200 w-[14.28%]"><?php echo esc_html__('Sunday', 'smart-calendar-events'); ?></th>
                    <th class="px-4 py-2 border border-gray-200 w-[14.28%]"><?php echo esc_html__('Monday', 'smart-calendar-events'); ?></th>
                    <th class="px-4 py-2 border border-gray-200 w-[14.28%]"><?php echo esc_html__('Tuesday', 'smart-calendar-events'); ?></th>
                    <th class="px-4 py-2 border border-gray-200 w-[14.28%]"><?php echo esc_html__('Wednesday', 'smart-calendar-events'); ?></th>
                    <th class="px-4 py-2 border border-gray-200 w-[14.28%]"><?php echo esc_html__('Thursday', 'smart-calendar-events'); ?></th>
                    <th class="px-4 py-2 border border-gray-200 w-[14.28%]"><?php echo esc_html__('Friday', 'smart-calendar-events'); ?></th>
                    <th class="px-4 py-2 border border-gray-200 w-[14.28%]"><?php echo esc_html__('Saturday', 'smart-calendar-events'); ?></th>
                </tr>
            </thead>
            <tbody>
                <!-- Calendar Loop -->
                <tr>
                    <?php
                    $day_of_week = date('w', mktime(0, 0, 0, $current_month, 1, $current_year));

                    for ($i = 0; $i < $day_of_week; $i++) {
                        echo '<td class="px-4 py-2 border border-gray-200 w-[14.28%]"></td>';
                    }

                    for ($day = 1; $day <= $num_days; $day++) {
                        $date = mktime(0, 0, 0, $current_month, $day, $current_year);
                        $event_date = date('Y-m-d', $date);
                        $event_titles = $this->get_event_titles_for_date($current_month_events, $event_date);
                        echo '<td class="px-4 py-2 border border-gray-200 w-[14.28%]">';
                        echo '<strong>' . $day . '</strong><br>';
                        if (!empty($event_titles)) {
                            echo '<ul class="pl-4">';
                            foreach ($event_titles as $event) {
                                $event_url = get_permalink($event->ID);
                                echo '<li class="list-disc"><a class="text-[#0017bd]" href="' . esc_url($event_url) . '">' . esc_html($event->post_title) . '</a></li>';
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