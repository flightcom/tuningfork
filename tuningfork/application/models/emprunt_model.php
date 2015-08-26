<?php

class Emprunt_model extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        // parent::__construct();
        $this->load->database(); 
    }
    
    function get_all_entries()
    {
        $this->db->select('*');
        $this->db->from('emprunts');
        $this->db->join('membres', 'emprunts.emp_membre_id = membres.membre_id');
        $this->db->join('instruments', 'emprunts.emp_instru_id = instruments.instru_id');
        $this->db->join('marques', 'marques.marque_id = instruments.instru_marque_id');
        $this->db->join('categories', 'categories.categ_id = instruments.instru_categ_id');
        $this->db->join('types_instru', 'types_instru.type_categ_id = categories.categ_id AND types_instru.type_id = instruments.instru_type_id', 'left outer');
        $this->db->order_by('emprunts.emp_date_debut', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function get_all_entries_extended()
    {
        $query = $this->db->get('emprunts_extended');
        return $query->result();
    }

    function get_entry($id)
    {
        $this->db->select('*');
        $this->db->from('emprunts');
        $this->db->join('membres', 'emprunts.emp_membre_id = membres.membre_id');
        $this->db->join('adresses', 'adresses.adr_id = membres.membre_adr_id');
        $this->db->join('villes', 'adresses.adr_ville_id = villes.ville_id');
        $this->db->join('instruments', 'emprunts.emp_instru_id = instruments.instru_id');
        $this->db->join('marques', 'marques.marque_id = instruments.instru_marque_id');
        $this->db->join('categories', 'categories.categ_id = instruments.instru_categ_id');
        $this->db->join('types_instru', 'types_instru.type_categ_id = categories.categ_id AND types_instru.type_id = instruments.instru_type_id', 'left outer');
        $this->db->where('emp_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_emprunts_by_membre_id($membre_id)
    {
        $this->db->select('*');
        $this->db->from('emprunts');
        $this->db->join('membres', 'membres.membre_id=emprunts.emp_membre_id');
        $this->db->join('instruments', 'instruments.instru_id=emprunts.emp_instru_id');
        $this->db->join('marques', 'instruments.instru_marque_id=marques.marque_id');
        $this->db->join('categories', 'instruments.instru_categ_id=categories.categ_id');
        $this->db->where('membre_id', $membre_id);
        $query = $this->db->get();
        return $query->result();
    }

    function check_emprunt_en_cours_by_membre_id($membre_id)
    {
        $this->db->select('count(*) as nb');
        $this->db->from('emprunts');
        $this->db->join('membres', 'membres.membre_id=emprunts.emp_membre_id');
        $this->db->where('membre_id', $membre_id);
        $this->db->where('emp_date_fin_effective IS NULL');
        $query = $this->db->get();
        return $query->row();
    }

    function get_emprunt_en_cours()
    {
        $this->db->select('*');
        $this->db->from('emprunts');
        $this->db->join('membres', 'membres.membre_id=emprunts.emp_membre_id');
        $this->db->join('instruments', 'emprunts.emp_instru_id = instruments.instru_id');
        $this->db->join('marques', 'marques.marque_id = instruments.instru_marque_id');
        $this->db->join('categories', 'categories.categ_id = instruments.instru_categ_id');
        $this->db->join('types_instru', 'types_instru.type_categ_id = categories.categ_id AND types_instru.type_id = instruments.instru_type_id', 'left outer');
        $this->db->where('emp_date_fin_effective IS NULL');
        $query = $this->db->get();
        return $query->result();
    }

    function get_history($instru_id)
    {
        $this->db->select('*');
        $this->db->from('emprunts');
        $this->db->join('membres', 'membres.membre_id=emprunts.emp_membre_id');
        $this->db->join('instruments', 'emprunts.emp_instru_id = instruments.instru_id');
        $this->db->where('emp_instru_id', $instru_id);
        $this->db->order_by('emp_date_debut', 'desc');
        $query = $this->db->get();
        return $query->result(); 
    }

    function insert($pret)
    {
        $this->db->insert('emprunts', $pret);
        return $this->db->insert_id();
    }

    function close($pret)
    {
        $this->db->where('emp_id', $pret->emp_id);
        $res = $this->db->update('emprunt', $pret);
        return $res;
    }

}

?>