<?php

namespace App\Models;

class Post extends Model{

    protected $table = 'posts';

    public function getCreatedAt() : string // : string avec return
    {
        return $this->created_at;
    }
}


?>