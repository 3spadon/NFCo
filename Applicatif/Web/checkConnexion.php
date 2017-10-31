<?php

  if(isset($_SESSION['pseudo']) && isset($_SESSION['password'])){
    $bdd = new PDO('mysql:host=localhost;dbname=NFCo;charset=utf8', 'root', 'root');
    $reponse = $bdd->query('SELECT id FROM utilisateurs WHERE pseudo = "'.$_SESSION['pseudo'].'" AND password=SHA1("'.$_SESSION['password'].'")');
    $nbLignes = $reponse->rowCount(); //On compte le nombre de lignes renvoyées
    if($nbLignes!=1) //si une ligne, alors une correspondance, càd une bonne combinaison pseudo/mdp
      {
          echo "<SCRIPT LANGUAGE='JavaScript'>document.location.href='index.php'</SCRIPT>";
      }
  }
  else{
      echo "<SCRIPT LANGUAGE='JavaScript'>document.location.href='index.php'</SCRIPT>";
  }

?>
