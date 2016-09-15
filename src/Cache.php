<?php
namespace Gmopx\LaravelOWM;

use Cmfcmf\OpenWeatherMap\AbstractCache;

class Cache extends AbstractCache
{

    private function urlToPath($url)
    {
        $dir = app()->storagePath() . DIRECTORY_SEPARATOR . "OpenWeatherMapPHPAPI";
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        $path = $dir . DIRECTORY_SEPARATOR . md5($url);
        return $path;
    }

    /**
     * Checks whether a cached weather data is available.
     *
     * @param string $url The unique url of the cached content.
     *
     * @return bool False if no cached information is available, otherwise true.
     *
     * You need to check if a cached result is outdated here. Return false in that case.
     */
    public function isCached($url)
    {
        $path = $this->urlToPath($url);

        if (!file_exists($path) || filectime($path) + $this->seconds < time()) {
            return false;
        }

        return true;
    }

    /**
     * Returns cached weather data.
     *
     * @param string $url The unique url of the cached content.
     *
     * @return string|bool The cached data if it exists, false otherwise.
     */
    public function getCached($url)
    {
        return file_get_contents($this->urlToPath($url));
    }

    /**
     * Saves cached weather data.
     *
     * @param string $url The unique url of the cached content.
     * @param string $content The weather data to cache.
     *
     * @return bool True on success, false on failure.
     */
    public function setCached($url, $content)
    {
        file_put_contents($this->urlToPath($url), $content);
    }
}