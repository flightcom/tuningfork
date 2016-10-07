<?php

class Agenda_model extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        // parent::__construct();
        $this->load->helper('database');
        $this->load->database(); 
    }
    
    function get_all_entries()
    {
        $this->db->select('*');
        $this->db->from('events');
        $query = $this->db->get();
        return $query->result();
    }

    function get_all_entries_formatted()
    {
        $this->db->select('event_id as id, event_type as class, event_nom as title, event_url as url, UNIX_TIMESTAMP(event_debut)*1000 as start, UNIX_TIMESTAMP(event_fin)*1000 as end');
        $this->db->from('events');
        $query = $this->db->get();
        return $query->result();
    }

    function get_entry($id)
    {
    }

    function insert($event)
    {
        $this->event_nom         = $event['nom'];
        $this->event_type        = $event['type'];
        $this->event_lieu        = $event['lieu'];
        $this->event_public      = $event['public'];
        $this->event_debut       = $event['day-start'] . ' ' . $event['hour-start'];
        $this->event_fin         = $event['day-end'] . ' ' . $event['hour-end'];
        $this->event_description = $event['description'];
        $this->event_url         = $event['url'];

        $this->db->insert('events', $this);
    }

    static function get_event_types()
    {
        $enums = field_enums('events', 'event_type');
        return $enums;        
    }
}

?>