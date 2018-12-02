<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Tag_article extends \Extend\Model{

    public $sets;

    public function __construct(){
        $this -> sets = new \Sets\Tag_articleSet;
    }

    public function get_tags_by_article_id($article_id){
    	$where = ['article_id', '=', $article_id];
    	$tags_links = atarr($this -> get(['rows' => ['tag_id'], 'where' => $where]));
    	$tags_ids = [];
    	foreach($tags_links as $i => $item){
    		$tags_ids[] = $item['tag_id'];
    	}

    	return $tags_ids;
    }

    public function add_tag_to_article($article_id, $tag_id){
    	return $this -> set(['article_id' => $article_id, 'tag_id' => $tag_id]);
    }

    public function remove_tag_from_article($article_id, $tag_id){
    	return $this-> remove(['article_id', '=', $article_id, 'AND', 'tag_id', '=', $tag_id]);
    }

    public function get_articles_by_tag_id($tag_id){
    	$where = ['tag_id', '=', $tag_id];
    	return atarr($this -> get(['rows' => ['article_id'], 'where' => $where]));
    }


}
