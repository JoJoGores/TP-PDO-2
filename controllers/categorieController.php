<?php
$action=$_GET['action'];
switch($action){
    case 'list':
        $lesCategories=Categorie::findAll();
        include('vues/listeCategories.php');
        break;
    case 'add':
        $mode="Ajouter";
        include('vues/formCategorie.php');
        break;
    case 'update':
        $mode="Modifier";
        $categorie=Categorie::findById($_GET['num']);
        include('vues/formCategorie.php');
        break;
    case 'delete':
        $categorie=Categorie::findById($_GET['num']);
        $nb=Categorie::delete($categorie);
        if($nb==1){
            $_SESSION['message']=["success"=>"La categorie a bien été supprimé"];
        }else{
            $_SESSION['message']=["danger"=>"La categorie n'a pas été supprimé"];
        }
        header('location: index.php?uc=categories&action=list');
        break;
    case 'valideForm':
        $categorie= new Categorie();
        if(empty($_POST['num'])){
            $categorie->setLibelle($_POST['libelle']);
            $nb=Categorie::add($categorie);
            $message = "ajoutée";  
        }else{
            $categorie->setLibelle($_POST['libelle']);
            $categorie->setNum($_POST['num']);
            $nb=Categorie::update($categorie);
            $message = "modifiée";  
        }

        if($nb==1){
            $_SESSION['message']=["success"=>"La categorie a bien été $message"];
        }else{
            $_SESSION['message']=["danger"=>"La categorie n'a pas été $message"];
        }
        header('location: index.php?uc=categories&action=list');
        break;
}



?>