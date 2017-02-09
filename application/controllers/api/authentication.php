<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// use \Utils;
use Entity\User;
use Entity\Adresse;
use Zend\View\Model\JsonModel;

class Authentication extends MY_REST_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function login_post()
    {
        $data = $this->post();
        $user = $this->em->getRepository('Entity\User')->findOneBy(["email" => $data['email']]);
        if ($user) {
            // Check password
            if (password_verify($data['password'], $user->getPassword()) ) {
                $this->session->set_userdata('current_user', $user->toArray());
                $this->response(['data' => $user->toArray()], 200);
            } else {
                $this->response(['error' => 'Mauvais mot de passe'], 500);
            }
        } else {
            $this->response(['data' => "Utilisateur inconnu"], 500);
        }

    }

    public function check_get()
    {
        $data = $this->session->userdata('current_user') ?? null;
        $this->response(['data' => $data], 200);
    }

}
