<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instruments extends Admin_Controller {

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
		$this->load->helper('text');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Instrument_model');
		$this->load->model('Emprunt_model');

		$this->menu = $this->load->view('admin/instruments/menu', NULL, TRUE);
    }

	public function index($param1 = null, $param2 = null)
	{
		if(is_null($param1))
		{
			$this->liste();
		} 
		else if(is_numeric($param1) && is_null($param2))
		{
			$id = $param1;
			$data = array(
				'title' => 'Informations sur l\'instrument',
				'formid'   => 'edit-instrument',
				'instrument' => $this->Instrument_model->get_entry($id),
				'types' => $this->Instrument_model->get_types_by_categ($this->Instrument_model->get_categ_id_of($id)),
				'emprunts' => $this->Emprunt_model->get_history($id)
				);
			$content = $this->load->view('admin/instruments/detail', $data, TRUE);
			$this->load->view('admin/master', array( 'content' => $content));
		}
		else if(is_numeric($param1) && !is_null($param2))
		{
			$instru_id = $param1;
			$action = $param2;

			switch($action){
				case 'delete'	: $this->delete($instru_id); break;
				case 'edit'		: $this->edit($instru_id); break;
				case 'preter'	: $this->preter($instru_id); break;
				default 		: break;
			}
		}
		else if(!is_numeric($param1) && is_null($param2))
		{
			switch($param1){
				case 'add'		: $this->add();break;
				case 'prets'	: $this->prets();break;
				case 'liste'	: $this->liste();break;
				default 		: break;
			}
		}

	}

	public function liste()
	{
		$data = array(
			'instruments' => $this->Instrument_model->get_all_entries(),
			'title' => 'Liste des instruments'
			);
		$content = $this->load->view('admin/instruments/liste', $data, TRUE);
		$this->load->view('admin/master', array('title' => 'Liste d\'instruments', 'content' => $content));
	}

	public function add()
	{
		$this->form_validation->set_rules('categorie', 'Catégorie', 'required');
		$this->form_validation->set_rules('type', 'Type', 'required');
		$this->form_validation->set_rules('marque', 'Marque', 'required');
		$this->form_validation->set_rules('modele', 'Modèle', 'required');
		$this->form_validation->set_rules('numero', 'Numéro de série', 'required');
		$this->form_validation->set_rules('code', 'Code', 'trim|required|is_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			$data = array(
				'marques' => $this->Instrument_model->get_all_marques(),
				'categories' => $this->Instrument_model->get_all_categories(),
				'title'   => 'Nouvel instrument'
			);

			$content = $this->load->view('admin/instruments/add', $data, TRUE);
			$this->load->view('admin/master', array('content' => $content));

		}
		else
		{
			$marque = $this->input->post('marque');
			$modele = $this->input->post('modele');
			$code = $this->input->post('code');
			$numero = $this->input->post('numero');
			$query = $this->Instrument_model->insert();
			redirect('/admin/instruments/liste');
		}

	}

	public function addMarque()
	{
		$this->form_validation->set_rules('newmarque', 'Marque', 'strtolower|ucfirst|is_unique[marques.marque_nom]');

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

	public function addType()
	{
		$this->form_validation->set_rules('newtype', 'Type', 'required');
		$this->form_validation->set_rules('categorie', 'Catégorie', 'required');

		$data = array();
		$data['errors'] = array();

		if ($this->form_validation->run() == FALSE)
		{
			$data['errors']['newtype'] = form_error('newtype');
			$data['errors']['categorie'] = form_error('categorie');
		}
		else
		{
			$type = $this->input->post('newtype');
			$categorie = $this->input->post('categorie');
			$res = $this->Instrument_model->insert_type($type, $categorie);
			if($res){
				$data['success'] = 1;
				$data['typeid'] = $res;
			}
			else {
				$data['success'] = 0;
			}
		}
		echo json_encode($data);

	}

	public function getTypes($categ_id = null)
	{
		$types = Instrument_model::get_types_by_categ($categ_id);

		echo json_encode($types);
	}

	public function getCategories()
	{
		$categs = $this->Instrument_model->get_all_categories();
		echo json_encode($categs);
	}

	public function getMarques()
	{
		$marques = $this->Instrument_model->get_all_marques();
		echo json_encode($marques);
	}

	public function addCategorie()
	{
		$this->form_validation->set_rules('newcateg', 'Catégorie', 'strtolower|ucfirst|is_unique[categories.categ_nom]');

		$data = array();
		$data['errors'] = array();

		if ($this->form_validation->run() == FALSE)
		{
			$data['errors']['newcateg'] = form_error('newcateg');
		}
		else
		{
			$categorie = $this->input->post('newcateg');
			$res = $this->Instrument_model->insert_categorie($categorie);
			if($res){
				$data['success'] = 1;
				$data['categid'] = $res;
			}
			else {
				$data['success'] = 0;
			}
		}
		echo json_encode($data);

	}

	public function edit($id)
	{
		$this->Instrument_model->update($id);
		redirect('/admin/instruments/'.$id);
	}

	public function delete($id)
	{
		$this->Instrument_model->delete($id);
		redirect('/admin/instruments/');
	}

	public function check_instru_code($instru_code) 
	{
		$res = $this->Instrument_model->get_entry_by_instru_code($instru_code);
		echo count($res);
	}

	public function preter($instru_id)
	{
		$strdate = 'last friday of june';
		$data = array(
			'title' => 'Nouveau prêt',
			'formid' => 'pret-new',
			'instrument' => $this->Instrument_model->get_entry($instru_id),
			'date_fin_prevue' => date('Y-m-d', strtotime($strdate) < time() ? strtotime($strdate . ' +1 year') : strtotime($strdate))
		);
		$content = $this->load->view('admin/prets/new', $data, TRUE);
		$this->load->view('admin/master', array('title' => $data['title'], 'content' => $content));
	}

	function getCode() {

		$code = null;

		while (!$code) {
			$tmpcode = $this->generateCode();
			$check = $this->Instrument_model->test_code($tmpcode);
			if ( $check ) $code = $tmpcode;
		}

	}

	private function generateCode() {}

}