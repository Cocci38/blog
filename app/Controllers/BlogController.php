<?php

namespace App\Controllers;

class BlogController extends Controller{

    public function index()
    {
        return $this->view('blog.index'); // Fonction view dans le dossier blog pour appeller la vue index
    }

    public function show(int $id)
    {
        return $this->view('blog.show', compact('id')); //Fonction view dans le dossier blog pour appeller la vue show
    }
}




?>