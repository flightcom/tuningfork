<?php

class Utils {
	
	public function __construct() {

	}

	public static function getGMapsCoordinates($address) {

		$url = "http://maps.google.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false";
		$data = json_decode(file_get_contents($url));
		return [
			'lat' => $data->results[0]->geometry->location->lat,
			'lng' => $data->results[0]->geometry->location->lng
		];
	}

}

