<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


// API route group
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return $router->app->version();
    });

    // Matches "/api/register
    $router->post('register', 'AuthController@register');
     // Matches "/api/login
    $router->post('login', 'AuthController@login');

    // Matches "/api/profile
    $router->get('profile', 'UserController@profile');

    // Matches "/api/user 
    //get one user by id
    $router->get('users/{id}', 'UserController@getOne');

    // Matches "/api/users
    $router->get('users', 'UserController@getAll');

    $router->get('notes', 'NotesController@getAll');

    $router->get('/videos', 'VideosController@show');

    $router->get('/institutions', function() {
        $data = json_decode(file_get_contents('../resources/data/institutions.json'), true);
        return array_map(function($institution) {return array_intersect_key(array_merge($institution['_source'], ["id" =>$institution["_id"]]), array_flip(['name', 'shortName', "id"]));}, $data['hits']['hits']);
    });

    $router->get('/courses/{institutionId}', function($institutionId) {
        $options = array(
            'http'=>array(
            'method'=>"GET",
            'header'=>"Accept-language: en\r\n" .
                        "User-Agent: Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.102011-10-16 20:23:10\r\n" // i.e. An iPad 
            )
        );
        
        $context = stream_context_create($options);
        $data = file_get_contents("https://www.studocu.com/ro/institution/universitatea-alexandru-ioan-cuza-din-iasi/{$institutionId}", false, $context);
        file_put_contents("../resources/data/{$institutionId}.html", $data);  
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $data);
        libxml_use_internal_errors(false);
        $xpath = new DOMXpath($dom);
        $elements = $xpath->query('//*[@id="main-wrapper"]/div[1]/section[5]/ul/li/a');
        $courses = [];
        foreach($elements as $element) {
            $courses[] = $element->textContent;
        }
        return $courses;
    });


});