// digital_watch.js

// Function to update the digital watch
function updateDigitalWatch() {
    // Get the current time using JavaScript Date object
    var currentTime = new Date();

    // Format the time as "Sun, 30th July 2023, 10:20 PM"
    var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    var dayOfWeek = days[currentTime.getDay()];
    var day = currentTime.getDate();
    var month = months[currentTime.getMonth()];
    var year = currentTime.getFullYear();
    var time = currentTime.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });

    // Update the digital watch content
    var digitalWatch = dayOfWeek + ', ' + day + 'th ' + month + ' ' + year + ', ' + time;
    $('#digital-watch').text(digitalWatch);
}

// Call the function once to display the initial time
updateDigitalWatch();

// Update the digital watch every second (1000 milliseconds)
setInterval(updateDigitalWatch, 1000);
