#!/bin/bash
#author: SC
# affiche et enregistre uniquement l'id, pas de persistence des données ( écrasement des données précédentes quand on relance le script )
echo "Passez le badge devant le lecteur"
explorenfc-basic > temp.txt
echo "----------------"
more +6 temp.txt > tid
cut -c17-32 tid > id_carte_nfc.txt
echo "ID de la carte lue: "
cat id_carte_nfc.txt
rm -f tid temp.txt
