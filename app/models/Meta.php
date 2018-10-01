<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Meta extends \Extend\Model{

    public $sets;
    public $metaCache = [];

    public function __construct(){
        $this -> sets = new \Sets\MetaSet;
    }

    public function getMeta($name, $arr_flag = false){
    	$meta = $this -> get(['where' => ['meta_name', '=', $name]]);
    	if(isset($meta['meta_name'])){
    		if(!$arr_flag){
    			return $meta['meta_value'];
    		}else{
    			return $meta;
    		}
    	}

    	return false;
    }

    public function setMeta($name, $val){
    	return $this -> set(['meta_name' => $name, 'meta_value' => $val]);
    }

    public function updateMeta($name, $val){
    	return $this -> update(['meta_name' => $name, 'meta_value' => $val], ['meta_name', '=', $name]);
    }

    public function removeMeta($name){
    	return $this -> remove(['meta_name', '=', $name]);
    }

    public function allMeta(){
    	return $this -> all();
    }

    public function issetMeta($name){
    	if(!count($this -> metaCache)){
    		$all = $this -> allMeta();
    		$this -> metaCache = $all;
    	}else{
    		$all = $this -> metaCache;
    	}

    	foreach($all as $i => $item){
    		if($item['meta_name'] == $name){
    			return true;
    		}
    	}

    	return false;
    }

    public function init(){
    	
    	$base = [
    		'sitename' => 'MySite',
            'siteurl' => '',
    		'keywords' => '{}',
    		'description' => 'Hello, I am description',
    		'title' => json_encode(['home' => 'Home page', 'rating' => 'Rating page', 'single' => 'Some Profile personal page']),
    		'password' => 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', // sha1 - root
    		'count_profiles' => '0',
    		'count_profile_views' => '0',
    		'count_personal_site_visits' => '0',
            'count_reviews' => '0',
    		'count_comments' => '0',
    		'social' => json_encode(['facebook' => 'http://facebook.com', 'twitter' => 'http://twitter.com', 'vk' => 'http://vk.com']),
            'metrica' => '',
    		// text pages
    		'text-pages' => json_encode(['help', 'about', 'privacy-policy', 'denial-of-responsibility']),
    		'help' => 'Text about help',
    		'about' => 'Text about us',
    		'privacy-policy' => 'Text about privacy policy',
    		'denial-of-responsibility' => 'Denial of responsibility',
            // keywords and title for main pages
            'main-pages' => json_encode(['home' => ['title' => '', 'keywords' => ''], 'rating' => ['title' => '', 'keywords' => '']]),
    		//text blocks
    		'text-blocks' => json_encode(['rules-for-adding-psychics', 'rules-for-adding-reviews', 'preface', 'after-top5-block']),
    		'rules-for-adding-psychics' => '<h3>Правила добавления экстрасенсов</h3>
					<p>Правила регистрации нового мага предельно просты. Вы заполняете специальную форму, в которой предоставляете информацию об адресе официального сайта экстрасенса и его полное имя, соглашаетесь с настоящими правилами и оставляете свой отзыв об опыте общения с зарегистрированным специалистом на 2м шаге формы.</p>
					<p><strong>1. Имя специалиста нужно писать полностью, приписки шарлатан, обманщик и тому подобное просим не употреблять.</strong></p>
					<p>- Свое Мнение и оценку Вы сможете написать на следующем шаге.</p>
					<p>Установленная защита в автоматическом режиме проверит внесенную информацию и, только убедившись в ее достоверности, поместит ее на сайте.</p>',
			'rules-for-adding-reviews' => '<h3>Правила добавления отзывов</h3>
							<p>Добавив в рейтинг нового мага и адрес его официального сайта, не забудьте оставить отзыв о своем контакте со специалистом. Ваша информация поможет многим людям нуждающимся в помощи, не попасть на удочку мошенников.</p>
							<p><strong>1. Не допускаются оскорбления, </strong>мат, грубое обращение (постарайтесь написать отзыв с минимальным количеством эмоций, и максимальным количеством фактов).</p>
							<p><strong>2. Указывайте настоящий email </strong>на него будет отправлена ссылка для активации отзыва (не активированные отзывы на главной странице сайта не отображаются, на рейтинг не влияют и могут быть удалены по требованию экстрасенса).</p>',
            'preface' => 'Есть много вариантов Lorem Ipsum, но большинство из них имеет не всегда приемлемые модификации, например, юмористические вставки или слова, которые даже отдалённо не напоминают латынь. Если вам нужен Lorem Ipsum для серьёзного проекта, вы наверняка не хотите какой-нибудь шутки, скрытой в середине абзаца. Также все другие известные генераторы Lorem Ipsum используют один и тот же текст, который они просто повторяют, пока не достигнут нужный объём. Это делает предлагаемый здесь генератор единственным настоящим Lorem Ipsum генератором. Он использует словарь из более чем 200 латинских слов, а также набор моделей предложений. В результате сгенерированный Lorem Ipsum выглядит правдоподобно, не имеет повторяющихся абзацей или "невозможных" слов.',
            'after-top5-block' => 'Есть много вариантов Lorem Ipsum, но большинство из них имеет не всегда приемлемые модификации, например, юмористические вставки или слова, которые даже отдалённо не напоминают латынь. Если вам нужен Lorem Ipsum для серьёзного проекта, вы наверняка не хотите какой-нибудь шутки, скрытой в середине абзаца. Также все другие известные генераторы Lorem Ipsum используют один и тот же текст, который они просто повторяют, пока не достигнут нужный объём. Это делает предлагаемый здесь генератор единственным настоящим Lorem Ipsum генератором. Он использует словарь из более чем 200 латинских слов, а также набор моделей предложений. В результате сгенерированный Lorem Ipsum выглядит правдоподобно, не имеет повторяющихся абзацей или "невозможных" слов.'
    	];

    	foreach($base as $name => $val){
    		if($this -> issetMeta($name)){
    			continue;
    		}
    		$this -> setMeta($name, $val);
    	}

    	return true;
    }

    public function getTextPageList(){
    	return json_decode($this -> getMeta('text-pages'), true);
    }

    public function issetPage($pagename){
    	$pages = $this -> getTextPageList();
    	foreach($pages as $i => $page){
    		if($page == $pagename){
    			return true;
    		}
    	}

    	return false;
    }

    public function getTitle($pagename){
    	$titles = json_decode($this -> getMeta('title'), true);
    	foreach($titles as $page => $title){
    		if($page == $pagename){
    			return $title;
    		}
    	}

    	return false;
    }

    public function getKeywords($pagename){
    	$keywords = json_decode($this -> getMeta('keywords'), true);
    	foreach($keywords as $page => $one){
    		if($page == $pagename){
    			return $one;
    		}
    	}

    	return false;
    }

    public function getTextPage($pagename){
    	if($this -> issetPage($pagename)){
    		$page = [
    			'content' => $this -> getMeta($pagename),
    			'title' => $this -> getTitle($pagename),
    			'keywords' => $this -> getKeywords($pagename)
    		];

    		return $page;
    	}

    	return false;
    }

    public function getTextBlocksList(){
    	return json_decode($this -> getMeta('text-blocks'), true);
    }

    public function incrementField($meta_name){
    	$num = intval($this -> getMeta($meta_name));
    	$num++;
    	$this -> updateMeta($meta_name, $num);
    }

    public function decrementField($meta_name){
    	$num = intval($this -> getMeta($meta_name));
    	$num--;
    	$this -> updateMeta($meta_name, $num);
    }

    public function get_main_pages(){
       $pages = json_decode($this -> getMeta('main-pages'), true);
       $mainpagelist = array_keys($pages);
       return ['mainPageList' => $mainpagelist, 'mainpages' => $pages];
    }

}
