<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
    DBW
};

class ArticleMigration extends \Extend\Migration{

    public static function up(){

        // Create tables in db

        DBW::create('Article',function($t){
            $t -> varchar('content')
            -> tinyint('with_comments')
            -> tinyint('published')
            -> int('thumbnail_media_id')
            -> datetime('timestamp');
        });

    }

    public static function down(){

        // Drop tables from db

        DBW::drop('Article');

    }

}

