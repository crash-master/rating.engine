<?php

/*  Automatically was generated from a template fw/templates/set.php */

namespace Sets;

class TagSet extends \Extend\Set{

    public function tableName(){ 

        return 'Tag'; 

    }

    public function defaultRows(){
        
        return [
            
            'timestamp' => 'NOW()'
            
        ];
        
    }

}