<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
	DBW
};

class ImgsMetaMigration extends \Extend\Migration{

	public static function up(){

		// Create tables in db

		DBW::create('ImgsMeta',function($t){
			$t -> int('img_storage_id')
			-> varchar('alt', 255)
			-> datetime('timestamp');
		});

	}

	public static function down(){

		// Drop tables from db

		DBW::drop('ImgsMeta');

	}

}

