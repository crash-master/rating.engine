<?php 
// pages
route('/com', 'Modules\\comController@dashboard');
route('/com/about', 'Modules\\comController@about');

// api
route('/com/create/controller/{name}', 'Modules\\comController@createController');
route('/com/create/model/{name}', 'Modules\\comController@createModel');
route('/com/create/set/{name}', 'Modules\\comController@createSet');
route('/com/create/migration/{name}', 'Modules\\comController@createMigration');
route('/com/migrations/up/{name}', 'Modules\\comController@migrationUp');
route('/com/migrations/down/{name}', 'Modules\\comController@migrationDown');
route('/com/migrations/up', 'Modules\\comController@migrationUpAll');
route('/com/migrations/down', 'Modules\\comController@migrationDownAll');
route('/com/migrations/list', 'Modules\\comController@migrationList');
route('/com/migrations/refresh/{name}', 'Modules\\comController@migrationRefresh');
route('/com/migrations/refresh', 'Modules\\comController@migrationRefreshAll');