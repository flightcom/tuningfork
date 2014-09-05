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
			show_404();
		}
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

	public function infos_membre($membre_id)
	{
		$data = array(
			'title'    => 'Informations sur le membre',
			'membre'   => $this->Membre_model->get_membre_by_id($membre_id),
			'emprunts' => $this->Emprunt_model->get_emprunts_by_membre_id($membre_id),
			'en_cours' => $this->Emprunt_model->check_emprunt_en_cours_by_membre_id($membre_id)
			);
		$content = $this->load->view('admin/membres/membre', $data, TRUE);
		$this->load->view('admin/master', array( 'content' => $content));
	}

}