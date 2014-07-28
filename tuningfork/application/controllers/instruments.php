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

		if ( $categ == null ) {

			$data = array(
				'categories' => $this->Instrument_model->get_categ_available(),
				'title' => 'Liste des catégories'
			);
			$content = $this->load->view('instruments/categories', $data, TRUE);
			$this->load->view('master', array('title' => 'Catégories', 'content' => $content));

		}
		else if ( $categ != null && $type == null) {

			$categ_infos = $this->Instrument_model->get_categ_by_public_id($categ);
			$data = array(
				'categorie' => $categ,
				'types' => $this->Instrument_model->get_sous_categ_available($categ_infos[0]->categ_id),
				'title' => 'Liste des types de ' . $categ_infos[0]->categ_nom
			);
			$content = $this->load->view('instruments/types', $data, TRUE);
			$this->load->view('master', array('title' => 'Types', 'content' => $content));

		}
		else if ( $categ != null && $type != null && $instru == null) {

			$categ_infos = $this->Instrument_model->get_categ_by_public_id($categ);
			$type_infos = $this->Instrument_model->get_type_by_public_id($type);
			$data = array(
				'instruments' => $this->Instrument_model->get_instruments($categ_infos[0]->categ_id, $type_infos[0]->type_id),
				'title' => 'Liste des <a href="/instruments/'.$categ.'">' . $categ_infos[0]->categ_nom . '</a> ' . $type_infos[0]->type_nom
			);
			$content = $this->load->view('instruments/liste', $data, TRUE);
			$this->load->view('master', array('title' => 'Instruments', 'content' => $content));

		}
	}

	public function _remap($method, $params = array())
	{
		if($method != 'index') :
			array_unshift($params, $method);
		endif;
        return call_user_func_array(array($this, 'index'), $params);
	}

}
