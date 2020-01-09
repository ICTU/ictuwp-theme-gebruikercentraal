
# sh '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/gebruiker-centraal/distribute.sh' &>/dev/null


# clear the log file

> '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/debug.log'


# copy to temp dir
rsync -r -a -v --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/gebruiker-centraal/' '/shared-paul-files/Webs/temp/'

# clean up temp dir
rm -rf '/shared-paul-files/Webs/temp/.codekit-cache/'
rm -rf '/shared-paul-files/Webs/temp/.git/'
rm '/shared-paul-files/Webs/temp/config.codekit'
rm '/shared-paul-files/Webs/temp/config.codekit3'
rm '/shared-paul-files/Webs/temp/distribute.sh'
rm '/shared-paul-files/Webs/temp/readme.txt'
rm '/shared-paul-files/Webs/temp/.config.codekit3'
rm '/shared-paul-files/Webs/temp/.gitignore'
rm '/shared-paul-files/Webs/temp/gebruikercentraal-wp-theme.code-workspace'



cd '/shared-paul-files/Webs/temp/'
find . -name ‘*.DS_Store’ -type f -delete
find . -name ‘*.map’ -type f -delete


# --------------------------------------------------------------------------------------------------------------------------------
# Vertalingen --------------------------------------------------------------------------------------------------------------------
# --------------------------------------------------------------------------------------------------------------------------------

rsync -r -a -v --delete '/shared-paul-files/Webs/temp/languages/' '/shared-paul-files/Webs/temp-lang/'

# remove the .pot
rm '/shared-paul-files/Webs/temp-lang/gebruikercentraal.pot'
rm '/shared-paul-files/Webs/temp-lang/e-newsletters/'

# rename the translations
mv '/shared-paul-files/Webs/temp-lang/en_US.po' '/shared-paul-files/Webs/temp-lang/gebruikercentraal-en_US.po'
mv '/shared-paul-files/Webs/temp-lang/en_US.mo' '/shared-paul-files/Webs/temp-lang/gebruikercentraal-en_US.mo'

mv '/shared-paul-files/Webs/temp-lang/en_GB.po' '/shared-paul-files/Webs/temp-lang/gebruikercentraal-en_GB.po'
mv '/shared-paul-files/Webs/temp-lang/en_GB.mo' '/shared-paul-files/Webs/temp-lang/gebruikercentraal-en_GB.mo'

mv '/shared-paul-files/Webs/temp-lang/nl_NL.po' '/shared-paul-files/Webs/temp-lang/gebruikercentraal-nl_NL.po'
mv '/shared-paul-files/Webs/temp-lang/nl_NL.mo' '/shared-paul-files/Webs/temp-lang/gebruikercentraal-nl_NL.mo'

# copy files to /wp-content/languages/themes
rsync -ah '/shared-paul-files/Webs/temp-lang/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/languages/themes/'
rsync -ah '/shared-paul-files/Webs/temp-lang/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/accept/www/wp-content/languages/themes/'
rsync -ah '/shared-paul-files/Webs/temp-lang/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/live/www/wp-content/languages/themes/'

# remove temp dir
rm -rf '/shared-paul-files/Webs/temp-lang/'
rmdir '/shared-paul-files/Webs/temp-lang/'

# ------------------

# echo 'extra opschonen'
# sed -i '.bak' 's/# sourceMappingURL=style.css.map/ Wat zit je haar leuk/g' '/shared-paul-files/Webs/temp/style.css'
# sed -i '.bak' 's/# sourceMappingURL=blogberichten.css.map/ Wat zit je haar leuk/g' '/shared-paul-files/Webs/temp/blogberichten.css'

rm '/shared-paul-files/Webs/temp/blogberichten.css.map'
rm '/shared-paul-files/Webs/temp/style.css.map'
rm '/shared-paul-files/Webs/temp/blogberichten.css.bak'
rm '/shared-paul-files/Webs/temp/style.css.bak'
find . -name ‘*.bak’ -type f -delete


# 
# ------------------
echo 'naar sentia folder: accept'
rsync -r -a -v --delete '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/accept/www/wp-content/themes/gebruiker-centraal/'

echo 'naar development folder, versiebackup: 3.29.2'
rsync -r -a -v --delete '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/xxx_old_versions/gebruiker-centraal-3.29.2/'

echo 'naar sentia folder: accept, versiebackup 3.29.2'
rsync -r -a -v --delete '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/accept/www/wp-content/themes/XXX_oude_versies/gebruiker-centraal-3.29.2/'



echo 'naar sentia folder: live'
rsync -r -a -v --delete '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/live/www/wp-content/themes/gebruiker-centraal/'

echo 'naar sentia folder: live, versiebackup 3.29.2'
rsync -r -a -v --delete '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/live/www/wp-content/themes/XXX_oude_versies/gebruiker-centraal-3.29.2/'


# remove temp dir
rm -rf '/shared-paul-files/Webs/temp/'


echo 'Klaar, handjes wassen'
