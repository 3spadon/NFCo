#!/bin/bash
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
echo "ID de la carte lue: "
cat id_carte_nfc.txt
rm -f tid temp.txt          #supression des fichiers temporaire


