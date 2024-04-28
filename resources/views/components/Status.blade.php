<section class="Status">
 <div class="weather" id="weather"></div>
 <div class="finished" id="finished">
    <div class="ntasks">
        <h1>00/00</h1>
        <p>Finished <br> tasks</p>
    </div>
 </div>
 <div class="Calendar" id="Calendar"></div>
</section>

<script>

      const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
      const currentDate = new Date();
      let calendarHTML = '<h2>Calendar</h2><ul>';
      for (let i = 0; i < 7; i++) {
        const day = new Date(currentDate);
        day.setDate(currentDate.getDate() + i);
        let dayHTML = `<li>${day.getDate()} <p>${days[i]}</p></li>`;
        if (day.toDateString() === currentDate.toDateString()) {
          dayHTML = `<li class="highlight" style="color: black; border: 1px solid black; background-color: transparent;">${day.getDate()}  <p>${days[day.getDay()]}</p></li>`;
        }
        calendarHTML += dayHTML;
      }
      calendarHTML += '</ul>';
      document.getElementById('Calendar').innerHTML = calendarHTML;

    const apiKey = '32ffe1919553cb3f3bd2b5fc0613b432';
    function getWeatherByLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(async position => {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
        const response = await fetch(`http://api.weatherstack.com/current?access_key=${apiKey}&query=${latitude},${longitude}`);
        const data = await response.json();
        displayWeather(data);
        }, error => {
        console.error('Error getting location:', error);
        document.getElementById('weather').innerHTML = '<p>Error getting location. Please try again later.</p>';
        });
    } else {
        console.error('Geolocation is not supported by this browser.');
        document.getElementById('weather').innerHTML = '<p>Geolocation is not supported by this browser.</p>';
    }
    }

    function displayWeather(data) {
    const weatherIcon = getWeatherIcon(data.current.weather_code);
    const weatherInfo = `
        <h2>${data.location.name}, ${data.location.country}</h2>
        <p>Temperature: ${data.current.temperature}°C</p>
        <p>Weather: ${weatherIcon}</p>
    `;
    document.getElementById('weather').innerHTML = weatherInfo;
  
    }

    function getWeatherIcon(weatherCode) {
    const weatherIcons = {
        113: '<i class="fas fa-sun"></i>', // Clear
        116: '<i class="fas fa-cloud-sun"></i>', // Partly cloudy
        119: '<i class="fas fa-cloud"></i>', // Cloudy
    };

    const defaultIcon = '<i class="fas fa-question-circle"></i>';

    return weatherIcons[weatherCode] || defaultIcon;
    }
    getWeatherByLocation();
</script>
