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
        $this->db->join('categories_extended', 'categories_extended.categ_id = instruments.instru_categ_id');
        $this->db->order_by('instruments.instru_id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function get_entry($id)
    {
        $this->db->select('*');
        $this->db->from('instruments');
        $this->db->join('marques', 'marques.marque_id= instruments.instru_marque_id');
        $this->db->join('categories', 'categories.categ_id= instruments.instru_categ_id');
        $this->db->where('instru_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function is_available($instru_id) {
        $this->db->select('count(*) as nb');
        $this->db->from('instruments');
        $this->db->where('instru_id', $instru_id);
        $this->db->where('instru_dispo', 1);
        $query = $this->db->get();
        return (int)$query->row()->nb == 1 ? true : false;
    }

    function get_entry_by_instru_code($instru_code)
    {
        $this->db->select('*');
        $this->db->from('instruments');
        $this->db->where('instru_code', $instru_code);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    function insert()
    {
        $this->instru_marque_id = $this->input->post('marque');
        $this->instru_categ_id = $this->input->post('categorie');
        $this->instru_modele = $this->input->post('modele');
        // $this->instru_code = $this->input->post('code');
        $this->instru_numero_serie = $this->input->post('numero');
        $this->instru_etat = $this->input->post('etat');
        $this->instru_dispo = $this->input->post('dispo');

        $this->db->insert('instruments', $this);
    }

    function update($id)
    {
        $this->instru_code = $this->input->post('code');
        $this->instru_dispo = $this->input->post('dispo');
        $this->instru_etat = $this->input->post('etat');
        $this->db->where('instru_id', $id);
        $this->db->update('instruments', $this);
    }

    function updateDispo($id, $dispo)
    {
        $this->instru_dispo = $dispo;
        $this->db->where('instru_id', $id);
        $this->db->update('instruments', $this);        
    }

    function updateCheck($id, $check)
    {
        $this->instru_a_verifier = $check;
        $this->db->where('instru_id', $id);
        $this->db->update('instruments', $this);        
    }

    function updateEtat($id, $etat)
    {
        $this->instru_etat = $etat;
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
        return $this->db->insert_id();
    }

    /** Catégories **/
    function get_parents_categories($id = null) 
    {
        $query = $this->db->query('CALL GetParents('.$id.')');
        $result = $query->result();
        $query->free_result();
        return $result;
    }

    function get_children_categories($parent = null)
    {
        $this->db->select('*');
        $this->db->from('categories_extended');
        $this->db->where('categ_parent_id', $parent);
        $this->db->order_by('categ_nom', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function get_categorie($id)
    {
        $this->db->select('*');
        $this->db->from('categories_extended');
        $this->db->where('categ_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_all_categories()
    {
        $this->db->order_by('categ_nom', 'asc');
        $query = $this->db->get('categories');
        return $query->result();
    }

    function insert_categorie($nom, $parent)
    {
        $this->categ_nom = mb_strtoupper(mb_substr($nom,0,1)).mb_substr($nom,1,mb_strlen($nom));
        $this->categ_public_id = strtolower(str_replace(' ', '-', convert_accented_characters($nom)));
        $this->categ_parent_id = $parent;
        $res = $this->db->insert('categories', $this);
        return $this->db->insert_id();
    }

    function update_categorie($categ_id, $data)
    {
        $this->db->where('categ_id', $categ_id);
        $res = $this->db->update('categories', $data);
        return $res;
    }

    function delete_categorie($categ_id)
    {
        $this->db->where('categ_id', $categ_id);
        $res = $this->db->delete('categories');
        return $res;
    }

    function get_categ_id_of($id)
    {
        $this->db->select('categ_id');
        $this->db->from('categories');
        $this->db->join('instruments', 'instruments.instru_categ_id = categories.categ_id');
        $this->db->where('instru_id', $id);
        $query = $this->db->get();
        return $query->row('categ_id');
    }

    function get_categ_available()
    {
        $this->db->select('categ_nom, categ_public_id');
        $this->db->from('categories');
        $this->db->join('instruments', 'instruments.instru_categ_id = categories.categ_id');
        $this->db->where('instru_dispo = 1');
        $this->db->where('instru_categ_id IS NOT NULL');
        $this->db->group_by('categ_id');
        $query = $this->db->get();
        return $query->result();
    }

    function get_sous_categ_available($categ_id)
    {
        $this->db->from('instruments');
        $this->db->join('categories', 'instruments.instru_categ_id = categories.categ_id');
        $this->db->where('instru_dispo = 1');
        $this->db->where('instru_categ_id', $categ_id);
        $this->db->where('instru_categ_id IS NOT NULL');
        $query = $this->db->get();
        return $query->result();
    }

    function get_categorie_by_public_id($public_id) 
    {
        $this->db->select('*');
        $this->db->from('categories_extended');
        $this->db->where('categ_public_id', $public_id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_instruments($categ_id)
    {
        $this->db->select('*');
        $this->db->from('instruments');
        $this->db->join('marques', 'instruments.instru_marque_id = marques.marque_id');
        $this->db->where('instru_categ_id', $categ_id);
        $query = $this->db->get();
        return $query->result();
    }

    function search_instru($search)
    {
        $this->db->select('*');
        $this->db->from('instruments');
        $this->db->join('categories', 'instruments.instru_categ_id = categories.categ_id');
        $this->db->join('marques', 'instruments.instru_marque_id = marques.marque_id');
        $this->db->where("instru_modele LIKE '%$search%' OR marque_nom LIKE '%$search%'");
        $query = $this->db->get();
        return $query->result();
    }

    function get_last($count)
    {
        $this->db->select('*');
        $this->db->from('instruments');
        $this->db->join('categories', 'instruments.instru_categ_id = categories.categ_id');
        $this->db->join('marques', 'instruments.instru_marque_id = marques.marque_id');
        $this->db->order_by('instru_date_entree', 'desc');
        $this->db->limit($count);
        $query = $this->db->get();
        return $query->result();

    }

    function test_code($code)
    {
        $this->db->select('*');
        $this->db->from('instruments');
        $this->db->where("instru_code = " . $code);
    }

}

?>