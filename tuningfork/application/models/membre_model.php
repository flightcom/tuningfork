<?php

class Membre_model extends CI_Model {

    var $adresse = "";

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
        $this->db->join('adresses', 'membres.membre_adr_id= adresses.adr_id');
        $this->db->join('villes', 'adresses.adr_ville_id= villes.ville_id');
        $this->db->join('pays', 'adresses.adr_pays_id= pays.pays_id');
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

    function get_membre_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('membres');
        $this->db->join('adresses', 'membres.membre_adr_id= adresses.adr_id');
        $this->db->join('villes', 'adresses.adr_ville_id= villes.ville_id');
        $this->db->join('pays', 'adresses.adr_pays_id= pays.pays_id');
        $this->db->where('membre_id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    function insert()
    {
        $adrid = !is_null($this->input->post('adresse')) ? $this->insert_address($this->input->post('adresse'), $this->input->post('ville'), $this->input->post('pays')) : 0;
        $this->membre_genre          = $this->input->post('genre');
        $this->membre_nom            = $this->input->post('nom');
        $this->membre_prenom         = $this->input->post('prenom');
        $this->membre_date_naissance = $this->input->post('dob');
        $this->membre_email          = $this->input->post('email');
        $this->membre_tel            = $this->input->post('tel');
        $this->membre_adr_id         = $adrid;
        $this->membre_login          = $this->input->post('login');
        $this->membre_password       = $this->input->post('passwd');

        $this->db->insert('membres', $this);
    }

    private function insert_address($adr, $ville_id, $pays_id)
    {
        $this->adr_voie     = $adr;
        $this->adr_ville_id = $ville_id;
        $this->adr_pays_id  = $pays_id;

        $adr_id = $this->db->insert('adresses', $this);

        return $adr_id;
    }

    static function format_address($m){
        $adr = "";
        $adr .= $m->adr_voie ." ";
        return $adr;

    }

    static function get_genders(){
        $enums = field_enums('membres', 'membre_genre');
        return $enums;
    }

    function set_date_last_connection($id, $date) 
    {
        $data = array('membre_date_last_connection'=> $date);
        $this->db->where('membre_id', $id);
        $this->db->update('membres', $data);
    }

    function search_membre($search)
    {
        $this->db->select('*');
        $this->db->from('membres');
        $this->db->join('adresses', 'membres.membre_adr_id= adresses.adr_id');
        $this->db->join('villes', 'adresses.adr_ville_id= villes.ville_id');
        $this->db->join('pays', 'adresses.adr_pays_id= pays.pays_id');
        $this->db->where("membre_nom LIKE '%$search%' OR membre_prenom LIKE '%$search%'");
        $query = $this->db->get();
        return $query->result();
    }

}

?>