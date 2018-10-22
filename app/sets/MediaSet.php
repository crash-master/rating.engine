<?php

/*  Automatically was generated from a template fw/templates/set.php */

namespace Sets;

class MediaSet extends \Extend\Set{

    public function tableName(){ 
        return 'Media'; 
    }

    public function defaultRows(){
        return [
            'timestamp' => 'NOW()'
        ];
    }
}