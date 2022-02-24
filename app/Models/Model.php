<?php
// Les modèles sont génériques, ils vont pouvoir être utilisés par les enfants de notre class Models (ici c'est Post.php)

namespace App\Models;

use Database\DBConnection;
use PDO;

abstract class Model{ //abstract parce qu'elle ne sera jamais instancier

    protected $db;
    protected $table;

    public function __construct(DBConnection $db)
    {
        $this->db = $db; // Je stocke ma connection à la base de donnée
    }

    public function all() : array
    {
        $stmt = $this->db->getPDO()->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this),[$this->db]);
        return $stmt->fetchAll(); // fetchAll  ==>  Pour récupérer toutes les données
        // PDO::FETCH_CLASS : Pour avoir une classe en particulier
        // get_class($this) : Pour récupérer le namepace complet de la classe (ici : App\Models\Post)
    }

    public function findById(int $id): Model // : Model ça me renvoie une instance de Model car Post hérite de Model
    {
        // getPDO()->prepare pour ce protéger des failles sql et des injections (avec prepare)
        $stmt = $this->db->getPDO()->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this),[$this->db]);
        $stmt->execute([$id]); // execute renvoie un true ou un false
        return $stmt->fetch(); // fetch sur $stmt et les résultats exploitablent sont stockés dans $post
    }
}


?>