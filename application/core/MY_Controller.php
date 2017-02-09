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
        // $this->session->set_userdata('referer', $_SERVER['HTTP_REFERER']);
        $this->breadcrumb = new Breadcrumb();
    }

}

class MY_REST_Controller extends REST_Controller {

    /**
     * @var EntityManager
     */
    protected $em = null;


    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('breadcrumb');
        $this->load->library('Doctrine');

        $account = $this->load->view('membres/button', NULL, TRUE);
        $this->session->set_userdata('account', $account);
        // $this->session->set_userdata('referer', $_SERVER['HTTP_REFERER']);
        $this->breadcrumb = new Breadcrumb();
        $this->em = $this->doctrine->getEntityManager();
        $this->hydrator = new DoctrineHydrator($this->em, false);
    }

    /**
     * Set entity manager
     *
     * @param EntityManager $em
     * @return mixed
     */
    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;

        return $this;
    }

    /**
     * Get entity manager
     *
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->em;
    }

}

class MY_REST_Auth_Controller extends MY_REST_Controller {

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user'))
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
        if (!$this->session->userdata('user')->isAdherent()) {
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
        if ( ! $this->session->userdata('user_isAdmin'))
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
