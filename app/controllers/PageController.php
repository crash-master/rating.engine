<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model
};

class PageController extends \Extend\Controller{

	public function admin_page(){
		return View::make('admin/page-list', [
			'pagelist' => model('Page') -> get_page_list()
		]);
	}

	public function create_page(){
		return View::make('admin/page-edit');
	}

	public function update_page($pageid){
		return View::make('admin/page-edit', ['page' => model('Page') -> get_page(intval($pageid))]);
	}

	public function create(){
		$post = \Kernel\Request::post();
		model('Page') -> create($post);
		return redirect(linkTo('PageController@admin_page'));
	}

	public function update(){
		$post = \Kernel\Request::post();
		model('Page') -> update_page($post);
		return redirect(linkTo('PageController@admin_page'));
	}

	public function update_field($id, $colname, $val){
		$val = str_replace('**', '/', $val);
		if($colname == 'route'){
	        model('Page') -> update([$colname => urldecode($val)], ['id', '=', $id]);
	        model('Route_meta') -> update([$colname => urldecode($val)], ['page_id', '=', $id]);
	    }elseif($colname == 'title'){
	    	model('Route_meta') -> update([$colname => urldecode($val)], ['id', '=', $id]);
	    }

	    return true;
    }

	public function remove($pageid){
		model('Page') -> remove_page($pageid);
		return redirect('PageController@admin_page');
	}

	public function page_meta_component($profile = false){
		if($profile){
			$page_meta = [
				'title' => $profile['name'],
				'description' => strip_tags($profile['site_obj']['description']),
				'keywords' => $profile['name']
			];
		}else{
			$route = \Kernel\Request::getUrl();
			$route = '/'.$route;
			$page_meta = model('Route_meta') -> get_by_route($route);
		}
		return ['page_meta' => $page_meta];
	}

	public function text_page($pagename){
		if(!model('Page') -> isset_page('/page/'.$pagename)){
			return re_404();
		}

		$page = model('Page') -> get_page('/page/'.$pagename);

		return View::make(\Kernel\Config::get('rating-engine -> view-template') . '/pages/info-page.php', ['page' => $page]);
	}


}
