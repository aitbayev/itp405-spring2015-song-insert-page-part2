<?php

namespace Itp\Music;

class Song extends \Itp\Base\Database{
    private $title;
    private $artistID;
    private $genreID;
    private $price;
    private $id;
    
    public function setTitle($title){
        $this->title = $title;
    }
    
    public function setArtistId($artist_id){
        $this->artistID = $artist_id;
    }
    
    public function setGenreId($genre_id){
        $this->genreID = $genre_id;
    }
    
    public function setPrice($price){
        $this->price = $price;
    }
    
    public function save(){
        $sql = "INSERT INTO songs(title, artist_id, genre_id, price, added, created_at, updated_at)
                 VALUES (?, ?, ?, ?, NOW(), NOW(), NOW())
        ";
        $statement = static::$pdo->prepare($sql);
        
        $statement->bindParam(1, $this->title);
        $statement->bindParam(2, $this->artistID);
        $statement->bindParam(3, $this->genreID);
        $statement->bindParam(4, $this->price);

        $statement->execute();
        
        $this->id = static::$pdo->lastInsertId();
        
    }
    
    public function getTitle(){
        return $this->title;
    }
    
    public function getId(){
        return $this->id;
    }
}

?>