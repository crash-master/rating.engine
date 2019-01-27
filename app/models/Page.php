<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Page extends \Extend\Model{

    public $sets;

    public function __construct(){
        $this -> sets = new \Sets\PageSet;
    }

    public function get_page_list(){
    	$pages = atarr($this -> all());
    	$count = count($pages);
    	for($i=0; $i<$count; $i++){
			$pages[$i] = array_merge($pages[$i], model('Route_meta') -> get_by_page_id($pages[$i]['id']));
    	}

    	return $pages;
    }

    public function get_page($pagename){
    	if(is_string($pagename)){
    		$page = $this -> get(['route', '=', $pagename]);
    	}else{
			$page = $this -> get(['id', '=', $pagename]);
    	}
    	$page = array_merge($page, model('Route_meta') -> get_by_page_id($page['id']));
    	return $page;
    }

    public function isset_page($route){
    	return $this -> length(['route', '=', $route]) ? true : false;
    }

    public function create($data){
    	if(strpos($data['route'], '/page/') === false and $data['is_text'] == 'on'){
    		$data['route'] = '/page/' . $data['route'];
    	}
    	$data['is_text'] = ($data['is_text'] == 'on') ? '1' : '0';
    	$data['content'] = tag_filer($data['content']);
    	$this -> set($data);
    	$last = $this -> last();
    	$data['page_id'] = $last['id'];
    	model('Route_meta') -> set($data);
    }

    public function update_page($data){
    	if(strpos($data['route'], '/page/') === false and $data['is_text'] == 'on'){
    		$data['route'] = '/page/' . $data['route'];
    	}
    	$data['is_text'] = ($data['is_text'] == 'on') ? '1' : '0';
    	$data['content'] = tag_filer($data['content']);
    	$this -> update($data, ['id', '=', $data['update-page']]);
    	model('Route_meta') -> update($data, ['page_id', '=', $data['update-page']]);
    }

    public function remove_page($pageid){
    	$this -> remove(['id', '=', $pageid]);
    	model('Route_meta') -> remove(['page_id', '=', $pageid]);
    }

    public function get_all_pages_for_map(){
        $pages_src = $this -> get_page_list();
        $pages = [];
        foreach($pages_src as $i => $page){
            list($lastmod) = explode(' ', $page['timestamp']);
            $pages[] = [
                'loc' => $page['route'],
                'lastmod' => $lastmod
            ];
        }

        return $pages;
    }

}
