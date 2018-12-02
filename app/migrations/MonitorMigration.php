<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
    DBW
};

class MonitorMigration extends \Extend\Migration{

    public static function up(){

        // Create tables in db

        DBW::create('Monitor',function($t){
            $t -> datetime('timestamp');
        });

    }

    public static function down(){

        // Drop tables from db

        DBW::drop('Monitor');

    }

}
