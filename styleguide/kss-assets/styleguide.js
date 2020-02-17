(function($) {
    // Plugin initialization Bootstrap Scrollspy
    var scrollSpyItem = '#scrollspy';
    $('body').scrollspy({
      target: scrollSpyItem,
      offset: $('.navbar').outerHeight(true),
    });

    $(scrollSpyItem).find('a').on('click', function(e){
      if (this.hash !== "") {
        e.preventDefault();
        var hash = this.hash;
        $('html, body').animate({
          scrollTop: $(hash).offset().top - $('.navbar').outerHeight(true) +1,
        }, 300);
      }
    });

    var bLazy = new Blazy();

    // var citiesForAutocomplete = [
    //   "Paris",
    //   "Marseille",
    //   "Lyon",
    //   "Toulouse",
    //   "Nice",
    //   "Nantes",
    //   "Strasbourg",
    //   "Montpellier",
    //   "Bordeaux",
    //   "Lille",
    //   "Rennes",
    //   "Reims",
    //   "Le Havre",
    //   "Saint-Étienne",
    //   "Toulon",
    //   "Grenoble",
    //   "Dijon",
    //   "Nîmes",
    //   "Angers",
    //   "Villeurbanne",
    //   "Le Mans",
    //   "Saint-Denis",
    //   "Aix-en-Provence",
    //   "Clermont-Ferrand",
    //   "Brest",
    //   "Limoges",
    //   "Tours",
    //   "Amiens",
    //   "Perpignan",
    //   "Metz",
    //   "Besançon",
    //   "Orléans"
    // ];
  
    // $('.form-autocomplete').autocomplete({
    //   source: citiesForAutocomplete
    // });

    // Attach autosize listener.
    autosize($('.form-control--autogrow'));

  })(jQuery);
