<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
    DBW
};

class Tag_profileMigration extends \Extend\Migration{

    public static function up(){

        // Create tables in db

        DBW::create('Tag_profile',function($t){
            $t -> int('profileid')
            -> int('tagid');
        });

    }

    public static function down(){

        // Drop tables from db

        DBW::drop('Tag_profile');

    }

}

