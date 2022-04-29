<?php

namespace App\Models;

use DateTime;
class Post extends Model{

    protected $table = 'posts';

    // Fonction pour afficher la date et l'heure
    public function getCreatedAt(): string  // : string avec return
    {
        return (new DateTime($this->created_at))->format('d/m/Y à H:i');
    }

    // Fonction pour raccourcir le contenu
    public function getExcerpt(): string // getExcerpt() => Pour raccourcir le contenu de notre Poste $content
    {
        return substr($this->content, 0, 200) . '...'; // substr => retourne un segment de chaine de caractère 
    }

    // Utilisation de la syntaxe Heredoc pour générer un bouton à la volée : 

    /*public function getButton(): string
    {
        return <<<HTML
        <a href="/site_poo/posts/$this->id">Lire l'article</a>
HTML;
    }*/

    // Fonction pour récupérer tous les tags
    public function getTags(){
        return $this->query("SELECT t.* FROM tags t  
                                            INNER JOIN post_tag pt ON pt.tag_id = t.id
                                            WHERE pt.post_id = ?
                                            ", [$this->id]); // $this->id  => on récupère l'id de notre instance
    }   // t est un alias pour la table tags (Les alias sont la pour éviter les erreurs)
        // pt est un alias pour la table post_tag
        // p est un alias pour la table posts

        public function create(array $data, ?array $relations = null)
    {
        parent::create($data);

        $id = $this->db->getPDO()->lastInsertId();

        foreach ($relations as $tagId) {
            $stmt = $this->db->getPDO()->prepare("INSERT post_tag (post_id, tag_id) VALUES (?, ?)");
            $stmt->execute([$id, $tagId]);
        }

        return true;
    }

    public function update(int $id, array $data, ?array $relations = null)
    {
        parent::update($id, $data);

        $stmt = $this->db->getPDO()->prepare("DELETE FROM post_tag WHERE post_id = ?");
        $result = $stmt->execute([$id]);

        foreach ($relations as $tagId) {
            $stmt = $this->db->getPDO()->prepare("INSERT post_tag (post_id, tag_id) VALUES (?, ?)");
            $stmt->execute([$id, $tagId]);
        }

        if ($result) {
            return true;
        }
    }
}       


?>