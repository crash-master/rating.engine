<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
    DBW
};

class Route_metaMigration extends \Extend\Migration{

    public static function up(){

        // Create tables in db

        DBW::create('Route_meta',function($t){
            $t -> varchar('title')
             -> text('keywords')
             -> text('description')
             -> text('extra')
             -> varchar('route')
             -> int('page_id')
             -> datetime('timestamp');
        });

    }

    public static function down(){

        // Drop tables from db

        DBW::drop('Route_meta');

    }

}

