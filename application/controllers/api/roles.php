<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Entity\Role;
use Zend\View\Model\JsonModel;

class Roles extends MY_REST_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index_get($id = null)
    {
        $id = $id ?? $this->get('id') ?? null;

        if ($id) {
            $roles = $this->em->getRepository('Entity\Role')->get($id);
        } else {
            $roles = $this->em->getRepository('Entity\Role')->getAll();
        }

        $this->response(['data' => $roles], 200);
    }

}
