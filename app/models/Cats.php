<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Cats extends \Extend\Model{

    public $sets;

    public function __construct(){

        $this -> sets = new \Sets\CatsSet;

    }

    public function full_list(){
    	return atarr($this -> all());
    }

    public function get_cat_by_id($catid){
    	return $this -> get(['id', '=', $catid]);
    }

}
