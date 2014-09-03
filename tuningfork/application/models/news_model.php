<?php

class News_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        // parent::__construct();
        $this->load->database(); 
    }
    
    function get_all_entries()
    {
        $this->db->select('*');
        $this->db->from('news');
        $this->db->order_by('news_date_creation', 'desc');
        $query = $this->db->get();
        return $query->result();

    }

    function get_last_ten_entries()
    {
        $this->db->select('*');
        $this->db->order_by('news_date_creation', 'desc');
        $query = $this->db->get('news', 10);
        return $query->result();
    }

    function get_entry($id)
    {
        $this->db->select('*');
        $this->db->from('news');
        $this->db->where('news_id', $id);
        $this->db->where('membre_password', $md5pass);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

}

?>