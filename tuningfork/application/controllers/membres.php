<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Membres extends MY_Controller {

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
		$this->load->model('Membre_model');
		$this->load->model('Adresse_model');
        $this->load->helper('database');
		$this->load->helper('form');
		$this->load->library('form_validation');		
	}

	public function index($param = null)
	{

		if(is_numeric($param)){
			$this->show_account();
		}

	}

	public function create()
	{
		$this->form_validation->set_rules('genre', 'Genre', 'required');
		$this->form_validation->set_rules('nom', 'Nom', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('prenom', 'Prénom', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[membres.membre_email]');
		$this->form_validation->set_rules('tel', 'Téléphone', 'required');
		$this->form_validation->set_rules('dob', 'Date de naissance', 'required');
		// $this->form_validation->set_rules('cp', 'CP', 'required|exact_length[5]');
		$this->form_validation->set_rules('adr_voie', 'Adresse', 'required');
		$this->form_validation->set_rules('ville', 'Ville', 'required');
		$this->form_validation->set_rules('passwd', 'Mot de passe', 'required');
		$this->form_validation->set_rules('passwdconf', 'Confirmation mot de passe', 'required|matches[passwd]');

		if ($this->form_validation->run() == FALSE)
		{
			$content = $this->load->view('membres/new', NULL, TRUE);
			$this->load->view('master', array('title' => 'Création de compte', 'content' => $content));				
		}
		else
		{
			$this->create_account();
		}

	}

	public function show_account()
	{
		$content = $this->load->view('button', NULL, TRUE);
		$this->load->view('master', array('title' => 'Mon compte', 'content' => $content));				
	}

	public function create_account()
	{
		$userdata = [
			'membre' => [
				'membre_nom' => $this->input->post('membre_nom'),
				'membre_prenom' => $this->input->post('membre_prenom'),
				'membre_date_naissance' => $this->input->post('membre_date_naissance'),
				'membre_email' => $this->input->post('membre_email'),
				'membre_tel' => $this->input->post('membre_tel'),
				'membre_password' => $this->input->post('membre_password'),
				'membre_genre' => $this->input->post('membre_genre')
			],
			'adresse' => [
				'adr_voie' => $this->input->post('adr_voie'),
				'adr_ville_id' => $this->input->post('adr_ville_id'),
				'adr_pays_id' => $this->input->post('adr_pays_id'),
			]
		];
		$res = $this->Membre_model->insert($userdata);
		if ($res) {
			$content = $this->load->view('membres/new_account_success', NULL, TRUE);
			$this->load->view('master', array('title' => 'Compte créé', 'content' => $content));							
		}
	}

	/* Password oublié */
	public function password()
	{
		$content = $this->load->view('membres/password_forgotten', NULL, TRUE);
		$this->load->view('master', array('title' => 'Mot de passe oublié', 'content' => $content));				
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */