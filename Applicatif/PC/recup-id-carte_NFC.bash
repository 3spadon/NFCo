#!/bin/bash
<<<<<<< HEAD
#Author: SC
echo "Passez le badge devant le lecteur"
explorenfc-basic > temp.txt
echo "------------------"
more +6 temp.txt > tid      #récupere la 6eme ligne du résultat
vid=`cut -c17-32 tid`       #récupere juste l'id
echo $vid > id_carte_nfc.txt
td=`date`                   #horraire auquel la carte a été passé
total="$vid $td"            #concaténation de l'id de la carte et de son horaire
echo $total | tr -d '\r' >> log_carte_lue.txt    #enleve le retour chariot ("^m") et ajoute le résulat dans un fichier de log
=======
#author: SC
# affiche et enregistre uniquement l'id, pas de persistence des données ( écrasement des données précédentes quand on relance le script )
echo "Passez le badge devant le lecteur"
explorenfc-basic > temp.txt
echo "----------------"
more +6 temp.txt > tid
cut -c17-32 tid > id_carte_nfc.txt
>>>>>>> 581f281... recup-id_v1.2
echo "ID de la carte lue: "
cat id_carte_nfc.txt
rm -f tid temp.txt          #supression des fichiers temporaire


