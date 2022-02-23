<?php

use Router\Router;

require '../vendor/autoload.php';

// Constante qui est un chemin qui pointe vers le dossier des vues (dirname(__DIR__) renvoie vers le dossier)
define ('VIEWS' , dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
// Contante qui envoie vers nos dossiers de script (dirname($_SERVER['SCRIPT_NAME']) pour avoir un bon chemin vers les scripts)
define('SCRIPTS' , dirname($_SERVER['SCRIPT_NAME']). DIRECTORY_SEPARATOR);

$router = new Router( $_GET['url']);

// On appelle la fonction index et show dans le bloc BlogController
//$router->get('/', 'App\Controllers\BlogController@index'); // Un chemin '/' et une action BlogController@index' (le controller @ la méthode)
$router->get('/', 'App\Controllers\BlogController@welcome'); // Mène vers la fonction welcome
$router->get('/posts', 'App\Controllers\BlogController@index'); // Mène liste tous les articles
$router->get('/posts/:id', 'App\Controllers\BlogController@show'); // Dans l'url on écrit posts/id

// Pour vérifier que nos routes fonctionnent
$router->run();

?>