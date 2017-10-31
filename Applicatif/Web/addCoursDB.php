<?php
session_start();
include('checkConnexion.php');

//On vérifie les champs du formulaire côté-serveur
if($_POST['intitule']){
    $intitule=$_POST['intitule'];
}
else{
    echo "Veuillez remplir l'intitulé.";
}

if($_SESSION['pseudo']){
  $enseignant=$_SESSION['pseudo'];
}
else{
  echo "Vous semblez ne pas être connecté: votre variable de session est inexistante.";
}

if($_POST['dateCours']){
  $date=$_POST['dateCours'];
}
else{
  echo "Veuillez remplir le champ date.";
}

$dateAjout=date("Y-m-d H:i:s");

if($_POST['filiere']){
  $filiere=$_POST['filiere'];
}
else{
  echo "Veuillez remplir le champ filière.";
}

if($_POST['TD']){
  $TD=$_POST['TD'];
}
else{
  $TD=0;
}

if($_POST['TP']){
  $TP=$_POST['TP'];
}
else{
  $TP=0;
}

if($_POST['classeEntiere']=='1'){
  $classeEntiere=1;
}
else{
  $classeEntiere=0;
}


try
{
 $bdd = new PDO('mysql:host=localhost;dbname=NFCo;charset=utf8', 'root', 'root'); //CONNEXION À LA BDD

}
 catch (Exception $e)
 {
         die('Erreur : ' . $e->getMessage()); //Si il y'a une erreur l'afficher
 }


 $req=$bdd->prepare("INSERT INTO `cours` (`id`, `dateAjout`, `intitule`, `enseignant`, `dateCours`, `filiere`, `classeEntiere`, `TD`, `TP`) VALUES(:id, :dateAjout, :intitule, :enseignant, :dateCours, :filiere, :classeEntiere, :TD, :TP)");
 $req->execute(array(
     'id'=>NULL,
     'dateAjout'=>$dateAjout,
     'intitule' => $intitule,
     'enseignant' => $enseignant,
     'dateCours' => $date,
     'filiere' => $filiere,
     'classeEntiere' => $classeEntiere,
     'TD' => $TD,
     'TP' => $TP
     ));

   header('Location: creerCours.php');

 ?>
