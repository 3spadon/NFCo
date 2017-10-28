<?php
function listeEtudiants($filiere,$annee){
  try
  {
   $bdd = new PDO('mysql:host=localhost;dbname=NFCo;charset=utf8', 'root', 'root'); //CONNEXION À LA BDD

 }
 catch (Exception $e)
 {
         die('Erreur : ' . $e->getMessage()); //Si il y'a une erreur l'afficher
 }

 $reponse = $bdd->query('SELECT * FROM etudiants WHERE filière = "'.$filiere.'" AND année="'.$annee.'"');
 echo "<TABLE BORDER='1'><CAPTION> Etudiants en ".$filiere."".$annee."A </CAPTION><TR><TH> Nom </TH><TH> Prénom </TH><TH> Numéro étudiant </TH></TR>";
 while ($donnees = $reponse->fetch())
 {
  echo"<TR><TD>".$donnees["nom"]."</TD><TD>".$donnees["prenom"]."</TD><TD>".$donnees["numEtudiant"]."</TD></TR>";
 }
 echo"</TABLE>";
$reponse->closeCursor();
}




 ?>
