<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Tag;

class BlogController extends Controller{

    public function welcome()
    {
        return $this->view('blog.welcome');  // Fonction view dans le dossier blog pour appeller la vue welcome
    }

    public function index()
    {
        $post = new Post($this->getDB());
        $posts = $post->all();

        // Fonction view dans le dossier blog pour appeller la vue index et on envoie les posts dans la vue (view)
        return $this->view('blog.index', compact('posts')); 
    }

    public function show(int $id)
    {
        $post = new Post($this->getDB()); // Nouvelle instance de notre modèle avec connection base de donnée
        $post = $post->findById($id);

        return $this->view('blog.show', compact('post')); //Fonction view dans le dossier blog pour appeller la vue show
    }

    public function tag(int $id)
    {
        $tag = (new Tag($this->getDB()))->findById($id);  // ->findById($id) écrit à la suite pour gagner une ligne ou on peut faire comme au dessus
        //$tag->findById($id);  // Si on écrit pas ->findById($id) au dessus
        return $this->view('blog.tag', compact('tag'));
    }
}

?>