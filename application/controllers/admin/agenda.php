<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda extends Admin_Controller {

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
		$this->load->model('Agenda_model');

		$this->menu = $this->load->view('admin/agenda/menu', NULL, TRUE);
    }

	public function index($event = null)
	{
		if(is_null($event)) {
			$this->liste();
		} else if ( !is_null($event) && !is_numeric($event)) {
			$this->$$event();
		}
	}

	public function liste()
	{
		$content = $this->load->view('admin/agenda/liste', null, TRUE);
		$this->load->view('admin/master', array('title' => 'Agenda', 'content' => $content));		
	}

	public function add()
	{
		$this->form_validation->set_rules('day-start', 'Date de début', 'required');
		$this->form_validation->set_rules('day-end', 'Date de fin', 'required');
		$this->form_validation->set_rules('hour-start', 'Heure de début', 'required');
		$this->form_validation->set_rules('hour-end', 'Heure de fin', 'required');
		$this->form_validation->set_rules('nom', 'Nom', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('lieu', 'Lieu', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$data = array(
				'title' => 'Nouvel Événement'
			);
			$content = $this->load->view('admin/agenda/add', $data, TRUE);
			$this->load->view('admin/master', array('title' => $data['title'], 'content' => $content));		
		}
		else
		{
			// $jour_debut = $this->input->post('day-start');
			// $jour_fin = $this->input->post('day-end');
			// $heure_debut = $this->input->post('hour-start');
			// $heure_fin = $this->input->post('hour-end');
			// $nom = $this->input->post('nom');
			// $texte = $this->input->post('texte');
			// $url = $this->input->post('numero');
			// show_404();
			$event = $this->input->post();
			// var_dump($event);
			$query = $this->Agenda_model->insert($event);
			redirect('/admin/agenda/');
		}
	}

	public function get_events()
	{
		$response = array();
		$response['success'] = 1;
		$response['result'] = $this->Agenda_model->get_all_entries_formatted();
		echo json_encode($response);
	}

}