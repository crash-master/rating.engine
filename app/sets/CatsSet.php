<?php

/*  Automatically was generated from a template fw/templates/set.php */

namespace Sets;

class CatsSet extends \Extend\Set{

    public function tableName(){ 

        return 'Cats'; 

    }

    public function defaultRows(){
        
        return [
            
            'timestamp' => 'NOW()'
            
        ];
        
    }

}