<?php

namespace Router;

use App\Exceptions\NotFoundException;
class Router{

    public $url;
    public $routes = [];

    public function __construct($url)
    {
        $this->url = trim($url, '/'); // trim pour enlever les slash en début et fin d'url
    }

    public function get(string $path, string $action)
    {
        $this->routes['GET'][] = new Route($path, $action);
    }

    // Pour boucler sur nos routes
    public function run()
    {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) // On appelle nos routes avec la super variable $_SERVER
        {
            if ($route->matches($this->url)) // La route a une fonction matches qui prend en paramètre l'url
                return $route->execute(); // Cette fonction appelle le bon controlleur avec la bonne fonction
        }
        throw new NotFoundException("La page demandée est introuvable :("); // On lance une nouvelle exception
        // \Exception est une classe native de PHP, elle se trouve donc dans le namespace racine
    }
}




?>