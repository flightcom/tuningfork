<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// use \Utils;
use Entity\User;
use Entity\Adresse;
use Zend\View\Model\JsonModel;
use Firebase\JWT\JWT;

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
                $this->session->set_userdata('current', $user->toArray());
                $token = JWT::encode(['id' => $user->getId()], $this->config->item('jwt_key'));
                $this->session->set_userdata('token', $token);
                error_log('TOKEN: ' . $token);
                $user->setDateLastConnection(new \DateTime('now'));
                $this->em->flush();
                $this->response([
                    'token' => $token,
                    'user'  => $user
                ], 200);
            } else {
                $this->response("Mauvais mot de passe", 500);
            }
        } else {
            $this->response("Utilisateur inconnu", 500);
        }

    }

    public function logout_post()
    {
        $this->session->set_userdata('current', null);
        $this->session->set_userdata('token', null);
        $this->response(null, 200);
    }

    public function check_get()
    {
        $data = $this->session->userdata('token') ?? null;
        if ($token) {
            $this->response(['token' => $token], 200);
        } else {
            $this->response(null, 401);
        }
    }

    public function allowed_get()
    {
        $request = $this->request;
        $user = $this->session->userdata('current');
        if ($user['isAdmin'])
            $this->response(null, 200);
        else
            $this->response(null, 401);
    }

}
