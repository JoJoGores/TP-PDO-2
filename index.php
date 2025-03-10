<?php ob_start();
session_start(); 
include "vues/header.php" ;
include "vues/messagesFlash.php";
include "modeles/monPdo.php";
include "modeles/Continent.php";
include "modeles/Nationalite.php";
include "modeles/Auteur.php";
include "modeles/Livre.php";
include "modeles/Genre.php";


$uc = empty($_GET['uc']) ? "accueil" : $_GET['uc'];

switch($uc){
    case 'accueil':
        include('vues/accueil.php');
        break;
    case 'continent':
        include('controllers/continentController.php');
        break;   
    case 'nationalite':
        include('controllers/nationaliteController.php');
        break;
    case 'auteur':
        include('controllers/auteurController.php');
        break;
    case 'livre':
        include('controllers/livreController.php');
        break;
    case 'genre':
        include('controllers/genreController.php');
        break;
   
}

include "vues/footer.php";?>
