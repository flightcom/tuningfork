<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Entity\Pret;
use Entity\PretStatus;

class Prets extends MY_REST_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index_get($id)
    {
        $id = $id ?? $this->get('id') ?? null;

        if ($id) {
            $prets = $this->em->getRepository('Entity\Pret')->get($id);
        } else {
            $prets = $this->em->getRepository('Entity\Pret')->getAll();
        }

        $this->response(["data" => $prets], 200);
    }

    public function index_post()
    {
        $data = $this->post();

        try {
            $this->object = new Pret();
            $this->createObject($data);
            $pret = $this->object->toArray();
            $this->response(['data' => $pret], 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }
    }

    public function index_put($id)
    {
        $data = $this->put();

        try {
            $this->object = $this->em->getRepository('Entity\Pret')->get($id);
            $this->updateObject($data);
            $this->setStatus();
            $this->em->flush();
            $this->response(['data' => $this->object], 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }

    }

    public function index_delete($id)
    {
        $pret = $this->em->getRepository('Entity\Pret')->get($id);
        try {
            $this->em->remove($pret);
            $this->em->flush();
        } catch (\Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }
        $this->response(['error' => null], 200);
    }

    public function search_get()
    {
        $params = $this->get();
        foreach ($params as $key => $value) {
            if (Utils::isJson($value))
                $params[$key] = is_object(json_decode($value)) ? (array) json_decode($value) : json_decode($value);
        }

        if ($this->get()) {
            $count = $this->em->getRepository('Entity\Pret')->search($params, true);
            $prets = $this->em->getRepository('Entity\Pret')->search($params);
        }

        $this->response([
            "count" => $count,
            "data" => $prets
        ], 200);
    }

    public function start_post()
    {
        $id = $id ?? $this->get('id') ?? null;
        $pret = $this->em->getRepository('Entity\Pret')->get($id);
        $pret->setDateDebut(new \DateTime('now'));

        try {
            $this->em->flush();
            $this->response(['data' => $pret], 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }

    }

}
