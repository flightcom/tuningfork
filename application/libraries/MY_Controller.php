<?php

require(APPPATH.'/libraries/REST_Controller.php');

use Doctrine\ORM\EntityManager;

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

?>
