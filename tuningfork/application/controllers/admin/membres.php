<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Membres extends Admin_Controller {

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
		$this->load->model('Membre_model');
		$this->load->model('Emprunt_model');

		$this->menu = $this->load->view('admin/membres/menu', NULL, TRUE);
    }

	public function index($membre_id = null, $action = null)
	{
		if(is_null($membre_id) && is_null($action))
		{
			$this->lister_membres();
		} 
		else if(is_numeric($membre_id) && is_null($action))
		{
			$this->infos_membre($membre_id);
		}
		else if(is_numeric($membre_id) && !is_null($action))
		{
			switch($action) {
				case 'edit':
					$this->edit();
					break;
				default: show_404();
			}
		}
	}

	public function edit()
	{
		$this->form_validation->set_rules('adresse', 'Adresse', 'required');
		$this->form_validation->set_rules('telephone', 'Téléphone', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|is_unique');

		$data = array();
		$data['errors'] = array();

		if ($this->form_validation->run() == FALSE)
		{
			$data['errors']['newmarque'] = form_error('newmarque');
		}
		else
		{
			$marque = $this->input->post('newmarque');
			$res = $this->Instrument_model->insert_marque($marque);
			if($res){
				$data['success'] = 1;
				$data['marqueid'] = $res;
			}
			else {
				$data['success'] = 0;
			}
		}
		echo json_encode($data);
	}

	public function lister_membres()
	{
		$data = array(
			'membres' => $this->Membre_model->get_all_entries(),
			'title' => 'Liste des membres',
			);
		$content = $this->load->view('admin/membres/liste', $data, TRUE);
		$this->load->view('admin/master', array('title' => 'Liste des membres', 'content' => $content));
	}

	public function getMembres($method)
	{
		$data = array(
			'membres' => $this->Membre_model->get_all_entries(),
			'title' => 'Liste des membres',
			);
		switch( $method ) {
			case 'ajax' : echo json_encode($data); break;
			default: return $data;
		}
	}

	public function infos_membre($membre_id)
	{
		$data = array(
			'title'    => 'Informations sur le membre',
			'formid'   => 'edit-membre',
			'membre'   => $this->Membre_model->get_membre_by_id($membre_id),
			'emprunts' => $this->Emprunt_model->get_emprunts_by_membre_id($membre_id),
			'en_cours' => $this->Emprunt_model->check_emprunt_en_cours_by_membre_id($membre_id)
			);
		$content = $this->load->view('admin/membres/detail', $data, TRUE);
		$this->load->view('admin/master', array( 'content' => $content));
	}

	public function map()
	{
		$data = [
			'title' => 'Localisation des membres'
		];
		$content = $this->load->view('admin/membres/map', $data, TRUE);
		$this->load->view('admin/master', array( 'content' => $content));
	}

	public function add()
	{
		$data = [
			'title' => 'Ajouter un membre'
		];
		$content = $this->load->view('membres/new', $data, TRUE);
		$this->load->view('admin/master', array( 'content' => $content));
	}

	public function getMembresLocation($method = null)
	{
		$data = [];
		$membres = $this->Membre_model->get_all_entries();
		foreach($membres as $k => $membre) {
			$data['membres'][$k] = $membre;
			$adresse = str_replace(' ', '+', Membre_model::merge_address($membre));
			// $data['membres'][$k]->adresse = $adresse;
			$data['membres'][$k]->location = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$adresse));
		}
		switch($method)
		{
			case 'ajax':
				echo json_encode($data);
				break;
			default: return $data;
		}
		return;
	}

}