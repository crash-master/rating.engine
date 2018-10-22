<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
	DBW
};

class MediaMigration extends \Extend\Migration{

	public static function up(){

		// Create tables in db

		DBW::create('Media',function($t){
			$t -> longtext('xs')
			-> longtext('sm')
			-> longtext('md')
			-> longtext('lg')
			-> varchar('title')
			-> varchar('type')
			-> datetime('timestamp');
		});

	}

	public static function down(){

		// Drop tables from db

		DBW::drop('Media');

	}

}

