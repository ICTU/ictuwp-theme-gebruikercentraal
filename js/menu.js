
//
// Gebruiker Centraal - functions.php
// ----------------------------------------------------------------------------------
// Zonder functions geen functionaliteit, he?
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.6.6
// @desc.   mobile menu, infoblock, naming convention functions
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme

// Vars
var header      = document.querySelector('.site-header .wrap'),
    menu        = document.querySelector('.nav-primary'),
    menuButton  = document.querySelector('.menu-button');


// =========================================================================================================

function hideMenuButton(document, window, undefined) {

  header.classList.remove('menu-met-js');

  header.classList.add('geen-menu-button');

  var ele = document.getElementById("menu-button");
  
  if (ele) {
    // Remove button from page
    header.removeChild(menuButton);
  }
}

// =========================================================================================================

function showMenuButton(document, window, undefined) {

  'use strict';

  header.classList.add('menu-met-js');
  header.classList.remove('geen-menu-button');
  
  menuButton = document.createElement('button');

    
  // Button properties
  menuButton.classList.add('menu-button');
  menuButton.setAttribute('id', 'menu-button');
  menuButton.setAttribute('aria-label', 'Menu');
  menuButton.setAttribute('aria-expanded', 'false');
  menuButton.setAttribute('aria-controls', 'menu');
  menuButton.innerHTML = '<i>&#x2261;</i><b>&nbsp;menu</b>';
  
  // Menu properties
  menu.setAttribute('aria-hidden', 'true');
  menu.setAttribute('aria-labelledby', 'menu-button');
  
  // Add button to page
  header.insertBefore(menuButton, menu);
  
  // Handle button click event
  menuButton.addEventListener('click', function () {
    
    // If active...
    if (menu.classList.contains('active')) {
      // Hide

      header.classList.remove('active');

      menu.classList.remove('active');
      menu.setAttribute('aria-hidden', 'true');
      
      menuButton.setAttribute('aria-expanded', 'false');
    } else {
      // Show

      header.classList.add('active');

      menu.classList.add('active');
      menu.setAttribute('aria-hidden', 'false');

      menuButton.setAttribute('aria-expanded', 'true');
    }
  }, false);
}

// =========================================================================================================

// media query change
function WidthChange(mq) {

    if (mq.matches) {
        // window width is at least 830px
        // don't show menu button
        hideMenuButton(document, window);
    }
    else {
        // window width is less than 830px
        // DO show menu button
        showMenuButton(document, window);

    }

}

// =========================================================================================================

// media query event handler
if (matchMedia) {
    var mq = window.matchMedia('(min-width: 830px)');
    mq.addListener(WidthChange);
    WidthChange(mq);
}


// =========================================================================================================

