<?php

namespace App\Controllers;

use Database\DBConnection;

class BlogController extends Controller{

    public function index()
    {
        return $this->view('blog.index'); // Fonction view dans le dossier blog pour appeller la vue index
    }

    public function show(int $id)
    {
        $db = new DBConnection('tutos1', 'localhost', 'root', '');
        var_dump($db->getPDO());
        return $this->view('blog.show', compact('id')); //Fonction view dans le dossier blog pour appeller la vue show
    }
}




?>