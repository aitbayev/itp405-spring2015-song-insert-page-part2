<?php

namespace Itp\Music;


class GenreQuery extends \Itp\Base\Database{
    public function getAll(){
        $sql = "SELECT genre, id
                FROM genres
        ";
        $statement = static::$pdo->prepare($sql);
        $statement -> execute();
        $genres = $statement->fetchAll();
        
        
        return $genres;
    }

}

?>