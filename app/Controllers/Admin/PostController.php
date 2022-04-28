<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller{

    public function index()
    {
        $this->isAdmin(); // Pour que seul l'admin puisse y accéder

        $posts = (new Post($this->getDB()))->all();

        return $this->view('admin.post.index', compact('posts'));
    }
    // Fonction pour renvoyer le formulaire
    public function create()
    {
        $this->isAdmin();

        $tags = (new Tag($this->getDB()))->all();

        return $this->view('admin.post.form', compact('tags'));
    }
    // Fonction pour traiter les données envoyées en Post
    public function createPost()
    {
        $this->isAdmin();

        $post = new Post($this->getDB());

        $tags = array_pop($_POST); // $_POST ne contient que le title et content / $tags ne contient que les tags

        $result = $post->create($_POST, $tags);

        if ($result) {
            return header('Location: /site_poo/admin/posts');
        }
    }
    
    public function edit(int $id)
    {
        $this->isAdmin();

        $post = (new Post($this->getDB()))->findById($id);
        $tags = (new Tag($this->getDB()))->all();
        return $this->view('admin.post.form', compact('post', 'tags'));
    }

    public function update(int $id)
    {
        $this->isAdmin();

        $post = new Post($this->getDB());

        $tags = array_pop($_POST); // array_pop() => dépile et retourne la valeur du dernier élément du tableau array, le raccourcissant d'un élément.

        $result = $post->update($id, $_POST, $tags); // Methode update pour mettre à jour dynamiquement les données ($_POST contient les infos à changer)

        if ($result){
            return header('Location: /site_poo/admin/posts');
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();

        $post = new Post($this->getDB());
        $result = $post->destroy($id);

        if ($result){
            return header('Location: /site_poo/admin/posts');
        }
    }
}





?>