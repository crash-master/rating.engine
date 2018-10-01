<?php

/*  Automatically was generated from a template fw/templates/set.php */

namespace Sets;

class CommentSet extends \Extend\Set{

    public function tableName(){ 

        return 'Comment'; 

    }

    public function defaultRows(){
        
        return [
            
            'timestamp' => 'NOW()'
            
        ];
        
    }

}