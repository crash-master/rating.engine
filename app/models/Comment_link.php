<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Comment_link extends \Extend\Model{

	public $sets;

	public function __construct(){
		$this -> sets = new \Sets\Comment_linkSet;
	}

	/**
	 * [create_link description]
	 *
	 * @param  [int or object] $srcid [comment]
	 * @param  [string] $link [example 'review_24' or 'profile_123']
	 *
	 * @return [bool] [success flag]
	 */
	public function create_link($srcid, $link){
		$data = [
			'srcid' => is_array($srcid) ? $srcid['id'] : $srcid,
			'link' => $link
		];
		return $this -> set($data);
	}

	public function remove_by_link($link){
		return $this -> remove(['link', '=', $link]);
	}

	public function remove_by_srcid($srcid){
		$link = 'comment_'.$srcid;
		$linked_comments = $this -> get_comments_by_link($link);
		$linked_comments = array_merge($linked_comments, $this -> get_comments_by_link($link, '0'));
		$this -> remove(['srcid', '=', $srcid]);
		return $linked_comments;
	}

	public function get_comments_by_link($link, $public_flag = '1', $order = "DESC"){
		$links = atarr($this -> get(['link', '=', $link]));
		$src = [];
		foreach($links as $link){
			$src[] = $link['srcid'];
		}
		$links_query_str = "('" . implode ( "','", $src ) . "')";
		$where = ['public_flag', '=', $public_flag, 'AND', 'id', 'IN', $links_query_str];
		$comments = atarr(model('Comment') -> get(['where' => $where, 'order' => ['timestamp', $order]]));
		foreach ($comments as $i => $comment) {
			$link = array_filter($links, function($item) use ($comment){
				return $item['srcid'] == $comment['id'];
			});
			list($inx) = array_keys($link);
			$comments[$i]['link'] = $link[$inx];
		}
		return $comments;
	}

	public function get_count_comment_links_by_link($link){
		return $this -> length(['link', '=', $link]);
	}

	public function get_count_comments_tree_by_link($link){
		$links = atarr($this -> get(['link', '=', $link]));
		$child_links = [];
		foreach($links as $link){
			$child_links[] = 'comment_' . $link['srcid'];
		}
		$links_query_str = "('" . implode ( "','", $child_links ) . "')";
		$count = count($links) + model('Comment_link') -> length(['link', 'IN', $links_query_str]);
		return $count;
	}

	public function get_last_links_by_link_type($link_type, $limit){
		return atarr(model('Comment_link') -> get(['where' => ['link', 'LIKE', '%'.$link_type.'%'], 'order' => ['id', 'DESC'], 'limit' => [0, $limit]]));
	}

}
