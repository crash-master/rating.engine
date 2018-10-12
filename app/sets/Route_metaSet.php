<?php

/*  Automatically was generated from a template fw/templates/set.php */

namespace Sets;

class Route_metaSet extends \Extend\Set{

    public function tableName(){ 
        return 'Route_meta'; 
    }

    public function defaultRows(){
        return [
            'timestamp' => 'NOW()'
        ];
    }
}