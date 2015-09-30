<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Pagination
{
    var $items_per_page;  
    var $items_total;  
    var $current_page;  
    var $num_pages;  
    var $mid_range;  
    var $low;  
    var $high;  
    var $limit;  
    var $return;  
    var $default_ipp = 25;  //default value for pagination items per page
  
    function Pagination()  
    {  
        $this->current_page = 1;  
        $this->mid_range = 7;  
        $this->items_per_page = (!empty($_GET['ipp'])) ? $_GET['ipp']:$this->default_ipp;  
    }  
}

?>
