<?php

class Sitemap{

	private $priority = [
		'profiles' => '1',
		'articles' => '.8',
		'pages' => '.6'
	];

	private $changefreq = 'weekly';

	public function generate(){
		$map_xml = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
		$map_xml .= $this -> arr_to_urls($this -> get_profiles_list());
		$map_xml .= $this -> arr_to_urls($this -> get_articles_list());
		$map_xml .= $this -> arr_to_urls($this -> get_pages_list());
		$map_xml .= '</urlset>';
		file_put_contents('sitemap.xml', $map_xml);
		return $map_xml;
	}

	private function arr_to_urls($data){
		$urls_xml = '';
		foreach($data as $url_item){
			$urls_xml .= $this -> url_item($url_item);
		}

		return $urls_xml;
	}

	private function url_item($data){
		$url_xml = "\t<url>\n";
		foreach($data as $prop_name => $prop_val){
			$url_xml .= "\t\t<{$prop_name}>{$prop_val}</{$prop_name}>\n";
		}
		$url_xml .= "\t</url>\n";

		return $url_xml;
	}

	private function get_profiles_list(){
		$profiles = model('Profile') -> get_all_profiles_for_map();
		foreach($profiles as $i => $profile){
			$profiles[$i]['priority'] = $this -> priority['profiles'];
			$profiles[$i]['changefreq'] = $this -> changefreq;
		}

		return $profiles;
	}

	private function get_articles_list(){
		$articles = model('Article') -> get_all_articles_for_map();
		foreach($articles as $i => $article){
			$articles[$i]['priority'] = $this -> priority['articles'];
			$articles[$i]['changefreq'] = $this -> changefreq;
		}

		return $articles;
	}

	private function get_pages_list(){
		$pages = model('Page') -> get_all_pages_for_map();
		foreach($pages as $i => $page){
			$pages[$i]['priority'] = $this -> priority['pages'];
			$pages[$i]['changefreq'] = $this -> changefreq;
		}

		return $pages;
	}
}