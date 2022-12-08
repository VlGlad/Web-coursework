<?php

$router->get('', 'WeightController@index');
$router->get('about', 'PageController@about');
$router->post('signup', 'Users@signUp');
$router->post('signin', 'Users@signIn');
$router->get('logout', 'Users@logOut');
$router->post('addpoint', 'WeightController@addPoint');
$router->get('edit', 'WeightController@edit');
$router->post('delete', 'WeightController@delete');
$router->post('get_names', 'WeightController@getNames');
$router->post('add_disease', 'WeightController@addDisease');
$router->post('update', 'WeightController@update');