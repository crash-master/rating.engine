<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
    DBW
};

class NumberMigration extends \Extend\Migration{

    public static function up(){

        // Create tables in db

        DBW::create('Number',function($t){
            $t -> int('profileid')
            -> int('number') -> null('0')
            -> datetime('timestamp');
        });

    }

    public static function down(){

        // Drop tables from db

        DBW::drop('Number');

    }

}

