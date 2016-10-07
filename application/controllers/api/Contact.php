<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_REST_Controller {

    public function __construct()
    {
    	parent::__construct();
    	$this->load->library('email');
    }

	public function index_post()
	{
		$this->email->from($this->post('email'), $this->post('name')); 
		// $this->email->to('admin@tuningfork.com');
		$this->email->to('flightcom@wanadoo.fr');
		$this->email->subject('Demande de contact');
		$this->email->message($this->post('message'));	

		try {
			$this->email->send();
			$this->response("Email envoyé", 200);
		} catch (Exception $e) {
			$this->response("Erreur lors de l'envoi du message : " . $e->getMessage(), 400);
		}

		// echo $this->email->print_debugger();
	}


}