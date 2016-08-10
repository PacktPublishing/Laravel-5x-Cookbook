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

use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;





Route::group(['middleware' => ['web']], function () {

    Route::auth();

    Route::resource("blogs","BlogController");
    
    Route::get("/setup/profile", "SetupBehatController@setupProfile");
    Route::get("/cleanup/profile", "CleanupBehatController@cleanupProfile");


    /**
     * Subscriptions area
     */

    Route::group(['middleware' => ['is_admin']], function () {
        Route::get('/admin/users', function () {
            return "You are here";})
            ->name('admin.users');

        Route::get('/admin/memberships', 'AdminMembershipsDashboardController@get')
            ->name('admin.memberships');

    });

    Route::post('/user/membership/edit', 'ProfileController@postEdit')
        ->name('user.membership.edit');

    Route::get('/user/membership/invoice/{invoice}', 'ProfileController@getPrintInvoice')
        ->name('user.membership.invoices');

    Route::get('/user/membership/cancel', 'ProfileController@getCancel')
        ->name('user.membership.cancel');
    
    Route::post('/user/membership', 'SubscriptionSwapController@swap')
        ->name('user.membership.swap');

    Route::get('/user/membership', 'ProfileController@getUser')
        ->name('user.membership.show');

    Route::group(['prefix' => 'subscribe'], function() {
        Route::get('/', 'SubscribeController@getLevelsPage')
            ->name('user.membership.signup');

        Route::post('comicslevel1', 'SubscribeController@postLevel1')
            ->name('user.membership.level1');

        Route::post('comicslevel2', 'SubscribeController@postLevel2')
            ->name('user.membership.level2');
    });

    Route::post('stripe/webhook', 'WebhookController@handleWebhook')
        ->name('user.membership.webhook');

    /** end subscription area */

    Route::get('/facebook/redirect', 'FacebookAuthController@redirect');

    Route::get('/facebook/callback', 'FacebookAuthController@callback');

    Route::post('/api/v1/test', 'TestController@foo');

    Route::get('/api/v1/token', function(){
        return csrf_token();
    });
    
    Route::get('/test_cors', 'TestController@view');


    Route::post('api/v1/favorite', 'FavoriteCreate@create')->name('favorite.create');
    Route::delete('api/v1/favorite/{comic_id}', 'FavoriteRemove@remove')->name('favorite.remove');

    Route::get('profile/edit', 'ProfileEditController@getAuthenticatedUsersProfileToEdit')->name('profile.edit');

    Route::put('profile/edit', 'ProfileEditController@updateAuthenticatedUsersProfile')->name('profile.update');

    Route::get('profile/{slug}', 'ProfileShowController@getProfileForUserUsingSlug')->name('profile');

    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    Route::get('/about', ['as' => 'about', function () {
        $title = "About";
        return view('about', compact('title'));
    }]);

    Route::resource("users", "UserController"); // Add this line in routes.php


    Route::group(['prefix' => '/api/v1'], function () {
        Route::get('/search', 'SearchComics@searchComicsByName');
    });

    Route::group(['middleware' => 'auth'], function() {
        Route::get('foo', function () {

            $data = ['label' => "Hello", 'value' => "World"];

            return view('examples.route_view', compact('data'));
        })->name('example_view');
    });

    Route::get('/show_message', function () {
       return redirect('/')->with("message", "Hello There");
    });

    Route::resource("wish_lists", "WishListController");

    /**
     * Example of Fake API
     *
     */
    if (env('MARVEL_API_FAKE') == true) {
        Route::get('/v1/public/comics', function () {
            Log::info(sprintf("Request coming in %s", env('MARVEL_API_FAKE')));
            if (Request::input('name')) {
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
