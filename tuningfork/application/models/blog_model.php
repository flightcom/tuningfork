<?php

class Blog_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        // parent::__construct();
        $this->load->database(); 
    }
    
    function get_all_entries()
    {
        $this->db->select('*');
        $this->db->from('articles');
        $this->db->join('membres', 'membres.membre_id = articles.article_auteur_id');
        $this->db->order_by('article_date_creation', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function get_all_entries_extended()
    {
        $this->db->select('*');
        $this->db->from('articles_extended');
        $this->db->order_by('article_date_creation', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function get_all_published_entries()
    {
        $this->db->select('*');
        $this->db->from('articles');
        $this->db->join('membres', 'membres.membre_id = articles.article_auteur_id');
        $this->db->where('article_published', true);
        $this->db->order_by('article_date_creation', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function get_last_ten_entries()
    {
        $this->db->select('*');
        $this->db->order_by('article_date_creation', 'desc');
        $query = $this->db->get('articles', 10);
        return $query->result();
    }

    function get_entry($id)
    {
        $this->db->select('*');
        $this->db->from('articles');
        // $this->db->join('membres', 'membres.membre_id = articles.article_auteur_id');
        $this->db->where('article_id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    function insert($titre, $texte, $tags = null)
    {
        $this->article_titre = $titre;
        $this->article_contenu = $texte;
        $this->article_auteur_id = $this->session->userdata('user_id');
        $res = $this->db->insert('articles', $this);
        if ($res) $articleid = $this->db->insert_id();
        if ($res && $tags) $res = $this->insert_tags($articleid, $tags);
        return $res;
    }

    function insert_tags($articleid, $tags)
    {
        $data = [
            'nt_article_id' => $articleid,
            'nt_tags' => serialize($tags)
        ];
        $res = $this->db->insert('articles_tags', $data);
        return $res;
    }

    function update($id, $data)
    {
        $this->db->where('article_id', $id);
        $res = $this->db->update('articles', $data);
        return $res;
    }

}

?>