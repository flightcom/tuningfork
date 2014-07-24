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
	public function index($categ = null, $ssCateg = null, $instru = null)
	{
		$this->load->model('Instrument_model');

		if ( $categ == null ) {

			$data = array(
				'categories' => $this->Instrument_model->get_categ_available(),
				'title' => 'Liste des catégories'
			);
			$content = $this->load->view('instruments/categories', $data, TRUE);
			$this->load->view('master', array('title' => 'Catégories', 'content' => $content));

		}
		else if ( $categ != null && $ssCateg == null) {

			$categ_infos = $this->Instrument_model->get_categ_by_public_id($categ);
			$data = array(
				'categories' => $this->Instrument_model->get_sous_categ_available($categ_infos->categ_id),
				'title' => 'Liste des types de ' . $categ_infos->categ_nom
			);
			$content = $this->load->view('instruments/categories', $data, TRUE);
			$this->load->view('master', array('title' => 'Catégories', 'content' => $content));

		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */