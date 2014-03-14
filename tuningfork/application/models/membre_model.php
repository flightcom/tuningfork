<?php

class Membre_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        // parent::__construct();
        $this->load->database(); 
    }
    
    function get_all_entries()
    {
        $this->db->select('*');
        $this->db->from('membres');
        $this->db->join('adresse', 'membres.membre_adr_id= adresse.adr_id');
        $this->db->join('ville', 'adresse.adr_ville_id= ville.ville_id');
        $this->db->join('pays', 'adresse.adr_pays_id= pays.pays_id');
        $query = $this->db->get();
        return $query->result();

    }

    function get_last_ten_entries()
    {
        $query = $this->db->get('membres', 10);
        return $query->result();
    }

    function get_entry($login, $md5pass)
    {
        $this->db->select('*');
        $this->db->from('membres');
        $this->db->where('membre_email', $login);
        $this->db->where('membre_password', $md5pass);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();        
    }

    function insert()
    {
        $this->membre = $this->input->post('marque');
        $this->instru_categ_id = $this->input->post('categorie');
        $this->instru_modele = $this->input->post('modele');
        $this->instru_code = $this->input->post('code');
        $this->instru_numero_serie = $this->input->post('numero');

        $this->db->insert('instruments', $this);
    }

}

?>