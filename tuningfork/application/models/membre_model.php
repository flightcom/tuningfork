<?php

class Membre_model extends CI_Model {

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

    function insert($userdata)
    {
        $this->db->trans_start();
        $adrid = !is_null($userdata['adresse']) ? $this->insert_address($userdata['adresse']) : 0;
        foreach($userdata['membre'] as $key => $value) :
            $this->$key = $value;
        endforeach;
        $this->membre_adr_id = $adrid ? $adrid : null;
        $res = $this->db->insert('membres', $this);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    function update($id, $userdata)
    {
        $this->db->where('m.membre_id', $id);
        $this->db->where('m.membre_adr_id = a.adr_id');
        $res = $this->db->update('membres as m, adresses as a', $userdata);
        return $res;
    }

    private function insert_address($data)
    {
        $adr_id = $this->db->insert('adresses', $data);
        return $adr_id ? $this->db->insert_id() : false;
    }

    private function delete_address($id)
    {
        $this->db->where('adr_id', $id);
        $this->db->delete('adresses');
    }

    static function format_address($m){
        $adr = "";
        $adr .= $m->adr_voie ." ";
        return $adr;

    }

    static function merge_address($m){
        return $m->adr_voie . " " .$m->ville_code_postal . " " .$m->ville_nom;
    }

    static function get_genders(){
        $enums = field_enums('membres', 'membre_genre');
        return $enums;
    }

    function update_date_last_connection($id) 
    {
        $data = array('membre_date_last_connection'=> 'NOW');
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