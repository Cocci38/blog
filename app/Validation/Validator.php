<?php

namespace App\Validation;

class Validator{

    private $data;
    private $errors;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function validate(array $rules): ?array
    {
        foreach ($rules as $name => $rulesArray) { // $name correspond au name des inputs et des colonnes de la bdd $rulesArray c'est le tableau validate dans UserController.php
            if (array_key_exists($name, $this->data)) { //est-ce que la clé $name existe dans le tableau de donnée $this->data
                foreach ($rulesArray as $rule) {
                    switch ($rule) {
                        case 'required':
                            $this->required($name, $this->data[$name]);
                            break;
                        case substr($rule, 0, 3) === 'min': // Savoir si les 3 premiers caractères sont strictement identique
                            $this->min($name, $this->data[$name], $rule);
                        default:
                            # code...
                            break;
                    }
                }
            }
        }
        return $this->getErrors();
    }

    private function required(string $name, string $value)
    {
        $value = trim($value);

        if (!isset($value) || is_null($value) || empty($value)) {  // Si value est différent de isset OU est null OU est vide
            $this->errors[$name][] = "{$name} est requis.";  // dans ce cas là j'ai une erreur
        }
    }

    private function min(string $name, string $value, string $rule)
    {
        preg_match_all('/(\d+)/', $rule, $matches); // rechercher un certain partern dans la chaine de caractère (tous les caractères numérique)
        $limit = (int) $matches[0][0];

        if (strlen($value) < $limit) { // Si le nombre de caractère de $value est strictement inférieur à $limit
            $this->errors[$name][] = "{$name} doit comprendre un minimum de {$limit} caractères"; // dans ce cas là j'ai une erreur
        }
    }

    private function getErrors(): ?array
    {
        return $this->errors;
    }
}




?>