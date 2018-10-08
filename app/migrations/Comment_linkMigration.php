<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
    DBW
};

class Comment_linkMigration extends \Extend\Migration{

    public static function up(){

        // Create tables in db

        DBW::create('Comment_link',function($t){
            $t -> int('srcid')
            -> varchar('link');
        });

    }

    public static function down(){

        // Drop tables from db

        DBW::drop('Comment_link');

    }

}

