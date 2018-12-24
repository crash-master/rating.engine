<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Article_cat extends \Extend\Model{

    public $sets;

    public function __construct(){
        $this -> sets = new \Sets\Article_catSet;
    }

    public function get_articles_by_cat_id($catid){
    	$where = ['cat_id', '=', $catid];
    	$rows = ['article_id'];
    	$articles = atarr($this -> get(['rows' => $rows, 'where' => $where]));
    	$ids = [];
    	foreach($articles as $i => $item){
    		$ids[] = $item['article_id'];
    	}

    	return $ids;
    }

    public function create_link_article_to_cat($article_id, $cat_id){
    	if(!$article_id or !$cat_id){
    		return false;
    	}
    	if($this -> length(['article_id', '=', $article_id, 'AND', 'cat_id', '=', $cat_id])){
    		return true;
    	}

    	$this -> set(['article_id' => $article_id, 'cat_id' => $cat_id]);
    	return true;
    }

    public function get_cat_id_by_article_id($article_id){
    	$cat = $this -> get(['article_id', '=', $article_id]);
    	return $cat['cat_id'];
    }

    public function update_article_cat($article_id, $cat_id){
    	if(!$article_id){
    		return false;
    	}

    	$exist = $this -> length(['article_id', '=', $article_id]);
    	if(!$exist){
    		$this -> create_link_article_to_cat($article_id, $cat_id);
    		return true;
    	}

    	if($cat_id == 0 and $exist){
			$this -> remove_article_cat_link($article_id);
			return true;
		}

    	$this -> update(['cat_id' => $cat_id], ['article_id', '=', $article_id]);

    	return true;
    }

    public function remove_article_cat_link($article_id){
    	return $this -> remove(['article_id', '=', $article_id]);
    }

}
