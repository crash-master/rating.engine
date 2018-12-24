<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Tag extends \Extend\Model{

    public $sets;

    public function __construct(){
        $this -> sets = new \Sets\TagSet;
    }

    public function get_tag_list(){
    	$tags = $this -> all();
    	$tags = arrayToArray($tags);
    	if(!$tags[0]){
    		$tags = [];
    	}

        foreach($tags as $i => $tag){
            $tags[$i]['link'] = linkTo('ArticleController@article_list_by_tag_slug', ['tag_slug' => $tag['slug'], 'page_num' => 1]);
        }
    	return $tags;
    }

    public function get_by_profile($profile){
        $profileid = isset($profile['id']) ? $profile['id'] : $profile;
    	$links = model('Tag_profile') -> get(['where' => ['profileid', '=', $profileid]]);
    	$links = arrayToArray($links);

    	$tags = [];
    	foreach($links as $link){
    		$tag = $this -> get(['where' => ['id', '=', $link['tagid']]]);
    		if($tag['id']){
    			$tags[] = $tag;
    		}
    	}

    	return $tags;
    }

    public function get_by_article_id($article_id){
        $tag_links = model('Tag_article') -> get_tags_by_article_id($article_id);
        $query = "('" . implode ( "','", $tag_links ) . "')";
        $tags = atarr($this -> get(['id', 'IN', $query]));
        foreach($tags as $i => $tag){
            $tags[$i]['link'] = linkTo('ArticleController@article_list_by_tag_slug', ['tag_slug' => $tag['slug'], 'page_num' => 1]);
        }
        return $tags;
    }

    public function get_tag_by_slug($slug){
        return $this -> get(['slug', '=', $slug]);
    }

    public function get_articles_by_tag_slug($slug){
        $tag = $this -> get_tag_by_slug($slug);
        $articles_ids = model('Tag_article') -> get_articles_by_tag_id($tag['id']);
        foreach($articles_ids as $i => $article){
            $articles_ids[] = $article['article_id'];
            unset($articles_ids[$i]);
        }

        return $articles_ids;
    }

    public function get_profiles_by_tag_slug($slug){

    }

}
