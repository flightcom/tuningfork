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
        $this->db->join('marques', 'marques.marque_id = instruments.instru_marque_id');
        $this->db->join('categories', 'categories.categ_id = instruments.instru_categ_id');
        $this->db->join('types_instru', 'types_instru.type_categ_id = categories.categ_id AND types_instru.type_id = instruments.instru_type_id', 'left outer');
        $query = $this->db->get();
        return $query->result();
    }

    function get_entry($id)
    {
        $this->db->select('*');
        $this->db->from('instruments');
        $this->db->join('marques', 'marques.marque_id= instruments.instru_marque_id');
        $this->db->join('categories', 'categories.categ_id= instruments.instru_categ_id');
        $this->db->join('types_instru', 'types_instru.type_categ_id = categories.categ_id AND types_instru.type_id = instruments.instru_type_id', 'left');
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
        $this->instru_type_id = $this->input->post('type') ? $this->input->post('type') : null;

        $this->db->insert('instruments', $this);
    }

    function update($id)
    {
        $this->instru_code = $this->input->post('code');
        $this->instru_dispo = $this->input->post('dispo');
        $this->db->where('instru_id', $id);
        $this->db->update('instruments', $this);
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
        $query = $this->db->get('marques');
        return $query->result();
    }

    function insert_marque($nom)
    {
        $this->marque_nom = ucfirst(strtolower($nom));
        $res = $this->db->insert('marques', $this);
        return $res;
    }

    /** Catégories **/
    function get_all_categories()
    {
        $this->db->order_by('categ_nom', 'asc');
        $query = $this->db->get('categories');
        return $query->result();
    }

    function insert_categorie($nom)
    {
        $this->categ_nom = ucfirst(strtolower($nom));
        $res = $this->db->insert('categories', $this);
        return $res;
    }

    function insert_type($nom, $categ_id)
    {
        $this->type_nom = ucfirst(strtolower($nom));
        $this->type_categ_id = $categ_id;
        $res = $this->db->insert('types_instru', $this);
        return $res;
    }

    function get_types_by_categ($categ_id)
    {
        $this->db->where('type_categ_id', $categ_id);
        $this->db->order_by('type_nom', 'asc');
        $query = $this->db->get('types_instru');
        return $query->result();
    }

    function get_categ_available()
    {
        $this->db->select('categ_nom, categ_public_id');
        $this->db->from('categories');
        $this->db->join('instruments', 'instruments.instru_categ_id = categories.categ_id');
        $this->db->group_by('categ_id');
        $query = $this->db->get();
        return $query->result();
    }

    function get_sous_categ_available($categ_id)
    {
        $this->db->select('type_nom, type_id');
        $this->db->from('instruments');
        $this->db->join('types_instru', 'types_instru.type_id = instruments.instru_type_id');
        $this->db->join('categories', 'instruments.instru_categ_id = categories.categ_id');
        $this->db->where('instru_categ_id', $categ_id);
        $this->db->where('instru_categ_id IS NOT', 'NULL');
        $this->db->group_by('type_id');
        $query = $this->db->get();
        return $query->result();
    }

    function get_categ_by_public_id($public_id) 
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('categ_public_id', $public_id);
        $query = $this->db->get();
        return $query->result();
    }

}

?>