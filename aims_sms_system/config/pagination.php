<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pagination
 *
 * @author Animesh
 */
class pagination {
   
    public function init_pagination($uri,$total_rows,$per_page=10,$segment=4){
       $ci                          =& get_instance();
       $config['per_page']          = $per_page;
       $config['uri_segment']       = $segment;
       $config['base_url']          = base_url().$uri;
       $config['total_rows']        = $total_rows;
       $config['use_page_numbers']  = TRUE;
 
       $ci->pagination->initialize($config);
       return $config;    
   } 
   
}


