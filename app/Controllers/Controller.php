<?php

namespace App\Controllers;

use Database\DBConnection;

abstract class Controller{ //abstract parce qu'elle ne sera jamais instancier

    protected $db;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    protected function view(string $path, array $params = null)
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
        /*if ($params){
            $params = extract($params);
        }*/
        $content = ob_get_clean();
        require VIEWS . 'layout.php';
    }

    // Fonction pour récupérer la connection à la base de donnée
    protected function getDB()
    {
        return $this->db;
    }
}

?>