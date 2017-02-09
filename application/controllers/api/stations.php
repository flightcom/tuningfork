<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Entity\Station;

class Stations extends MY_REST_Controller {

    public function __construct()
    {
    	parent::__construct();
    }

	public function index_get($id = null)
	{
		$id = !$id ? ($this->get('id') ? $this->get('id') : null) : $id;

		if ($id) {
			$stations = $this->em->getRepository('Entity\Station')->get($id);
		} else {
			$stations = $this->em->getRepository('Entity\Station')->getAll();
		}

		$this->response($stations, 200);
	}

}
