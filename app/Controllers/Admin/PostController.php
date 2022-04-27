<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller{

    public function index()
    {
        $posts = (new Post($this->getDB()))->all();

        return $this->view('admin.post.index', compact('posts'));
    }
    // Fonction pour renvoyer le formulaire
    public function create()
    {
        return $this->view('admin.post.form');
    }
    // Fonction pour traiter les données envoyées en Post
    public function createPost()
    {
        $post = new Post($this->getDB());

        $tags = array_pop($_POST);

        $result = $post->create($_POST, $tags);

        if ($result) {
            return header('Location: /site_poo/admin/posts');
        }
    }
    
    public function edit(int $id)
    {
        $post = (new Post($this->getDB()))->findById($id);
        $tags = (new Tag($this->getDB()))->all();
        return $this->view('admin.post.edit', compact('post', 'tags'));
    }

    public function update(int $id)
    {
        $post = new Post($this->getDB());

        $tags = array_pop($_POST); // array_pop() => dépile et retourne la valeur du dernier élément du tableau array, le raccourcissant d'un élément.

        $result = $post->update($id, $_POST, $tags); // Methode update pour mettre à jour dynamiquement les données ($_POST contient les infos à changer)

        if ($result){
            return header('Location: /site_poo/admin/posts');
        }
    }

    public function destroy(int $id)
    {
        $post = new Post($this->getDB());
        $result = $post->destroy($id);

        if ($result){
            return header('Location: /site_poo/admin/posts');
        }
    }
}





?>