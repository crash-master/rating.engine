<?php

/*  Automatically was generated from a template fw/templates/set.php */

namespace Sets;

class RecomendedSet extends \Extend\Set{

    public function tableName(){ 
        return 'Recomended'; 
    }

    public function defaultRows(){
        return [
            'timestamp' => 'NOW()'
        ];
    }
}