<!DOCTYPE html>
<?php
session_start();
include('checkConnexion.php');
?>

<html lang="fr">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Vincent Bouchez">

    <title>NFCo | Présence</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="Css/style.css" rel="stylesheet">
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-lighter fixed-top">
      <div class="container">
		<img src="img/logo_uga.png" alt="logo UGA">
		<img src="img/logo_iut.jpg" class="logo_iut" alt="logo IUT de Valence">
        <a class="navbar-brand" href="accueil.php">NFCo | Gestionnaire d'absences</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="accueil.php">Accueil
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="creerCours.php">Mes cours</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="checkCours.php">Appel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="deconnexion.php">Déconnexion</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
      <div class="row tabForm">
        <div class="col-lg-12 text-center">
          <div id="formAccueil">
          <form method="post" action="checkCours.php" >
            Cours <SELECT name="cours" size="3" class="formCours">
                <?php
                $jourHier=date("d")-1;
                $dateHier=date("Y")."-".date("m")."-".$jourHier." ".date("H").":".date("i").":".date("s");
                  try
                  {
                   $bdd = new PDO('mysql:host=localhost;dbname=NFCo;charset=utf8', 'root', 'root'); //CONNEXION À LA BDD

                 }
                 catch (Exception $e)
                 {
                         die('Erreur : ' . $e->getMessage()); //Si il y'a une erreur l'afficher
                 }
                 //On affiche seulement les cours enseignés par le professeur connecté
                 $reponse = $bdd->query('SELECT cours.intitule FROM cours WHERE cours.Enseignant="'.$_SESSION['pseudo'].'"');
                 //$reponse = $bdd->query('SELECT cours.intitule FROM cours WHERE cours.Enseignant="'.$_SESSION['pseudo'].'" AND cours.dateCours>"'.$dateHier.'"');
                 while ($donnees = $reponse->fetch())
                 {
                  echo "<OPTION>".$donnees["intitule"];//On liste les cours associés au professeur connecté
                 }

                $reponse->closeCursor();

                ?>

                </SELECT>
                <input type="submit" value="Lister">
            </div>

    		  </form>

        </div>
      </div>
      <br>
<!---  On liste les élèves enregistrés--->
      <div class="row">
        <div class="col-lg-10 text-center">
          <div id="tableau">
          <?php
          if($_POST['cours']){
              $cours=$_POST['cours'];

                try
                {
                 $bdd = new PDO('mysql:host=localhost;dbname=NFCo;charset=utf8', 'root', 'root'); //CONNEXION À LA BDD

               }
               catch (Exception $e)
               {
                       die('Erreur : ' . $e->getMessage()); //Si il y'a une erreur l'afficher
               }


              //  $reponse = $bdd->query('SELECT etudiants.nom,etudiants.prenom,presence.dateCheckin FROM etudiants JOIN presence ON etudiants.id=presence.idEtudiant JOIN CoursWHERE presence.idEtudiant="1"');
               $reponse = $bdd->query('SELECT etudiants.nom,etudiants.prenom,presence.dateCheckin FROM cours JOIN presence ON cours.id=presence.idCours JOIN etudiants ON etudiants.id=presence.idEtudiant WHERE cours.id=(SELECT id FROM cours WHERE intitule="'.$_POST['cours'].'")');
               echo "<style>CAPTION{caption-side:top;margin-left:5px;}TABLE{border-radius: 5px;overflow: hidden;}TD,TH{border: 4px solid grey;padding:3px;width:150px;}</style>";
                echo "<TABLE BORDER='1'><CAPTION> Cours de <b>".$_POST['cours']."</b> enseigné par <b>".$_SESSION['pseudo']."</b> </CAPTION><TR><TH> Nom </TH><TH> Prénom </TH><TH> Enregistrement </TH></TR>";

               while ($donnees = $reponse->fetch())
               {
                echo"<TR><TD  class='td'>".$donnees["nom"]."</TD><TD>".$donnees["prenom"]."</TD><TD>".$donnees["dateCheckin"]."</TD></TR>";
               }
                echo"</TABLE>";

              $reponse->closeCursor();
          }
          ?></div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
