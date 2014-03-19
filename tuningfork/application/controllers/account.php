<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

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

	public function create()
	{
		$this->load->helper('form');
		$content = $this->load->view('create_account', NULL, TRUE);
		$this->load->view('master', array('title' => 'Création de compte', 'content' => $content));				

	}

	public function show_account()
	{
		$content = $this->load->view('account', NULL, TRUE);
		$this->load->view('master', array('title' => 'Mon compte', 'content' => $content));				
	}

	/* Password oublié */
	public function password()
	{
		$content = $this->load->view('password_forgotten', NULL, TRUE);
		$this->load->view('master', array('title' => 'Mot de passe oublié', 'content' => $content));				
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */