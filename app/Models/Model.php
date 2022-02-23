<?php

namespace App\Models;

use Database\DBConnection;
use stdClass;

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
        return $stmt->fetchAll();
    }

    public function findById(int $id): stdClass
    {
        $stmt = $this->db->getPDO()->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]); // execute renvoie un true ou un false
        return $stmt->fetch(); // fetch sur $stmt et les résultats exploitablent sont stockés dans $post
    }
}


?>