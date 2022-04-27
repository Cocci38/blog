<?php

namespace App\Models;

class Tag extends Model{

    protected $table = 'tags';

    public function getPosts()
    {
        return $this->query("SELECT p.* FROM posts p
                                            INNER JOIN post_tag pt ON pt.post_id = p.id
                                            WHERE pt.tag_id = ?
        ", [$this->id]);  // On trie uniquement où tag_ig est égal à $this->id (l'id du tag en question)
                               // pt est un alias pour la table post_tag (Les alias sont la pour éviter les erreurs)
                              // p est un alias pour la table posts
    }
}


?>