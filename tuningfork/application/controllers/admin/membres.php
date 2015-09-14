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

		$this->breadcrumb->add('Membres', '/membres');
    }

	public function index($membre_id = null, $action = null)
	{
		if(is_null($membre_id) && is_null($action))
		{
			$this->liste();
		} 
		else if(is_numeric($membre_id) && is_null($action))
		{
			$this->read($membre_id);
		}
		else if(is_numeric($membre_id) && !is_null($action))
		{
			if(method_exists($this, $action)) {
				$this->$action($membre_id);
			} else {
				show_404();
			}
		}
	}

	public function edit($membre_id, $method = null)
	{
		$id = $membre_id;

		$this->form_validation->set_rules('adresse', 'Adresse', 'required');
		$this->form_validation->set_rules('tel', 'Téléphone', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('ville', 'Téléphone', 'required');

		$data = array();
		$data['errors'] = array();

		if ($this->form_validation->run() == FALSE)
		{
			$data['errors']['adresse'] = form_error('adresse');
			$data['errors']['tel']     = form_error('tel');
			$data['errors']['email']   = form_error('email');
			$data['errors']['ville']   = form_error('ville');
		}
		else
		{
			$editdata = [
				'adr_voie'     => $this->input->post('adresse'),
				'membre_tel'   => $this->input->post('tel'),
				'membre_email' => $this->input->post('email'),
				'adr_ville_id' => $this->input->post('ville')
			];
			$res = $this->Membre_model->update($id, $editdata);
			$data['success'] = $res ? 1 : 0;
		}

		switch($method) {
			case 'ajax' : echo json_encode($data); break;
			default: $this->index($id);
		}

	}

	public function delete($id)
	{
		$this->Membre_model->delete($id);
		$this->index();
	}

	public function liste($format = null)
	{
		$this->submenu = $this->load->view('admin/membres/menus/liste', NULL, true);
		$this->breadcrumb->add('Liste', '/liste');
		$data = array(
			'membres' => $this->Membre_model->get_all_entries_extended(),
		);

		if( $format == 'json' )
			die(json_encode($data));

		$content = $this->load->view('admin/membres/liste', $data, TRUE);
		$this->load->view('admin/master', array('title' => 'Liste des membres', 'content' => $content));
	}

	public function getMembres($method)
	{
		$data = array(
			'membres' => $this->Membre_model->get_all_entries_extended(),
			'title' => 'Liste des membres',
			);
		switch( $method ) {
			case 'ajax' : echo json_encode($data); break;
			default: return $data;
		}
	}

	public function read($membre_id)
	{
		$this->submenu = $this->load->view('admin/membres/menus/detail', NULL, true);
		// $this->angular = false;

		$data = array(
			'title'    => 'Informations sur le membre',
			'formid'   => 'edit-membre',
			'membre'   => $this->Membre_model->get_membre_by_id($membre_id),
			'emprunts' => $this->Emprunt_model->get_emprunts_by_membre_id($membre_id),
			'en_cours' => $this->Emprunt_model->check_emprunt_en_cours_by_membre_id($membre_id)
		);

		$this->breadcrumb->add($data['membre']->membre_nom . ' ' . $data['membre']->membre_prenom, '/' . $membre_id);
		$content = $this->load->view('admin/membres/detail', $data, TRUE);
		$this->load->view('admin/master', array( 'content' => $content));
	}

	public function map()
	{
		// $this->submenu = $this->load->view('admin/membres/menus/liste', NULL, true);
		$this->breadcrumb->add('Carte', '/map');
		$this->angular = false;
		$data = [
			'title' => 'Localisation des membres'
		];
		$content = $this->load->view('admin/membres/map', $data, TRUE);
		$this->load->view('admin/master', array( 'content' => $content));
	}

	public function create()
	{
		$this->breadcrumb->add('Nouveau', '/' . $this->router->fetch_method());
		// $this->form_validation->set_rules('categorie', 'Catégorie', 'required');
		// $this->form_validation->set_rules('marque', 'Marque', 'required');
		// $this->form_validation->set_rules('modele', 'Modèle', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$data = array();

			$content = $this->load->view('admin/membres/create', $data, TRUE);
			$this->load->view('admin/master', array('content' => $content));

		}
		else
		{
			// $marque = $this->input->post('marque');
			// $modele = $this->input->post('modele');
			// // $code = $this->input->post('code');
			// $numero = $this->input->post('numero');
			// $query = $this->Instrument_model->insert();
			redirect('/admin/membres/liste');
		}

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
