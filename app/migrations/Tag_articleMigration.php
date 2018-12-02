<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
    DBW
};

class Tag_articleMigration extends \Extend\Migration{

    public static function up(){

        // Create tables in db

        DBW::create('Tag_article',function($t){
            $t -> int('tag_id')
            -> int('article_id')
            -> datetime('timestamp');
        });

    }

    public static function down(){

        // Drop tables from db

        DBW::drop('Tag_article');

    }

}

