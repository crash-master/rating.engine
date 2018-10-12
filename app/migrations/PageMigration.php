<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
    DBW
};

class PageMigration extends \Extend\Migration{

    public static function up(){

        // Create tables in db

        DBW::create('Page',function($t){
            $t -> longtext('content')
            -> varchar('route')
            -> tinyint('is_text')
            -> datetime('timestamp');
        });

    }

    public static function down(){

        // Drop tables from db

        DBW::drop('Page');

    }

}

