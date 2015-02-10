<?php

namespace Itp\Music;

require_once __DIR__ . '/ArtistQuery.php';
require_once __DIR__ . '/GenreQuery.php';
require_once __DIR__ . '/Song.php';

$artistQuery = new ArtistQuery();
$artists = $artistQuery->getAll();

$genreQuery = new GenreQuery();
$genres = $genreQuery->getAll();

if (isset($_POST['submit'])){
$title = $_POST['title'];
$artistID = $_POST['artist'];
$genreID = $_POST['genre'];
$price = $_POST['price'];

    $song = new Song();
    $song->setTitle($title);
    $song->setArtistId($artistID);
    $song->setGenreId($genreID);
    $song->setPrice($price);
    
    if (empty($title)){
        echo "Please enter title of the song";
    }
    else if (empty($artistID)){
        echo "Please choose artist name";
    }
    else if (empty($genreID)){
        echo "Please choose genre og the song";
    }
    else if (empty($price)){
        echo "Please enter price";
    }
    else{
        $song->save();
    }
}


?>

<!DOCTYPE html>
<html>
    <head>
    <title> Song insert </title>
        <style>
            .left {
                float: left;
                width: 100px;
            }

            .right {
                margin-left:100px;
            }

           
           
            </style>
    </head>
    <body>
        <h2> Add a new song </h2>
    <div>
       <?php if (isset($_POST['submit']) && !empty($title) && !empty($artistID) && !empty($genreID) && !empty($price)){ ?>
        
            <p>The song <?php echo $song->getTitle() ?>
   with an ID of <?php echo $song->getId() ?>
   was inserted successfully!</p>
     <?php   } 
        else {
        ?>
        
        </div>
    <form method ="post">
       <div class="left"> Song title </div>
       <div class="right"> <input type="text" name="title"> </input></div>
        
        
        
        <div class="left"> Artist </div>
        <div class="right"> <select name="artist">
           <option value="">Artist</option>
            <?php 
                foreach($artists as $artist){
            echo "<option value = '" .$artist['id'] . "'>" .                                                       $artist['artist_name'] . "</option>";
            
                }
            ?>
        
        
        </select>
        </div>
        
       
        <div class="left"> Genre </div>
        <div class="right"><select name="genre">
            <option value="">Genre</option>
            <?php
            foreach($genres as $genre){
                echo "<option value = '" . $genre['id'] . "'>" .
                                         $genre['genre'] . "</option>";
            }
            ?>
            
        </select>
        </div>
        
       
        
        <div class="left">Price</div> 
        
        <div class="right"><input type="text" name="price"</input> </div>
    
    
              <input type="submit" name="submit"> </input>
        

        </form>
    <?php  } ?>
    </body>
    
    
</html>