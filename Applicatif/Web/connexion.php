<?php
session_start();
 try
 {
  $bdd = new PDO('mysql:host=localhost;dbname=NFCo;charset=utf8', 'root', 'root'); //CONNEXION À LA BDD

  if (!empty($_POST['pseudo']) && !empty($_POST['password'])){ //Si les champs pseudo/mot de passe ne sont pas vides

    $_SESSION['pseudo']=htmlentities($_POST["pseudo"]);
    $_SESSION['password']=htmlentities($_POST["password"]);
    $reponse = $bdd->query('SELECT id FROM utilisateurs WHERE pseudo = "'.$_SESSION['pseudo'].'" AND password=SHA1("'.$_SESSION['password'].'")');

    $nbLignes = $reponse->rowCount(); //On compte le nombre de lignes renvoyées
    if($nbLignes==1) //si une ligne, alors une correspondance, càd une bonne combinaison pseudo/mdp
      {
          header('Location: accueil.php');
      }

    else
      {
          header('Location: badLogin.php');
      }

  }
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage()); //Si il y'a une erreur l'afficher
}


?>
