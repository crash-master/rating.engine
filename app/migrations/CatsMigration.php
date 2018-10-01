<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
    DBW
};

class CatsMigration extends \Extend\Migration{

    public static function up(){

        // Create tables in db

        DBW::create('Cats',function($t){
            $t -> varchar('title')
            -> datetime('timestamp');
        });

    }

    public static function down(){

        // Drop tables from db

        DBW::drop('Cats');

    }

}

