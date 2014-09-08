<?php

class Agenda_model extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        // parent::__construct();
        $this->load->database(); 
    }
    
    function get_all_entries()
    {
        $this->db->select('*');
        $this->db->from('events');
        $query = $this->db->get();
        return $query->result();
    }

    function get_entry($id)
    {
    }

    function insert($event)
    {
        $this->event_nom = $event['nom'];
        $this->event_lieu = $event['lieu'];
        $this->event_debut = $event['day-start'] . ' ' . $event['hour-start'];
        $this->event_fin = $event['day-end'] . ' ' . $event['hour-end'];
        $this->event_description = $event['description'];
        $this->event_url = $event['url'];

        $this->db->insert('events', $this);
    }
}

?>