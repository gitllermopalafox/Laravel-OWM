# Laravel-OWM (Open Weather Map)
## A wrapper for [OpenWeatherMap-PHP-Api](https://github.com/cmfcmf/OpenWeatherMap-PHP-Api) writen by [@cmfcmf](https://github.com/cmfcmf)
### This package allows you to implement OpenWeatherMap-PHP-Api in laravel-way in your Laravel project.

#### 1. Installation

`composer require gmopx/laravel-owm`

#### 2. Add this line to your conf/app.php file

For Laravel == 5.0.*

```
'Gmopx\LaravelOWM\LaravelOWMServiceProvider'
```

For Laravel <= 5.4.*

```
Gmopx\LaravelOWM\LaravelOWMServiceProvider::class,

```

For Laravel >= 5.5.* will use the auto-discovery function.

#### 3. Publish the config file (config/laravel-owm.php)

`php artisan vendor:publish --provider="Gmopx\LaravelOWM\LaravelOWMServiceProvider"`


#### 4. Add your Open Weather Map API key

```
   ...
       'api_key' => '',            // visit: http://openweathermap.org/appid#get for more info.
       'routes_enabled' => true,   // If the routes have to be enabled.
   ...
```

### How to use...

#### Current weather

```
...
use Gmopx\LaravelOWM\LaravelOWM;
...

public function foo()
{
    $lowm = new LaravelOWM();
    $current_weather = $lowm->getCurrentWeather('london');

    dd($current_weather->temperature);
}

```

Visit [https://github.com/cmfcmf/OpenWeatherMap-PHP-Api/blob/master/Examples/CurrentWeather.php](https://github.com/cmfcmf/OpenWeatherMap-PHP-Api/blob/master/Examples/CurrentWeather.php) for more info.


#### Forecast

```
...
use Gmopx\LaravelOWM\LaravelOWM;
...

public function bar()
{
    $lowm = new LaravelOWM();
    $forecast = $lowm->getWeatherForecast('london');

    dd($forecast);
}

```

Visit [https://github.com/cmfcmf/OpenWeatherMap-PHP-Api/blob/master/Examples/WeatherForecast.php](https://github.com/cmfcmf/OpenWeatherMap-PHP-Api/blob/master/Examples/WeatherForecast.php) for more info.


#### History

```
...
use Gmopx\LaravelOWM\LaravelOWM;
...

public function bar()
{
    $lowm = new LaravelOWM();

    // Get yesterday's date
    $date = new \DateTime();
    $date->add(\DateInterval::createFromDateString('yesterday'));

    $history = $lowm->getWeatherHistory('london', $date);

    dd($history);
}

```

Visit [https://github.com/cmfcmf/OpenWeatherMap-PHP-Api/blob/master/Examples/WeatherForecast.php](https://github.com/cmfcmf/OpenWeatherMap-PHP-Api/blob/master/Examples/WeatherForecast.php) for more info.

##### Parameters:

Note:
```
There are three ways to specify the place to get weather information for:
    - Use the city name: $query must be a string containing the city name.
    - Use the city id: $query must be an integer containing the city id.
    - Use the coordinates: $query must be an associative array containing the 'lat' and 'lon' values.
```

##### getCurrentWeather:
```
    /**
     * Get the current weather of the requested location/city.
     *
     * More info about how to interact with the results:
     *
     * https://github.com/cmfcmf/OpenWeatherMap-PHP-Api/blob/master/Examples/CurrentWeather.php
     *
     * @param $query            (required)
     * @param string $lang      (default: en) - http://openweathermap.org/current#multi.
     * @param string $units     (default: metric) - 'metric' or 'imperial'.
     * @param bool $cache       (default: false)
     * @param int $time         (default: 600)
     * @return OpenWeatherMap\CurrentWeather
     */
    public function getCurrentWeather($query, $lang = 'en', $units = 'metric', $cache = false, $time = 600)
    ...

```

##### getWeatherForecast:
```
    /**
     * Get the forecast of the requested location/city.
     *
     * More info about how to interact with the results:
     *
     * https://github.com/cmfcmf/OpenWeatherMap-PHP-Api/blob/master/Examples/WeatherForecast.php
     *
     * @param $query            (required)
     * @param string $lang      (default: en) - http://openweathermap.org/current#multi.
     * @param string $units     (default: metric) - 'metric' or 'imperial'.
     * @param int $days         (default: 5) - maximum 16.
     * @param bool $cache       (default: false)
     * @param int $time         (default: 600)
     * @return OpenWeatherMap\WeatherForecast
     */
    public function getWeatherForecast($query, $lang = 'en', $units = 'metric', $days = 5, $cache = false, $time = 600)
    ...

```

##### getDailyWeatherForecast:
```
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
    ...
```

##### getWeatherHistory:
```
    /**
     * Get the forecast of the requested location/city.
     *
     * More info about how to interact with the results:
     *
     * https://github.com/cmfcmf/OpenWeatherMap-PHP-Api/blob/master/Examples/WeatherHistory.php
     *
     * @param $query            (required)
     * @param \DateTime $start  (default: today)
     * @param int $endOrCount   (default: 1)
     * @param string $type      (default: hour) - 'tick', 'hour', or 'day'
     * @param string $lang      (default: en) - http://openweathermap.org/current#multi.
     * @param string $units     (default: metric) - 'metric' or 'imperial'.
     * @param bool $cache       (default: false)
     * @param int $time         (default: 600)
     * @return OpenWeatherMap\WeatherForecast
     */
    public function getWeatherHistory($query, \DateTime $start, $endOrCount = 1, $type = 'hour', $lang = 'en', $units = 'metric', $cache = false, $time = 600)
    ...

```


### Routes

#### Additionally this package includes 2 routes ready-to-use that shows weather data in JSON format.

`[GET]` `/current-weather`

Parameters:
```
city: 'London'
coord: ['lat': -0.13, 'lon': 51.51]
lang: 'en' (default: 'en')
units: 'metric'||'imperial' (default: 'metric')
```

`[GET]` `/forecast`

Parameters:
```
city: 'London'
coord: ['lat': -0.13, 'lon': 51.51]
lang: 'en' (default: 'en')
units: 'metric'||'imperial' (default: 'metric')
days: 5 (default: 5)
```

Note: You must use `city` or `coord` but not both.


#### /current-weather

Consider the following:

- The timezone for the dates of the results is taken from the `app/config.php` file ('app.timezone').

```
{
   "status":"ok",
   "data":{
      "city":{
         "id":2643743,
         "name":"London",
         "lat":51.51,
         "lon":-0.13,
         "country":"GB",
         "population":null
      },
      "sun":{
         "rise":{
            "date":"2016-09-14 05:34:37",
            "timestamp":1473831277
         },
         "set":{
            "date":"2016-09-14 18:16:08",
            "timestamp":1473876968
         }
      },
      "lastUpdate":{
         "date":"2016-09-14 03:58:17",
         "timestamp":1473825497
      },
      "temperature":{
         "now":{
            "value":19.39,
            "unit":"&deg;C"
         },
         "min":{
            "value":17,
            "unit":"&deg;C"
         },
         "max":{
            "value":21.67,
            "unit":"&deg;C"
         }
      },
      "humidity":{
         "value":82,
         "unit":"%"
      },
      "pressure":{
         "value":1008,
         "unit":"hPa"
      },
      "wind":{
         "speed":{
            "value":2.1,
            "unit":"m/s",
            "description":"Light breeze",
            "description_slug":"light-breeze"
         },
         "direction":{
            "value":100,
            "unit":"E",
            "description":"East",
            "description_slug":"east"
         }
      },
      "clouds":{
         "value":8,
         "unit":"",
         "description":"clear sky",
         "description_slug":"clear-sky"
      },
      "precipitation":{
         "value":0,
         "unit":"",
         "description":"no",
         "description_slug":"no"
      },
      "weather":{
         "id":800,
         "description":"clear sky",
         "description_slug":"clear-sky",
         "icon":"02n"
      }
   }
}

```

### /forecast (5 days)

Consider the following:

- The timezone for the dates of the results is taken from the `app/config.php` file ('app.timezone').
- The indexes of the days array, are ISO-8601 numeric representation of the day of the week, 1 (for Monday) through 7 (for Sunday).
- The OWM API returns 3 hour forecast data, it means for each day you requested you'll get weather data each 3 hours in this order:
06:00 - 09:00, 09:00 - 12:00, 12:00 - 15:00, 15:00 - 18:00, 18:00 - 21:00, 21:00 - 00:00.
So to maintain a well-ordered info I built a key depending on the hours range (ie: ['06-09'] : { ... }).

```
{
   "status":"ok",
   "data":{
      "city":{
         "id":0,
         "name":"London",
         "lat":51.50853,
         "lon":-0.12574,
         "country":"GB",
         "population":null
      },
      "sun":{
         "rise":{
            "date":"2016-09-14 05:34:37",
            "timestamp":1473831277
         },
         "set":{
            "date":"2016-09-14 18:16:05",
            "timestamp":1473876965
         }
      },
      "lastUpdate":{
         "date":"2016-09-14 04:17:23",
         "timestamp":1473826643
      },
      "days":{
         "3":{
            "06-09":{
               "time":{
                  "from":{
                     "date":"2016-09-14 06:00:00",
                     "timestamp":1473832800
                  },
                  "to":{
                     "date":"2016-09-14 09:00:00",
                     "timestamp":1473843600
                  },
                  "day":{
                     "date":"2016-09-14 00:00:00",
                     "timestamp":1473811200
                  }
               },
               "lastUpdate":{
                  "date":"2016-09-14 04:17:23",
                  "timestamp":1473826643
               },
               "temperature":{
                  "now":{
                     "value":25.45,
                     "unit":"&deg;C"
                  },
                  "min":{
                     "value":25.18,
                     "unit":"&deg;C"
                  },
                  "max":{
                     "value":25.72,
                     "unit":"&deg;C"
                  }
               },
               "humidity":{
                  "value":53,
                  "unit":"%"
               },
               "pressure":{
                  "value":1016.12,
                  "unit":"hPa"
               },
               "wind":{
                  "speed":{
                     "value":3.12,
                     "unit":"m\/s",
                     "description":"Light breeze",
                     "description_slug":"light-breeze"
                  },
                  "direction":{
                     "value":111.003,
                     "unit":"ESE",
                     "description":"East-southeast",
                     "description_slug":"east-southeast"
                  }
               },
               "clouds":{
                  "value":0,
                  "unit":"%",
                  "description":"clear sky",
                  "description_slug":"clear-sky"
               },
               "precipitation":{
                  "value":0,
                  "unit":"",
                  "description":"",
                  "description_slug":""
               },
               "weather":{
                  "id":800,
                  "description":"clear sky",
                  "description_slug":"clear-sky",
                  "icon":"01d"
               }
            },

            ...
         },
         "4":{
            "03-06":{
               "time":{
                  "from":{
                     "date":"2016-09-15 03:00:00",
                     "timestamp":1473908400
                  },
                  "to":{
                     "date":"2016-09-15 06:00:00",
                     "timestamp":1473919200
                  },
                  "day":{
                     "date":"2016-09-15 00:00:00",
                     "timestamp":1473897600
                  }
               },
               "lastUpdate":{
                  "date":"2016-09-14 04:17:23",
                  "timestamp":1473826643
               },
               "temperature":{
                  "now":{
                     "value":16.34,
                     "unit":"&deg;C"
                  },
                  "min":{
                     "value":16.34,
                     "unit":"&deg;C"
                  },
                  "max":{
                     "value":16.34,
                     "unit":"&deg;C"
                  }
               },
               "humidity":{
                  "value":82,
                  "unit":"%"
               },
               "pressure":{
                  "value":1015.58,
                  "unit":"hPa"
               },
               "wind":{
                  "speed":{
                     "value":1.22,
                     "unit":"m\/s",
                     "description":"Calm",
                     "description_slug":"calm"
                  },
                  "direction":{
                     "value":40.0064,
                     "unit":"NE",
                     "description":"NorthEast",
                     "description_slug":"northeast"
                  }
               },
               "clouds":{
                  "value":8,
                  "unit":"%",
                  "description":"clear sky",
                  "description_slug":"clear-sky"
               },
               "precipitation":{
                  "value":0,
                  "unit":"",
                  "description":"",
                  "description_slug":""
               },
               "weather":{
                  "id":800,
                  "description":"clear sky",
                  "description_slug":"clear-sky",
                  "icon":"02d"
               }
            },
            ...
         },
         "5":{
            "03-06":{
               "time":{
                  "from":{
                     "date":"2016-09-16 03:00:00",
                     "timestamp":1473994800
                  },
                  "to":{
                     "date":"2016-09-16 06:00:00",
                     "timestamp":1474005600
                  },
                  "day":{
                     "date":"2016-09-16 00:00:00",
                     "timestamp":1473984000
                  }
               },
               "lastUpdate":{
                  "date":"2016-09-14 04:17:23",
                  "timestamp":1473826643
               },
               "temperature":{
                  "now":{
                     "value":17,
                     "unit":"&deg;C"
                  },
                  "min":{
                     "value":17,
                     "unit":"&deg;C"
                  },
                  "max":{
                     "value":17,
                     "unit":"&deg;C"
                  }
               },
               "humidity":{
                  "value":87,
                  "unit":"%"
               },
               "pressure":{
                  "value":1018.92,
                  "unit":"hPa"
               },
               "wind":{
                  "speed":{
                     "value":2.81,
                     "unit":"m\/s",
                     "description":"Light breeze",
                     "description_slug":"light-breeze"
                  },
                  "direction":{
                     "value":314.505,
                     "unit":"NW",
                     "description":"Northwest",
                     "description_slug":"northwest"
                  }
               },
               "clouds":{
                  "value":88,
                  "unit":"%",
                  "description":"overcast clouds",
                  "description_slug":"overcast-clouds"
               },
               "precipitation":{
                  "value":0,
                  "unit":"",
                  "description":"",
                  "description_slug":""
               },
               "weather":{
                  "id":804,
                  "description":"overcast clouds",
                  "description_slug":"overcast-clouds",
                  "icon":"04d"
               }
            },
            ...
         },
         "6":{
            "03-06":{
               "time":{
                  "from":{
                     "date":"2016-09-17 03:00:00",
                     "timestamp":1474081200
                  },
                  "to":{
                     "date":"2016-09-17 06:00:00",
                     "timestamp":1474092000
                  },
                  "day":{
                     "date":"2016-09-17 00:00:00",
                     "timestamp":1474070400
                  }
               },
               "lastUpdate":{
                  "date":"2016-09-14 04:17:23",
                  "timestamp":1473826643
               },
               "temperature":{
                  "now":{
                     "value":11.53,
                     "unit":"&deg;C"
                  },
                  "min":{
                     "value":11.53,
                     "unit":"&deg;C"
                  },
                  "max":{
                     "value":11.53,
                     "unit":"&deg;C"
                  }
               },
               "humidity":{
                  "value":91,
                  "unit":"%"
               },
               "pressure":{
                  "value":1029.85,
                  "unit":"hPa"
               },
               "wind":{
                  "speed":{
                     "value":2.91,
                     "unit":"m\/s",
                     "description":"Light breeze",
                     "description_slug":"light-breeze"
                  },
                  "direction":{
                     "value":314.505,
                     "unit":"NW",
                     "description":"Northwest",
                     "description_slug":"northwest"
                  }
               },
               "clouds":{
                  "value":36,
                  "unit":"%",
                  "description":"scattered clouds",
                  "description_slug":"scattered-clouds"
               },
               "precipitation":{
                  "value":0,
                  "unit":"",
                  "description":"",
                  "description_slug":""
               },
               "weather":{
                  "id":802,
                  "description":"scattered clouds",
                  "description_slug":"scattered-clouds",
                  "icon":"03d"
               }
            },
            ...
         },
         "7":{
            "03-06":{
               "time":{
                  "from":{
                     "date":"2016-09-18 03:00:00",
                     "timestamp":1474167600
                  },
                  "to":{
                     "date":"2016-09-18 06:00:00",
                     "timestamp":1474178400
                  },
                  "day":{
                     "date":"2016-09-18 00:00:00",
                     "timestamp":1474156800
                  }
               },
               "lastUpdate":{
                  "date":"2016-09-14 04:17:23",
                  "timestamp":1473826643
               },
               "temperature":{
                  "now":{
                     "value":11.44,
                     "unit":"&deg;C"
                  },
                  "min":{
                     "value":11.44,
                     "unit":"&deg;C"
                  },
                  "max":{
                     "value":11.44,
                     "unit":"&deg;C"
                  }
               },
               "humidity":{
                  "value":98,
                  "unit":"%"
               },
               "pressure":{
                  "value":1031.08,
                  "unit":"hPa"
               },
               "wind":{
                  "speed":{
                     "value":2.96,
                     "unit":"m\/s",
                     "description":"Light breeze",
                     "description_slug":"light-breeze"
                  },
                  "direction":{
                     "value":240.011,
                     "unit":"WSW",
                     "description":"West-southwest",
                     "description_slug":"west-southwest"
                  }
               },
               "clouds":{
                  "value":0,
                  "unit":"%",
                  "description":"clear sky",
                  "description_slug":"clear-sky"
               },
               "precipitation":{
                  "value":0,
                  "unit":"",
                  "description":"",
                  "description_slug":""
               },
               "weather":{
                  "id":800,
                  "description":"clear sky",
                  "description_slug":"clear-sky",
                  "icon":"01d"
               }
            },
            ...
         }
      }
   }
}
```

## Changelog

v0.1.2
- Support for getDailyWeatherForecast

v0.1.1
- Whitespace/formatting.
- Added getWeatherHistory method
- Additional README documentation

Thanks to: 
- [@nateritter](https://github.com/nateritter)
- [@jmaurer1994](https://github.com/jmaurer1994)

### License: MIT


### Contributing
You can help me fixing my horrific English in the documentation & comments.
