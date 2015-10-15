<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('field_enums'))
{
    function field_enums($table = '', $field = '')
    {
        $enums = array();
        if ($table == '' || $field == '') return $enums;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value) {
            $enums[$value] = $value; 
        }
        return $enums;
    }  
}

if ( ! function_exists('get_auto_increment'))
{
    function get_auto_increment($tablename = '')
    {
        $auto_increment = null;
        if ($tablename == '') return $auto_increment;
        $CI =& get_instance();
        $query = $CI->db->query("SELECT `AUTO_INCREMENT`
            FROM  INFORMATION_SCHEMA.TABLES
            WHERE TABLE_SCHEMA = '".$CI->db->database."'
            AND   TABLE_NAME   = '".$tablename."'");
        return $query->result()[0]->AUTO_INCREMENT;
    }
}
