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
        return $this->query("SELECT * FROM {$this->table} ORDER BY created_at DESC"); // Pour remplacer le code du dessous  grâce à la public function query plus bas
        
        // $stmt = $this->db->getPDO()->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
        // $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this),[$this->db]); // setFetchMode => fonction propre à PDO
        // return $stmt->fetchAll(); // fetchAll  ==>  Pour récupérer toutes les données
        // PDO::FETCH_CLASS : Pour avoir une classe en particulier
        // get_class($this) : Pour récupérer le namepace complet de la classe (ici => App\Models\Post)
    }

    public function findById(int $id): Model // : Model ça me renvoie une instance de Model car Post hérite de Model
    {
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", $id, true); // Pour remplacer le code du dessous  grâce à la public function query plus bas
        
        // getPDO()->prepare pour ce protéger des failles sql et des injections (avec prepare)
        // $stmt = $this->db->getPDO()->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        // $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this),[$this->db]);
        // $stmt->execute([$id]); // execute renvoie un true ou un false
        // return $stmt->fetch(); // fetch sur $stmt et les résultats exploitablent sont stockés dans $post
    }
   
    // Fonction qui nous permet de récupérer à la volée nos résultats en économisant du code
    public function query(string $sql, int $param = null, bool $single = null){ // requete sql, parfois on a un paramètre parfois non, pour savoir si on a un fetch() ou un fetchAll()
        
        $method = is_null($param) ? 'query' : 'prepare'; // est-ce que $param est null ? Si oui c'est une query() : Si non c'est un prepare()
        $fetch = is_null($single) ? 'fetchAll' : 'fetch'; // est-ce que $single est null ? Si oui alors on utilise fetchAll() : Si non on utilise un fetch()

        $stmt = $this->db->getPDO()->$method($sql); // method pour déterminer si on est en query() ou prepare()
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);

        if ($method=='query') {               // $method strictement égale à query
            return $stmt->$fetch();          // si on a une query() on retourne directement notre résultat fetch() 
        } else {
            $stmt->execute([$param]);   // si différent de query alors on a rempli quelque chose dans $params donc on execute $param
            return $stmt->$fetch();         // ensuite on retourne dans tous les cas $stmt->$fetch();
        }
    }
}


?>