<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
    DBW
};

class ProfileMigration extends \Extend\Migration{

    public static function up(){

        // Create tables in db

        DBW::create('Profile',function($t){
            $t -> int('catid')
            -> varchar('site')
            -> varchar('name')
            -> varchar('slug')
            -> text('contacts')
            -> tinyint('public_flag') -> null(0)
            -> int('count_views')
            -> int('count_like')
            -> int('count_dislike')
            -> int('count_neutral')
            -> int('count_reviews')
            -> int('rating')
            -> datetime('timestamp');
        });

    }

    public static function down(){

        // Drop tables from db

        DBW::drop('Profile');

    }

}

