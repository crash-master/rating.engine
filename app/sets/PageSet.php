<?php

/*  Automatically was generated from a template fw/templates/set.php */

namespace Sets;

class PageSet extends \Extend\Set{

    public function tableName(){ 
        return 'Page'; 
    }

    public function defaultRows(){
        return [
            'timestamp' => 'NOW()'
        ];
    }
}