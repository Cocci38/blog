<?php

namespace App\Models;

use DateTime;
class Post extends Model{

    protected $table = 'posts';

    public function getCreatedAt(): string  // : string avec return
    {
        return (new DateTime($this->created_at))->format('d/m/Y à H:i');
    }

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
}


?>