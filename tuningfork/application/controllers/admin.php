<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller {

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
		$content = $this->load->view('admin/index', NULL, TRUE);
		$this->load->view('master_admin', array('title' => 'Connexion', 'content' => $content));
	}

	public function lister_instruments()
	{
		$this->load->model('Instrument_model');
		$data = array(
			'instruments' => $this->Instrument_model->get_all_entries(),
			'title' => 'Liste des instruments'
			);
		$content = $this->load->view('admin/instruments', $data, TRUE);
		$this->load->view('master_admin', array('title' => 'Liste d\'instruments', 'content' => $content));
	}

	public function ajouter_instrument()
	{
		/* Check if admin */
		$this->load->helper('form');
		$this->load->model('Instrument_model');
		$this->load->library('form_validation');

		$data = array(
			'marques' => $this->Instrument_model->get_all_marques(),
			'categories' => $this->Instrument_model->get_all_categories()
		);

		$this->form_validation->set_rules('numero', 'Number', 'required');
		$this->form_validation->set_rules('code', 'Code', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$content = $this->load->view('instruments/add', $data, TRUE);
			$this->load->view('master_admin', array('title' => 'Nouvel instrument', 'content' => $content));		
		}
		else
		{
			$marque = $this->input->post('marque');
			$modele = $this->input->post('modele');
			$code = $this->input->post('code');
			$numero = $this->input->post('numero');
			$query = $this->Instrument_model->insert();
			redirect('/admin/instruments');
		}

	}

	public function ajouter_marque()
	{
		// $this->load->helper('form');
		$this->load->model('Instrument_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nom-marque', 'Marque', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$content = $this->load->view('instruments/add_marque', NULL, TRUE);
			echo $content;
		}
		else
		{
			$marque = $this->input->post('nom-marque');
			$res = $this->Instrument_model->insert_marque($marque);
			if($res){
				redirect('/admin/instruments/add');
			}
			else {
				// echo $marque;
			}
		}

	}

	public function ajouter_categorie()
	{
		// $this->load->helper('form');
		$this->load->model('Instrument_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nom-categorie', 'Catégorie', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$content = $this->load->view('instruments/add_categorie', NULL, TRUE);
			echo $content;
		}
		else
		{
			$categorie = $this->input->post('nom-categorie');
			$res = $this->Instrument_model->insert_categorie($categorie);
			if($res){
				redirect('/admin/instruments/add');
			}
			else {
				// echo $marque;
			}
		}

	}

	public function instruments($param1 = null, $param2 = null)
	{
		$this->load->helper('form');
		$this->load->model('Instrument_model');
		$this->load->library('form_validation');

		if(is_null($param1))
		{
			$this->lister_instruments();
		} 
		else if(is_numeric($param1))
		{
			$id = $param1;
			$data = array(
				'title' => 'Informations sur l\'instrument',
				'instrument' => $this->Instrument_model->get_entry($id)
				);
			$content = $this->load->view('admin/instrument', $data, TRUE);
			$this->load->view('master_admin', array( 'content' => $content));
		}
		else {
			switch($param1){
				case 'add': 
					$this->ajouter_instrument();
					break;
				case 'delete':
					if(is_numeric($param2)){ $this->supprimer_instrument($param2); }
					break;
				case 'edit':
					if(is_numeric($param2)){ $this->modifier_instrument($param2); }
					break;
				case 'liste':
					$this->lister_instruments();
					break;
				default: break;
			}
		}

	}

	public function modifier_instrument($id)
	{
		$this->load->model('Instrument_model');
		$this->Instrument_model->update($id);
		redirect('/admin/instruments/'.$id);
		// $this->instruments();
	}

	public function supprimer_instrument($id)
	{
		$this->load->model('Instrument_model');
		// echo $id;
		$this->Instrument_model->delete($id);
		redirect('/admin/instruments/');
		// $this->instruments();
	}

	public function membres($param1 = null, $param2 = null)
	{
		// $this->load->helper('form');
		// $this->load->model('Membre_model');
		// $this->load->library('form_validation');

		if(is_null($param1))
		{
			$this->lister_membres();
		} 
		else if(is_numeric($param1))
		{
			$this->infos_membre($param1);
		}
		else {
			switch($param1){
				case 'add': 
					$this->ajouter_instrument();
					break;
				case 'delete':
					if(is_numeric($param2)){ $this->supprimer_instrument($param2); }
					break;
				case 'edit':
					if(is_numeric($param2)){ $this->modifier_instrument($param2); }
					break;
				case 'liste':
					$this->lister_instruments();
					break;
				default: break;
			}
		}
	}

	public function lister_membres()
	{
		$this->load->model('Membre_model');
		$data = array(
			'membres' => $this->Membre_model->get_all_entries(),
			'title' => 'Liste des membres',
			);
		$content = $this->load->view('admin/membres', $data, TRUE);
		$this->load->view('master_admin', array('title' => 'Liste des membres', 'content' => $content));
	}

	public function infos_membre()
	{
		$this->load->model('Membre_model');
		$id = $param1;
		$data = array(
			'title' => 'Informations sur l\'instrument',
			'membre' => $this->Membre_model->get_entry($id)
			);
		$content = $this->load->view('admin/membre', $data, TRUE);
		$this->load->view('master_admin', array( 'content' => $content));
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */