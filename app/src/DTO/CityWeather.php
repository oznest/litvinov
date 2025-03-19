<?php
declare(strict_types=1);

namespace App\DTO;

class CityWeather
{
    private Location $location;

    private Current $current;

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function getCurrent(): Current
    {
        return $this->current;
    }
}
