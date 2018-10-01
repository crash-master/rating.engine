<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
    DBW
};

class TagMigration extends \Extend\Migration{

    public static function up(){

        // Create tables in db

        DBW::create('Tag',function($t){
            $t  -> varchar('title')
            -> varchar('slug')
            -> int('count_profiles')
            -> datetime('timestamp');
        });

    }

    public static function down(){

        // Drop tables from db

        DBW::drop('Tag');

    }

}

