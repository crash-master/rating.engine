<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
    DBW
};

class APIAuthMigration extends \Extend\Migration{

    public static function up(){

        // Create tables in db

        DBW::create('APIAuth',function($t){
            $t -> varchar('api_key')
            -> varchar('access_url')
            -> varchar('email')
            -> int('count_request') -> null(0)
            -> tinyint('confirm_flag') -> null(0)
            -> tinyint('active_flag')
            -> datetime('date_of_issue')
            -> datetime('timestamp');
        });

    }

    public static function down(){

        // Drop tables from db

        DBW::drop('APIAuth');

    }

}

