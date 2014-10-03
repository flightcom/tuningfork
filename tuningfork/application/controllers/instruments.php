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
    public function __construct()
    {
    	parent::__construct();
		$this->load->model('Instrument_model');
		$this->load->model('Membre_model');
		$this->load->model('Emprunt_model');
    }

	public function index($params = null)
	{
		// if ( $categ != null && is_numeric($categ) && $type == null) { // Instrument en particulier
		// 	$instru_id = $categ;
		// 	$instru_exists = $this->Instrument_model->get_entry($instru_id);
		// 	$instru_dispo = $this->Instrument_model->is_available($instru_id);
		// 	if ( ! $instru_exists ) :
		// 		$data = array('error' => 'Cet instrument n\'existe pas');
		// 	elseif ( ! $instru_dispo ) :
		// 		$data = array('error' => 'Cet instrument n\'est pas disponible pour le moment');
		// 	else :
		// 		$instrument = $this->Instrument_model->get_entry($instru_id);
		// 		$data = array(
		// 			'instrument' => $instrument,
		// 			'title' => ''
		// 		);
		// 	endif;
		// 	$content = $this->load->view('instruments/detail', $data, TRUE);
		// 	$this->load->view('master', array('title' => $instrument->marque_nom . ' ' . $instrument->instru_modele, 'content' => $content));

		// }
		// else if ( $categ != null && is_numeric($categ) && $type != null && $instru != null) { 
		// 	$action = $type;
		// 	$membre_id = $instru;

		// 	$content = $this->load->view('instruments/detail', $data, TRUE);
		// 	$this->load->view('master', array('title' => $instrument->marque_nom . ' ' . $instrument->instru_modele, 'content' => $content));

		// }
		// if ( count($params) == 0 ) { // Liste des categories
		if ( @!is_numeric(array_reverse($params)[0]) ) { // Liste des categories

			@$parent = array_reverse($params)[0];

			$data = array(
				'parent' => $this->Instrument_model->get_categorie_by_public_id($parent),
				'children' => $this->Instrument_model->get_children_categories($parent),
				'title' => 'Nos instruments'
			);
			$content = $this->load->view('instruments/categories', $data, TRUE);
			$this->load->view('master', array(	
					'title' => 'Catégories', 
					'content' => $content));

		}
		else {
			var_dump($params);
		}
		// else if ( $categ != null && $type == null) { // Liste des types d'un catégorie

		// 	$categ_infos = $this->Instrument_model->get_categ_by_public_id($categ);
		// 	$data = array(
		// 		'categ' => $categ_infos,
		// 		'types' => $this->Instrument_model->get_sous_categ_available($categ_infos->categ_id),
		// 		'title' => 'Choisissez un type de ' . $categ_infos->categ_nom
		// 	);
		// 	$content = $this->load->view('instruments/types', $data, TRUE);
		// 	$this->load->view('master', array('title' => 'Types', 'content' => $content));

		// }
		// else if ( $categ != null && $type != null && $instru == null) { // Liste des instruments de la categorie correspondant au type

		// 	$categ_infos = $this->Instrument_model->get_categ_by_public_id($categ);
		// 	$type_infos = $this->Instrument_model->get_type_by_public_id($type);
		// 	$data = array(
		// 		'categ' => $categ_infos,
		// 		'type' => $type_infos,
		// 		'instruments' => $this->Instrument_model->get_instruments($categ_infos->categ_id, $type_infos->type_id)
		// 	);
		// 	$content = $this->load->view('instruments/liste', $data, TRUE);
		// 	$this->load->view('master', array('title' => 'Instruments', 'content' => $content));

		// }
	}

	private function envoyer_demande_emprunt($instru_id, $membre_id) 
	{
		// Vérifier instru dispo
		$instruDispo = $this->Instrument_model->check_instru_dispo($instru_id);
		$membreDispo = $this->Membre_model->check_membre_dispo($instru_id);
		// Vérifier membre n'a pas de prêt en cours
	}

	public function getCategorieInfos($categ_id) {

		$data = array(
			'categorie' => $this->Instrument_model->get_categorie($categ_id)
		);

		echo json_encode($data);

	}

	public function getChildrenCategories($parent = null) {

		$categs = $this->Instrument_model->get_children_categories($parent);
		echo json_encode($categs);

	}

	public function _remap($method, $args)
	{
		if (method_exists($this, $method)){
			// $this->$method($args);
			call_user_func_array(array($this, $method), $args);
		} else {
			$this->index(array_merge(array($method),$args));
		}
	}

}
