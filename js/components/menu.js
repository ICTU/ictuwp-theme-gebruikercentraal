//
// Gebruiker Centraal - menu.js
// ----------------------------------------------------------------------------------
// Functionaliteit voor tonen / verbergen mobiel menu
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Tamara de Haas, Paul van Buuren
// @license GPL-2.0+
// @version 3.15.9
// @desc.   CTA-kleuren, a11y groen, sharing buttons optional, beeldbank CPT code separation.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme


// Vars
var header = $('.site-header'),
  mainMenu = document.querySelector('.nav-primary');


function navDesktop() {

  // Remove menu button if there
  if($('.btn--toggle-menu').length){
    $('.btn--toggle-menu').remove();
  }

  // Add buttons
  $('.nav-primary .menu-item-has-children').each(function () {

    $(this).find('a:first').attr('aria-expanded', true);

    // Add a button to each link with a submenu
    $(this).find('a:first').after('<button class="icon icon--arrow icon--small" aria-expanded="false" data-ol-has-click-handler aria-expanded="false">' +
      '<span class="visuallyhidden">Open submenu ' + $(this).find('a:first span').text() + '</span>' +
      '</button>');

    $(this).find('.sub-menu').attr('aria-hidden', true);
  });

  // Add class on mouse enter
  $('.menu-primary > li.menu-item-has-children > a').mouseenter(function () {
    if (!($(this).hasClass('open'))) {
      // Unset other active if there
      $('.menu-primary').find('.open').removeClass('open');
      $('.menu-primary').find('ul[aria-hidden="false"]').attr('aria-hidden', 'true');

      // Add attributes to current menu
      $(this).parent().addClass('open').find('.sub-menu').attr('aria-hidden', 'false');
      $(this).find('a:first-child').attr('aria-expanded', 'true');
    }
  });

  // And remove again on mouseleave
  $('.menu-primary > li.menu-item-has-children .sub-menu').mouseleave(function () {
    // Add attributes to current menu
    $(this).parent().removeClass('open');
    $(this).attr('aria-hidden', 'true');
    $(this).parent().find('a:first-child').attr('aria-expanded', 'false');
  });

  // Add toggle behaviour on click
  $('.nav-primary .menu-item-has-children > button').click(function () {
    var menuItem = $(this).parent();
    var currentActive = $('.nav-primary .menu-item.open');

    if (!(menuItem.hasClass('open'))) {
      //Submenu is closed, has to open
      if(currentActive.length){
        //If there is another item open remove it
        currentActive.removeClass('open').find('.sub-menu').attr('aria-hidden', true);
        currentActive.find('button').attr('aria-expanded', false);
      }

      $(this).attr('aria-expanded', true).find('span').text('Sluit ' + menuItem.find('a:first span').text());
      menuItem.addClass('open').find('.sub-menu').attr('aria-hidden', false);

    } else if (menuItem.hasClass('open')) {
      // Submenu is open, has to close
      $(this).attr('aria-expanded', false).find('span').text('Open ' + menuItem.find('a:first span').text());
      menuItem.removeClass('open').find('.sub-menu').attr('aria-hidden', true);
    }
  });

  //Remove open
}

function navMobile() {

  const menuBtn = $('.btn--toggle-menu');

  // Unset desktop things
  if($('button.icon').length){
    $('button.icon').remove();
  }

  $('.nav-primary .menu-item-has-children').each(function () {
    $(this).find('.sub-menu').removeAttr('aria-hidden');
  });


  const menuBtnHtml =
    '<button class="btn btn--toggle-menu" ' +
    'aria-haspopup="true" aria-controls="menu-primary" aria-expanded="false" aria-label="Open menu">' +
    '<i>&#x2261;</i><span class="btn__text">Menu</span>' +
    '</button>';

  if(!(menuBtn.length)) {
    $('.site-header > .wrap').append(menuBtnHtml);
  }

  $('.btn--toggle-menu').click(function(){
    if($(this).hasClass('active')){
      $(this).find('i').html('&#x2261;');
    } else {
      $(this).find('i').html('&times;');
    }
    $('body').toggleClass('menu-open');
    $('.nav-primary').toggleClass('show');
    $(this).toggleClass('active');
  });


}

// =========================================================================================================

// media query change
function WidthChange(mq) {

  if (mq.matches) {
    // window width is at least 830px
    // don't show menu button
    navDesktop(document, window);
  }
  else {
    // window width is less than 830px
    // DO show menu button
    navMobile(document, window);

  }

}

// =========================================================================================================

// media query event handler
if (matchMedia && mainMenu) {
  var mq = window.matchMedia('(min-width: 900px)');
  mq.addListener(WidthChange);
  WidthChange(mq);
}


// =========================================================================================================
