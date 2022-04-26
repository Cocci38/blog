<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Post;

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