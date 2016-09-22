<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recherche extends Admin_Controller {

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
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Instrument_model');
		$this->load->model('Membre_model');
		$this->load->model('Emprunt_model');

    }

	public function index()
	{
		$search = $this->input->post('search');

		$data = array(
			'membres' => $this->Membre_model->search_membre($search),
			'instruments' => $this->Instrument_model->search_instru($search),
			'title' => 'Résultats de la recherche',
			);
		$content = $this->load->view('admin/results', $data, TRUE);
		$this->load->view('admin/master', array('title' => $data['title'], 'content' => $content));

	}

}