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
        $id = $id ?? $this->get('id') ?? null;

        if ($id) {
            $users = $this->em->getRepository('Entity\User')->get($id);
            $users = $users->toArray(['adresse.ville', 'adresse.pays', 'roles']);
        } else {
            $users = $this->em->getRepository('Entity\User')->getAll();
        }

        $this->response(["data" => $users], 200);
    }

    public function index_post()
    {
        $data = $this->post();

        try {
            $this->object = new User();
            $this->createObject($data);
            $user = $this->object->toArray(['adresse.ville', 'adresse.pays', 'roles']);
            $this->response(['data' => $user], 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }

    }

    public function index_put($id)
    {
        $data = $this->put();

        try {
            $this->object = $this->em->getRepository('Entity\User')->get($id);
            $this->updateObject($data);
            $user = $this->object->toArray(['adresse.ville', 'adresse.pays', 'roles']);
            $this->response(['data' => $user], 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }

    }

    public function search_get()
    {
        $params = $this->get();
        foreach ($params as $key => $value) {
            if (Utils::isJson($value))
                $params[$key] = is_object(json_decode($value)) ? (array) json_decode($value) : json_decode($value);
        }

        if ($this->get()) {
            $count = $this->em->getRepository('Entity\User')->search($params, true);
            $users = $this->em->getRepository('Entity\User')->search($params);
        }

        $this->response([
            "count" => $count,
            "data" => $users
        ], 200);
    }

    public function count_get()
    {
        $data = array_merge(['count' => true], $this->get());
        if ($data) {
            $users = $this->em->getRepository('Entity\User')->search($data);
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
        // $user->setRegistrationToken(Utils::generateToken(32));
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

    public function current_get()
    {
        $this->response(['data' => $this->session->userdata('current')], 200);
    }

    public function addRole_get($id, $rolename)
    {
        if (!$this->getIdentity()->isAdmin()) {
            $this->response('You can\'t do that !', 403);
        } else {
            try {
                $user = $this->em->getRepository('Entity\User')->get($id);
                $role = $this->em->getRepository('Entity\Role')->findOneBy(['name' => $rolename]);
                $user->addRole($role);
                $this->em->flush();
                $this->response(['data' => $user], 200);
            } catch (\Exception $e) {
                $this->response([
                    'error' => 'Un problème est survenu : ' . $e->getMessage()
                ], 500);
            }
        }
    }

    public function prets_get($id)
    {
        $id = $id ?? $this->get('id') ?? null;

        $user = $this->em->getRepository('Entity\User')->get($id);
        $prets = $this->em->getRepository('Entity\Pret')->findAll(['user' => $user]);
        $this->response(["data" => $prets], 200);
    }

}
