<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
    DBW
};

class CommentMigration extends \Extend\Migration{

    public static function up(){

        // Create tables in db

        DBW::create('Comment',function($t){
            $t -> int('reviewid')
            -> varchar('name')
            -> text('message')
            -> tinyint('public_flag')
            -> datetime('timestamp');
        });

    }

    public static function down(){

        // Drop tables from db

        DBW::drop('Comment');

    }

}

