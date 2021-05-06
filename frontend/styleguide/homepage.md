<div class="hp-wrapper">

# GC Styleguide #


Dit is de Living Styleguide voor het Gebruiker Centraal thema. Hier vind je (bijna) alle componenten die gebruikt worden in de diverse layouts. Hij is beschikbaar onder URL:

[siteurl]/wp-content/themes/ictuwp-theme-gebruikercentraal/styleguide

Deze styleguide maakt gebruikt van de CSS uit het Gebruiker Centraal thema.

## 1. Front-end tools installeren ##

### 1.1 Wat heb je nodig? ###

De front-end maakt gebruik van Gulp en NodeJS. Om de CSS te kunnen compilen heb je Node, NPM (node package manager) en Yarn (frontend package manager) nodig.
Installeer dus eerst Node, NPM en Yarn volgens de online handleidingen:


- [Hoe NodeJS installeren?](https://nodejs.org/en/download/)
- [Hoe NPM installeren?](https://www.npmjs.com/get-npm)
- [Hoe Yarn installeren?](https://classic.yarnpkg.com/en/docs/install/#mac-stable)

Yarn is een package manager voor frontend packages die het een heel stukje gemakkelijker maakt onderlinge dependency problemen op te lossen.

### 1.2 Lokaal opzetten ###

- Navigeer in de terminal naar het thema "gebruiker-centraal" en daarna naar mapje "frontend"
- Typ `yarn install` . De benodigde packages, onder andere Gulp, worden geinstalleerd. De map "node_modules" wordt gegenereerd. Deze wordt niet meegecommit - hij is alleen nodig voor het compilen.
- Typ om te testen "gulp prod". Als het goed is zie je nu het bericht `gulp-notify: [Gulp notification] GC - Base Theme LESS task complete` verschijnen. Is dit niet zo? Dan is er waarschijnlijk iets nog niet goed geïnstalleerd.
- om plugins te ontwikkelen: haal de juiste plugins op via Git. Op dit moment (3 maart) hebben alle GC plugins nog een eigen GIT-repo. Het is onze bedoeling om het ontwikkelen van alle GC-gerelateerde plugins vanuit de GC-theme folder te doen. Hiermee willen we dubbele code en vergissingen voorkomen. Deze plugins zijn nu verwerkt in de sites_config:
  - [ictuwp-plugin-inclusie](https://github.com/ICTU/ictuwp-plugin-inclusie)
  - [ictuwp-plugin-conference](https://github.com/ICTU/ictuwp-plugin-conference)
  - [ictuwp-plugin-maturityscore](https://github.com/ICTU/gc-maturityscore-plugin)
  - [ictuwp-plugin-beeldbank](https://github.com/ICTU/ictuwp-plugin-beeldbank)


Deze plugins moet je hier neerzetten:

```
[WordPress root]
├── wp-content/ 
│    └── themes/
│         └── gebruiker-centraal/
│              └── development/
│                   ├── ictuwp-plugin-inclusie
│                   ├── ictuwp-plugin-conference
│                   ├── ictuwp-plugin-maturityscore
│                   └── ictuwp-plugin-beeldbank

```

### 1.3 De taken ###

De front-end is zo opgezet dat vanuit de frontend directory alle subthema's en modules gecompiled kunnen worden. 
In de "sites_config.json" vind je een overzicht van alle sites die momenteel in de configuratie zitten: 
- gebruiker-centraal is het basisthema.
- inclusie (plugin voor inclusie.gebruikercentraal.nl)
- beeldbank (plugin voor beeldbank.gebruikercentraal.nl)
- maturityscore (plugin voor volwassenheidsscan.gebruikercentraal.nl)
- conference (plugin voor conference.gebruikercentraal.nl)

#### 1.3.1 De configuratie

Iedere site in de config heeft:

- Een shortname (`name`)
- Een directory (`path`). Deze wordt gebruikt om de correcte map te kunnen watchen. 
- Een proxy (`proxy`). Deze gebruikt browsersync om front-end wijzigingen direct te kunnen zien. Met browsersync zie je wijzigingen die gemaakt worden direct in de browser én is je lokale omgeving via een URL beschikbaar voor andere devices. Je kunt dus meteen testen op mobiel of tablet.
- Plugin folders hebben ook nog een aantal andere velden:
  - `type`: plugin
  - `csssource`: de folder met daarin de bronbestanden voor de CSS (Less)
  - `cssdest`: de folder waarin de uiteindelijke CSS-bestanden terecht moeten komen
  - `pluginsource`: deze folder wordt gekopieerd naar `plugintarget`
  - `plugintarget`: de locatie waar de plugin in de plugins folder moet komen
  
  

#### 1.3.2 De front-end compilen  ####

**Voor het hoofdthema**

- `gulp` - Om het Gebruiker Centraal theme zelf te watchen typ je simpelweg "gulp" in je terminal. Browsersync wordt gestart met als proxy (lokale url) http://live-gebruikercentraal.co.uk. Iedere keer als je iets wijzigt wordt de css opnieuw gecompiled.
- `gulp prod` - Taak voor productie. Met gulp prod wordt de CSS gecompiled zonder sourcemaps. Gebruik deze taak als je klaar bent en je wil gaan committen. 
- `gulp all` - Deze taak compiled voor alle sites uit sites_config.json de CSS. Heel handig als je veel hebt gewijzigd in het basisthema. 
- `gulp js` - Deze taak compiled de javascript bestanden uit js/components tot 1 minified bestand Javascript bestand. 
- `gulp styleguide` - Deze taak compiled deze Styleguide en de CSS die nodig is voor de Styleguide . 

**Voor een plugin**

- `gulp --site=[site_name]` - Met deze taak watch je een specifieke plugin. Bijvoorbeeld `gulp --site=inclusie` of `gulp --site=beeldbank`
- `gulp prod --site=[site_name]` - Met deze taak voer je de productietaak uit voor een specifieke site. Bijvoorbeeld `gulp prod --site=beeldbank`

**Wat doet commando 'gulp'?**

Wanneer je `gulp` intikt in de terminal gebeuren de volgende dingen:

- Browsersync start met de ingegeven proxy.
- Thema 'gebruiker-centraal' less bestanden worden gewatched. Wanneer er je een wijziging maakt wordt de CSS opnieuw gecompiled en zie je de wijzigingen in je Browsersync venster. 
- Indien een site is ingegeven met --site=[site] wordt de directory van de ingegeven site ook gewatched. Bij het wijzigingen in het gebruiker-centraal thema wordt eerst de CSS van dat thema opnieuw gecompiled. Vervolgens wordt de CSS van de ingegeven site gecompiled.
- Directory js/components wordt gewatched voor wijzigingen in de javascript bestanden
- Directory frontend/styleguide wordt gewatched voor wijzigingen aan de styleguide. Wanneer er iets wordt gewijzigd in de specifieke styleguide .less wordt eerst de CSS taak en vervolgens de styleguide taak uitgevoerd.  


## 2 De werkwijze ##

Een nieuw component maken? Kijk eerst of hij hier al bestaat. Voeg 'm bij voorkeur eerst hier toe en verwerk hem vervolgens in de front-end waar nodig. Hergebruik zoveel mogelijk.

### 3.1 Gebruik als het kan BEM ### 
Bem, ofwel Block / Element / Modifier is een methodologie die veel gebruikt wordt in front-end. Het zorgt ervoor dat je herbruikbare componenten krijgt. Kort gezegd heb je een html object, een element (aangeduid met __[element]) en een modifier (zelfde component, net een beetje anders).

Voor een card bijvoorbeeld: 

- .card , 
- elementen in .card bijvoorbeeld .card__title , 
- card modifier bijvoorbeeld .card--doelgroep, card--with-image.  

Ieder component krijgt zijn eigen less. Ga er bij alles vanuit dat het overal hergebruikt moet kunnen worden en dat een component een losstaand iets is. Responsive gedrag zit in het component. Het moet in principe overal geplaatst kunnen worden.

Gebruik voor wrappers van elementen de prefix "l-" ofwel layout. Bijvoorbeeld l-content-wrapper.

[BEM door Ezra Botter](https://www.ezrabotter.com/blog/bem-block-element-modifier/)




### 1.4.2 Gebruik Atomic Design ###

Met Atomic Design bouw je met al je BEM componenten samen uiteindelijk een hele pagina. Je begint met je kleinste elementen (atomen) zoals bijvoorbeeld knopjes, inputs en linkjes. Vervolgens gebruk je die in je grotere componenten (kaartjes, teasers, lijsten) die je weer gebruikt in je nog grotere componenten (contentblokken, zijbalken). Met al deze dingen samen maak je vervolgens pagina's. 

[Atomic Design door Brad Frost](https://bradfrost.com/blog/post/atomic-web-design/)

</div>