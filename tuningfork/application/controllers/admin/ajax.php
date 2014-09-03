<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends Admin_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct()
    {
    	parent::__construct();
		$this->load->model('Instrument_model');
		$this->load->model('Membre_model');
		$this->load->model('Emprunt_model');
    }

	public function searchMember($search)
	{
		$membres = $this->Membre_model->search_membre($search);

		echo json_encode($membres);
	}

	public function searchInstru($search)
	{
		$instruments = $this->Instrument_model->search_instru($search);

		echo json_encode($instruments);
	}

}