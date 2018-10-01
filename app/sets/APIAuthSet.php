<?php

/*  Automatically was generated from a template fw/templates/set.php */

namespace Sets;

class APIAuthSet extends \Extend\Set{

    public function tableName(){ 

        return 'APIAuth'; 

    }

    public function defaultRows(){
        
        return [
            
            'timestamp' => 'NOW()'
            
        ];
        
    }

}