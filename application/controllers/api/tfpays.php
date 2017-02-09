<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Entity\Pays;
use Zend\View\Model\JsonModel;

class Tfpays extends MY_REST_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index_get($id = null)
    {
        $id = !$id ? ($this->get('id') ? $this->get('id') : null) : $id;

        if ($id) {
            $pays = $this->em->getRepository('Entity\Pays')->get($id);
        } else {
            $pays = $this->em->getRepository('Entity\Pays')->getAll();
        }

        $this->response($pays, 200);
    }

}
