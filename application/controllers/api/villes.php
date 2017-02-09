<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Entity\Ville;
use Zend\View\Model\JsonModel;

class Villes extends MY_REST_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index_get($id = null)
    {
        $id = !$id ? ($this->get('id') ? $this->get('id') : null) : $id;

        if ($id) {
            $villes = $this->em->getRepository('Entity\Ville')->get($id);
        } else {
            $villes = $this->em->getRepository('Entity\Ville')->getAll();
        }

        $this->response($villes, 200);
    }

    public function filter_get()
    {
        $filters = $this->get();

        if (isset($filters['limit'])) {
            $limit = $filters['limit'];
            unset($filters['limit']);
        } else {
            $limit = 0;
        }

        $villes = $this->em->getRepository('Entity\Ville')->filter($filters, $limit);

        $this->response($villes, 200);
    }

}
