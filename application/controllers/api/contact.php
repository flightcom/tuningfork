<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Entity\Message;

class Contact extends MY_REST_Controller {

    public function __construct()
    {
    	parent::__construct();
    	$this->load->library('email');
		$config['protocol'] = "smtp";
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

		$this->email->from($this->post('email'), $this->post('name'));
		$this->email->from('admin@tuningfork.fr');
		$this->email->to('contact@tuningfork.fr');
		$this->email->subject('Demande de contact de ' . $this->post('name'));

		// We set the email content
		$emailContent = 'Message de ' . $this->post('name') . "<br>"
			. 'email : ' . $this->post('email') . "<br>"
			. "<br>"
			. $this->post('message') . "<br>";
		$this->email->message($emailContent);

		try {
			$this->email->send();
			$this->em->persist($message);
			$this->em->flush();
			$this->response(["text" => "Message envoyé"], 200);
		} catch (Exception $e) {
			$this->response(["text" => "Erreur lors de l'envoi du message : " . $e->getMessage()], 400);
		}

	}


}