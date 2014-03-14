<?php

class Instrument_model extends CI_Model {

    // var $title   = '';
    // var $content = '';
    // var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        // parent::__construct();
        $this->load->database(); 
    }
    
    function get_all_entries()
    {
        $this->db->select('*');
        $this->db->from('instruments');
        $this->db->join('marque', 'marque.marque_id= instruments.instru_marque_id');
        $this->db->join('categorie', 'categorie.categ_id= instruments.instru_categ_id');
        $query = $this->db->get();
        return $query->result();
    }

    function get_entry($id)
    {
        $this->db->select('*');
        $this->db->from('instruments');
        $this->db->join('marque', 'marque.marque_id= instruments.instru_marque_id');
        $this->db->join('categorie', 'categorie.categ_id= instruments.instru_categ_id');
        $this->db->where('instru_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function insert()
    {
        $this->instru_marque_id = $this->input->post('marque');
        $this->instru_categ_id = $this->input->post('categorie');
        $this->instru_modele = $this->input->post('modele');
        $this->instru_code = $this->input->post('code');
        $this->instru_numero_serie = $this->input->post('numero');

        $this->db->insert('instruments', $this);
    }

    function delete($id)
    {
        $this->db->where('instru_id', $id);
        $this->db->delete('instruments');
    }

    /** Marques **/
    function get_all_marques()
    {
        $this->db->order_by('marque_nom', 'asc');
        $query = $this->db->get('marque');
        return $query->result();
    }

    function insert_marque($nom)
    {
        $this->marque_nom = ucfirst(strtolower($nom));
        $res = $this->db->insert('marque', $this);
        return $res;
    }

    /** Catégories **/
    function get_all_categories()
    {
        $this->db->order_by('categ_nom', 'asc');
        $query = $this->db->get('categorie');
        return $query->result();
    }

    function insert_categorie($nom)
    {
        $this->categ_nom = ucfirst(strtolower($nom));
        $res = $this->db->insert('categorie', $this);
        return $res;
    }
}

?>