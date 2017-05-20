<?php
namespace Gmopx\LaravelOWM;

use Cmfcmf\OpenWeatherMap;

class LaravelOWM
{
    /**
     * @var mixed
     */
    protected $config;

    /**
     * @var
     */
    protected $api_key;

    public function __construct()
    {
        $this->config = config('laravel-owm');

        if ($this->config === null) {
            throw new \Exception('config/laravel-owm.php not found');
        }

        if ($this->config['api_key'] === null) {
            throw new \Exception('laravel-owm.api_key not found');
        }

        $this->api_key = $this->config['api_key'];
    }

    /**
     * Get the current weather of the requested location/city.
     *
     * More info about how to interact with the results:
     *
     * https://github.com/cmfcmf/OpenWeatherMap-PHP-Api/blob/master/Examples/CurrentWeather.php
     *
     * There are three ways to specify the place to get weather information for
     *  - Use the city name: $query must be a string containing the city name.
     *  - Use the city id: $query must be an integer containing the city id.
     *  - Use the coordinates: $query must be an associative array containing the 'lat' and 'lon' values.
     *
     * @param array|int|string $query
     * @param string $lang
     * @param string $units
     * @param bool $cache
     * @param int $time
     * @return OpenWeatherMap\CurrentWeather
     */
    public function getCurrentWeather($query, $lang = 'en', $units = 'metric', $cache = false, $time = 600)
    {
        $lang = $lang ?: 'en';
        $units = $units ?: 'metric';

        if ($cache) {
            $owm = new OpenWeatherMap($this->api_key, null, new Cache(), $time);
            return $owm->getWeather($query, $units, $lang);
        }

        $owm = new OpenWeatherMap($this->api_key);
        return $owm->getWeather($query, $units, $lang);
    }

    /**
     * Get the forecast of the requested location/city.
     *
     * More info about how to interact with the results:
     *
     * https://github.com/cmfcmf/OpenWeatherMap-PHP-Api/blob/master/Examples/WeatherForecast.php
     *
     * There are three ways to specify the place to get weather information for:
     *  - Use the city name: $query must be a string containing the city name.
     *  - Use the city id: $query must be an integer containing the city id.
     *  - Use the coordinates: $query must be an associative array containing the 'lat' and 'lon' values.
     *
     * @param array|int|string $query
     * @param string $lang
     * @param string $units
     * @param int $days
     * @param bool $cache
     * @param int $time
     * @return OpenWeatherMap\WeatherForecast
     */
    public function getWeatherForecast($query, $lang = 'en', $units = 'metric', $days = 5, $cache = false, $time = 600)
    {
        $lang = $lang ?: 'en';
        $units = $units ?: 'metric';
        $days = $days ?: 6;

        if ($cache) {
            $owm = new OpenWeatherMap($this->api_key, null, new Cache(), $time);
            return $owm->getWeatherForecast($query, $units, $lang, '', $days);
        }

        $owm = new OpenWeatherMap($this->api_key);
        return $owm->getWeatherForecast($query, $units, $lang, '', $days);
    }

    /**
     * Get the daily forecast of the requested location/city.
     *
     *
     * There are three ways to specify the place to get weather information for:
     *  - Use the city name: $query must be a string containing the city name.
     *  - Use the city id: $query must be an integer containing the city id.
     *  - Use the coordinates: $query must be an associative array containing the 'lat' and 'lon' values.
     *
     * @param array|int|string $query
     * @param string $lang
     * @param string $units
     * @param int $days
     * @param bool $cache
     * @param int $time
     * @return OpenWeatherMap\WeatherForecast
     */
    public function getDailyWeatherForecast($query, $lang = 'en', $units = 'metric', $days = 5, $cache = false, $time = 600)
    {
        $lang = $lang ?: 'en';
        $units = $units ?: 'metric';
        $days = $days ?: 6;

        if ($cache) {
            $owm = new OpenWeatherMap($this->api_key, null, new Cache(), $time);
            return $owm->getDailyWeatherForecast($query, $units, $lang, '', $days);
        }

        $owm = new OpenWeatherMap($this->api_key);
        return $owm->getDailyWeatherForecast($query, $units, $lang, '', $days);
    }

    /**
     * Returns the weather history for the place you specified.
     *
     * More info about how to interact with the results:
     *
     * https://github.com/cmfcmf/OpenWeatherMap-PHP-Api/blob/master/Examples/WeatherHistory.php
     *
     * There are three ways to specify the place to get weather information for:
     *  - Use the city name: $query must be a string containing the city name.
     *  - Use the city id: $query must be an integer containing the city id.
     *  - Use the coordinates: $query must be an associative array containing the 'lat' and 'lon' values.
     *
     * @param array|int|string $query
     * @param \DateTime $start
     * @param int $endOrCount
     * @param string $type
     * @param string $lang
     * @param string $units
     * @param bool $cache
     * @param int $time
     * @return OpenWeatherMap\WeatherHistory
     */
    public function getWeatherHistory($query, \DateTime $start, $endOrCount = 1, $type = 'hour', $lang = 'en', $units = 'metric', $cache = false, $time = 600)
    {
        $lang = $lang ?: 'en';
        $units = $units ?: 'metric';
        $start = $start ?: new \DateTime;
        $endOrCount = $endOrCount ?: 1;
        $type = $type ?: 'hour';

        if ($cache) {
            $owm = new OpenWeatherMap($this->api_key, null, new Cache(), $time);
            return $owm->getWeatherHistory($query, $start, $endOrCount, $type, $units, $lang, '');
        }

        $owm = new OpenWeatherMap($this->api_key);
        return $owm->getWeatherHistory($query, $start, $endOrCount, $type, $units, $lang, '');
    }
}
