<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Profile extends \Extend\Model{

    public $sets;

    public function __construct(){
        $this -> sets = new \Sets\ProfileSet;
    }

    public function create($data){
        $data['timestamp'] = 'NOW()';
        $this -> set($data);
        $slug = translit($data['name']);
        $profile = $this -> get(['where' => ['site', '=', $data['site']]]);
        $profile_search = $this -> get(['where' => ['slug', '=', $slug]]);
        if($profile_search['id']){
            $slug .= '_'.$profile['id'];
        }
        $this -> update(['slug' => strtolower($slug)], ['id', '=', $profile['id']]);

        $site_link = linkToLink($profile['site']);
        $site = $this -> getMetaDataFromSite($site_link);
        $site['profileid'] = $profile['id'];
        model('Site') -> set($site);
        model('Site') -> domen_created($mag); // domen_created

        return $profile;
    }

    public function search_request($request){
        $profiles = arrayToArray(model('Profile') -> get(['where' => ['name', 'LIKE', '%'.$request.'%', 'OR', 'site', 'LIKE', '%'.$request.'%'], 'limit' => [0, 5]]));
        if(!$profiles[0]){
            $profiles = [];
        }
        $count = count($profiles);
        $profiles_public = [];
        $n = 0;
        for($i=0; $i<$count; $i++){
            if($profiles[$i]['public_flag'] == '0'){
                return false;
            }
            $profiles_public[$i] = $this -> profile_fields_transform($profiles[$i], ['to_profile', 'site', 'timestamp']);
            $profiles_public[$i]['number'] = ($n < 9) ? '0' . ($n + 1) : $n + 1;
            $n++;
        }

        return $profiles_public;
    }

    public function get_last_profiles($count_profiles){
        $profiles = arrayToArray($this -> get(['where' => ['public_flag','=','1'], 'order' => ['id','DESC'], 'limit' => [0, $count_profiles]]));
        if(!$profiles[0]){
            $profiles = [];
        }
        for($i=0; $i<$count_profiles; $i++) {
            $profiles[$i] = $this -> profile_fields_transform($profiles[$i], ['site', 'timestamp', 'site_link']);
        }

        return $profiles;
    }

    public function profile_fields_transform($profile, $fields){
        foreach($fields as $field){
            switch($field){
                case 'site_link': $profile['site_link'] = linkTo('SiteController@incrementSiteVisit', ['profileid' => $profile['id']]); break;
                case 'timestamp': $profile['timestamp'] = dateFormat($profile['timestamp']); break;
                case 'site_obj': $profile['site_obj'] = model('Site') -> get(['where' => ['profileid', '=', $profile['id']]]); break;
                case 'cat': $profile['cat'] = model('Cats') -> get(['where' => ['id', '=', $profile['catid']]]); break;
                case 'site': $profile['site'] = url_without_prefix($profile['site']); break;
                case 'to_profile': $profile['to_profile'] = model('Meta') -> getMeta('siteurl') . linkTo('ProfileController@page', ['slug' => $data[$i]['slug']]); break;
                case 'domen_created': $profile['site_obj']['domen_created'] = dateFormat($profile['site_obj']['domen_created']); break;
                case 'number': $profile['number'] = model('Number') -> get_number($profile['id']); break;
                case 'number_txt': $profile['number_txt'] = model('Number') -> get_number($profile['id']);
                    $profile['number_txt'] = ($profile['number_txt'] < 9) ? '0' . $profile['number_txt'] : $profile['number_txt'];
                break;
                case 'tags': $profile['tags'] = model('Tag') -> get_by_profile($profile); break;
            }
        }

        return $profile;
    }

    function get_profile_by_slug($slug){
        $profile = model('Profile') -> get(['where' => ['slug', '=', $slug]]);
        if(!$profile){
            return false;
        }
        $profile = $this -> profile_fields_transform($profile, ['site_link', 'timestamp', 'site_obj', 'cat', 'site', 'domen_created', 'number_txt', 'tags']);

        model('Profile') -> update(['count_views' => $profile['count_views'] + 1], ['slug', '=', $slug]);
        model('Meta') -> incrementField('count_profile_views');

        return $profile;
    }

    public function get_moderation_list(){
    	$data = arrayToArray($this -> get(['where' => ['public_flag','=',0], 'order' => ['id', 'ASC']]));
        if(!$data[0]){
            $data = [];
        }
    	$count = count($data);
    	for($i=0;$i<$count;$i++){
    		$data[$i]['site'] = linkToLink($data[$i]['site']);
            $data[$i]['site_obj'] = model('Site') -> get(['where' => ['profileid', '=', $data[$i]['id']]]);
    	}
    	return $data;
    }

    public function getMetaDataFromSite($url){
        include_once("./app/vendor/simple_html_dom.php");
        $html = @file_get_contents($url);
        if(!$html){
            return [
                'title' => 'Неизвестно',
                'description' => 'Неизвестно',
                'keywords' => 'Неизвестно',
                'favicon' => 'Неизвестно'
            ];
        }
        $dom = str_get_html($html);
        $title = '';
        $title = $dom -> find('title', 0);
        if($title){
             $title = $title -> innertext;
        }
        $description = '';
        $keywords = '';
        $favicon = '';
        try{
            $description = $dom -> find('meta[name="description"]', 0);
            if($description){
                 $description = $description -> getAttribute('content');
            }
            $keywords = $dom -> find('meta[name="keywords"]', 0);
            if($keywords){
                 $keywords = $keywords -> getAttribute('content');
            }
            $favicon = $dom -> find('link[rel="icon"]', 0);
            if($favicon){
                 $favicon = $favicon -> getAttribute('href');
            
                if(strstr($favicon, 'http') === false){
                    $favicon = $url . $favicon;
                }
            }
        }catch (Exception $e){

        }
        return [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'favicon' => $favicon
        ];
    }

        /////// RATING ///////

    /**
     * [rating description]
     *
     * @param  [array] $review [model object]
     * @param  [type] $profileid [description]
     *
     * @return [type] [description]
     */
    public function rating($review, $removeFlag = false){
        $profileid = $review['profileid'];
        switch($review['rating']){
            case '-1': $this -> rating_minus($profileid, $removeFlag); break;
            case '1': $this -> rating_plus($profileid, $removeFlag); break;
            case '0': $this -> rating_neutral($profileid, $removeFlag); break;
        }

    }

    public function rating_plus($profileid, $removeFlag){
        $profile = model('Profile') -> get(['where' => ['id', '=', $profileid]]);
        if(!$removeFlag){
            $newProfileRating = intval($profile['rating']) + 1;
            $newCount = intval($profile['count_like']) + 1;
        }else{
            $newProfileRating = intval($profile['rating']) - 1;
            $newCount = intval($profile['count_like']) - 1;
        }
        
        $data = [
            'rating' => $newProfileRating,
            'count_like' => $newCount
        ];
        model('Profile') -> update($data, ['id', '=', $profileid]);
    }

    public function rating_minus($profileid, $removeFlag){
        $profile = model('Profile') -> get(['where' => ['id', '=', $profileid]]);
        if(!$removeFlag){
            $newProfileRating = intval($profile['rating']) - 1;
            $newCount = intval($profile['count_dislike']) + 1;
        }else{
            $newProfileRating = intval($profile['rating']) + 1;
            $newCount = intval($profile['count_dislike']) - 1;
        }
        
        $data = [
            'rating' => $newProfileRating,
            'count_dislike' => $newCount
        ];
        model('Profile') -> update($data, ['id', '=', $profileid]);
    }

    public function rating_neutral($profileid, $removeFlag){
        $profile = model('Profile') -> get(['where' => ['id', '=', $profileid]]);
        if(!$removeFlag){
            $newCount = intval($profile['count_neutral']) + 1;
        }else{
            $newCount = intval($profile['count_neutral']) - 1;
        }

        $data = [
            'count_neutral' => $newCount
        ];
        model('Profile') -> update($data, ['id', '=', $profileid]);
    }
}
