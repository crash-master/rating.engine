<?php

/*  Automatically was generated from a template fw/templates/set.php */

namespace Sets;

class MonitorSet extends \Extend\Set{

    public function tableName(){ 
        return 'Monitor'; 
    }

    public function defaultRows(){
        return [
            'timestamp' => 'NOW()'
        ];
    }
}