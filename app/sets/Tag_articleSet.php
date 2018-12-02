<?php

/*  Automatically was generated from a template fw/templates/set.php */

namespace Sets;

class Tag_articleSet extends \Extend\Set{

    public function tableName(){ 
        return 'Tag_article'; 
    }

    public function defaultRows(){
        return [
            'timestamp' => 'NOW()'
        ];
    }
}