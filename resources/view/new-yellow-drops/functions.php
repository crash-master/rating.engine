<?php
use Kernel\Components;

function nyd_get_profile_thumb($profile_id, $size = 'xs'){
	$site_obj = model('Site') -> get_site_obj_by_profile_id($profile_id);
	$screen = model('Media') -> get_media($site_obj['screen'], $size);
	$screen = model('Media') -> get_src($screen);
	return $screen ? $screen : '/resources/view/new-yellow-drops/assets/imgs/no-img.jpg';
}

function nyd_short_timestamp($timestamp){
	list($timestamp) = explode(" ", $timestamp);
	return $timestamp;
}

function nyd_excerpt_from_text($text, $max_count_words){
	$words = explode(' ', $text);
	$count = min(count($words), $max_count_words);
	$new_string = '';
	for($i=0; $i<$count; $i++){
		$new_string .= $words[$i];
		if($i != $count - 1){
			$new_string .= ' ';
		}
	}

	if($count == $max_count_words){
		$new_string .= '...';
	}

	return $new_string;
}

function nyd_articles_pag($current, $category){
	$count_articles = model('Article') -> count_published_articles($category['id']);
	$count_on_page = 10;	
	$total = ceil($count_articles / $count_on_page);
	$prev = $current > 1 ? $current - 1 : false;
	$next = $current < $total ? $current + 1 : false;
	return compact('current', 'total', 'prev', 'next');
}


function nyd_profiles_pag($current, $category){
	$count_articles = model('Profile') -> get_count_published_profiles($category['id']);
	$count_on_page = 10;	
	$total = ceil($count_articles / $count_on_page);
	$prev = $current > 1 ? linkTo('ProfileController@profile_list_by_category', ['cat_slug' => $category['slug'], 'page_num' => $current - 1]) : false;
	$next = $current < $total ? linkTo('ProfileController@profile_list_by_category', ['cat_slug' => $category['slug'], 'page_num' => $current + 1]) : false;
	$pages = [];
	if($current > 2 && $total > 3){
		$pages[] = '<a href="' . linkTo('ProfileController@profile_list_by_category', ['cat_slug' => $category['slug'], 'page_num' => 1]) . '" class="yd-btn simple-page-number">1</a>';
		$pages[] = '<span class="simple-pagination-space"></span>';
	}

	for($i=1; $i<=$total; $i++){
		if($i == $current){
			if($i-1 > 0){
				$pages[] = '<a href="' . linkTo('ProfileController@profile_list_by_category', ['cat_slug' => $category['slug'], 'page_num' => ($i - 1)]) . '" class="yd-btn simple-page-number">' . ($i - 1) . '</a>';
			}

			if($i-2 > 0 && $total == $current){
				$pages[] = '<a href="' . linkTo('ProfileController@profile_list_by_category', ['cat_slug' => $category['slug'], 'page_num' => ($i - 2)]) . '" class="yd-btn simple-page-number">' . ($i - 2) . '</a>';
			}

			$pages[] = '<span class="yd-btn simple-page-number active">' . $i . '</span>';

			if($i+1 < $total){
				$pages[] = '<a href="' . linkTo('ProfileController@profile_list_by_category', ['cat_slug' => $category['slug'], 'page_num' => ($i + 1)]) . '" class="yd-btn simple-page-number">' . ($i + 1) . '</a>';
			}

			if($i == 1 and $total > 3){
				$pages[] = '<a href="' . linkTo('ProfileController@profile_list_by_category', ['cat_slug' => $category['slug'], 'page_num' => ($i + 2)]) . '" class="yd-btn simple-page-number">' . ($i + 2) . '</a>';
			}
		}
	}

	if($current < $total){
		$pages[] = '<span class="simple-pagination-space"></span>';
		$pages[] = '<a href="' . linkTo('ProfileController@profile_list_by_category', ['cat_slug' => $category['slug'], 'page_num' => $total]) . '" class="yd-btn simple-page-number">' . $total . '</a>';;
	}

	$pages = implode('', $pages);
	return compact('current', 'total', 'prev', 'next', 'pages');
}


// NYD COMPONENTS

Components::create('Proved_profiles', ['new-yellow-drops/layouts/proved-profiles' => [
	'RecomendedController@get_recomended'
]]);

Components::create('NYDComments', ['new-yellow-drops/layouts/comments' => [
	'CommentController@comments'
]]);

Components::create('NYDTagCloud', ['new-yellow-drops/layouts/blocks/tags-cloud' => [
	'TagController@get_tag_list'
]]);

Components::create('Share', ['new-yellow-drops/layouts/share' => []]);


// ROUTES

