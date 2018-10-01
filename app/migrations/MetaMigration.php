<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
    DBW
};

class MetaMigration extends \Extend\Migration{

    public static function up(){

        // Create tables in db

        DBW::create('Meta',function($t){
            $t -> varchar('meta_name')
            -> text('meta_value')
            -> datetime('timestamp');
        });

    }

    public static function down(){

        // Drop tables from db

        DBW::drop('Meta');

    }

}

