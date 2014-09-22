<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MY_Controller {

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

	public function getLastInstru($count = null)
	{
		$count = is_null($count) ? 5 : $count;
		$data = array(
			'instrus' => $this->Instrument_model->get_last($count)
		);

		$content = $this->load->view('instruments/last', $data, TRUE);
		echo $content;
	}

	public function getcities($cp)
	{
		$this->load->model('Adresse_model');
		$data = array(
			'cities' => $this->Adresse_model->get_cities_by_cp($cp)
		);
		echo json_encode($data);
	}

	public function searchInstru($search)
	{
		$instruments = $this->Instrument_model->search_instru($search);

		echo json_encode($instruments);
	}

	public function testpdf()
	{
		$this->load->library('pdf');
		$this->pdf->load_view('account/contrat');
		$this->pdf->render();
		$this->pdf->stream("welcome.pdf");
	}
}