<?php

/*  Automatically was generated from a template fw/templates/set.php */

namespace Sets;

class SiteSet extends \Extend\Set{

    public function tableName(){ 

        return 'Site'; 

    }

    public function defaultRows(){
        
        return [
            
            'last_data_update' => 'NOW()'
            
        ];
        
    }

}