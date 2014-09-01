<?php

class Emprunt_model extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        // parent::__construct();
        $this->load->database(); 
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
        $this->db->where('emp_date_fin < ', 'NOW()');
        $query = $this->db->get();
        return $query->row();
    }

}

?>