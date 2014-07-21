<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instruments extends Auth_Controller {

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
	public function index()
	{
		$this->liste();
	}

	public function liste()
	{
		$this->load->model('Instrument_model');
		$data = array(
			'instruments' => $this->Instrument_model->get_all_entries(),
			'title' => 'Liste des instruments'
			);
		$content = $this->load->view('instruments/liste', $data, TRUE);
		$this->load->view('master', array('title' => 'Liste d\'instruments', 'content' => $content));
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */