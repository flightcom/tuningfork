<?php

require(APPPATH.'/libraries/REST_Controller.php');

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class MY_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('breadcrumb');
        $this->load->library('Doctrine');
        $this->em = $this->doctrine->getEntityManager();

        $account = $this->load->view('membres/button', NULL, TRUE);
        $this->session->set_userdata('account', $account);
        $this->breadcrumb = new Breadcrumb();
    }

}

class MY_REST_Controller extends REST_Controller {

    /**
     * @var EntityManager
     */
    protected $em = null;
    protected $object;


    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('breadcrumb');
        $this->load->library('Doctrine');

        $account = $this->load->view('membres/button', NULL, TRUE);
        $this->session->set_userdata('account', $account);
        $this->em = $this->doctrine->getEntityManager();
        // $this->hydrator = new DoctrineHydrator($this->em, false);
        $this->hydrator = new DoctrineHydrator($this->em);
    }

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
        return $this;
    }

    public function getEntityManager()
    {
        return $this->em;
    }

    protected function invalidateCache()
    {
        // Drop cache for all objects because we don't want relations to have old data
        $config = $this->em->getConfiguration();
        $cacheDriver = $config->getResultCacheImpl();
        return $cacheDriver->deleteAll();
    }

    protected function updateObject($data)
    {
        // error_log(print_r($data['roles'], true));
        // $this->unsetRelations($data);
        $this->hydrator->hydrate($data, $this->object);
        // $this->object->update($data);
        // error_log(print_r($this->object->toArray(), true));
        // $this->em->merge($this->object);
        $this->em->flush();
        $this->invalidateCache();
    }

    /**
     *
     * Don't want to update associations when updating main entity
     *
     * @param $data
     */
    protected function unsetRelations(&$data)
    {
        foreach ($this->object->getRelations() as $key => $relation) {
            unset($data[$key]);
        }
    }

    public function getIdentity()
    {
        $userdata = $this->session->userdata('current_user');
        try {
            $user = $this->em->getRepository('Entity\User')->get($userdata['id']);
            return $user;
        } catch ( \Exception $e) {
            return null;
        }
    }

}

class MY_REST_Auth_Controller extends MY_REST_Controller {

    function __construct()
    {
        parent::__construct();
        if (!$this->getIdentity())
        {
            throw new Exception("Vous n'êtes pas connecté");
            // Stop the execution of the script.
            exit();
        }

    }
}

class MY_REST_Membre_Controller extends MY_REST_Auth_Controller {

    function __construct()
    {
        parent::__construct();
        // Traitements
        if (!($this->getIdentity() && $this->getIdentity()->isMembre())) {
            throw new Exception("Vous n'êtes pas membre");
            // Stop the execution of the script.
            exit();
        }
    }

}

class MY_REST_Admin_Controller extends MY_REST_Membre_Controller {

    function __construct()
    {
        parent::__construct();
        if (!($this->getIdentity() && $this->getIdentity()->isAdmin()))
        {
            $content = $this->load->view('access_forbidden', NULL, TRUE);
            $this->load->view('master', array('title' => 'Accès non autorisé', 'content' => $content));
            // Write the output.
            echo $this->output->get_output();

            // Stop the execution of the script.
            exit();
        }

        $this->dashboard = $this->load->view('admin/dashboard', NULL, TRUE);
        $this->breadcrumb->add('Admin', '/admin');
        $this->menu = '';
    }
}
