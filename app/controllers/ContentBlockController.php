<?

use Kernel\Request;

class ContentBlockController{
	public function admin_page(){
		return view('admin/content-blocks', ['blocks' => model('Content_block') -> get_blocks()]);
	}

	public function json_block($block_alias){
		return json_encode(model('Content_block') -> get_block_by_alias($block_alias));
	}

	public function update(){
		$block_alias = Request::post('block-alias');
		$block_content = Request::post('content');
		model('Content_block') -> update_block_content($block_alias, $block_content);
		return redirect(linkTo('ContentBlockController@admin_page'));
	}
}
