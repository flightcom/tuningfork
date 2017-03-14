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
        // $data = $this->post();

        // $marque = $this->em->getRepository('Entity\Marque')->get($data['marque']['id']);
        // $instrument = Instrument::create($data);
        // $instrument->setMarque($marque);

        // try {
        //     $this->em->persist($instrument);
        //     $this->em->flush();
        //     $this->response(['success' => true], 200);
        // } catch (Exception $e) {
        //     $this->response(['error' => $e->getMessage()], 500);
        // }

    }

    public function index_put($id)
    {
        $data = $this->put();

        try {
            $this->object = $this->em->getRepository('Entity\Pret')->get($id);
            $this->updateObject($data);
            $this->response(['data' => $this->object], 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }

    }

    public function index_delete($id)
    {
        // $instrument = $this->em->getRepository('Entity\Instrument')->get($id);
        // try {
        //     $this->em->remove($instrument);
        //     $this->em->flush();
        // } catch (\Exception $e) {
        //     $this->response(['error' => $e->getMessage()], 500);
        // }
        // $this->response(['error' => null], 200);
    }

    public function search_get()
    {
        if ($this->get()) {
            $prets = $this->em->getRepository('Entity\Pret')->search($this->get());
        }

        $this->response(["data" => $prets], 200);
    }

    public function count_get()
    {
        $data = array_merge(['count' => true], $this->get());
        if ($data) {
            $prets = $this->em->getRepository('Entity\Pret')->search($data);
        }

        $this->response(["data" => $prets], 200);
    }

    public function start_post()
    {
        $id = $id ?? $this->get('id') ?? null;
        $pret = $this->em->getRepository('Entity\Pret')->get($id);
        $pret->setDateDebut(new \DateTime('now'));
        $status = $this->em->getRepository('Entity\PretStatus')->findOneBy(['name' => PretStatus::calculate()]);
        $pret->setStatus($status);

        try {
            $this->em->flush();
            $this->response(['data' => $pret], 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }

    }

}
