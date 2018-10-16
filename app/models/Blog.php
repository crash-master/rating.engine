<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Blog{

    public function last($news_url, $count){
    	$request = 'wp-json/wp/v2/posts';
    	$data = json_decode(file_get_contents($news_url . $request), true);
    	$ret = [];
    	$i=0;
    	$k = 0;
    	foreach($data as $item){
    		if($i > $count - 1){
    			break;
    		}
    		$i++;
    		if($item['status'] == 'publish'){
    			$ret[$k] = $item;
    			$ret[$k]['date'] = dateFormat(str_replace('T', ' ', $ret[$k]['date']));

    			$k++;
    		}else{
    			$i--;
    		}
    	}
    	return $ret;
    }

    public function thumbnail($request_url){
        if(!$request_url){
            return false;
        }
		$data = json_decode(file_get_contents($request_url), true);
		// dd($data['media_details']);
        if($data['media_details']['sizes']['large']){
            $url = $data['media_details']['sizes']['large']['source_url'];
        }else{
            $url = $data['media_details']['sizes']['medium_large']['source_url'];
        }
		return $url;
    }

}
