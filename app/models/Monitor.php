<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Monitor extends \Extend\Model{

	public $sets;

	public function __construct(){
		$this -> sets = new \Sets\MonitorSet;
	}

	public function __call($meth, $args){
		if(strpos($meth, 'monfix_') === false){
			return null;
		}

		$fix = str_replace('monfix', 'fix', $meth);
		$monitor = str_replace('monfix', 'monitor', $meth);

		return call_user_func_array([$this, $fix], [call_user_func_array([$this, $monitor], $args)]);
	}

	// monitor

	public function monitor(){

	}

	public function monitor_profile_without_site(){
		$profiles = model('Profile') -> get(['rows' => ['id', 'site']]);

		$report = [];
		foreach($profiles as $inx => $profile){
			if(!model('Site') -> length(['profileid', '=', $profile['id']])){
				$report[] = [
					'profileid' => $profile['id'],
					'site' => $profile['site']
				];
			}
		}

		return count($report) ? $report : false;
	}

	public function monitor_site(){
		$report = [];
		// without profile id
		$sites = atarr(model('Site') -> get(['rows' => ['id'], 'where' => ['profileid', '=', '0']]));
		if(count($sites))
			$report['without_profileid'] = $sites;
		// without domen_created
		$sites = atarr(model('Site') -> get(['rows' => ['id', 'profileid'], 'where' => ['domen_created', '=', '']]));
		if(count($sites))
			$report['without_domen_created'] = $sites;

		return count($report) ? $report : [];
	}

	public function monitor_recomended(){
		$recomended = model('Recomended') -> all();

		$report = [];
		foreach($recomended as $inx => $item){
			if(!model('Profile') -> length(['id', '=', $item['profileid']])){
				$report[] = [
					'recomended-item' => $item
				];
			}
		}

		return count($report) ? $report : false;
	}

	public function monitor_profile_rating(){
		$rows = [
			'count_like', 'count_dislike', 'count_neutral', 'count_reviews', 'rating', 'id'
		];
		$profiles = model('Profile') -> get(['rows' => $rows]);
		$report = [];
		foreach($profiles as $inx => $profile){
			$current = [
				'count_like' => $profile['count_like'],
				'count_dislike' => $profile['count_dislike'],
				'count_neutral' => $profile['count_neutral'],
				'count_reviews' => $profile['count_reviews'],
				'rating' => $profile['rating']
			];

			$real = [
				'count_like' => model('Review') -> length(['profileid', '=', $profile['id'], 'AND', 'rating', '=', '1']),
				'count_dislike' => model('Review') -> length(['profileid', '=', $profile['id'], 'AND', 'rating', '=', '-1']),
				'count_neutral' => model('Review') -> length(['profileid', '=', $profile['id'], 'AND', 'rating', '=', '0'])
			];
			$real['count_reviews'] = $real['count_like'] + $real['count_dislike'] + $real['count_neutral'];
			$real['rating'] = $real['count_like'] - $real['count_dislike'];

			foreach($current as $key_name => $item){
				if($item != $real[$key_name]){
					$report[] = [
						'profileid' => $profile['id'],
						'real' => $real,
						'current' => $current
					];
					break;
				}
			}
		}

		return count($report) ? $report : false;
	}

	public function monitor_site_stats(){
		// current data
		$count_profiles = model('Meta') -> getMeta('count_profiles');
		$count_reviews = model('Meta') -> getMeta('count_reviews');
		$count_comments = model('Meta') -> getMeta('count_comments');
		if($count_comments === false){
			$count_comments = 0;
			model('Meta') -> setMeta('count_comments', '0');
		}

		// get real data
		$count_profiles_real = model('Profile') -> length();
		$count_reviews_real = model('Review') -> length();
		$count_comments_real = model('Comment') -> length();

		$report = [];
		if($count_profiles != $count_profiles_real){
			$report[] = [
				'name' => 'count_profiles',
				'current' => $count_profiles,
				'real' => $count_profiles_real
			];
		}

		if($count_reviews != $count_reviews_real){
			$report[] = [
				'name' => 'count_reviews',
				'current' => $count_reviews,
				'real' => $count_reviews_real
			];
		}

		if($count_comments != $count_comments_real){
			$report[] = [
				'name' => 'count_comments',
				'current' => $count_comments,
				'real' => $count_comments_real
			];
		}

		return count($report) ? $report : false;
	}

	public function monitor_media_without_link(){
		$media_items = model('Media') -> get(['rows' => ['id']]);
		$report = [];
		foreach($media_items as $inx => $item){
			$id = $item['id'];
			if(!model('Site') -> length(['screen', '=', $id])){
				if(!model('Review') -> length(['image', '=', $id])){
					if(!model('Article') -> length(['thumbnail_media_id', '=', $id])){
						$report[] = [
							'mediaid' => $id
						];
					}
				}
			}
		}

		return count($report) ? $report : false;
	}

	// fix

	public function fix_profile_rating($monitor_profile_rating_report){
		if($monitor_profile_rating_report === false){
			return false;
		}

		foreach($monitor_profile_rating_report as $inx => $item){
			$profileid = $item['profileid'];
			model('Profile') -> update($item['real'], ['id', '=', $profileid]);
		}

		return $monitor_profile_rating_report;
	}

	public function fix_site_stats($monitor_site_stats_report){
		if($monitor_site_stats_report === false){
			return false;
		}

		foreach($monitor_site_stats_report as $inx => $item){
			model('Meta') -> updateMeta($item['name'], $item['real']);
		}

		return $monitor_site_stats_report;
	}

	public function fix_profile_without_site($monitor_profile_without_site){
		if($monitor_profile_without_site === false){
			return false;
		}

		foreach($monitor_profile_without_site as $inx => $item){
			model('Site') -> create($item['profileid']);
		}

		return $monitor_profile_without_site;
	}

	public function fix_media_without_link($monitor_media_without_link){
		if($monitor_media_without_link === false){
			return false;
		}

		foreach($monitor_media_without_link as $inx => $item){
			model('Media') -> remove(['id', '=', $item['mediaid']]);
		}

		return $monitor_media_without_link;
	}

	public function fix_recomended($monitor_recomended){
		if(!$monitor_recomended){
			return false;
		}

		foreach($monitor_recomended as $inx => $item){
			model('Recomended') -> remove(['id', '=', $item['recomended-item']['id']]);
		}

		return $monitor_recomended;
	}

	public function fix_site($monitor_site){
		if(!$monitor_site){
			return false;
		}

		if(isset($monitor_site['without_profileid'])){
			foreach($monitor_site['without_profileid'] as $inx => $item){
				model('Site') -> remove(['id', '=', $item['id']]);
			}
		}

		if(isset($monitor_site['without_domen_created'])){
			foreach($monitor_site['without_domen_created'] as $inx => $item){
				$profile = model('Profile') -> get(['id', '=', $item['profileid']]);
				model('Site') -> domen_created($profile);
			}
		}

		return $monitor_site;
	}

	public function fix_all(){
		$report = [];
		$report['monfix_profile_without_site'] = $this -> monfix_profile_without_site();
		$report['monfix_profile_rating'] = $this -> monfix_profile_rating();
		$report['monfix_site_stats'] = $this -> monfix_site_stats();
		$report['monfix_media_without_link'] = $this -> monfix_media_without_link();
		$report['monfix_recomended'] = $this -> monfix_recomended();
		$report['monfix_site'] = $this -> monfix_site();
		return $report;
	}
	

}
