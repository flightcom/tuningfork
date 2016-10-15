<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Entity\Station;
use Zend\View\Model\JsonModel;

class Stations extends MY_REST_Controller {

    public function __construct()
    {
    	parent::__construct();
    }

	public function index_get()
	{
		$id = $this->get('id') ? $this->get('id') : null;
		if ($id) {
			$stations = $this->em->getRepository('Entity\Station')->get($id);
		} else {
			$stations = $this->em->getRepository('Entity\Station')->getAll();
		}

		$this->response($stations, 200);
	}

	public function stations_get($id)
	{
		echo $this->get('id');
		// if ($id) {
		// 	$stations = $this->em->getRepository('Entity\Station')->get($id);
		// } else {
		// 	$stations = $this->em->getRepository('Entity\Station')->getAll();
		// }

		// $this->response(['stations' => $stations], 200);
	}

}