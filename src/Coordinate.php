<?php


namespace Hanson\Coordinate;


class Coordinate
{

    public function distance($fromLng, $fromLat, $toLng, $toLat)
    {
        $earthRadius = 6367000; //approximate radius of earth in meters

        $lat1 = ($fromLat * pi() ) / 180;
        $lng1 = ($fromLng * pi() ) / 180;
        $lat2 = ($toLat * pi() ) / 180;
        $lng2 = ($toLng * pi() ) / 180;

        $calcLongitude = $lng2 - $lng1;
        $calcLatitude = $lat2 - $lat1;

        $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
        $stepTwo = 2 * asin(min(1, sqrt($stepOne)));

        $calculatedDistance = $earthRadius * $stepTwo;

        return round($calculatedDistance);
    }

    public function getAround($lng, $lat, $radius){
        $pai = 3.14159265;
        $degree = (24901 * 1609) / 360.0;
        $dpmLat = 1 / $degree;
        $radiusLat = $dpmLat * $radius;
        $minLat = $lat - $radiusLat;
        $maxLat = $lat + $radiusLat;
        $mpdLng = $degree * cos($lat * ($pai / 180));
        $dpmLng = 1 / $mpdLng;
        $radiusLng = $dpmLng * $radius;
        $minLng = $lng - $radiusLng;
        $maxLng = $lng + $radiusLng;

        return array($minLng, $maxLng, $minLat, $maxLat);
    }
}