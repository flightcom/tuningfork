<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compte extends MY_Controller {

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
	public function index($param)
	{
		if(is_numeric($param)){
			$this->show_account();
		}

	}

	public function creation()
	{
		$this->load->model('Membre_model');
		$this->load->model('Adresse_model');
        $this->load->helper('database');
		$this->load->helper('form');
		$data = array( 'cities' => $this->load->view('select_city', NULL, TRUE) );
		$content = $this->load->view('account/create', $data, TRUE);
		$this->load->view('master', array('title' => 'Création de compte', 'content' => $content));				

	}

	public function show_account()
	{
		$content = $this->load->view('button', NULL, TRUE);
		$this->load->view('master', array('title' => 'Mon compte', 'content' => $content));				
	}

	/* Password oublié */
	public function password()
	{
		$content = $this->load->view('account/password_forgotten', NULL, TRUE);
		$this->load->view('master', array('title' => 'Mot de passe oublié', 'content' => $content));				
	}

	public function select_city($cp)
	{
		$this->load->model('Adresse_model');
		$data = array(
			'cities' => $this->Adresse_model->get_cities_by_cp($cp)
		);
		$content = $this->load->view('select_city', $data, TRUE);
		echo $content;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */