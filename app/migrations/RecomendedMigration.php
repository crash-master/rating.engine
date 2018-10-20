<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
    DBW
};

class RecomendedMigration extends \Extend\Migration{

    public static function up(){

        // Create tables in db

        DBW::create('Recomended',function($t){
            $t -> int('profileid')
            -> datetime('timestamp');
        });

    }

    public static function down(){

        // Drop tables from db

        DBW::drop('Recomended');

    }

}

