<?php

require_once 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Session\Session;

$session = new \Symfony\Component\HttpFoundation\Session\Session();
$session->start();

$artistQuery = new \Itp\Music\ArtistQuery();
$artists = $artistQuery->getAll();

$genreQuery = new \Itp\Music\GenreQuery();
$genres = $genreQuery->getAll();

if (isset($_POST['submit'])){
$title = $_POST['title'];
$artistID = $_POST['artist'];
$genreID = $_POST['genre'];
$price = $_POST['price'];

    $song = new \Itp\Music\Song();
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
        $message = "The song: '" . $song->getTitle() . "' with an ID " . $song->getID(). " was successfully added."; 
        $session->getFlashBag()->add('song-added', $message);
        header('Location: add-song.php');
        exit;
        
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

      <?php
            foreach ($session->getFlashBag()->get('song-added') as $message) {
                        echo $message. "<br/>";
                    } 
                ?>

        <br/>
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
   
    </body>
    
    
</html>