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
        $this->db->where('membre_id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    /* A modifier */
    function insert()
    {
        $this->membre = $this->input->post('marque');
        $this->instru_categ_id = $this->input->post('categorie');
        $this->instru_modele = $this->input->post('modele');
        $this->instru_code = $this->input->post('code');
        $this->instru_numero_serie = $this->input->post('numero');

        $this->db->insert('instruments', $this);
    }

    static function format_address($m){
        $adr = "";
        $adr .= $m->adr_numero ." ";
        $adr .= $m->adr_type_voie ." ";
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