<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
    DBW
};

class SiteMigration extends \Extend\Migration{

    public static function up(){

        // Create tables in db

        DBW::create('Site',function($t){
            $t  -> int('profileid')
            -> varchar('title')
            -> text('keywords')
            -> text('description')
            -> longtext('screen')
            -> varchar('favicon') // url to favicon on other server
            -> int('count_visits')
            -> varchar('domen_created')
            -> datetime('last_data_update');
        });

    }

    public static function down(){

        // Drop tables from db

        DBW::drop('Site');

    }

}

