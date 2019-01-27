<?php

class Content_block{
	private $section_name = 'content_block';
	private $block_list = [];

	public function register_block($title, $alias, $default_content = '', $about_block = ''){
		$option_name = $this -> section_name . '_' . $alias;
		if(!count(model('Option') -> get_by_name($option_name))){
			$block = [
				'title' => $title,
				'alias' => $alias,
				'content' => $default_content,
				'about_block' => $about_block
			];

			$this -> block_list[] = $block;
			$this -> dump_block($block);
			return true;
		}

		$option = model('Option') -> get_by_name($option_name);
		$block_content = json_decode($option['value'], true);
		list(, $alias) = explode($this -> section_name . '_', $option['name']);
		$block = [
				'title' => $block_content['title'],
				'alias' => $alias,
				'content' => $block_content['content'],
				'about_block' => $about_block
			];

		$this -> block_list[] = $block;
		return true;
	}

	public function get_blocks(){
		return $this -> block_list;
	}

	private function search_block_by_alias($alias){
		foreach($this -> block_list as $i => $block){
			if($alias == $block['alias']){
				return ['inx' => $i, 'block' => $block];
			}
		}

		return false;
	}

	public function get_block_by_alias($alias){
		$block_item = $this -> search_block_by_alias($alias);
		if(!$block_item){
			return false;
		}

		return $block_item['block'];
	}

	public function update_block_content($alias, $content){
		$block_item = $this -> search_block_by_alias($alias);
		$block_inx = $block_item['inx'];

		$this -> block_list[$block_inx]['content'] = $content;
		$this -> dump_block_changes($block_inx);

		return true;
	}

	public function dump_block_changes($block_inx){
		return $this -> dump_block($this -> block_list[$block_inx]);
	}

	public function dump_block($block){
		$content = [
			'title' => $block['title'],
			'content' => $block['content']
		];
		$option_name = $this -> section_name . '_' . $block['alias'];
		$content_json = json_encode($content);
		return model('Option') -> set_option($option_name, $content_json, $this -> section_name, $block['about_block']);
	}
}