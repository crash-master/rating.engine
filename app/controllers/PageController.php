<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model
};

class PageController extends \Extend\Controller{
    
    public function admin_page(){
        return View::make('admin/pages.php', [
        	'pagelist' => model('Meta') -> getTextPageList()
        ]);
    }

    public function text_page($pagename){
    	return View::make(\Kernel\Config::get('rating-engine -> view-template') . '/pages/info-page.php', ['page' => model('Meta') -> getTextPage($pagename)]);
    }

    public function main_pages_admin(){
        return View::make('admin/main-pages.php', model('Meta') -> get_main_pages());
    }

    public function main_page_edit($pagename){
        $pages = model('Meta') -> get_main_pages($pagename);
        return View::make('admin/main-pages.php', [
            'pagename' => $pagename, 
            'page' => $pages['mainpages'][$pagename],
            'pageedit' => true,
            'mainPageList' => $pages['mainPageList']
        ]);
    }

    public function main_page_save($pagename){
        $data = \Kernel\Request::post();
        $pages = model('Meta') -> get_main_pages($pagename);
        $pages = $pages['mainpages'];
        $pages[$pagename]['title'] = $data['title'];
        $pages[$pagename]['keywords'] = $data['keywords'];
        model('Meta') -> updateMeta('main-pages', json_encode($pages));

        return redirect(linkTo('PageController@main_page_edit', ['pagename' => $pagename]));
    }

    public function text_page_meta(){
    	$data = \Kernel\Request::getArgs();
        $meta = model('Meta') -> getTextPage($data['pagename']);    
        if(!$meta){
            $m = model('Meta') -> get_main_pages();
            $url = \Kernel\Request::getUrl();
            if($url == '/'){
                $data['pagename'] = 'home';
            }elseif($url == '/page/rating' || $url == '/page/rating/'){
                $data['pagename'] = 'rating';
            }
            if(array_search($data['pagename'], $m['mainPageList']) !== false){
                $meta['title'] = $m['mainpages'][$data['pagename']]['title'];
                $meta['keywords'] = $m['mainpages'][$data['pagename']]['keywords'];
            }
        }
    	return ['meta_page' => $meta];
    }

    public function admin_page_edit($pagename){
    	return View::make('admin/pages.php', [
        	'pagelist' => model('Meta') -> getTextPageList(),
        	'pageedit' => true,
        	'page' => model('Meta') -> getTextPage($pagename),
        	'pagename' => $pagename
        ]);
    }

    public function save_page($pagename){
    	$data = \Kernel\Request::post();
    	$keywords = json_decode(model('Meta') -> getMeta('keywords'), true);
    	$keywords[$pagename] = $data['keywords'];
    	model('Meta') -> updateMeta('keywords', json_encode($keywords));
    	$title = json_decode(model('Meta') -> getMeta('title'), true);
    	$title[$pagename] = $data['title'];
    	model('Meta') -> updateMeta('title', json_encode($title));

    	model('Meta') -> updateMeta($pagename, $data['content']);

    	return redirect(linkTo('PageController@admin_page_edit', ['pagename' => $pagename]));
    }

    
    // Other methods
    
    
}