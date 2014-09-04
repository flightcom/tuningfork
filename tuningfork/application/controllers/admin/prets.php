<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prets extends Admin_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -  
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Instrument_model');
        $this->load->model('Emprunt_model');

        $this->menu = $this->load->view('admin/prets/menu', NULL, TRUE);
    }  

    public function index($param1 = null, $param2 = null)
    {
        if(is_null($param1))
        {
            $this->liste();
        } 
        else if(is_numeric($param1) && is_null($param2))
        {
            $id = $param1;
            $data = array(
                'title' => 'Informations sur l\'instrument',
                'instrument' => $this->Instrument_model->get_entry($id)
                );
            $content = $this->load->view('admin/instruments/instrument', $data, TRUE);
            $this->load->view('admin/master', array( 'content' => $content));
        }
        else if(is_numeric($param1) && !is_null($param2))
        {
            $instru_id = $param1;
            $action = $param2;

            switch($action){
                case 'delete'   : $this->delete($instru_id); break;
                case 'edit'     : $this->edit($instru_id); break;
                default         : break;
            }
        }
        else if(!is_numeric($param1) && is_null($param2))
        {
            switch($param1){
                case 'add'      : $this->add();break;
                case 'prets'    : $this->prets();break;
                case 'liste'    : $this->liste();break;
                default         : break;
            }
        }

    }

    public function liste()
    {
        $data = array(
            'emprunts' => $this->Emprunt_model->get_all_entries(),
            'title' => 'Liste des prêts'
            );
        $content = $this->load->view('admin/prets/liste', $data, TRUE);
        $this->load->view('admin/master', array('title' => $data['title'], 'content' => $content));
    }

    public function add()
    {


    }

    public function now()
    {
        $data = array(
            'emprunts' => $this->Emprunt_model->get_emprunt_en_cours(),
            'title' => 'Liste des prêts en cours'
            );
        $content = $this->load->view('admin/prets/liste', $data, TRUE);
        $this->load->view('admin/master', array('title' => $data['title'], 'content' => $content));

    }

    public function retards()
    {
        $data = array(
            'emprunts' => $this->Emprunt_model->get_emprunt_en_cours(),
            'title' => 'Liste des prêts en retard'
            );
        $content = $this->load->view('admin/prets/liste', $data, TRUE);
        $this->load->view('admin/master', array('title' => $data['title'], 'content' => $content));

    }

}