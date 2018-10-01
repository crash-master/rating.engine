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
	if(strpos($date, '-') === false){
		$time = $date;
	}else{
		$time = strtotime($date);
	}
    return @date('d.m.y в h:i', $time);
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