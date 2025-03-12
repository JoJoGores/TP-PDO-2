<?php
$action = $_GET['action'];
switch($action){
    case 'list':
        
        $libelle = "";
        $continentSel = "Tous";
        if (!empty($_POST['libelle']) || !empty($_POST['continentSel'])) {
            $libelle = $_POST['libelle'];
            $continentSel = $_POST['continentSel'];
        }
        $lesContinents = Continent::findAll();
        $lesNationalites = Nationalite::findAll($libelle, $continentSel);
        include('vues/nationalite/listeNationalite.php');
        break;

    case 'add':
        $mode = "Ajouter";
        $lesContinents = Continent::findAll();
        include('vues/nationalite/formNationalite.php');
        break;

    case 'update':
        $mode = "Modifier";
        $lesContinents = Continent::findAll();
        $laNationalite = Nationalite::findById($_GET['num']);
        include('vues/nationalite/formNationalite.php');
        break;

    case 'delete':
        $laNationalite = Nationalite::findById($_GET['num']);
        $nb = Nationalite::delete($laNationalite);
        if ($nb == 1) {
            $_SESSION['message'] = ["success" => "La nationalitée a bien été supprimée"];
        } else {
            $_SESSION['message'] = ["danger" => "La nationalitée n'a pas été supprimée"];
        }
        header('location:index.php?uc=nationalite&action=list');
        break;

    case 'validerForm':
        $nationalite = new Nationalite();
        $continent = Continent::findById($_POST['continent']);
        $nationalite->setLibelle($_POST['libelle'])
                    ->setContinent($continent);
        if (empty($_POST['num'])) { 
            $nb = Nationalite::add($nationalite);
            $message = "ajoutée"; 
        } else { 
            $nationalite->setNum(($_POST["num"]));
            $nb = Nationalite::update($nationalite);
            $message = "modifiée";
        }
        if ($nb == 1) {
            $_SESSION['message'] = ["success" => "La nationalitée a bien été $message"];
        } else {
            $_SESSION['message'] = ["danger" => "La nationalitée n'a pas été $message"];
        }
        header('location:index.php?uc=nationalite&action=list');
        break;
}
