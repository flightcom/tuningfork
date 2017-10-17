<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Entity\Categorie;
use Entity\PretStatus;

class Categories extends MY_REST_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index_get($id = null)
    {
        $id = $id ?? $this->get('id') ?? null;

        if ($id) {
            $prets = $this->em->getRepository('Entity\Categorie')->get($id);
        } else {
            $prets = $this->em->getRepository('Entity\Categorie')->getAll();
        }

        $this->response(["data" => $prets], 200);
    }

    public function index_post()
    {
        $data = $this->post();
        $parent = isset($data['parent']) ? $this->em->getRepository('Entity\Categorie')->get($data['parent']['id']) : null;
        $categorie = Categorie::create($data);
        $categorie->setParent($parent);

        try {
            $this->em->persist($categorie);
            $this->em->flush();
            $this->response(['data' => $categorie], 200);
        } catch (Exception $e) {
            $this->response($e->getMessage(), 500);
        }
    }

    public function index_put($id)
    {}

    public function index_delete($id)
    {}

    public function search_get()
    {
        $params['filters'] = $this->get('params');
        foreach ($params as $key => $value) {
            if (Utils::isJson($value))
                $params[$key] = is_object(json_decode($value)) ? (array) json_decode($value) : json_decode($value);
        }

        if ($params) {
            $count      = $this->em->getRepository('Entity\Categorie')->search($params, true);
            $categories = $this->em->getRepository('Entity\Categorie')->search($params);
        }

        $this->response([
            "count" => $count,
            "data"  => $categories ?? null
        ], 200);
    }

    public function tree_get($id = null)
    {
        $id = $id ?? $this->get('id') ?? null;

        if ($id) {
            $prets = $this->em->getRepository('Entity\Categorie')->get($id);
        } else {
            $prets = $this->em->getRepository('Entity\Categorie')->getAll();
        }

        $rootCategories = $this->em->getRepository('Entity\Categorie')->findAll(['parent' => null]);

        $this->response(["data" => $prets], 200);
    }

    private function buildTree ($id = null)
    {
        $categories = $this->em->getRepository('Entity\Categorie')->findAll(['parent' => null]);



        foreach ($categories as $categorie) {

        }
    }

}
