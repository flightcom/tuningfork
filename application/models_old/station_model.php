<?php

class Station_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        // parent::__construct();
        // $this->load->database(); 
    }
    
    function getAll()
    {
        $this->db->select('*');
        $this->db->from('station');
        $query = $this->db->get();
        return $query->result();
    }

}

?>