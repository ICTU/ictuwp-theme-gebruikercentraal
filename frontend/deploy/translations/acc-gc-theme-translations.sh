#!/bin/sh

GREEN='\033[0;32m'
NC='\033[0m' # No Color

# set proper folder locations
WWWROOT="/home/acccentraal/www/wp-content"

#translations

LANGSOURCEDIR="${WWWROOT}/themes/gebruiker-centraal/languages/"
LANGSOURCEFILES="${WWWROOT}/themes/gebruiker-centraal/languages/**"

LANGTARGET="${WWWROOT}/languages/themes/gebruiker-centraal"

#For newsletters

ELANGSOURCEDIR="${WWWROOT}/themes/gebruiker-centraal/languages/e-newsletters/"
ELANGSOURCEFILES="${WWWROOT}/themes/gebruiker-centraal/languages/e-newsletters/**"

ELANGTARGET="${WWWROOT}/languages/themes/gebruiker-centraal/e-newsletters"

PREFIX="gebruiker-centraal-"

printf "\n\n"
printf "********************************"
printf "\n"
printf "\n ${GREEN}Translations ${NC}\n"
printf "\n Source:      ${GREEN}$LANGSOURCEDIR ${NC}"
printf "\n Dest:        ${GREEN}$LANGTARGET ${NC} \n"
printf "\n"
printf "********************************"
printf "\n\n"

# Make directory if not there
[ ! -d "$LANGTARGET" ] && mkdir -p "$LANGTARGET"

for file in ${LANGSOURCEFILES}; do

  file_name="${file##*/}"
  file_ext="${file##*.}"

# If it's not a pot file and not a directory move to new location and prefix
if [ ! $file_ext = "pot" ] && [ ! -d "$file" ]; then

  FILESOURCE="${LANGSOURCEDIR}${file_name}"
  FILEDEST="${LANGTARGET}/${PREFIX}${file_name}"

  mv "${FILESOURCE}" "${FILEDEST}"

  printf "${GREEN}mv${NC} ${FILESOURCE} > ${FILEDEST} \n"
fi

done

# Make directory for newsletters if not there
[ ! -d "$ELANGTARGET" ] && mkdir -p "$ELANGTARGET"

for file in ${ELANGSOURCEFILES}; do

  file_name="${file##*/}"
  file_ext="${file##*.}"

# If it's not a pot file and not a directory move to new location and prefix
if [ ! $file_ext = "pot" ] && [ ! -d "$file" ]; then

  NSOURCE="${ELANGSOURCEDIR}${file_name}"
  NDEST="${ELANGTARGET}/${file_name}"

  mv "${NSOURCE}" "${NDEST}"

  printf "${GREEN}mv${NC} ${NSOURCE} > ${NDEST} \n"
fi

done
