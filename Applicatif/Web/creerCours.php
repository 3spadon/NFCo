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

    <title>NFCo | Créer un cours</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

    <!-- Custom styles for this template -->

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

    <div class="container">
      <div class="row">
        <div class="col-lg-3 text-center">
          <div id="panelCreationCours">
                <h3>Ajouter un cours</h3>
                <div id="boxCreationCours">
                  <form method="post" action="/addCoursDB.php" class="formCreerCours">
                    Intitule <input required type="text" name="intitule"><br>
                    <div class="date">Date (a-m-j h:m:s) <input required type="datetime-local" name="dateCours" value="<?php echo date("Y-m-d H:i:s");?>"></div><br>
                    Filière <SELECT required name="filiere" class="selectFiliere" size="1"><OPTION>RT<OPTION>GEA<OPTION>INFO<OPTION>TC</select><br>
                    <input type="checkbox" id="classeEntiere" name="classeEntiere" onload="checkboxClasseEntiere()" onchange="checkboxClasseEntiere()" class="checkboxClasseEntiere"> Classe entière<br>
                    <div id="selectTDTP">
                      TD <SELECT  name="TD" size="1" class="selectTDTP"><OPTION>1<OPTION>2<OPTION>3<OPTION>4</select>
                      TP <SELECT  name="TP" size="1" class="selectTDTP"><OPTION>1<OPTION>2<OPTION>3<OPTION>4</select><br>
                    </div>
                    <input type="submit" value="Ajouter le cours" class="btnAjouter" onclick="checkFormCreerCours();">
                    <script src="form.js"></script>
                    <script>

                    </script>
                    </form>
                  <p id="checked"></p>
                </div>
              </div>
          </div>
          <div class="col-lg-1"></div>
          <div class="col-lg-8 text-center listeCours">
          <?php
          session_start();

          try
          {
           $bdd = new PDO('mysql:host=localhost;dbname=NFCo;charset=utf8', 'root', 'root'); //CONNEXION À LA BDD

          }
           catch (Exception $e)
           {
                   die('Erreur : ' . $e->getMessage()); //Si il y'a une erreur l'afficher
           }

          //  $reponse = $bdd->query('SELECT etudiants.nom,etudiants.prenom,presence.dateCheckin FROM etudiants JOIN presence ON etudiants.id=presence.idEtudiant JOIN CoursWHERE presence.idEtudiant="1"');
           $reponse = $bdd->query('SELECT intitule,dateCours,classeEntiere,dateAjout,filiere,TD,TP FROM cours WHERE enseignant="'.$_SESSION['pseudo'].'" AND dateCours>"'.date("Y-m-d H:i:s").'" ORDER BY dateCours ASC'); //.$_SESSION['pseudo'].
           echo "<style>CAPTION{caption-side:top;margin-left:5px;}TABLE{border-radius: 5px;overflow: hidden;}TD,TH{border: 4px solid grey;padding:3px;width:150px;}</style>";
            echo "<TABLE BORDER='1'><CAPTION> Cours à venir</b> </CAPTION><TR><TH> Intitulé </TH><TH> Date </TH><TH> Filière </TH><TH> Classe entière </TH><TH> TD </TH><TH> TP </TH><TH> Date d'ajout </TH></TR>";

           while ($donnees = $reponse->fetch())
           {
            if($donnees['classeEntiere']==1){
              $classeEntiere="Oui";
              $TD="-";
              $TP="-";
            }
            else{
              $classeEntiere="Non";
              $TD=$donnees['TD'];
              $TP=$donnees['TP'];
            }

            echo"<TR><TD  class='td'>".$donnees["intitule"]."</TD><TD>".$donnees["dateCours"]."</TD><TD>".$donnees["filiere"]."</TD><TD>".$classeEntiere."</TD><TD>".$TD."</TD><TD>".$TP."</TD><TD>".$donnees["dateAjout"]."</TD></TR>";
           }
            echo"</TABLE>";


          $reponse->closeCursor();
          ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
