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
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true); // Pour remplacer le code du dessous  grâce à la public function query plus bas
        
        // getPDO()->prepare pour ce protéger des failles sql et des injections (avec prepare)
        // $stmt = $this->db->getPDO()->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        // $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this),[$this->db]);
        // $stmt->execute([$id]); // execute renvoie un true ou un false
        // return $stmt->fetch(); // fetch sur $stmt et les résultats exploitablent sont stockés dans $post
    }
    public function create(array $data, ?array $relations = null)
    {
        $firstParenthesis = ""; // valeur après INSERT INTO
        $secondParenthesis = ""; // valeur après VALUES
        $i = 1;

        foreach ($data as $key => $comma) {
            $comma = $i === count($data) ? "" : ", "; // Si $i est strictement = au count de $data => on est arrivé à la fin alors on ne met rien sinon on met une virgule et un espace.
            $firstParenthesis .= "{$key}{$comma}"; // .= pour cumuler les valeurs
            $secondParenthesis .= ":{$key}{$comma}";
            $i++;
        }
        //var_dump($firstParenthesis, $secondParenthesis); die();
        return $this->query("INSERT INTO {$this->table} ($firstParenthesis)
        VALUES($secondParenthesis), $data");
    }

    public function update(int $id, array $data, ?array $relations = null)
    {
        $sqlRequestPart = "";
        $i = 1;
        foreach ($data as $key => $value) {
            $comma = $i == count($data) ? " " : ', '; // Pour ajouter les virgules si on en a besoin
            $sqlRequestPart .= "{$key} = :{$key}{$comma}"; //  Pour faire dynamique ça => title = :title, content = :content
            $i++;
        }
        $data['id'] = $id;

        return $this->query("UPDATE {$this->table} SET {$sqlRequestPart} WHERE id = :id", $data); // $data uniquement avec la fonction query 
        // Quand on lui passe $data, il va pouvoir executer avec le tableau de donnée et à la fin il executera la requête préparée avec l'id
        
        //$sql = "UPDATE {$this->table} SET title = :title, content = :content WHERE id = :id";
    }

    public function destroy(int $id): bool
    {
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id]); // On lui passe $id parce que c'est une requête préparée
    }
    // Fonction qui nous permet de récupérer à la volée nos résultats en économisant du code
    public function query(string $sql, array $param = null, bool $single = null){ // requete sql, parfois on a un paramètre parfois non, pour savoir si on a un fetch() ou un fetchAll()
        
        $method = is_null($param) ? 'query' : 'prepare'; // est-ce que $param est null ? Si oui c'est une query() : Si non c'est un prepare()

        // Pour vérifier si notre premier mot est un DELETE ou un UPDATE ou un CREATE parce que l'on ne veut pas rapporter de données
        // strpos => permet de récupérer la position d'une chaîne de caractère
        if (
            strpos($sql, 'DELETE') === 0
            || strpos($sql, 'UPDATE') === 0
            || strpos($sql, 'INSERT') === 0) {

                $stmt = $this->db->getPDO()->$method($sql); // method pour déterminer si on est en query() ou prepare()
                $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
                return $stmt->execute($param);
        }

        $fetch = is_null($single) ? 'fetchAll' : 'fetch'; // est-ce que $single est null ? Si oui alors on utilise fetchAll() : Si non on utilise un fetch()

        $stmt = $this->db->getPDO()->$method($sql); // method pour déterminer si on est en query() ou prepare()
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);

        if ($method=='query') {               // $method strictement égale à query
            return $stmt->$fetch();          // si on a une query() on retourne directement notre résultat fetch() 
        } else {
            $stmt->execute($param);   // si différent de query alors on a rempli quelque chose dans $params donc on execute $param
            return $stmt->$fetch();         // ensuite on retourne dans tous les cas $stmt->$fetch();
        }
    }
}


?>