//
// Gebruiker Centraal - filters.js
// ----------------------------------------------------------------------------------
// Functionaliteit voor het toevoegen van een active class aan filters
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Tamara de Haas
// @license GPL-2.0+
// @version 3.15.9
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme


var filterLabel = $('.form-item--filter label');

filterLabel.click(function () {

    var formItem = $(this).parent();

    if (formItem.find('input:checked').length) {
        formItem.removeClass('is-active');
    } else {
        formItem.addClass('is-active');
    }

});


// =========================================================================================================
