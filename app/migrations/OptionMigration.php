<?php

/*  Automatically was generated from a template fw/templates/migration.php */
use Kernel\{
    DBW
};

class OptionMigration extends \Extend\Migration{

    public static function up(){

        // Create tables in db

        DBW::create('Option',function($t){
            $t -> varchar('name')
            -> longtext('value')
            -> varchar('section_name')
            -> varchar('about_option');
        });

    }

    public static function down(){

        // Drop tables from db

        DBW::drop('Option');

    }

}

