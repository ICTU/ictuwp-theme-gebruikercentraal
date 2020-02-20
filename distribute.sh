
# sh '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/gebruiker-centraal/distribute.sh' &>/dev/null


# clear the log file

> '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/debug.log'


# copy to temp dir
rsync -r -a -v --delete '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/gebruiker-centraal/' '/Users/paul/shared-paul-files/Webs/temp/'

# clean up temp dir
rm -rf '/Users/paul/shared-paul-files/Webs/temp/.codekit-cache/'
rm -rf '/Users/paul/shared-paul-files/Webs/temp/.git/'
rm -rf '/Users/paul/shared-paul-files/Webs/temp/.idea/'
rm -rf '/Users/paul/shared-paul-files/Webs/temp/node_modules/'
rm -rf '/Users/paul/shared-paul-files/Webs/temp/frontend/'


rm '/Users/paul/shared-paul-files/Webs/temp/config.codekit'
rm '/Users/paul/shared-paul-files/Webs/temp/config.codekit3'
rm '/Users/paul/shared-paul-files/Webs/temp/distribute.sh'
rm '/Users/paul/shared-paul-files/Webs/temp/readme.txt'
rm '/Users/paul/shared-paul-files/Webs/temp/.config.codekit3'
rm '/Users/paul/shared-paul-files/Webs/temp/.gitignore'
rm '/Users/paul/shared-paul-files/Webs/temp/.idea'
rm '/Users/paul/shared-paul-files/Webs/temp/gebruikercentraal-wp-theme.code-workspace'
rm '/Users/paul/shared-paul-files/Webs/temp/yarn.lock'
rm '/Users/paul/shared-paul-files/Webs/temp/gulpfile.js'
rm '/Users/paul/shared-paul-files/Webs/temp/package.json'




cd '/Users/paul/shared-paul-files/Webs/temp/'
find . -name "*.code-workspace" -type f -delete
find . -name "*.DS_Store" -type f -delete
find . -name "*.map" -type f -delete


# --------------------------------------------------------------------------------------------------------------------------------
# Vertalingen --------------------------------------------------------------------------------------------------------------------
# --------------------------------------------------------------------------------------------------------------------------------

rsync -r -a -v --delete '/Users/paul/shared-paul-files/Webs/temp/languages/' '/Users/paul/shared-paul-files/Webs/temp-lang/'

# remove the .pot
rm '/Users/paul/shared-paul-files/Webs/temp-lang/gebruikercentraal.pot'
rm '/Users/paul/shared-paul-files/Webs/temp-lang/e-newsletters/'

# rename the translations
mv '/Users/paul/shared-paul-files/Webs/temp-lang/en_US.po' '/Users/paul/shared-paul-files/Webs/temp-lang/gebruikercentraal-en_US.po'
mv '/Users/paul/shared-paul-files/Webs/temp-lang/en_US.mo' '/Users/paul/shared-paul-files/Webs/temp-lang/gebruikercentraal-en_US.mo'

mv '/Users/paul/shared-paul-files/Webs/temp-lang/en_GB.po' '/Users/paul/shared-paul-files/Webs/temp-lang/gebruikercentraal-en_GB.po'
mv '/Users/paul/shared-paul-files/Webs/temp-lang/en_GB.mo' '/Users/paul/shared-paul-files/Webs/temp-lang/gebruikercentraal-en_GB.mo'

mv '/Users/paul/shared-paul-files/Webs/temp-lang/nl_NL.po' '/Users/paul/shared-paul-files/Webs/temp-lang/gebruikercentraal-nl_NL.po'
mv '/Users/paul/shared-paul-files/Webs/temp-lang/nl_NL.mo' '/Users/paul/shared-paul-files/Webs/temp-lang/gebruikercentraal-nl_NL.mo'

# copy files to /wp-content/languages/themes
rsync -ah '/Users/paul/shared-paul-files/Webs/temp-lang/' '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/languages/themes/'
rsync -ah '/Users/paul/shared-paul-files/Webs/temp-lang/' '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/accept/www/wp-content/languages/themes/'
rsync -ah '/Users/paul/shared-paul-files/Webs/temp-lang/' '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/live/www/wp-content/languages/themes/'

# remove temp dir
rm -rf '/Users/paul/shared-paul-files/Webs/temp-lang/'
rmdir '/Users/paul/shared-paul-files/Webs/temp-lang/'

# ------------------

rm '/Users/paul/shared-paul-files/Webs/temp/blogberichten.css.map'
rm '/Users/paul/shared-paul-files/Webs/temp/css/blogberichten.css.map'
rm '/Users/paul/shared-paul-files/Webs/temp/style.css.map'
rm '/Users/paul/shared-paul-files/Webs/temp/blogberichten.css.bak'
rm '/Users/paul/shared-paul-files/Webs/temp/style.css.bak'
find . -name ‘*.bak’ -type f -delete


# 
# ------------------
echo 'naar sentia folder: accept'
rsync -r -a -v --delete '/Users/paul/shared-paul-files/Webs/temp/' '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/accept/www/wp-content/themes/gebruiker-centraal/'

echo 'naar development folder, versiebackup: 4.3.3.a'
rsync -r -a -v --delete '/Users/paul/shared-paul-files/Webs/temp/' '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/xxx_old_versions/gebruiker-centraal-4.3.3.a/'

echo 'naar sentia folder: accept, versiebackup 4.3.3.a'
rsync -r -a -v --delete '/Users/paul/shared-paul-files/Webs/temp/' '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/accept/www/wp-content/themes/XXX_oude_versies/gebruiker-centraal-4.3.3.a/'



echo 'naar sentia folder: live'
rsync -r -a -v --delete '/Users/paul/shared-paul-files/Webs/temp/' '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/live/www/wp-content/themes/gebruiker-centraal/'

echo 'naar sentia folder: live, versiebackup 4.3.3.a'
rsync -r -a -v --delete '/Users/paul/shared-paul-files/Webs/temp/' '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/live/www/wp-content/themes/XXX_oude_versies/gebruiker-centraal-4.3.3.a/'


# remove temp dir
rm -rf '/Users/paul/shared-paul-files/Webs/temp/'


echo 'Klaar, handjes wassen'
