<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
    DBW
};

class ReviewMigration extends \Extend\Migration{

    public static function up(){

        // Create tables in db

        DBW::create('Review',function($t){
            $t -> int('profileid')
            -> varchar('username')
            -> varchar('email')
            -> text('message')
            -> tinyint('rating') // +1 / - / -1
            -> varchar('user_ip')
            -> varchar('country')
            -> varchar('city')
            -> tinyint('public_flag')
            -> longtext('image') // base64
            -> datetime('timestamp');
        });

    }

    public static function down(){

        // Drop tables from db

        DBW::drop('Review');

    }

}

