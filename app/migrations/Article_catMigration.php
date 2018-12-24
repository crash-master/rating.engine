<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
    DBW
};

class Article_catMigration extends \Extend\Migration{

    public static function up(){

        // Create tables in db

        DBW::create('Article_cat',function($t){
            $t -> int('article_id')
            -> int('cat_id');
        });

    }

    public static function down(){

        // Drop tables from db

        DBW::drop('Article_cat');

    }

}

