<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model
};

class YDController extends \Extend\Controller{
	
	public function site_present($mini = false){
		$sitename = model('Meta') -> getMeta('sitename');
		$sub_sitename = model('Meta') -> getMeta('sub_sitename');
		return ['mini' => $mini, 'sitename' => $sitename, 'sub_sitename' => $sub_sitename];
	}

	public function profile_list(){
		$profiles = model('Profile') -> get_rating_list('id');
		$count = count($profiles);
		for($i=0; $i<$count; $i++){
			list($profiles[$i]['timestamp']) = explode(' ', $profiles[$i]['timestamp']);
		}
		return view('yellow-drops/pages/profile-list', ['profiles' => $profiles]);
	}

	public function transport(){
		function get_site($content){
			preg_match_all('/(http|ftp|https):\/\/([\w_-]+(?:(?:\.[\w_-]+)+))([\w.,@?^=%&:\/~+#-]*[\w@?^=%&\/~+#-])?/', $content, $matches);
			return $matches[0][0];
		}

		function get_email($content){
			preg_match_all('/[^@\s]++@\S++/', $content, $matches);
			$email = str_replace("—", '', str_replace(" ", '', html_entity_decode(strip_tags($matches[0][0]))));
			if(strpos($email, '>')){
				list(,$email) = explode('">', $email);
			}
			if(strpos($email, "&nbsp;")){
				list(,$email) = explode("&nbsp;", $email);
			}
			return strtolower(trim($email));
		}

		function get_description($content, $excerpt){
			$description = $excerpt.'::::'.$content;
			return $description;
		}

		// function get_description($content, $excerpt){
		// 	list($excerpt) = explode(' [', $excerpt);
		// 	list(, $description) = explode($content, $excerpt);
		// 	list($description) = explode('</p>', $description);
		// 	$description = strip_tags($excerpt.$description);

		// 	list($description, $services) = explode('слуги:', $description);
		// 	$description = explode('.', $description);
		// 	unset($description[count($description) - 1]);
		// 	$description = implode('.', $description);
		// 	list(,$description) = explode(':', $description);
		// 	return $description.'.';
		// }

		function get_comments($post_id){
			$comments_url = 'http://extrasensi.org/wp-json/wp/v2/comments?post=';
			$comments_json = file_get_contents($comments_url.$post_id);
			$comments = json_decode($comments_json, true);
			$COMMENTS = [];
			foreach($comments as $comment){
				$COMMENTS[] = [
					'name' => $comment['author_name'],
					'message' => strip_tags($comment['content']['rendered']),
					'timestamp' => str_replace('T', ' ', $comment['date_gmt']),
					'public_flag' => '1'
				];
			}
			return $COMMENTS;
		}

		$posts_url = 'http://extrasensi.org/wp-json/wp/v2/posts?page=';
		$POSTS = [];
		$all_comments = [];
		$flag = true;
		$page = 1;
		do{
			$posts_json = file_get_contents($posts_url.$page);
			$posts = json_decode($posts_json, true);
			if(isset($posts['code'])){
				$flag = false;
			}else{
				foreach($posts as $post){
					$post_main = [
						'post_id' => $post['id'],
						'timestamp' => str_replace('T', ' ', $post['date_gmt']),
						'name' => $post['title']['rendered'],
						'site' => get_site($post['content']['rendered']),
						'description' => get_description($post['content']['rendered'], $post['excerpt']['rendered']),
						'contacts' => ['email' => get_email($post['content']['rendered'])],
						'comments' => get_comments($post['id']),
						'catid' => '1',
						'public_flag' => '1',
						'slug' => translit($post['title']['rendered'])
					];
					$POSTS[] = $post_main;
					// add to db in profile table
					model('Profile') -> set($post_main);
					$profile = model('Profile') -> last();
					model('Site') -> set(['profileid' => $profile['id'], 'description' => $post_main['description'], 'count_visits' => '0']);
					foreach($post_main['comments'] as $comment){
						$link = 'profile_'.$profile['id'];
						$comment['link'] = $link;
						$all_comments[] = $comment;
						// model('Comment') -> create($comment, $link);
					}
				}
			}
			$page++;
		}while(count($posts));

		$rand_arr = [];
		$count = count($all_comments);
		for($i=0; $i<$count; $i++){
			$flag = false;
			$r = rand(0, $count-1);
			for($j=0; $j<count($rand_arr); $j++){
				if($rand_arr[$j] == $r){
					$flag = true;
				}
			}
			if($flag){
				$i--;
				continue;	
			} 
			model('Comment') -> create($all_comments[$r], $all_comments[$r]['link']);
			$rand_arr[] = $r;
		}
		dd($all_comments);
	}
}