(function ($, document, window) { 
//
// Gebruiker Centraal - filters.js
// ----------------------------------------------------------------------------------
// Functionaliteit voor het toevoegen van een active class aan filters
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Tamara de Haas
// @license GPL-2.0+
// @version 3.15.9
// @link    https://github.com/ICTU/ictuwp-theme-gebruikercentraal


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
// @link    https://github.com/ICTU/ictuwp-theme-gebruikercentraal


// Vars
var header = $('.site-header'),
  mainMenu = document.querySelector('.nav-primary');
const breakpointmenu = 900; // op 900px toggle tussen desktop / mobiel

// dit is het hele menu-object. Als BUITEN dit object geklikt wordt, dan moeten alle
// menu-elementen weer ingeklapt worden
const totalMenuElement = document.getElementById("mainnav");

// Dit zijn alle menu-items met een submenu
const menuItems = document.querySelectorAll("li.menu-item-has-children");


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
      '<span class="visuallyhidden">' + menustrings.showsubmenu + ' ' + $(this).find('a:first span').text() + '</span>' +
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

      $(this).attr('aria-expanded', true).find('span').text( menustrings.closesubmenu + ' ' + menuItem.find('a:first span').text());
      menuItem.addClass('open').find('.sub-menu').attr('aria-hidden', false);
      menuItem.find('.sub-menu').removeClass('visuallyhidden');


    } else if (menuItem.hasClass('open')) {
      // Submenu is open, has to close
      $(this).attr('aria-expanded', false).find('span').text( menustrings.showsubmenu + ' ' + menuItem.find('a:first span').text());
      menuItem.removeClass('open').find('.sub-menu').attr('aria-hidden', true);
      menuItem.find('.sub-menu').addClass('visuallyhidden');
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

// functie om alle opengeklapte items in het menu weer te sluiten
function closeMenuItems() {

  var width = window.innerWidth;
  var listitems = document.querySelectorAll(".menu-item-has-children");

  Array.prototype.forEach.call(menuItems, function (el, i) {
    el.classList.remove("open");
    el.querySelector('a').setAttribute('aria-expanded', "false");

    if (width > breakpointmenu) {

      var buttonExists = el.querySelector('button');

      if (buttonExists && typeof buttonExists != 'undefined') {
        buttonExists.setAttribute('aria-expanded', "false");
        buttonExists.classList.remove('open-list');
      }
      el.querySelector('ul.sub-menu').classList.add('visuallyhidden');

    }

  });
}

// functie om te checken of binnen of buiten het menu ergens op geklikt wordt;
// als er buiten het menu ergens op geklikt wordt, dan moeten alle opengeklapte items
// in het menu weer sluiten
function istotalMenuElementMenu(event) {

  if (totalMenuElement !== event.target && !totalMenuElement.contains(event.target)) {
    closeMenuItems();
    console.log('Event is BUITEN totalmenu');
    totalMenuElement.classList.remove('hasfocus');
  }
  else {
    console.log('Event is BINNEN totalmenu');
    totalMenuElement.classList.add('hasfocus');
  }
}

document.onkeydown = function (evt) {
  // menu-items ook laten sluiten met ESC-toets
  evt = evt || window.event;
  if (evt.keyCode == 27) {
    // close with ESC
    closeMenuItems();
  }
};
document.addEventListener('click', istotalMenuElementMenu);

// =========================================================================================================
})(jQuery, document, window);
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJnYy1tYWluLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIi8vXG4vLyBHZWJydWlrZXIgQ2VudHJhYWwgLSBmaWx0ZXJzLmpzXG4vLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4vLyBGdW5jdGlvbmFsaXRlaXQgdm9vciBoZXQgdG9ldm9lZ2VuIHZhbiBlZW4gYWN0aXZlIGNsYXNzIGFhbiBmaWx0ZXJzXG4vLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4vLyBAcGFja2FnZSBnZWJydWlrZXItY2VudHJhYWxcbi8vIEBhdXRob3IgIFRhbWFyYSBkZSBIYWFzXG4vLyBAbGljZW5zZSBHUEwtMi4wK1xuLy8gQHZlcnNpb24gMy4xNS45XG4vLyBAbGluayAgICBodHRwczovL2dpdGh1Yi5jb20vSUNUVS9pY3R1d3AtdGhlbWUtZ2VicnVpa2VyY2VudHJhYWxcblxuXG52YXIgZmlsdGVyTGFiZWwgPSAkKCcuZm9ybS1pdGVtLS1maWx0ZXIgbGFiZWwnKTtcblxuZmlsdGVyTGFiZWwuY2xpY2soZnVuY3Rpb24gKCkge1xuXG4gICAgdmFyIGZvcm1JdGVtID0gJCh0aGlzKS5wYXJlbnQoKTtcblxuICAgIGlmIChmb3JtSXRlbS5maW5kKCdpbnB1dDpjaGVja2VkJykubGVuZ3RoKSB7XG4gICAgICAgIGZvcm1JdGVtLnJlbW92ZUNsYXNzKCdpcy1hY3RpdmUnKTtcbiAgICB9IGVsc2Uge1xuICAgICAgICBmb3JtSXRlbS5hZGRDbGFzcygnaXMtYWN0aXZlJyk7XG4gICAgfVxuXG59KTtcblxuXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cblxuLy9cbi8vIEdlYnJ1aWtlciBDZW50cmFhbCAtIG1lbnUuanNcbi8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbi8vIEZ1bmN0aW9uYWxpdGVpdCB2b29yIHRvbmVuIC8gdmVyYmVyZ2VuIG1vYmllbCBtZW51XG4vLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4vLyBAcGFja2FnZSBnZWJydWlrZXItY2VudHJhYWxcbi8vIEBhdXRob3IgIFRhbWFyYSBkZSBIYWFzLCBQYXVsIHZhbiBCdXVyZW5cbi8vIEBsaWNlbnNlIEdQTC0yLjArXG4vLyBAdmVyc2lvbiAzLjE1Ljlcbi8vIEBkZXNjLiAgIENUQS1rbGV1cmVuLCBhMTF5IGdyb2VuLCBzaGFyaW5nIGJ1dHRvbnMgb3B0aW9uYWwsIGJlZWxkYmFuayBDUFQgY29kZSBzZXBhcmF0aW9uLlxuLy8gQGxpbmsgICAgaHR0cHM6Ly9naXRodWIuY29tL0lDVFUvaWN0dXdwLXRoZW1lLWdlYnJ1aWtlcmNlbnRyYWFsXG5cblxuLy8gVmFyc1xudmFyIGhlYWRlciA9ICQoJy5zaXRlLWhlYWRlcicpLFxuICBtYWluTWVudSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5uYXYtcHJpbWFyeScpO1xuY29uc3QgYnJlYWtwb2ludG1lbnUgPSA5MDA7IC8vIG9wIDkwMHB4IHRvZ2dsZSB0dXNzZW4gZGVza3RvcCAvIG1vYmllbFxuXG4vLyBkaXQgaXMgaGV0IGhlbGUgbWVudS1vYmplY3QuIEFscyBCVUlURU4gZGl0IG9iamVjdCBnZWtsaWt0IHdvcmR0LCBkYW4gbW9ldGVuIGFsbGVcbi8vIG1lbnUtZWxlbWVudGVuIHdlZXIgaW5nZWtsYXB0IHdvcmRlblxuY29uc3QgdG90YWxNZW51RWxlbWVudCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibWFpbm5hdlwiKTtcblxuLy8gRGl0IHppam4gYWxsZSBtZW51LWl0ZW1zIG1ldCBlZW4gc3VibWVudVxuY29uc3QgbWVudUl0ZW1zID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChcImxpLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW5cIik7XG5cblxuZnVuY3Rpb24gbmF2RGVza3RvcCgpIHtcblxuICAvLyBSZW1vdmUgbWVudSBidXR0b24gaWYgdGhlcmVcbiAgaWYoJCgnLmJ0bi0tdG9nZ2xlLW1lbnUnKS5sZW5ndGgpe1xuICAgICQoJy5idG4tLXRvZ2dsZS1tZW51JykucmVtb3ZlKCk7XG4gIH1cblxuICAvLyBBZGQgYnV0dG9uc1xuICAkKCcubmF2LXByaW1hcnkgLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4nKS5lYWNoKGZ1bmN0aW9uICgpIHtcblxuICAgICQodGhpcykuZmluZCgnYTpmaXJzdCcpLmF0dHIoJ2FyaWEtZXhwYW5kZWQnLCB0cnVlKTtcblxuICAgIC8vIEFkZCBhIGJ1dHRvbiB0byBlYWNoIGxpbmsgd2l0aCBhIHN1Ym1lbnVcbiAgICAkKHRoaXMpLmZpbmQoJ2E6Zmlyc3QnKS5hZnRlcignPGJ1dHRvbiBjbGFzcz1cImljb24gaWNvbi0tYXJyb3cgaWNvbi0tc21hbGxcIiBhcmlhLWV4cGFuZGVkPVwiZmFsc2VcIiBkYXRhLW9sLWhhcy1jbGljay1oYW5kbGVyIGFyaWEtZXhwYW5kZWQ9XCJmYWxzZVwiPicgK1xuICAgICAgJzxzcGFuIGNsYXNzPVwidmlzdWFsbHloaWRkZW5cIj4nICsgbWVudXN0cmluZ3Muc2hvd3N1Ym1lbnUgKyAnICcgKyAkKHRoaXMpLmZpbmQoJ2E6Zmlyc3Qgc3BhbicpLnRleHQoKSArICc8L3NwYW4+JyArXG4gICAgICAnPC9idXR0b24+Jyk7XG5cbiAgICAkKHRoaXMpLmZpbmQoJy5zdWItbWVudScpLmF0dHIoJ2FyaWEtaGlkZGVuJywgdHJ1ZSk7XG4gIH0pO1xuXG4gIC8vIEFkZCBjbGFzcyBvbiBtb3VzZSBlbnRlclxuICAkKCcubWVudS1wcmltYXJ5ID4gbGkubWVudS1pdGVtLWhhcy1jaGlsZHJlbiA+IGEnKS5tb3VzZWVudGVyKGZ1bmN0aW9uICgpIHtcbiAgICBpZiAoISgkKHRoaXMpLmhhc0NsYXNzKCdvcGVuJykpKSB7XG4gICAgICAvLyBVbnNldCBvdGhlciBhY3RpdmUgaWYgdGhlcmVcbiAgICAgICQoJy5tZW51LXByaW1hcnknKS5maW5kKCcub3BlbicpLnJlbW92ZUNsYXNzKCdvcGVuJyk7XG4gICAgICAkKCcubWVudS1wcmltYXJ5JykuZmluZCgndWxbYXJpYS1oaWRkZW49XCJmYWxzZVwiXScpLmF0dHIoJ2FyaWEtaGlkZGVuJywgJ3RydWUnKTtcblxuICAgICAgLy8gQWRkIGF0dHJpYnV0ZXMgdG8gY3VycmVudCBtZW51XG4gICAgICAkKHRoaXMpLnBhcmVudCgpLmFkZENsYXNzKCdvcGVuJykuZmluZCgnLnN1Yi1tZW51JykuYXR0cignYXJpYS1oaWRkZW4nLCAnZmFsc2UnKTtcbiAgICAgICQodGhpcykuZmluZCgnYTpmaXJzdC1jaGlsZCcpLmF0dHIoJ2FyaWEtZXhwYW5kZWQnLCAndHJ1ZScpO1xuICAgIH1cbiAgfSk7XG5cbiAgLy8gQW5kIHJlbW92ZSBhZ2FpbiBvbiBtb3VzZWxlYXZlXG4gICQoJy5tZW51LXByaW1hcnkgPiBsaS5tZW51LWl0ZW0taGFzLWNoaWxkcmVuIC5zdWItbWVudScpLm1vdXNlbGVhdmUoZnVuY3Rpb24gKCkge1xuICAgIC8vIEFkZCBhdHRyaWJ1dGVzIHRvIGN1cnJlbnQgbWVudVxuICAgICQodGhpcykucGFyZW50KCkucmVtb3ZlQ2xhc3MoJ29wZW4nKTtcbiAgICAkKHRoaXMpLmF0dHIoJ2FyaWEtaGlkZGVuJywgJ3RydWUnKTtcbiAgICAkKHRoaXMpLnBhcmVudCgpLmZpbmQoJ2E6Zmlyc3QtY2hpbGQnKS5hdHRyKCdhcmlhLWV4cGFuZGVkJywgJ2ZhbHNlJyk7XG4gIH0pO1xuXG4gIC8vIEFkZCB0b2dnbGUgYmVoYXZpb3VyIG9uIGNsaWNrXG4gICQoJy5uYXYtcHJpbWFyeSAubWVudS1pdGVtLWhhcy1jaGlsZHJlbiA+IGJ1dHRvbicpLmNsaWNrKGZ1bmN0aW9uICgpIHtcbiAgICB2YXIgbWVudUl0ZW0gPSAkKHRoaXMpLnBhcmVudCgpO1xuICAgIHZhciBjdXJyZW50QWN0aXZlID0gJCgnLm5hdi1wcmltYXJ5IC5tZW51LWl0ZW0ub3BlbicpO1xuXG4gICAgaWYgKCEobWVudUl0ZW0uaGFzQ2xhc3MoJ29wZW4nKSkpIHtcbiAgICAgIC8vU3VibWVudSBpcyBjbG9zZWQsIGhhcyB0byBvcGVuXG4gICAgICBpZihjdXJyZW50QWN0aXZlLmxlbmd0aCl7XG4gICAgICAgIC8vSWYgdGhlcmUgaXMgYW5vdGhlciBpdGVtIG9wZW4gcmVtb3ZlIGl0XG4gICAgICAgIGN1cnJlbnRBY3RpdmUucmVtb3ZlQ2xhc3MoJ29wZW4nKS5maW5kKCcuc3ViLW1lbnUnKS5hdHRyKCdhcmlhLWhpZGRlbicsIHRydWUpO1xuICAgICAgICBjdXJyZW50QWN0aXZlLmZpbmQoJ2J1dHRvbicpLmF0dHIoJ2FyaWEtZXhwYW5kZWQnLCBmYWxzZSk7XG4gICAgICB9XG5cbiAgICAgICQodGhpcykuYXR0cignYXJpYS1leHBhbmRlZCcsIHRydWUpLmZpbmQoJ3NwYW4nKS50ZXh0KCBtZW51c3RyaW5ncy5jbG9zZXN1Ym1lbnUgKyAnICcgKyBtZW51SXRlbS5maW5kKCdhOmZpcnN0IHNwYW4nKS50ZXh0KCkpO1xuICAgICAgbWVudUl0ZW0uYWRkQ2xhc3MoJ29wZW4nKS5maW5kKCcuc3ViLW1lbnUnKS5hdHRyKCdhcmlhLWhpZGRlbicsIGZhbHNlKTtcbiAgICAgIG1lbnVJdGVtLmZpbmQoJy5zdWItbWVudScpLnJlbW92ZUNsYXNzKCd2aXN1YWxseWhpZGRlbicpO1xuXG5cbiAgICB9IGVsc2UgaWYgKG1lbnVJdGVtLmhhc0NsYXNzKCdvcGVuJykpIHtcbiAgICAgIC8vIFN1Ym1lbnUgaXMgb3BlbiwgaGFzIHRvIGNsb3NlXG4gICAgICAkKHRoaXMpLmF0dHIoJ2FyaWEtZXhwYW5kZWQnLCBmYWxzZSkuZmluZCgnc3BhbicpLnRleHQoIG1lbnVzdHJpbmdzLnNob3dzdWJtZW51ICsgJyAnICsgbWVudUl0ZW0uZmluZCgnYTpmaXJzdCBzcGFuJykudGV4dCgpKTtcbiAgICAgIG1lbnVJdGVtLnJlbW92ZUNsYXNzKCdvcGVuJykuZmluZCgnLnN1Yi1tZW51JykuYXR0cignYXJpYS1oaWRkZW4nLCB0cnVlKTtcbiAgICAgIG1lbnVJdGVtLmZpbmQoJy5zdWItbWVudScpLmFkZENsYXNzKCd2aXN1YWxseWhpZGRlbicpO1xuICAgIH1cbiAgfSk7XG5cbiAgLy9SZW1vdmUgb3BlblxufVxuXG5mdW5jdGlvbiBuYXZNb2JpbGUoKSB7XG5cbiAgY29uc3QgbWVudUJ0biA9ICQoJy5idG4tLXRvZ2dsZS1tZW51Jyk7XG5cbiAgLy8gVW5zZXQgZGVza3RvcCB0aGluZ3NcbiAgaWYoJCgnYnV0dG9uLmljb24nKS5sZW5ndGgpe1xuICAgICQoJ2J1dHRvbi5pY29uJykucmVtb3ZlKCk7XG4gIH1cblxuICAkKCcubmF2LXByaW1hcnkgLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4nKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICAkKHRoaXMpLmZpbmQoJy5zdWItbWVudScpLnJlbW92ZUF0dHIoJ2FyaWEtaGlkZGVuJyk7XG4gIH0pO1xuXG5cbiAgY29uc3QgbWVudUJ0bkh0bWwgPVxuICAgICc8YnV0dG9uIGNsYXNzPVwiYnRuIGJ0bi0tdG9nZ2xlLW1lbnVcIiAnICtcbiAgICAnYXJpYS1oYXNwb3B1cD1cInRydWVcIiBhcmlhLWNvbnRyb2xzPVwibWVudS1wcmltYXJ5XCIgYXJpYS1leHBhbmRlZD1cImZhbHNlXCIgYXJpYS1sYWJlbD1cIk9wZW4gbWVudVwiPicgK1xuICAgICc8aT4mI3gyMjYxOzwvaT48c3BhbiBjbGFzcz1cImJ0bl9fdGV4dFwiPk1lbnU8L3NwYW4+JyArXG4gICAgJzwvYnV0dG9uPic7XG5cbiAgaWYoIShtZW51QnRuLmxlbmd0aCkpIHtcbiAgICAkKCcuc2l0ZS1oZWFkZXIgPiAud3JhcCcpLmFwcGVuZChtZW51QnRuSHRtbCk7XG4gIH1cblxuICAkKCcuYnRuLS10b2dnbGUtbWVudScpLmNsaWNrKGZ1bmN0aW9uKCl7XG4gICAgaWYoJCh0aGlzKS5oYXNDbGFzcygnYWN0aXZlJykpe1xuICAgICAgJCh0aGlzKS5maW5kKCdpJykuaHRtbCgnJiN4MjI2MTsnKTtcbiAgICB9IGVsc2Uge1xuICAgICAgJCh0aGlzKS5maW5kKCdpJykuaHRtbCgnJnRpbWVzOycpO1xuICAgIH1cbiAgICAkKCdib2R5JykudG9nZ2xlQ2xhc3MoJ21lbnUtb3BlbicpO1xuICAgICQoJy5uYXYtcHJpbWFyeScpLnRvZ2dsZUNsYXNzKCdzaG93Jyk7XG4gICAgJCh0aGlzKS50b2dnbGVDbGFzcygnYWN0aXZlJyk7XG4gIH0pO1xuXG5cbn1cblxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG5cbi8vIG1lZGlhIHF1ZXJ5IGNoYW5nZVxuZnVuY3Rpb24gV2lkdGhDaGFuZ2UobXEpIHtcblxuICBpZiAobXEubWF0Y2hlcykge1xuICAgIC8vIHdpbmRvdyB3aWR0aCBpcyBhdCBsZWFzdCA4MzBweFxuICAgIC8vIGRvbid0IHNob3cgbWVudSBidXR0b25cbiAgICBuYXZEZXNrdG9wKGRvY3VtZW50LCB3aW5kb3cpO1xuICB9XG4gIGVsc2Uge1xuICAgIC8vIHdpbmRvdyB3aWR0aCBpcyBsZXNzIHRoYW4gODMwcHhcbiAgICAvLyBETyBzaG93IG1lbnUgYnV0dG9uXG4gICAgbmF2TW9iaWxlKGRvY3VtZW50LCB3aW5kb3cpO1xuXG4gIH1cblxufVxuXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cblxuLy8gbWVkaWEgcXVlcnkgZXZlbnQgaGFuZGxlclxuaWYgKG1hdGNoTWVkaWEgJiYgbWFpbk1lbnUpIHtcbiAgdmFyIG1xID0gd2luZG93Lm1hdGNoTWVkaWEoJyhtaW4td2lkdGg6IDkwMHB4KScpO1xuICBtcS5hZGRMaXN0ZW5lcihXaWR0aENoYW5nZSk7XG4gIFdpZHRoQ2hhbmdlKG1xKTtcbn1cblxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG5cbi8vIGZ1bmN0aWUgb20gYWxsZSBvcGVuZ2VrbGFwdGUgaXRlbXMgaW4gaGV0IG1lbnUgd2VlciB0ZSBzbHVpdGVuXG5mdW5jdGlvbiBjbG9zZU1lbnVJdGVtcygpIHtcblxuICB2YXIgd2lkdGggPSB3aW5kb3cuaW5uZXJXaWR0aDtcbiAgdmFyIGxpc3RpdGVtcyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoXCIubWVudS1pdGVtLWhhcy1jaGlsZHJlblwiKTtcblxuICBBcnJheS5wcm90b3R5cGUuZm9yRWFjaC5jYWxsKG1lbnVJdGVtcywgZnVuY3Rpb24gKGVsLCBpKSB7XG4gICAgZWwuY2xhc3NMaXN0LnJlbW92ZShcIm9wZW5cIik7XG4gICAgZWwucXVlcnlTZWxlY3RvcignYScpLnNldEF0dHJpYnV0ZSgnYXJpYS1leHBhbmRlZCcsIFwiZmFsc2VcIik7XG5cbiAgICBpZiAod2lkdGggPiBicmVha3BvaW50bWVudSkge1xuXG4gICAgICB2YXIgYnV0dG9uRXhpc3RzID0gZWwucXVlcnlTZWxlY3RvcignYnV0dG9uJyk7XG5cbiAgICAgIGlmIChidXR0b25FeGlzdHMgJiYgdHlwZW9mIGJ1dHRvbkV4aXN0cyAhPSAndW5kZWZpbmVkJykge1xuICAgICAgICBidXR0b25FeGlzdHMuc2V0QXR0cmlidXRlKCdhcmlhLWV4cGFuZGVkJywgXCJmYWxzZVwiKTtcbiAgICAgICAgYnV0dG9uRXhpc3RzLmNsYXNzTGlzdC5yZW1vdmUoJ29wZW4tbGlzdCcpO1xuICAgICAgfVxuICAgICAgZWwucXVlcnlTZWxlY3RvcigndWwuc3ViLW1lbnUnKS5jbGFzc0xpc3QuYWRkKCd2aXN1YWxseWhpZGRlbicpO1xuXG4gICAgfVxuXG4gIH0pO1xufVxuXG4vLyBmdW5jdGllIG9tIHRlIGNoZWNrZW4gb2YgYmlubmVuIG9mIGJ1aXRlbiBoZXQgbWVudSBlcmdlbnMgb3AgZ2VrbGlrdCB3b3JkdDtcbi8vIGFscyBlciBidWl0ZW4gaGV0IG1lbnUgZXJnZW5zIG9wIGdla2xpa3Qgd29yZHQsIGRhbiBtb2V0ZW4gYWxsZSBvcGVuZ2VrbGFwdGUgaXRlbXNcbi8vIGluIGhldCBtZW51IHdlZXIgc2x1aXRlblxuZnVuY3Rpb24gaXN0b3RhbE1lbnVFbGVtZW50TWVudShldmVudCkge1xuXG4gIGlmICh0b3RhbE1lbnVFbGVtZW50ICE9PSBldmVudC50YXJnZXQgJiYgIXRvdGFsTWVudUVsZW1lbnQuY29udGFpbnMoZXZlbnQudGFyZ2V0KSkge1xuICAgIGNsb3NlTWVudUl0ZW1zKCk7XG4gICAgY29uc29sZS5sb2coJ0V2ZW50IGlzIEJVSVRFTiB0b3RhbG1lbnUnKTtcbiAgICB0b3RhbE1lbnVFbGVtZW50LmNsYXNzTGlzdC5yZW1vdmUoJ2hhc2ZvY3VzJyk7XG4gIH1cbiAgZWxzZSB7XG4gICAgY29uc29sZS5sb2coJ0V2ZW50IGlzIEJJTk5FTiB0b3RhbG1lbnUnKTtcbiAgICB0b3RhbE1lbnVFbGVtZW50LmNsYXNzTGlzdC5hZGQoJ2hhc2ZvY3VzJyk7XG4gIH1cbn1cblxuZG9jdW1lbnQub25rZXlkb3duID0gZnVuY3Rpb24gKGV2dCkge1xuICAvLyBtZW51LWl0ZW1zIG9vayBsYXRlbiBzbHVpdGVuIG1ldCBFU0MtdG9ldHNcbiAgZXZ0ID0gZXZ0IHx8IHdpbmRvdy5ldmVudDtcbiAgaWYgKGV2dC5rZXlDb2RlID09IDI3KSB7XG4gICAgLy8gY2xvc2Ugd2l0aCBFU0NcbiAgICBjbG9zZU1lbnVJdGVtcygpO1xuICB9XG59O1xuZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBpc3RvdGFsTWVudUVsZW1lbnRNZW51KTtcblxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4iXSwiZmlsZSI6ImdjLW1haW4tZGVidWcuanMifQ==
