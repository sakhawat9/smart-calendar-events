jQuery(document).ready(function($) {
    $('#prevMonth, #nextMonth').on('click', function() {
        var currentMonth = parseInt($('#calendar').data('current-month'));
        var currentYear = parseInt($('#calendar').data('current-year'));
        var direction = $(this).attr('id') === 'prevMonth' ? -1 : 1;

        // Calculate the new month and year values
        var newMonth = currentMonth + direction;
        var newYear = currentYear;

        if (newMonth === 0) {
            newMonth = 12;
            newYear--;
        } else if (newMonth === 13) {
            newMonth = 1;
            newYear++;
        }

        // Make AJAX request to fetch events for the new month and year
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'get_month_events',
                month: newMonth,
                year: newYear,
            },
            success: function(response) {
                $('#calendar').html(response);
                $('#calendar').data('current-month', newMonth);
                $('#calendar').data('current-year', newYear);
            }
        });
    });
});
