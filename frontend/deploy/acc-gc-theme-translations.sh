#!/bin/sh

# ${WPROOT}/wp-content/themes/gebruiker-centraal/frontend/deploy/acc-gc-theme-translations.sh

# WPROOT="${HOME}/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/"
WPROOT="${HOME}/www/"

LANGFOLDERSOURCE="${WPROOT%%/}/wp-content/themes/gebruiker-centraal/languages"
LANGFOLDERTARGET="${WPROOT%%/}/wp-content/languages/themes"


printf "\n\n"
printf "********************************"
printf "\n"


printf "Source folder: ${LANGFOLDERSOURCE}\n"
printf "Target folder: ${LANGFOLDERTARGET}\n"

printf "\n"

# Copy translation files to relevant target folder

printf "Files for UK English\n"
cp "${LANGFOLDERSOURCE}/en_GB.po" "${LANGFOLDERTARGET}/gebruikercentraal-en_GB.po"
cp "${LANGFOLDERSOURCE}/en_GB.mo" "${LANGFOLDERTARGET}/gebruikercentraal-en_GB.mo"

printf "Files for US English\n"
cp "${LANGFOLDERSOURCE}/en_US.po" "${LANGFOLDERTARGET}/gebruikercentraal-en_US.po"
cp "${LANGFOLDERSOURCE}/en_US.mo" "${LANGFOLDERTARGET}/gebruikercentraal-en_US.mo"

printf "Files for NL Dutch\n"
cp "${LANGFOLDERSOURCE}/nl_NL.po" "${LANGFOLDERTARGET}/gebruikercentraal-nl_NL.po"
cp "${LANGFOLDERSOURCE}/nl_NL.mo" "${LANGFOLDERTARGET}/gebruikercentraal-nl_NL.mo"


printf "\nReady...\n"
printf "********************************"
printf "\n\n"


exit

EOF
