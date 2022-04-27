<?php

use App\Exceptions\NotFoundException;
use Router\Router;

require '../vendor/autoload.php';

// Constante qui est un chemin qui pointe vers le dossier des vues (dirname(__DIR__) renvoie vers le dossier)
define ('VIEWS' , dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
// Contante qui envoie vers nos dossiers de script (dirname($_SERVER['SCRIPT_NAME']) pour avoir un bon chemin vers les scripts)
define('SCRIPTS' , dirname($_SERVER['SCRIPT_NAME']). DIRECTORY_SEPARATOR);
//'tutos1', 'localhost', 'root', '' :
define('DB_NAME', 'tutos1');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PWD', '');

$router = new Router( $_GET['url']);

// On appelle la fonction index et show dans le bloc BlogController
//$router->get('/', 'App\Controllers\BlogController@index'); // Un chemin '/' et une action BlogController@index' (le controller @ la méthode)
$router->get('/', 'App\Controllers\BlogController@welcome'); // Le chemin qui mène vers la fonction welcome
$router->get('/posts', 'App\Controllers\BlogController@index'); // Mène liste tous les articles
$router->get('/posts/:id', 'App\Controllers\BlogController@show'); // Dans l'url on écrit posts/id
$router->get('/tags/:id', 'App\Controllers\BlogController@tag'); // Dans l'url on écrit tags/id (on aura une fonction tag dans BlogController)

$router->get('/admin/posts', 'App\Controllers\Admin\PostController@index');// Mène à la liste des articles dans admin
$router->get('/admin/posts/create', 'App\Controllers\Admin\PostController@create');
$router->post('/admin/posts/create', 'App\Controllers\Admin\PostController@createPost');
$router->post('/admin/posts/delete/:id', 'App\Controllers\Admin\PostController@destroy'); // Le chemin pour la fonction delete
$router->get('/admin/posts/edit/:id', 'App\Controllers\Admin\PostController@edit');
$router->post('/admin/posts/edit/:id', 'App\Controllers\Admin\PostController@update');
// Pour vérifier que nos routes fonctionnent
// try => Pour tenter d'executer la fonction
try{
$router->run(); // On l'attrape avec catch si elle nous retourne une exception
} catch (NotFoundException $e){
    echo $e->getMessage(); // $e comme pour erreur  // $e->getMessage() => Pour afficher notre message
}  // On tente d'executer cette fonction, si cette fonction relève une erreur (ici aucune route ne match avec l'url)
    // On va pouvoir ratrapper notre exception qui est de classe Exception et lui passer  le message indiqué dans getMessage()


?>