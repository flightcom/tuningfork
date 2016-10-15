<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Entity\Message;

class Contact extends MY_REST_Controller {

    public function __construct()
    {
    	parent::__construct();
    	$this->load->library('email');
		$config['protocol'] = "smtp";
		$config['smtp_host'] = "ssl://smtp.orange.fr";
		$config['smtp_port'] = "465";
		$config['smtp_user'] = "flightcom@wanadoo.fr"; 
		$config['smtp_pass'] = "vanessa";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";

		$this->email->initialize($config);
    }

	public function index_post()
	{
		$data = [
			'type' => 'contact',
			'name' => $this->post('name'),
			'email' => $this->post('email'),
			'subject' => 'Demande de contact',
			'content' => $this->post('message'),
		];

		$message = Message::create($data);

		$this->em->persist($message);
		$this->em->flush();

		// $this->email->from($this->post('email'), $this->post('name')); 
		// // $this->email->to('admin@tuningfork.com');
		// $this->email->to('flightcom@wanadoo.fr');
		// $this->email->subject('Demande de contact');
		// $this->email->message($this->post('message'));	

		try {
			// $this->email->send();
			// $this->response("Email envoyé", 200);
			$this->response("Message envoyé", 200);
		} catch (Exception $e) {
			$this->response("Erreur lors de l'envoi du message : " . $e->getMessage(), 400);
		}

		// echo $this->email->print_debugger();
	}


}