<?php

namespace Itp\Music;

class ArtistQuery extends \Itp\Base\Database{
    public function getAll(){
        $sql = "SELECT artist_name, id
                FROM artists
        ";
        $statement = static::$pdo->prepare($sql);
        $statement -> execute();
        $artists = $statement->fetchAll();
        
        
        return $artists;
    }

}

?>