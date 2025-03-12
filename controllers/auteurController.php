<?php
$action=$_GET['action'];
switch($action){
        case 'list';
            $lesAuteurs = Auteur::findAll();
            include('vues/auteur/listeAuteur.php');
            break;

        case 'add';
            $mode="Ajouter";
            $lesNationalites=Nationalite::findAll();
            include('vues/auteur/formAuteur.php');
            break;

        case 'update';
            $mode="Modifier";
            $auteur=Auteur::findById($_GET['num']);
            include('vues/auteur/formAuteur.php');
            break;

        case 'delete';
            $auteur=Auteur::findById($_GET['num']);
            $nb=Auteur::delete($auteur);
            if($nb==1){
                $_SESSION['message']=["success"=>"L'auteur a bien été supprimé"];
            }else{
                $_SESSION['message']=["danger"=>"L'auteur n'a pas été supprimé"];
            }
            header('location:index.php?uc=auteur&action=list');
            break;

        case 'valideForm';
            $auteur=new Auteur();
            if(empty($_POST['num'])){
                $auteur->setNom($_POST['nom']);
                $auteur->setPrenom($_POST['prenom']);
                $nation=Nationalite::findById($_POST['nationalite']);
                $auteur->setNationalite($_POST['nation']);

                $nb=Auteur::add($auteur);
                $message ="ajouté"; 
            }else{
                $auteur->setNum($_POST['num']);
                $auteur->setNom($_POST['nom']);
                $auteur->setPrenom($_POST['prenom']);
                $nation=Nationalite::findById($_POST['nationalite']);
                $auteur->setNationalite($_POST['nationalite']);

                $nb=Auteur::update($auteur);
                $message ="modifié";
            }
            if($nb==1){
                $_SESSION['message']=["success"=>"L'auteur a bien été $message"];
            }else{
                $_SESSION['message']=["danger"=>"L'auteur n'a pas été $message"];
            }
            header('location:index.php?uc=auteurs&action=list');
            break;
}