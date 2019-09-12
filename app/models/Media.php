<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Media extends \Extend\Model{

	public $sets;
	public $lg_size;
	public $md_size;
	public $sm_size;
	public $xs_size;

	public function __construct(){
		$this -> sets = new \Sets\MediaSet;
		$this -> lg_size = 1200;
		$this -> md_size = 768;
		$this -> sm_size = 320;
		$this -> xs_size = 150;
	}

	public function get_media($id, $size){
		$size_list = ['lg', 'md', 'sm', 'xs'];
		$rows = [$size, 'timestamp', 'type', 'title', 'id'];
		$media = $this -> get(['rows' => $rows, 'where' => ['id', '=', $id]]);
		$media['size'] = $size;
		if(empty($media[$size])){
			$inx = array_search($size, $size_list);
			$count = count($size_list);
			while($inx > 0){
				$inx--;
				$size = $size_list[$inx];
				$rows[0] = $size;
				$media = $this -> get(['rows' => $rows, 'where' => ['id', '=', $id]]);
				if(!empty($media[$size])){
					$media['size'] = $size;
					return $media;
				}
			}
		}
		return $media;
	}

	public function get_src($media){
		return $media[$media['size']];
	}

	public function set_new_media($media, $title){
		$tmp_title = sha1(rand(100000, 9999999).$media);
		$media_tmp_name = 'tmp/media/' . '__' . $tmp_title;
		include_once('app/vendor/ImageResize.php');
		$image = new ImageResize($media);
		$image -> resizeToWidth($this -> lg_size);
		$image -> save($media_tmp_name);
		$b64 = $this -> gen_b64_meta($title) . base64_encode(file_get_contents($media_tmp_name));
		unlink($media_tmp_name);
		$this -> set(['lg' => $b64, 'type' => $this -> get_type($title), 'title' => $title ? $title : $tmp_title]);
		$last = $this -> last();
		return $last['id'];

	}

	public function continue_resizing($size, $size_txt, $prev_img, $mediaid){
		$path_to_img = $this -> b64_to_file($prev_img);
		include_once('app/vendor/ImageResize.php');
		$image = new ImageResize($path_to_img);
		$image -> resizeToWidth($size);
		$image -> save($path_to_img);
		$b64 = $this -> gen_b64_meta($path_to_img) . base64_encode(file_get_contents($path_to_img));
		unlink($path_to_img);
		$this -> update([$size_txt => $b64], ['id', '=', $mediaid]);
	}

	public function get_type($filename){
		$fname = explode('.', $filename);
		$fname = strtolower($fname[count($fname) - 1]);
		if($fname == 'jpg' || $fname == 'jpeg'){
			return 'image/jpeg';
		}

		return 'image/png';
	}

	public function gen_b64_meta($filename){
		return 'data:'.$this -> get_type($filename).';base64,';
	}

	public function b64_to_file($b64){
		list($meta, $b64) = explode('base64,', $b64);
		$format = strpos($meta, 'image/jpeg') !== false ? 'jpg' : 'png';
		$tmp_name = 'tmp/media/'.sha1(rand(10000, 9999999)).'.'.$format;
		file_put_contents($tmp_name, base64_decode($b64));
		return $tmp_name;
	}

	public function always_resize(){
		$where = [
			'xs', '=', '',
			'OR',
			'sm', '=', '',
			'OR',
			'md', '=', ''
		];
		$search = $this -> get(['where' => $where, 'limit' => [0, 1], 'order' => ['id', 'ASC']]);
		if(!isset($search['id'])){
			return false;
		}

		if(empty($search['md'])){
			$size = $this -> md_size;
			$size_txt = 'md';
			$prev_img = $search['lg'];
		}elseif(empty($search['sm'])){
			$size = $this -> sm_size;
			$size_txt = 'sm';
			$prev_img = $search['md'];
		}elseif(empty($search['xs'])){
			$size = $this -> xs_size;
			$size_txt = 'xs';
			$prev_img = $search['sm'];
		}else{
			return false;
		}

		$this -> continue_resizing($size, $size_txt, $prev_img, $search['id']);
	}

	public function get_media_list($size, $count_on_page, $page_num){
		$page_num--;
		$from = $count_on_page * $page_num; 
		$media = atarr($this -> get(['rows' => ['id', 'timestamp'], 'limit' => [$from, $count_on_page], 'order' => ['id', 'DESC']]));
		foreach ($media as $i => $item) {
			$media[$i]['src'] = linkTo('MediaController@get_binary_img', ['media_id' => $item['id'], 'size' => $size]);
			$media[$i]['alt'] = model('ImgsMeta') -> get_alt($item['id']);
		}
		return $media;
	}

	public function get_pagination($count_on_page, $current){
		$total = $this -> length();
		$count_pages = ceil($total / $count_on_page);
		$items = [
			0 => [
				'prev' => $current == 1 ? false : linkTo('MediaController@admin_page', ['page_num' => $current - 1]),
				'next' => $current == $count_pages ? false : linkTo('MediaController@admin_page', ['page_num' => $current + 1])
			],
			1 => []
		];
		for($i=1; $i<=$count_pages; $i++){
			$items[1][] = [
				'num' => $i,
				'link' => linkTo('MediaController@admin_page', ['page_num' => $i]),
				'current' => $current == $i ? true : false
			];
		}

		return $items;
	}

	public function remove_media($media_id){
		return $this -> remove(['id', '=', $media_id]);
	}

	public function get_binary($media_id, $size = 'md'){
		$media = $this -> get_src($this -> get_media($media_id, $size));
		list($meta, $b64) = explode('base64,', $media);
		$format = strpos($meta, 'image/jpeg') !== false ? 'jpg' : 'png';
		return ['bin' => base64_decode($b64), 'format' => $format];
	}

	public function get_all_media_list(){
		$media = atarr($this -> get(['rows' => ['id'], 'order' => ['id', 'DESC']]));
		foreach($media as $i => $item){
			$media[$i]['alt'] = model('ImgsMeta') -> get_alt($item['id']);
		}
		return $media;
	}

	public function transform_binary_links($media_list, $size = 'sm'){
		foreach($media_list as $i => $item){
			$media_list[$i]['bin_link'] = linkTo('MediaController@get_binary_img', ['media_id' => $item['id'], 'size' => $size]);
		}
		return $media_list;
	}

}
