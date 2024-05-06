
<header class="flex justify-between items-center mb-4">
<h1 class="text-2xl font-bold mb-4"><?php echo esc_html__( 'Calendar Events', 'smart-calendar-events' ); ?></h1>
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
		<button type="button" class="px-4 py-2 rounded-md bg-blue-500 text-white text-sm font-semibold hover:bg-blue-600">
			<a class="hover:text-white" href="<?php echo esc_url( admin_url( 'post-new.php?post_type=calendar-events' ) ); ?>"><?php esc_html_e( 'Add event', 'smart-calendar-events' ); ?></a>
		</button>
	</div>
</header>




