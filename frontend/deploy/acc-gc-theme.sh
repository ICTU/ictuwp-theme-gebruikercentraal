#!/bin/sh

GREEN='\033[0;32m'
NC='\033[0m' # No Color

deploypath="www/wp-content/themes/gebruiker-centraal"

ssh -T acccentraal@ictu-web-a02.sc.nines.nl << EOF

printf "\n\n"
printf "********************************"
printf "\n"
printf "\n ${GREEN}Deploy Gebruiker Centraal [ACC] ${NC}"
printf "\n ${GREEN}Logged in at Gebruiker Centraal ACC ${NC} \n"
printf "\n Servername:    ${GREEN}ictu-web-a02.sc.nines.nl ${NC}"
printf "\n Pad:           ${GREEN}$deploypath ${NC}"
printf "\n Branch:        ${GREEN}development ${NC} \n"
printf "\n"
printf "********************************"
printf "\n"

cd $deploypath

ls -la

exit

EOF