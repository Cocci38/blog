<?php

namespace App\Controllers;

class BlogController extends Controller{

    public function welcome()
    {
        return $this->view('blog.welcome');  // Fonction view dans le dossier blog pour appeller la vue welcome
    }

    public function index()
    {
        $stmt = $this->db->getPDO()->query('SELECT * FROM posts ORDER BY created_at DESC');
        $posts = $stmt->fetchAll();

        // Fonction view dans le dossier blog pour appeller la vue index et on envoie les posts dans la vue (view)
        return $this->view('blog.index', compact('posts')); 
    }

    public function show(int $id)
    {
        // getPDO()->prepare pour ce protéger des failles sql et des injections (avec prepare)
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM posts WHERE id = ?');
        $stmt->execute([$id]); // execute renvoie un true ou un false
        $post = $stmt->fetch(); // fetch sur $stmt et les résultats exploitablent sont stockés dans $post

        return $this->view('blog.show', compact('post')); //Fonction view dans le dossier blog pour appeller la vue show
    }
    /*$req = $this->db->getPDO()->query('SELECT * FROM posts');
    $posts = $req->fetchAll();   // fetchAll  ==>  Pour récupérer toutes les données
    foreach ($posts as $post){
        echo $post->title;*/
}

?>