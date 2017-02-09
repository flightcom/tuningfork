<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// use \Utils;
use Entity\User;
use Entity\Adresse;
use Zend\View\Model\JsonModel;

class Users extends MY_REST_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index_get($id = null)
    {
        $id = !$id ? ($this->get('id') ? $this->get('id') : null) : $id;

        if ($id) {
            $users = $this->em->getRepository('Entity\User')->get($id);
        } else {
            $users = $this->em->getRepository('Entity\User')->getAll();
        }

        $this->response(["data" => $users], 200);
    }

    public function search_get()
    {
        if ($this->get()) {
            $users = $this->em->getRepository('Entity\User')->search($this->get());
        }

        $this->response(["data" => $users], 200);
    }

    public function signup_post()
    {
        $data = $this->post();

        $pays = $this->em->getRepository('Entity\Pays')->find($data['adresse']['pays']['id']);
        $ville = $this->em->getRepository('Entity\Ville')->find($data['adresse']['ville']['id']);
        $adresse = Adresse::create($data['adresse']);

        $user = User::create($data);
        $adresse->setVille($ville);
        $adresse->setPays($pays);
        $user->setAdresse($adresse);
        $user->setRegistrationToken(Utils::generateToken(32));
        $user->setDateNaissance(new \DateTime($user->getDateNaissance()));

        try {
            $this->em->persist($user);
            $this->em->flush();
            $this->response($user, 200);
        } catch (ConstraintViolationException $e){
            $this->response(['error' => 'Duplicat : ' . $e->getMessage()], 500);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }
    }

    public function signin_post()
    {
        $data = $this->post();
        $user = $this->em->getRepository('Entity\User')->findOneBy(["email" => $data['email']]);
        if ($user) {
            $this->session->set_userdata($user->toArray());
            $this->response(['data' => $user->toArray()], 200);
        } else {
            $this->response(['data' => "Utilisateur inconnu"], 500);
        }

        // $this->response($data, 200);
    }

    public function loggedin_get()
    {
        $this->response(['data' => $this->session->userdata()], 200);
    }

}
