<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Station extends MY_Controller {

    public function __construct()
    {
    	parent::__construct();
		$this->load->model('Instrument_model');
		$this->load->model('Membre_model');
		$this->load->model('Emprunt_model');
		$this->load->library('Utils');
    }


	public function get() {
		$stations = $this->Instrument_model->get_stations_addresses();
		foreach ($stations as $key => $station) {
			$adresse['location'] = Utils::getGMapsCoordinates($station->adresse);
			$adresse['name'] = $station->name;
			$adresses[] = $adresse;
		}
		// die('<pre>'.print_r($adresses, true));
		echo json_encode($adresses);
	}

}