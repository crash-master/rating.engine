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

    public function get_cat_by_slug($cat_slug){
        return $this -> get(['slug', '=', $cat_slug]);
    }

    public function get_article_by_cat_slug($cat_slug){
        $cat = $this -> get(['slug', '=', $cat_slug]);
        $article_ids = atarr(model('Article_cat') -> get_articles_by_cat_id($cat['id']));
        return $article_ids;
    }

    public function get_profile_ids_by_cat_slug($cat_slug){
        $cat = $this -> get_cat_by_slug($cat_slug);
        $rows = ['id'];
        $where = ['catid', '=', $cat['id']];
        $order = ['id', 'DESC'];
        $profile_ids = atarr(model('Profile') -> get(['rows' => $rows, 'where' => $where, 'order' => $order]));
        foreach($profile_ids as $i => $id){
            $profile_ids[] = $id['id'];
            unset($profile_ids[$i]);
        }
        return $profile_ids;
    }

    public function get_cat_by_article_id($article_id){
        $catid = model('Article_cat') -> get_cat_id_by_article_id($article_id);
        return $this -> get(['id', '=', $catid]);
    }

    public function update_article_cat($article_id, $cat_id){
        return model('Article_cat') -> update_article_cat($article_id, $cat_id);
    }

}
