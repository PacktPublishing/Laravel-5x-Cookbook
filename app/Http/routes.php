<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

Route::group(['middleware' => ['web']], function () {

    Route::auth();

    Route::get('profile', 'ProfileController@getAuthenticatedUsersProfile')->name('profile');
    Route::get('profile/edit', 'ProfileEditController@getAuthenticatedUsersProfileToEdit')->name('profile.edit');
    Route::put('profile/edit', 'ProfileEditController@updateAuthenticatedUsersProfile')->name('profile.update');

    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    Route::get('/about', ['as' => 'about', function(){
        $title = "About";
        return view('about', compact('title'));
    }]);

    Route::resource("users","UserController"); // Add this line in routes.php

    Route::get('/api/v1/search', ['as' => 'search',
        'uses' => 'SearchComics@searchComicsByName']);

    Route::get('/show_message', function() {
       return redirect('/')->with("message", "Hello There");
    });

    Route::resource("wish_lists","WishListController");

    /**
     * Example of Fake API
     *
     */
    if(env('MARVEL_API_FAKE') == true)
    {
        Route::get('/v1/public/comics', function(){
            Log::info(sprintf("Request coming in %s", env('MARVEL_API_FAKE')));
            if(Request::input('name'))
            {
                Log::info("This one had a name");
                $fixture = File::get(base_path('tests/fixtures/results_no_name.json'));
                $data = ['data' => json_decode($fixture, true)];
            } else {
                $fixture = File::get(base_path('tests/fixtures/results_no_name.json'));

                $data = ['data' => json_decode($fixture, true)];
            }

            return Response::json($data);
        });
    }
});

