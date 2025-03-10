<?php
$action = isset($_GET['action']) ? $_GET['action'] : 'list'; 

switch($action) {
    case 'list':
    
        $lesContinents = Continent::findAll();
        include('vues/continent/listeContinent.php');
        break;

    case 'add':
     
        $mode = "Ajouter";
        $continent = new Continent(); 
        include('vues/continent/formContinent.php');
        break;

    case 'update':
        
        $mode = "Modifier";
      
        if (isset($_GET['num'])) {
            $continent = Continent::findById($_GET['num']);
            include('vues/continent/formContinent.php');
        } else {
            $_SESSION['message'] = ["error" => "Identifiant du continent manquant"];
            header('location:index.php?uc=continent&action=list');
            exit();
        }
        break;

    case 'delete':
        
        if (isset($_GET['num'])) {
            $continent = Continent::findById($_GET['num']);
            $nb = Continent::delete($continent);
           
            if ($nb == 1) {
                $_SESSION['message'] = ["success" => "Le continent a bien été supprimé"];
            } else {
                $_SESSION['message'] = ["error" => "Le continent n'a pas été supprimé"];
            }
        } else {
            $_SESSION['message'] = ["error" => "Identifiant du continent manquant pour suppression"];
        }
        header('location:index.php?uc=continent&action=list');
        exit();
        break;

    case 'valideForm':
        
        if (!empty($_POST['libelle'])) {
            $continent = new Continent(); 

            if (empty($_POST['num'])) {
                $continent->setLibelle($_POST['libelle']);
                $nb = Continent::add($continent);
                $message = "ajouté";
            } else {
                $continent->setNum($_POST['num']);
                $continent->setLibelle($_POST['libelle']);
                $nb = Continent::update($continent);
                $message = "modifié";
            }

           
            if ($nb == 1) {
                $_SESSION['message'] = ["success" => "Le continent a bien été $message"];
            } else {
                $_SESSION['message'] = ["error" => "Le continent n'a pas été $message"];
            }
        } else {
            $_SESSION['message'] = ["error" => "Le libellé est obligatoire"];
        }
        header('location:index.php?uc=continent&action=list');

        
        exit();
        break;

   
}
?>
