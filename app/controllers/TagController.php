<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model
};

class TagController extends \Extend\Controller{

	public function admin_page(){
		return View::make('admin/tag', ['tag_list' => model('Tag') -> get_tag_list()]);
	}

	public function page($slug){
		$tag = model('Tag') -> get(['where' => ['slug', '=', $slug]]);
		return View::make(\Kernel\Config::get('rating-engine -> view-template') . '/pages/tag-page.php', ['tag' => $tag]);
	}

	public function rating_by_tag($tagid, $limit){
		$profileids = model('Tag_profile') -> get_id_profiles_by_tag($tagid, $limit);
		$profileids_str = "('" . implode ( "','", $profileids ) . "')";
		$data = arrayToArray(model('Profile') -> get(['where' => ['public_flag','=','1', 'AND', 'id', 'IN', $profileids_str], 'order' => ['rating','DESC']]));
        $count = count($data);
        for($i=0; $i<$count; $i++){
						$data[$i] = model('Profile') -> fields_transform($data[$i], ['timestamp', 'number_txt', 'site_link', 'site', 'to_profile', 'site_obj', 'cat']);
        }

        return View::json(['rating' => $data, 'len' => model('Meta') -> getMeta('count_profiles') - 1]);
	}

	public function exist($slug){
		if(model('Tag') -> get(['where' => ['slug', '=', $slug]])){
			return json_encode(['exist' => true]);
		}
		return json_encode(['exist' => false]);
	}

	public function create(){
		$data = \Kernel\Request::post();
		model('Tag') -> set($data);
		return redirect(linkTo('TagController@admin_page'));
	}

	public function remove($tagid){
		model('Tag') -> remove(['id', '=', $tagid]);
		return redirect(linkTo('TagController@admin_page'));
	}

	public function update($id, $colname, $val){
    	return model('Tag') -> update([$colname => urldecode($val)], ['id', '=', $id]);
    }

	public function get_tag_list(){
		$tags = model('Tag') -> get_tag_list();
		return ['tags' => $tags];
	}

	public function remove_profile_tag_link($profileid, $tagid){
		return model('Tag_profile') -> remove(['profileid', '=', $profileid, 'AND', 'tagid', '=', $tagid]);
	}

	public function create_profile_tag_link($profileid, $tagid){
		return model('Tag_profile') -> set(['profileid' => $profileid, 'tagid' => $tagid]);
	}


}
