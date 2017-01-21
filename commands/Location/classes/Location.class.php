<?php
class Location {
	protected $formatted_address;
	protected $location_lat;
	protected $location_lng;

	public function __construct() {
		$this->formatted_address = null;
		$this->location_lat = null;
		$this->location_lng = null;

		return $this;
	}

	public static function fetchByAddress(string $address) : array {
		$response = [];

		# prepare url
		$address = urlencode($address);
		$url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=" . $address;
		
		# get results
		$results = file_get_contents($url);
		$results = json_decode($results,true);

		# store results
		foreach ( $results['results'] as $location ) {
			$temp = (new Location())
				->setFormattedAddress( $location['formatted_address'] )
				->setLocationLat( $location['geometry']['location']['lat'] )
				->setLocationLng( $location['geometry']['location']['lng'] );
			array_push($response, clone $temp);
		}

		return $response;
	}

	public function setFormattedAddress(string $formatted_address) : Location {
		$this->formatted_address = $formatted_address;
		return $this;
	}

	public function getFormattedAddress() : string {
		return $this->formatted_address;
	}

	public function setLocationLat(string $location_lat) : Location {
		$this->location_lat = $location_lat;
		return $this;
	}

	public function getLocationLat() : string {
		return $this->location_lat;
	}

	public function setLocationLng(string $location_lng) : Location {
		$this->location_lng = $location_lng;
		return $this;
	}

	public function getLocationLng() : string {
		return $this->location_lng;
	}
}