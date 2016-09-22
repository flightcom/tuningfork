<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connexion extends MY_Controller {

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
	}

	public function index()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		if(!$this->session->userdata('logged_in'))
		{
			$this->form_validation->set_rules('username', 'Adresse Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			log_message('debug', serialize($this->input->post()));

			if ($this->form_validation->run() == FALSE)
			{
				$content = $this->load->view('connexion', NULL, TRUE);
				$this->load->view('master', array('title' => 'Connexion', 'content' => $content));				
			}
			else
			{
				$username = $this->input->post('username');
				$password = md5($this->input->post('password'));
				if($user = $this->Membre_model->get_entry($username, $password)){
					$this->Membre_model->update_date_last_connection($user->membre_id);
					$this->session->set_userdata('logged_in', true);
					$this->session->set_userdata('user_isAdmin', $user->membre_admin);
					$this->session->set_userdata('user_id', $user->membre_id);
					$this->session->set_userdata('user_nom', $user->membre_nom);
					$this->session->set_userdata('user_prenom', $user->membre_prenom);
					$this->session->set_userdata('user_email', $user->membre_email);
					if($this->session->userdata('user_isAdmin') == 1)
						redirect('/admin/');
					else
						redirect('/');
				}
				else {
					echo "erreur";
				}
			}
		} else 
		{
			if($this->session->userdata('user_isAdmin')) {
				redirect('/admin/');
			} else {
				redirect('/');
			}
		}

	}

	public function fb() {

		if ( $this->input->post('verified') ) {

			$this->session->set_userdata('logged_in', true);
			$this->session->set_userdata('user_isAdmin', 0);
			$this->session->set_userdata('user_id', $this->input->post('id'));
			$this->session->set_userdata('user_nom', $this->input->post('last_name'));
			$this->session->set_userdata('user_prenom', $this->input->post('first_name'));
			$this->session->set_userdata('user_email', $this->input->post('email'));
			$this->session->set_userdata('user_picture', 'https://graph.facebook.com/332574310237336/picture?type=large');

			echo 1;

		} else {

			echo 0;

		}

	}

	public function deconnexion(){

		$this->session->sess_destroy();
		redirect('/');

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