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
	public function index($categ = null, $type = null, $instru = null)
	{
		$this->load->model('Instrument_model');

		if ( $categ != null && is_numeric($categ) && $type == null) { // Instrument en particulier
			$instru_id = $categ;
			$instru_exists = $this->Instrument_model->get_entry($instru_id);
			$instru_dispo = $this->Instrument_model->is_available($instru_id);
			if ( ! $instru_exists ) :
				$data = array('error' => 'Cet instrument n\'existe pas');		
			else if ( ! $instru_dispo ) :
				$data = array('error' => 'Cet instrument n\'est pas disponible pour le moment');
			else :
				$instrument = $this->Instrument_model->get_entry($instru_id);
				$data = array(
					'instrument' => $instrument,
					'title' => ''
				);
			endif;
			$content = $this->load->view('instruments/detail', $data, TRUE);
			$this->load->view('master', array('title' => $instrument->marque_nom . ' ' . $instrument->instru_modele, 'content' => $content));

		}
		else if ( $categ != null && is_numeric($categ) && $type != null && $instru != null) { 
			$action = $type;
			$membre_id = $instru;

			$content = $this->load->view('instruments/detail', $data, TRUE);
			$this->load->view('master', array('title' => $instrument->marque_nom . ' ' . $instrument->instru_modele, 'content' => $content));

		}
		else if ( $categ == null ) { // Liste des categories

			$data = array(
				'categories' => $this->Instrument_model->get_categ_available(),
				'title' => 'Nos instruments'
			);
			$content = $this->load->view('instruments/categories', $data, TRUE);
			$this->load->view('master', array('title' => 'Catégories', 'content' => $content));

		}
		else if ( $categ != null && $type == null) { // Liste des types d'un catégorie

			$categ_infos = $this->Instrument_model->get_categ_by_public_id($categ);
			$data = array(
				'categ' => $categ_infos,
				'types' => $this->Instrument_model->get_sous_categ_available($categ_infos->categ_id),
				'title' => 'Choisissez un type de ' . $categ_infos->categ_nom
			);
			$content = $this->load->view('instruments/types', $data, TRUE);
			$this->load->view('master', array('title' => 'Types', 'content' => $content));

		}
		else if ( $categ != null && $type != null && $instru == null) { // Liste des instruments de la categorie correspondant au type

			$categ_infos = $this->Instrument_model->get_categ_by_public_id($categ);
			$type_infos = $this->Instrument_model->get_type_by_public_id($type);
			$data = array(
				'categ' => $categ_infos,
				'type' => $type_infos,
				'instruments' => $this->Instrument_model->get_instruments($categ_infos->categ_id, $type_infos->type_id)
			);
			$content = $this->load->view('instruments/liste', $data, TRUE);
			$this->load->view('master', array('title' => 'Instruments', 'content' => $content));

		}
	}

	private function envoyer_demande_emprunt($instru_id, $membre_id) 
	{
		$this->load->model('Instrument_model');
		$this->load->model('Membre_model');
		// Vérifier instru dispo
		$instruDispo = $this->Instrument_model->check_instru_dispo($instru_id);
		$membreDispo = $this->Membre_model->check_membre_dispo($instru_id);
		// Vérifier membre n'a pas de prêt en cours
	}

	public function _remap($method, $params = array())
	{
		if($method != 'index') :
			array_unshift($params, $method);
		endif;
        return call_user_func_array(array($this, 'index'), $params);
	}

}
