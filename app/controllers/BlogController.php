<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model
};

class BlogController extends \Extend\Controller{

    public function last_news(){
        $blog_url = \Kernel\Config::get('rating-engine -> blog -> url');
    	$count_articles = \Kernel\Config::get('rating-engine -> blog -> count_articles');
    	$news = model('Blog') -> last($blog_url, $count_articles);
    	return ['news' => $news];
    }
    
}