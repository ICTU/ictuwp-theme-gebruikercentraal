#!/bin/sh

# set proper folder locations
WWWROOT="/home/acccentraal/www/wp-content"

#translations
LANGSOURCEDIR="${WWWROOT%%/}/themes/gebruiker-centraal/languages/"
LANGSOURCEFILES="${WWWROOT%%/}/themes/gebruiker-centraal/languages/**"

LANGTARGET="${WWWROOT%%/}/languages/themes/gebruiker-centraal/"

PREFIX="gebruiker-centraal-"

for file in ${SOURCEFILES}; do

  file_name="${file##*/}"
  file_ext="${file##*.}"

# If it's not a pot file and not a directory move to new location and prefix
if [ ! $file_ext = "pot" ] && [ ! -d "$file" ]; then

  FILESOURCE="${LANGSOURCEDIR}${file_name}"
  FILEDEST="${LANGTARGET}${PREFIX}${file_name}"

  printf "$file_name > $PREFIX$file_name \n"
fi

done
