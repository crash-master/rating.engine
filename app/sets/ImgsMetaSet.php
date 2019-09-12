<?php

/*  Automatically was generated from a template fw/templates/set.php */

namespace Sets;

class ImgsMetaSet extends \Extend\Set{

    public function tableName(){ 
        return 'ImgsMeta'; 
    }

    public function defaultRows(){
        return [
            'timestamp' => 'NOW()'
        ];
    }
}