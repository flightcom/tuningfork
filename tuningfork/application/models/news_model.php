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
        $this->db->join('membres', 'membres.membre_id = news.news_auteur_id');
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

    function insert($titre, $texte, $tags = null)
    {
        $this->news_titre = $titre;
        $this->news_contenu = $texte;
        $this->news_auteur_id = $this->session->userdata('user_id');
        $res = $this->db->insert('news', $this);
        if ($res) $newsid = $this->db->insert_id();
        if ($res && $tags) $res = $this->insert_tags($newsid, $tags);
        return $res;
    }

    function insert_tags($newsid, $tags)
    {
        $this->nt_news_id = $newsid;
        $this->nt_tags = serialize($tags);
        $res = $this->db->insert('news_tags', $this);
        return $res;
    }

}

?>