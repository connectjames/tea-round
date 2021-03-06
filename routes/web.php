<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/debug', function () {

    $debug = [
        'Environment' => App::environment(),
        'Database defaultStringLength' => Illuminate\Database\Schema\Builder::$defaultStringLength,
    ];

    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you're facing difficulties connecting to the
    database and you need to confirm your credentials. When you're done
    debugging, comment it back out so you don't accidentally leave it
    running on your production server, making your credentials public.
    */
    $debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED: '.$e->getMessage();
    }

    dump($debug);
});



Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return 'Here is the index page with TABLE OF USERS / THEIR DRINKS / BUTTON REQUEST NEXT ROUND / TEA MAKER';
    });

    Route::group(['middleware' => 'CheckAdmin'], function() {
        Route::get('/admin', function () {
            return 'Here is the admin panel index';
        });
        Route::get('/admin/users', function () {
            return 'Here is the admin panel users, with EMAIL \ NAME \ DRINK \ FREQUENCY \ NUMBER OF TIME CHOSEN \ DELETE ';
        });
        Route::get('/admin/users/add', function () {
            return 'Here is the admin panel users with ADD';
        });
        Route::get('/admin/users/{id}', function () {
            return 'Here is the admin panel users with UPDATE';
        });
    });
});

Auth::routes();
