<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('hscje'))
{
    function hscje($obj)
    {
        return htmlspecialchars(json_encode($obj));
    }  
}