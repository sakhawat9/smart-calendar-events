// jQuery(document).ready(function ($) {
//   "use strict";
//   var sce_myScript = function () {
//     var ajaxurl = scevents.ajaxurl;
//     document.addEventListener("DOMContentLoaded", function () {
//       var calendar = document.getElementById("calendar");
//       var currentMonth = parseInt(calendar.getAttribute("data-current-month"));
//       var currentYear = parseInt(calendar.getAttribute("data-current-year"));

//       document
//         .getElementById("prevMonth")
//         .addEventListener("click", function () {
//           currentMonth--;
//           if (currentMonth < 1) {
//             currentMonth = 12;
//             currentYear--;
//           }
//           updateCalendar(currentMonth, currentYear);
//         });

//       document
//         .getElementById("nextMonth")
//         .addEventListener("click", function () {
//           currentMonth++;
//           if (currentMonth > 12) {
//             currentMonth = 1;
//             currentYear++;
//           }
//           updateCalendar(currentMonth, currentYear);
//         });

//       function updateCalendar(month, year) {
//         var xhr = new XMLHttpRequest();
//         xhr.open("GET", ajaxurl + "?month=" + month + "&year=" + year, true);
//         xhr.onload = function () {
//           if (xhr.status >= 200 && xhr.status < 300) {
//             var responseData = JSON.parse(xhr.responseText);
//             updateCalendarContent(responseData);
//           } else {
//             console.error("Failed to retrieve events");
//           }
//         };
//         xhr.send();
//       }

//       function updateCalendarContent(eventsData) {
//         var calendarBody = document.getElementById("calendarBody");
//         calendarBody.innerHTML = "";
//       }
//     });
//   };
//   sce_myScript();
// });
