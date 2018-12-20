<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DbLoad {

         public function __construct() {
                 $this->load();
         }

         /**
          * Load the databases and ignore the old ordinary CI loader which only allows one
          */
         public function load() {
                 $CI =& get_instance();

                 $CI->db = $CI->load->database('default', TRUE);
                 $CI->db2 = $CI->load->database('second_db', TRUE);
                 
         }
}
