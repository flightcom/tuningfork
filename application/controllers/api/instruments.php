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

        try {
            $this->object = new Instrument();
            $this->createObject($data);
            $instrument = $this->object->toArray(['categories']);
            $this->response(['data' => $instrument], 200);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }

        // $marque = $this->em->getRepository('Entity\Marque')->get($data['marque']['id']);
        // $instrument = Instrument::create($data);
        // $instrument->setMarque($marque);

        // try {
        //     $this->em->persist($instrument);
        //     $this->em->flush();
        //     $this->response(['data' => true], 200);
        // } catch (Exception $e) {
        //     $this->response(['error' => $e->getMessage()], 500);
        // }

    }

    public function index_put($id)
    {
        $data = $this->put();

        $this->object = $this->em->getRepository('Entity\Instrument')->get($id);

        try {
            $this->updateObject($data);
            $this->response(['data' => $this->object], 200);
        } catch (Exception $e) {
            $this->response($e->getMessage(), 500);
        }

    }

    public function index_delete($id)
    {
        $instrument = $this->em->getRepository('Entity\Instrument')->get($id);
        try {
            $this->em->remove($instrument);
            $this->em->flush();
        } catch (\Exception $e) {
            $this->response($e->getMessage(), 500);
        }
        $this->response(null, 200);
    }

    public function search_get()
    {
        $params = $this->get();
        foreach ($params as $key => $value) {
            if (Utils::isJson($value))
                $params[$key] = is_object(json_decode($value)) ? (array) json_decode($value) : json_decode($value);
        }

        if ($this->get()) {
            $count = $this->em->getRepository('Entity\Instrument')->search($params, true);
            $prets = $this->em->getRepository('Entity\Instrument')->search($params);
        }

        $this->response([
            "count" => $count,
            "data" => $prets
        ], 200);
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
