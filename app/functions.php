<?php


function get_count_days_from_birth(){
	$date = model('Profile') -> first();
	$date = $date['timestamp'];
	list($date) = explode(' ', $date);
	$date = explode('-', $date);
	$mk = mktime(0, 0, 0, $date[1], $date[2], $date[0]);
	$mk_now = mktime();
	$days = floor(($mk_now - $mk) / 3600 / 24);
	return $days;
}

function is_admin(){
	$admin = \Kernel\Sess::get('admin');
	if($admin){
		return true;
	}
	return false;
}

function api_error($message){
	return json_encode(['status' => 'error', 'result' => ['error_message' => $message]]);
}

function api_success($result){
	return json_encode(['status' => 'success', 'result' => $result]);
}

function dateFormat($date){
	if(strpos($date, 'в')){
		return $date;
	}
	if(empty($date)){
		return false;
	}
	if(strpos($date, '-') === false){
		$time = $date;
	}else{
		$time = strtotime($date);
	}
    return date('d.m.y в h:i', intval($time));
}

function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', ' ');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', '_');
    return str_replace($rus, $lat, $str);
}

function url_without_prefix($url){
    $url = str_replace('http://', '', $url);
    $url = str_replace('https://', '', $url);
    $url = str_replace('www.', '', $url);
    list($url) = explode('/', $url);
    return $url;
}

function linkToLink($link){
	if(strstr($link, 'http') !== false){
		return $link;
	}else{
		return 'http://'.$link;
	}
}

function re_is_visible($admin_page_route){
	$admin_routes = \Kernel\Config::get('rating-engine -> admin-panel -> hidden_routes');

	foreach($admin_routes as $admin_route){
		if(strpos($admin_route, 'Controller@') !== false){
			$admin_route = linkTo($admin_route);
		}
		if($admin_page_route == $admin_route){
			return false;
		}
	}

	return true;
}

function tag_filer($text){
	return strip_tags($text, '<p><a><em><b><strong><h1><h2><h3><h4><h5><h6><ul><li><ol><img><del><sup><sub><hr><blockquote><font>');
}

function txtpage($slug){
	return linkTo('PageController@text_page', ['pagename' => $slug]);
}

function re_404(){
	$path = \Kernel\Config::get('rating-engine -> view-template') . '/pages/404.php';
	$pathForCheck = 'resources/view/' . $path;
	if(file_exists($pathForCheck)){
		return view($path, ['url' => \Kernel\Router::getUrl()]);
	}
	return view('default/404.php', ['url' => \Kernel\Router::getUrl()]);
}

function compile_css($css_file){
	$_compile = str_replace("\t", '', $css_file);
	$len = strlen($_compile);
	$f = false;
	$compile = '';
	$quot_open = false;
	for($i=0; $i<$len; $i++){
		if($_compile[$i] == '"' or $_compile[$i] == "'"){
			$quot_open = !$quot_open;
		}

		if($_compile[$i] == '{'){
			$f = true;
		}elseif($_compile[$i] == '}'){
			$f = false;
		}

		if($f and $_compile[$i] == ' ' and !$quot_open){
			continue;
		}
		$compile .= $_compile[$i];
	}
	$compile = preg_replace('!/\*.*?\*/!s', '', $compile);
	return $compile;
}


function _compress_css($string) {
	/* Strips Comments */
  $string = preg_replace('!/\*.*?\*/!s','', $string);
  $string = preg_replace('/\n\s*\n/',"\n", $string);

  /* Minifies */
  $string = preg_replace('/[\n\r \t]/',' ', $string);
  $string = preg_replace('/ +/',' ', $string);
  $string = preg_replace('/ ?([,:;{}]) ?/','$1',$string);

  /* Kill Trailing Semicolon, Contributed by Oliver */
  $string = preg_replace('/;}/','}',$string);

  /* Return Minified CSS */
  return $string;
}

function _css($path_to_css_dir = "", $files, $out = "./resources/css/master.min.css"){
	if(strpos($path_to_css_dir, './') !== 0){
		$path_to_css_dir = '.' . $path_to_css_dir;
	}
	if(strpos($out, './') !== 0){
		$out = '.' . $out;
	}
	$time_of_edit = filemtime($out);
	$compress_flag = false;

	foreach($files as $file){
		$path = $path_to_css_dir . $file;
		if(filemtime($path) > $time_of_edit){
			$compress_flag = true;
			break;
		}
	}

	if($compress_flag){
		$css = '';
		$_files = [];
		foreach($files as $file){
			$path = $path_to_css_dir . $file;
			$css_file = file_get_contents($path);
			$_files[] = $path;
			$css .= _compress_css($css_file);
		}
		file_put_contents($out, $css);
	}

	$out = str_replace('./', '/', $out);
	return '<link rel="stylesheet" href="' . $out . '" />';
}

function _js($path_to_css_dir = "", $files, $out = "./resources/js/master.min.js"){
	if(strpos($path_to_css_dir, './') !== 0){
		$path_to_css_dir = '.' . $path_to_css_dir;
	}
	if(strpos($out, './') !== 0){
		$out = '.' . $out;
	}

	$time_of_edit = filemtime($out);
	$compress_flag = false;

	foreach($files as $file){
		$path = $path_to_css_dir . $file;
		if(filemtime($path) > $time_of_edit){
			$compress_flag = true;
			break;
		}
	}

	if($compress_flag){
		$js = '';
		$_files = [];
		foreach($files as $file){
			$path = $path_to_css_dir . $file;
			$js_file = file_get_contents($path);
			$_files[] = $path;
			$js .= "\n" . $js_file;
		}
		file_put_contents($out, $js);
	}

	$out = str_replace('./', '/', $out);
	return '<script src="' . $out . '" ></script>';
}
