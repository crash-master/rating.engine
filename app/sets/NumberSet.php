<?php

/*  Automatically was generated from a template fw/templates/set.php */

namespace Sets;

class NumberSet extends \Extend\Set{

    public function tableName(){ 

        return 'Number'; 

    }

    public function defaultRows(){
        
        return [
            
            'timestamp' => 'NOW()'
            
        ];
        
    }

}