
<div class="block" style="<?= $css ?>">
	<div style="display:flex;justify-content:space-between;">
	  <div id="local-time"></div>
	  <div id="local-weather"></div>
	</div>
</div>

<script>
// Local time
function updateLocalTime() {
  const now = new Date();
  const options = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
  document.getElementById("local-time").textContent =
    new Intl.DateTimeFormat([], options).format(now);
}
setInterval(updateLocalTime, 1000);
updateLocalTime();

// Weather + City
navigator.geolocation.getCurrentPosition(
  function(pos) {
    const lat = pos.coords.latitude;
    const lon = pos.coords.longitude;

    // Get city name
    fetch(`https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${lat}&longitude=${lon}&localityLanguage=en`)
      .then(res => res.json())
      .then(loc => {
        const city = loc.city || loc.locality || loc.principalSubdivision;

        // Get weather
        fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true`)
          .then(res => res.json())
          .then(data => {
            const weather = data.current_weather;
            const tempC = weather.temperature;
            const tempF = (tempC * 9/5 + 32).toFixed(1);
            const icon = getWeatherIcon(weather.weathercode);
            document.getElementById("local-weather").textContent =
              `${city} | ${icon} ${tempC}°C / ${tempF}°F, wind ${weather.windspeed} km/h`;
          });
      });
  },
  function(err) {
    document.getElementById("local-weather").textContent = "Location denied";
    console.error(err);
  }
);

// Weather icon mapping
function getWeatherIcon(code) {
  if (code === 0) return "☀️";
  if (code >= 1 && code <= 3) return "🌤️";
  if (code === 45 || code === 48) return "🌫️";
  if (code >= 51 && code <= 57) return "🌦️";
  if (code >= 61 && code <= 67) return "🌧️";
  if (code >= 71 && code <= 77) return "❄️";
  if (code >= 80 && code <= 82) return "🌦️";
  if (code >= 85 && code <= 86) return "🌨️";
  if (code === 95) return "⛈️";
  if (code >= 96 && code <= 99) return "🌩️";
  return "";
}
</script>