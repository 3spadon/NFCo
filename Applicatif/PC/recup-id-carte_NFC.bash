#!/bin/bash
explorenfc-basic > temp.txt
more +6 temp.txt > tid
cut -c17-32 tid > id_carte_nfc.txt
cat id_carte_nfc.txt
rm -f tid temp.txt
