<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Entity\Instrument;
use Entity\Marque;

class Instruments extends MY_REST_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index_get($id = null)
    {
        $id = $id ?? $this->get('id') ?? null;

        if ($id) {
            $instruments = $this->em->getRepository('Entity\Instrument')->get($id);
        } else {
            $instruments = $this->em->getRepository('Entity\Instrument')->getAll();
        }

        $this->response(["data" => $instruments], 200);
    }

    public function index_post()
    {
        $data = $this->post();

        $marque = $this->em->getRepository('Entity\Marque')->get($data['marque']['id']);
        $instrument = Instrument::create($data);
        $instrument->setMarque($marque);

        try {
            $this->em->persist($instrument);
            $this->em->flush();
            $this->response(['success' => true], 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }

    }

    public function index_put($id)
    {
        $data = $this->put();

        $this->object = $this->em->getRepository('Entity\Instrument')->get($id);

        try {
            $this->updateObject($data);
            $this->response(['success' => $this->object], 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }

    }

    public function index_delete($id)
    {
        $instrument = $this->em->getRepository('Entity\Instrument')->get($id);
        try {
            $this->em->remove($instrument);
            $this->em->flush();
        } catch (\Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }
        $this->response(['error' => null], 200);
    }

    public function search_get()
    {
        if ($this->get()) {
            $instruments = $this->em->getRepository('Entity\Instrument')->search($this->get());
        }

        $this->response(["data" => $instruments], 200);
    }

    public function count_get()
    {
        $data = array_merge(['count' => true], $this->get());
        if ($data) {
            $instruments = $this->em->getRepository('Entity\Instrument')->search($data);
        }

        $this->response(["data" => $instruments], 200);
    }

    public function barcode_get()
    {
        do {
            $barcode = Utils::generateBarcodeValue('ean13');
        } while ($this->em->getRepository('Entity\Instrument')->findBy(['barcode' => $barcode]));
        $this->response(["data" => $barcode], 200);
    }

    public function prets_get($id)
    {
        $id = $id ?? $this->get('id') ?? null;

        $instrument = $this->em->getRepository('Entity\Instrument')->get($id);
        $prets = $this->em->getRepository('Entity\Pret')->findAll(['instrument' => $id]);
        $this->response(["data" => $prets], 200);
    }


}
