<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Entity\Marque;
use Barcode;

class Marques extends MY_REST_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index_get($id = null)
    {
        $id = !$id ? ($this->get('id') ? $this->get('id') : null) : $id;

        if ($id) {
            $marques = $this->em->getRepository('Entity\Marque')->get($id);
        } else {
            $marques = $this->em->getRepository('Entity\Marque')->getAll();
        }

        $this->response(['data' => $marques], 200);
    }

    public function index_post()
    {
        $data = $this->post();
        $marque = Marque::create($data);

        try {
            $this->em->persist($marque);
            $this->em->flush();
            $this->response(['success' => true], 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }

    }

}
