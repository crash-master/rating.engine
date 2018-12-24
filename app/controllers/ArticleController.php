<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model,
	Request
};

class ArticleController extends \Extend\Controller{
	// admin pages
	public function admin_article_list_page(){
		return view('admin/articles/article_list', [
			'article_list' => model('Article') -> get_all()
		]);
	}

	public function admin_update_page($article_id){
		return view('admin/articles/article-create-update', [
			'update_flag' => true,
			'article' => model('Article') -> get_article_by_id($article_id),
			'tag_list' => model('Tag') -> get_tag_list(),
			'categories' => model('Cats') -> full_list()
		]);
	}

	public function admin_create_page(){
		return view('admin/articles/article-create-update', [
			'update_flag' => false,
			'categories' => model('Cats') -> full_list()
		]);
	}

	// manipulations
	public function create(){
		$data = Request::post();
		$file = false;
		if(isset($_FILES['thumbnail']) and $thumbnail = $_FILES['thumbnail']['tmp_name']){
			$file = $_FILES['thumbnail'];
		}
		model('Article') -> create($data, $file);
		return redirect('ArticleController@admin_article_list_page');
	}

	public function update(){
		$data = Request::post();
		$article_id = $data['article-update'];
		$file = false;
		if(isset($_FILES['thumbnail']) and $thumbnail = $_FILES['thumbnail']['tmp_name']){
			$file = $_FILES['thumbnail'];
		}
		model('Article') -> update_article($data, $article_id, $file);
		return redirect('ArticleController@admin_article_list_page');
	}

	public function article_list($page_num = 1){
		$count_on_page = 10;	
		$page_num --;
		$articles = model('Article') -> get_article_list($count_on_page, $page_num);
		$page_num++;
		return view(\Kernel\Config::get('rating-engine -> view-template') . '/pages/article-list', compact('articles', 'page_num'));
	}

	public function article_list_by_category($cat_slug, $page_num = 1){
		$count_on_page = 10;	
		$page_num --;
		$articles = model('Article') -> get_article_list_by_cat_slug($cat_slug, $count_on_page, $page_num);
		$category = model('Cats') -> get_cat_by_slug($cat_slug);
		$page_num++;
		return view(\Kernel\Config::get('rating-engine -> view-template') . '/pages/articles', compact('articles', 'category', 'page_num'));
	}

	public function pagination($current_page){
		$count_articles = model('Article') -> count_published_articles();
		$count_on_page = 10;	
		$count_page = ceil($count_articles / $count_on_page);
		$pagination = [];
		for($i=0; $i<$count_page; $i++){
			$pagination[] = [
				'number' => $i + 1,
				'href' => linkTo('ArticleController@article_list', ['page_num' => $i + 1])
			];
		}
		return compact('pagination');
	}

	public function single_article($slug){
		$route = '/article/' . $slug;
		$article = model('Article') -> get_article_by_slug($route);
		if(!$article['published']){
			return re_404();
		}
		return view(\Kernel\Config::get('rating-engine -> view-template') . '/pages/single-article', compact('article'));
	}

	public function remove($article_id){
		model('Article') -> remove_article($article_id);
		return redirect('ArticleController@admin_article_list_page');
	}

	public function article_list_by_tag_slug($tag_slug, $page_num = 1){
		$count_on_page = 10;
		$page_num --;
		$articles = model('Article') -> get_article_list_by_tag_slug($tag_slug, $count_on_page, $page_num);
		$tag = model('Tag') -> get_tag_by_slug($tag_slug);
		$page_num++;
		return view(\Kernel\Config::get('rating-engine -> view-template') . '/pages/articles', compact('articles', 'tag', 'page_num'));
	}
}