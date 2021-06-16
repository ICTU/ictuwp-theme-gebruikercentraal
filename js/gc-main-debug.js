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
  if ($('.btn--toggle-menu').length) {
    $('.btn--toggle-menu').remove();
  }

  // Add buttons
  $('.nav-primary .menu-item-has-children').each(function () {
    console.log('Add buttons');

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
      console.log('mouseenter op a');
      $('.menu-primary').find('.open').removeClass('open');
      $('.menu-primary').find('ul[aria-hidden="false"]').attr('aria-hidden', 'true');

      // Add attributes to current menu
      $(this).parent().addClass('open').find('.sub-menu').attr('aria-hidden', 'false');
      $(this).find('a:first-child').attr('aria-expanded', 'true');
    }
  });

  $('.menu-primary > li.menu-item-has-children').focusin(function () {

    var currentsubmenu = $(this).find('.sub-menu');
    var menuItem = $(this);

    var allclasses = menuItem.attr("class")
    console.log('focusin');

    if (!(menuItem.hasClass('menu-item-has-focus'))) {
      menuItem.addClass('menu-item-has-focus');
    }

  });

  $('.menu-primary > li.menu-item-has-children').focusout(function () {
      var currentsubmenu = $(this).find('.sub-menu');
      var currentbutton = $(this).find('button');
      var menuItem = $(this);

      var allclasses = menuItem.attr("class");
      console.log("focusout \n" + allclasses + "\n");

      if (menuItem.hasClass('menu-item-has-focus') && menuItem.hasClass('open')) {

        var button_has_attr_expanded = String(currentbutton.attr("aria-expanded"));
        var submenu_has_attr_ariahidden = String(currentsubmenu.attr("aria-hidden"));

        if (button_has_attr_expanded == "true" && submenu_has_attr_ariahidden == "false") {
          console.log('focusout functie menu item heeft class open, button expanded: ' + button_has_attr_expanded + ', aria hidden: ' + submenu_has_attr_ariahidden + '.');

//          closeMenuItems();
//        console.log('WOEPIEDEPOEPIE button expanded: ' + button_has_attr_expanded + ', aria hidden: ' + submenu_has_attr_ariahidden + '.');
//          menuItem.removeClass('open');
//          menuItem.removeClass('menu-item-has-focus');
//        currentbutton.attr('aria-expanded', false);
//          currentsubmenu.attr('aria-hidden', true);
        }

      }

    }
  )
  ;

// And remove again on mouseleave
  $('.menu-primary > li.menu-item-has-children .sub-menu').mouseleave(function () {

    console.log('sub-menu mouseleave');

    // Add attributes to current menu
    $(this).parent().removeClass('open');
    $(this).attr('aria-hidden', 'true');
    $(this).parent().find('a:first-child').attr('aria-expanded', 'false');

  });

// Add toggle behaviour on click
  $('.nav-primary .menu-item-has-children > button').click(function () {

    console.log('BUTTON KLIK');

    var menuItem = $(this).parent();
    var currentActive = $('.nav-primary .menu-item.open');

    if (!(menuItem.hasClass('open'))) {
      console.log('klik op button en menu item IS NIET OPEN !!!');
      //Submenu is closed, has to open
      if (currentActive.length) {
        //If there is another item open remove it
        currentActive.removeClass('open').find('.sub-menu').attr('aria-hidden', true);
        currentActive.find('button').attr('aria-expanded', false);
      }

      $(this).attr('aria-expanded', true).find('span').text(menustrings.closesubmenu + ' ' + menuItem.find('a:first span').text());
      menuItem.addClass('open').find('.sub-menu').attr('aria-hidden', false);
      menuItem.find('.sub-menu').removeClass('visuallyhidden');


    } else if (menuItem.hasClass('open')) {
      console.log('klik op button en menu item is OPEN');
      // Submenu is open, has to close
      $(this).attr('aria-expanded', false).find('span').text(menustrings.showsubmenu + ' ' + menuItem.find('a:first span').text());
      menuItem.removeClass('open').find('.sub-menu').attr('aria-hidden', true);
      menuItem.find('.sub-menu').addClass('visuallyhidden');
    }
  });

//Remove open
}

function navMobile() {

  const menuBtn = $('.btn--toggle-menu');

  // Unset desktop things
  if ($('button.icon').length) {
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

  if (!(menuBtn.length)) {
    $('.site-header > .wrap').append(menuBtnHtml);
  }

  $('.btn--toggle-menu').click(function () {
    if ($(this).hasClass('active')) {
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
  } else {
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

  console.log('closeMenuItems');

  var width = window.innerWidth;
  var listitems = document.querySelectorAll(".menu-item-has-children");

  Array.prototype.forEach.call(menuItems, function (el, i) {
    el.classList.remove("open");
    el.querySelector('a').setAttribute('aria-expanded', "false");

    if (width > breakpointmenu) {

      var buttonExists = el.querySelector('button');
      var submenu = el.querySelector('ul.sub-menu');

      if (buttonExists && typeof buttonExists != 'undefined') {
        buttonExists.setAttribute('aria-expanded', "false");
        buttonExists.classList.remove('open-list');
      }
      el.querySelector('ul.sub-menu').classList.add('visuallyhidden');
      el.querySelector('ul.sub-menu').setAttribute('aria-hidden', 'true');

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
  } else {
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
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJnYy1tYWluLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIi8vXG4vLyBHZWJydWlrZXIgQ2VudHJhYWwgLSBmaWx0ZXJzLmpzXG4vLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4vLyBGdW5jdGlvbmFsaXRlaXQgdm9vciBoZXQgdG9ldm9lZ2VuIHZhbiBlZW4gYWN0aXZlIGNsYXNzIGFhbiBmaWx0ZXJzXG4vLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4vLyBAcGFja2FnZSBnZWJydWlrZXItY2VudHJhYWxcbi8vIEBhdXRob3IgIFRhbWFyYSBkZSBIYWFzXG4vLyBAbGljZW5zZSBHUEwtMi4wK1xuLy8gQHZlcnNpb24gMy4xNS45XG4vLyBAbGluayAgICBodHRwczovL2dpdGh1Yi5jb20vSUNUVS9pY3R1d3AtdGhlbWUtZ2VicnVpa2VyY2VudHJhYWxcblxuXG52YXIgZmlsdGVyTGFiZWwgPSAkKCcuZm9ybS1pdGVtLS1maWx0ZXIgbGFiZWwnKTtcblxuZmlsdGVyTGFiZWwuY2xpY2soZnVuY3Rpb24gKCkge1xuXG4gICAgdmFyIGZvcm1JdGVtID0gJCh0aGlzKS5wYXJlbnQoKTtcblxuICAgIGlmIChmb3JtSXRlbS5maW5kKCdpbnB1dDpjaGVja2VkJykubGVuZ3RoKSB7XG4gICAgICAgIGZvcm1JdGVtLnJlbW92ZUNsYXNzKCdpcy1hY3RpdmUnKTtcbiAgICB9IGVsc2Uge1xuICAgICAgICBmb3JtSXRlbS5hZGRDbGFzcygnaXMtYWN0aXZlJyk7XG4gICAgfVxuXG59KTtcblxuXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cblxuLy9cbi8vIEdlYnJ1aWtlciBDZW50cmFhbCAtIG1lbnUuanNcbi8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbi8vIEZ1bmN0aW9uYWxpdGVpdCB2b29yIHRvbmVuIC8gdmVyYmVyZ2VuIG1vYmllbCBtZW51XG4vLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4vLyBAcGFja2FnZSBnZWJydWlrZXItY2VudHJhYWxcbi8vIEBhdXRob3IgIFRhbWFyYSBkZSBIYWFzLCBQYXVsIHZhbiBCdXVyZW5cbi8vIEBsaWNlbnNlIEdQTC0yLjArXG4vLyBAdmVyc2lvbiAzLjE1Ljlcbi8vIEBkZXNjLiAgIENUQS1rbGV1cmVuLCBhMTF5IGdyb2VuLCBzaGFyaW5nIGJ1dHRvbnMgb3B0aW9uYWwsIGJlZWxkYmFuayBDUFQgY29kZSBzZXBhcmF0aW9uLlxuLy8gQGxpbmsgICAgaHR0cHM6Ly9naXRodWIuY29tL0lDVFUvaWN0dXdwLXRoZW1lLWdlYnJ1aWtlcmNlbnRyYWFsXG5cblxuLy8gVmFyc1xudmFyIGhlYWRlciA9ICQoJy5zaXRlLWhlYWRlcicpLFxuICBtYWluTWVudSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5uYXYtcHJpbWFyeScpO1xuY29uc3QgYnJlYWtwb2ludG1lbnUgPSA5MDA7IC8vIG9wIDkwMHB4IHRvZ2dsZSB0dXNzZW4gZGVza3RvcCAvIG1vYmllbFxuXG4vLyBkaXQgaXMgaGV0IGhlbGUgbWVudS1vYmplY3QuIEFscyBCVUlURU4gZGl0IG9iamVjdCBnZWtsaWt0IHdvcmR0LCBkYW4gbW9ldGVuIGFsbGVcbi8vIG1lbnUtZWxlbWVudGVuIHdlZXIgaW5nZWtsYXB0IHdvcmRlblxuY29uc3QgdG90YWxNZW51RWxlbWVudCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibWFpbm5hdlwiKTtcblxuLy8gRGl0IHppam4gYWxsZSBtZW51LWl0ZW1zIG1ldCBlZW4gc3VibWVudVxuY29uc3QgbWVudUl0ZW1zID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChcImxpLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW5cIik7XG5cblxuZnVuY3Rpb24gbmF2RGVza3RvcCgpIHtcblxuICAvLyBSZW1vdmUgbWVudSBidXR0b24gaWYgdGhlcmVcbiAgaWYgKCQoJy5idG4tLXRvZ2dsZS1tZW51JykubGVuZ3RoKSB7XG4gICAgJCgnLmJ0bi0tdG9nZ2xlLW1lbnUnKS5yZW1vdmUoKTtcbiAgfVxuXG4gIC8vIEFkZCBidXR0b25zXG4gICQoJy5uYXYtcHJpbWFyeSAubWVudS1pdGVtLWhhcy1jaGlsZHJlbicpLmVhY2goZnVuY3Rpb24gKCkge1xuICAgIGNvbnNvbGUubG9nKCdBZGQgYnV0dG9ucycpO1xuXG4gICAgJCh0aGlzKS5maW5kKCdhOmZpcnN0JykuYXR0cignYXJpYS1leHBhbmRlZCcsIHRydWUpO1xuXG4gICAgLy8gQWRkIGEgYnV0dG9uIHRvIGVhY2ggbGluayB3aXRoIGEgc3VibWVudVxuICAgICQodGhpcykuZmluZCgnYTpmaXJzdCcpLmFmdGVyKCc8YnV0dG9uIGNsYXNzPVwiaWNvbiBpY29uLS1hcnJvdyBpY29uLS1zbWFsbFwiIGFyaWEtZXhwYW5kZWQ9XCJmYWxzZVwiIGRhdGEtb2wtaGFzLWNsaWNrLWhhbmRsZXIgYXJpYS1leHBhbmRlZD1cImZhbHNlXCI+JyArXG4gICAgICAnPHNwYW4gY2xhc3M9XCJ2aXN1YWxseWhpZGRlblwiPicgKyBtZW51c3RyaW5ncy5zaG93c3VibWVudSArICcgJyArICQodGhpcykuZmluZCgnYTpmaXJzdCBzcGFuJykudGV4dCgpICsgJzwvc3Bhbj4nICtcbiAgICAgICc8L2J1dHRvbj4nKTtcblxuICAgICQodGhpcykuZmluZCgnLnN1Yi1tZW51JykuYXR0cignYXJpYS1oaWRkZW4nLCB0cnVlKTtcbiAgfSk7XG5cbiAgLy8gQWRkIGNsYXNzIG9uIG1vdXNlIGVudGVyXG4gICQoJy5tZW51LXByaW1hcnkgPiBsaS5tZW51LWl0ZW0taGFzLWNoaWxkcmVuID4gYScpLm1vdXNlZW50ZXIoZnVuY3Rpb24gKCkge1xuICAgIGlmICghKCQodGhpcykuaGFzQ2xhc3MoJ29wZW4nKSkpIHtcbiAgICAgIC8vIFVuc2V0IG90aGVyIGFjdGl2ZSBpZiB0aGVyZVxuICAgICAgY29uc29sZS5sb2coJ21vdXNlZW50ZXIgb3AgYScpO1xuICAgICAgJCgnLm1lbnUtcHJpbWFyeScpLmZpbmQoJy5vcGVuJykucmVtb3ZlQ2xhc3MoJ29wZW4nKTtcbiAgICAgICQoJy5tZW51LXByaW1hcnknKS5maW5kKCd1bFthcmlhLWhpZGRlbj1cImZhbHNlXCJdJykuYXR0cignYXJpYS1oaWRkZW4nLCAndHJ1ZScpO1xuXG4gICAgICAvLyBBZGQgYXR0cmlidXRlcyB0byBjdXJyZW50IG1lbnVcbiAgICAgICQodGhpcykucGFyZW50KCkuYWRkQ2xhc3MoJ29wZW4nKS5maW5kKCcuc3ViLW1lbnUnKS5hdHRyKCdhcmlhLWhpZGRlbicsICdmYWxzZScpO1xuICAgICAgJCh0aGlzKS5maW5kKCdhOmZpcnN0LWNoaWxkJykuYXR0cignYXJpYS1leHBhbmRlZCcsICd0cnVlJyk7XG4gICAgfVxuICB9KTtcblxuICAkKCcubWVudS1wcmltYXJ5ID4gbGkubWVudS1pdGVtLWhhcy1jaGlsZHJlbicpLmZvY3VzaW4oZnVuY3Rpb24gKCkge1xuXG4gICAgdmFyIGN1cnJlbnRzdWJtZW51ID0gJCh0aGlzKS5maW5kKCcuc3ViLW1lbnUnKTtcbiAgICB2YXIgbWVudUl0ZW0gPSAkKHRoaXMpO1xuXG4gICAgdmFyIGFsbGNsYXNzZXMgPSBtZW51SXRlbS5hdHRyKFwiY2xhc3NcIilcbiAgICBjb25zb2xlLmxvZygnZm9jdXNpbicpO1xuXG4gICAgaWYgKCEobWVudUl0ZW0uaGFzQ2xhc3MoJ21lbnUtaXRlbS1oYXMtZm9jdXMnKSkpIHtcbiAgICAgIG1lbnVJdGVtLmFkZENsYXNzKCdtZW51LWl0ZW0taGFzLWZvY3VzJyk7XG4gICAgfVxuXG4gIH0pO1xuXG4gICQoJy5tZW51LXByaW1hcnkgPiBsaS5tZW51LWl0ZW0taGFzLWNoaWxkcmVuJykuZm9jdXNvdXQoZnVuY3Rpb24gKCkge1xuICAgICAgdmFyIGN1cnJlbnRzdWJtZW51ID0gJCh0aGlzKS5maW5kKCcuc3ViLW1lbnUnKTtcbiAgICAgIHZhciBjdXJyZW50YnV0dG9uID0gJCh0aGlzKS5maW5kKCdidXR0b24nKTtcbiAgICAgIHZhciBtZW51SXRlbSA9ICQodGhpcyk7XG5cbiAgICAgIHZhciBhbGxjbGFzc2VzID0gbWVudUl0ZW0uYXR0cihcImNsYXNzXCIpO1xuICAgICAgY29uc29sZS5sb2coXCJmb2N1c291dCBcXG5cIiArIGFsbGNsYXNzZXMgKyBcIlxcblwiKTtcblxuICAgICAgaWYgKG1lbnVJdGVtLmhhc0NsYXNzKCdtZW51LWl0ZW0taGFzLWZvY3VzJykgJiYgbWVudUl0ZW0uaGFzQ2xhc3MoJ29wZW4nKSkge1xuXG4gICAgICAgIHZhciBidXR0b25faGFzX2F0dHJfZXhwYW5kZWQgPSBTdHJpbmcoY3VycmVudGJ1dHRvbi5hdHRyKFwiYXJpYS1leHBhbmRlZFwiKSk7XG4gICAgICAgIHZhciBzdWJtZW51X2hhc19hdHRyX2FyaWFoaWRkZW4gPSBTdHJpbmcoY3VycmVudHN1Ym1lbnUuYXR0cihcImFyaWEtaGlkZGVuXCIpKTtcblxuICAgICAgICBpZiAoYnV0dG9uX2hhc19hdHRyX2V4cGFuZGVkID09IFwidHJ1ZVwiICYmIHN1Ym1lbnVfaGFzX2F0dHJfYXJpYWhpZGRlbiA9PSBcImZhbHNlXCIpIHtcbiAgICAgICAgICBjb25zb2xlLmxvZygnZm9jdXNvdXQgZnVuY3RpZSBtZW51IGl0ZW0gaGVlZnQgY2xhc3Mgb3BlbiwgYnV0dG9uIGV4cGFuZGVkOiAnICsgYnV0dG9uX2hhc19hdHRyX2V4cGFuZGVkICsgJywgYXJpYSBoaWRkZW46ICcgKyBzdWJtZW51X2hhc19hdHRyX2FyaWFoaWRkZW4gKyAnLicpO1xuXG4vLyAgICAgICAgICBjbG9zZU1lbnVJdGVtcygpO1xuLy8gICAgICAgIGNvbnNvbGUubG9nKCdXT0VQSUVERVBPRVBJRSBidXR0b24gZXhwYW5kZWQ6ICcgKyBidXR0b25faGFzX2F0dHJfZXhwYW5kZWQgKyAnLCBhcmlhIGhpZGRlbjogJyArIHN1Ym1lbnVfaGFzX2F0dHJfYXJpYWhpZGRlbiArICcuJyk7XG4vLyAgICAgICAgICBtZW51SXRlbS5yZW1vdmVDbGFzcygnb3BlbicpO1xuLy8gICAgICAgICAgbWVudUl0ZW0ucmVtb3ZlQ2xhc3MoJ21lbnUtaXRlbS1oYXMtZm9jdXMnKTtcbi8vICAgICAgICBjdXJyZW50YnV0dG9uLmF0dHIoJ2FyaWEtZXhwYW5kZWQnLCBmYWxzZSk7XG4vLyAgICAgICAgICBjdXJyZW50c3VibWVudS5hdHRyKCdhcmlhLWhpZGRlbicsIHRydWUpO1xuICAgICAgICB9XG5cbiAgICAgIH1cblxuICAgIH1cbiAgKVxuICA7XG5cbi8vIEFuZCByZW1vdmUgYWdhaW4gb24gbW91c2VsZWF2ZVxuICAkKCcubWVudS1wcmltYXJ5ID4gbGkubWVudS1pdGVtLWhhcy1jaGlsZHJlbiAuc3ViLW1lbnUnKS5tb3VzZWxlYXZlKGZ1bmN0aW9uICgpIHtcblxuICAgIGNvbnNvbGUubG9nKCdzdWItbWVudSBtb3VzZWxlYXZlJyk7XG5cbiAgICAvLyBBZGQgYXR0cmlidXRlcyB0byBjdXJyZW50IG1lbnVcbiAgICAkKHRoaXMpLnBhcmVudCgpLnJlbW92ZUNsYXNzKCdvcGVuJyk7XG4gICAgJCh0aGlzKS5hdHRyKCdhcmlhLWhpZGRlbicsICd0cnVlJyk7XG4gICAgJCh0aGlzKS5wYXJlbnQoKS5maW5kKCdhOmZpcnN0LWNoaWxkJykuYXR0cignYXJpYS1leHBhbmRlZCcsICdmYWxzZScpO1xuXG4gIH0pO1xuXG4vLyBBZGQgdG9nZ2xlIGJlaGF2aW91ciBvbiBjbGlja1xuICAkKCcubmF2LXByaW1hcnkgLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4gPiBidXR0b24nKS5jbGljayhmdW5jdGlvbiAoKSB7XG5cbiAgICBjb25zb2xlLmxvZygnQlVUVE9OIEtMSUsnKTtcblxuICAgIHZhciBtZW51SXRlbSA9ICQodGhpcykucGFyZW50KCk7XG4gICAgdmFyIGN1cnJlbnRBY3RpdmUgPSAkKCcubmF2LXByaW1hcnkgLm1lbnUtaXRlbS5vcGVuJyk7XG5cbiAgICBpZiAoIShtZW51SXRlbS5oYXNDbGFzcygnb3BlbicpKSkge1xuICAgICAgY29uc29sZS5sb2coJ2tsaWsgb3AgYnV0dG9uIGVuIG1lbnUgaXRlbSBJUyBOSUVUIE9QRU4gISEhJyk7XG4gICAgICAvL1N1Ym1lbnUgaXMgY2xvc2VkLCBoYXMgdG8gb3BlblxuICAgICAgaWYgKGN1cnJlbnRBY3RpdmUubGVuZ3RoKSB7XG4gICAgICAgIC8vSWYgdGhlcmUgaXMgYW5vdGhlciBpdGVtIG9wZW4gcmVtb3ZlIGl0XG4gICAgICAgIGN1cnJlbnRBY3RpdmUucmVtb3ZlQ2xhc3MoJ29wZW4nKS5maW5kKCcuc3ViLW1lbnUnKS5hdHRyKCdhcmlhLWhpZGRlbicsIHRydWUpO1xuICAgICAgICBjdXJyZW50QWN0aXZlLmZpbmQoJ2J1dHRvbicpLmF0dHIoJ2FyaWEtZXhwYW5kZWQnLCBmYWxzZSk7XG4gICAgICB9XG5cbiAgICAgICQodGhpcykuYXR0cignYXJpYS1leHBhbmRlZCcsIHRydWUpLmZpbmQoJ3NwYW4nKS50ZXh0KG1lbnVzdHJpbmdzLmNsb3Nlc3VibWVudSArICcgJyArIG1lbnVJdGVtLmZpbmQoJ2E6Zmlyc3Qgc3BhbicpLnRleHQoKSk7XG4gICAgICBtZW51SXRlbS5hZGRDbGFzcygnb3BlbicpLmZpbmQoJy5zdWItbWVudScpLmF0dHIoJ2FyaWEtaGlkZGVuJywgZmFsc2UpO1xuICAgICAgbWVudUl0ZW0uZmluZCgnLnN1Yi1tZW51JykucmVtb3ZlQ2xhc3MoJ3Zpc3VhbGx5aGlkZGVuJyk7XG5cblxuICAgIH0gZWxzZSBpZiAobWVudUl0ZW0uaGFzQ2xhc3MoJ29wZW4nKSkge1xuICAgICAgY29uc29sZS5sb2coJ2tsaWsgb3AgYnV0dG9uIGVuIG1lbnUgaXRlbSBpcyBPUEVOJyk7XG4gICAgICAvLyBTdWJtZW51IGlzIG9wZW4sIGhhcyB0byBjbG9zZVxuICAgICAgJCh0aGlzKS5hdHRyKCdhcmlhLWV4cGFuZGVkJywgZmFsc2UpLmZpbmQoJ3NwYW4nKS50ZXh0KG1lbnVzdHJpbmdzLnNob3dzdWJtZW51ICsgJyAnICsgbWVudUl0ZW0uZmluZCgnYTpmaXJzdCBzcGFuJykudGV4dCgpKTtcbiAgICAgIG1lbnVJdGVtLnJlbW92ZUNsYXNzKCdvcGVuJykuZmluZCgnLnN1Yi1tZW51JykuYXR0cignYXJpYS1oaWRkZW4nLCB0cnVlKTtcbiAgICAgIG1lbnVJdGVtLmZpbmQoJy5zdWItbWVudScpLmFkZENsYXNzKCd2aXN1YWxseWhpZGRlbicpO1xuICAgIH1cbiAgfSk7XG5cbi8vUmVtb3ZlIG9wZW5cbn1cblxuZnVuY3Rpb24gbmF2TW9iaWxlKCkge1xuXG4gIGNvbnN0IG1lbnVCdG4gPSAkKCcuYnRuLS10b2dnbGUtbWVudScpO1xuXG4gIC8vIFVuc2V0IGRlc2t0b3AgdGhpbmdzXG4gIGlmICgkKCdidXR0b24uaWNvbicpLmxlbmd0aCkge1xuICAgICQoJ2J1dHRvbi5pY29uJykucmVtb3ZlKCk7XG4gIH1cblxuICAkKCcubmF2LXByaW1hcnkgLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4nKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICAkKHRoaXMpLmZpbmQoJy5zdWItbWVudScpLnJlbW92ZUF0dHIoJ2FyaWEtaGlkZGVuJyk7XG4gIH0pO1xuXG5cbiAgY29uc3QgbWVudUJ0bkh0bWwgPVxuICAgICc8YnV0dG9uIGNsYXNzPVwiYnRuIGJ0bi0tdG9nZ2xlLW1lbnVcIiAnICtcbiAgICAnYXJpYS1oYXNwb3B1cD1cInRydWVcIiBhcmlhLWNvbnRyb2xzPVwibWVudS1wcmltYXJ5XCIgYXJpYS1leHBhbmRlZD1cImZhbHNlXCIgYXJpYS1sYWJlbD1cIk9wZW4gbWVudVwiPicgK1xuICAgICc8aT4mI3gyMjYxOzwvaT48c3BhbiBjbGFzcz1cImJ0bl9fdGV4dFwiPk1lbnU8L3NwYW4+JyArXG4gICAgJzwvYnV0dG9uPic7XG5cbiAgaWYgKCEobWVudUJ0bi5sZW5ndGgpKSB7XG4gICAgJCgnLnNpdGUtaGVhZGVyID4gLndyYXAnKS5hcHBlbmQobWVudUJ0bkh0bWwpO1xuICB9XG5cbiAgJCgnLmJ0bi0tdG9nZ2xlLW1lbnUnKS5jbGljayhmdW5jdGlvbiAoKSB7XG4gICAgaWYgKCQodGhpcykuaGFzQ2xhc3MoJ2FjdGl2ZScpKSB7XG4gICAgICAkKHRoaXMpLmZpbmQoJ2knKS5odG1sKCcmI3gyMjYxOycpO1xuICAgIH0gZWxzZSB7XG4gICAgICAkKHRoaXMpLmZpbmQoJ2knKS5odG1sKCcmdGltZXM7Jyk7XG4gICAgfVxuICAgICQoJ2JvZHknKS50b2dnbGVDbGFzcygnbWVudS1vcGVuJyk7XG4gICAgJCgnLm5hdi1wcmltYXJ5JykudG9nZ2xlQ2xhc3MoJ3Nob3cnKTtcbiAgICAkKHRoaXMpLnRvZ2dsZUNsYXNzKCdhY3RpdmUnKTtcbiAgfSk7XG5cblxufVxuXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cblxuLy8gbWVkaWEgcXVlcnkgY2hhbmdlXG5mdW5jdGlvbiBXaWR0aENoYW5nZShtcSkge1xuXG4gIGlmIChtcS5tYXRjaGVzKSB7XG4gICAgLy8gd2luZG93IHdpZHRoIGlzIGF0IGxlYXN0IDgzMHB4XG4gICAgLy8gZG9uJ3Qgc2hvdyBtZW51IGJ1dHRvblxuICAgIG5hdkRlc2t0b3AoZG9jdW1lbnQsIHdpbmRvdyk7XG4gIH0gZWxzZSB7XG4gICAgLy8gd2luZG93IHdpZHRoIGlzIGxlc3MgdGhhbiA4MzBweFxuICAgIC8vIERPIHNob3cgbWVudSBidXR0b25cbiAgICBuYXZNb2JpbGUoZG9jdW1lbnQsIHdpbmRvdyk7XG5cbiAgfVxuXG59XG5cbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuXG4vLyBtZWRpYSBxdWVyeSBldmVudCBoYW5kbGVyXG5pZiAobWF0Y2hNZWRpYSAmJiBtYWluTWVudSkge1xuICB2YXIgbXEgPSB3aW5kb3cubWF0Y2hNZWRpYSgnKG1pbi13aWR0aDogOTAwcHgpJyk7XG4gIG1xLmFkZExpc3RlbmVyKFdpZHRoQ2hhbmdlKTtcbiAgV2lkdGhDaGFuZ2UobXEpO1xufVxuXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cblxuLy8gZnVuY3RpZSBvbSBhbGxlIG9wZW5nZWtsYXB0ZSBpdGVtcyBpbiBoZXQgbWVudSB3ZWVyIHRlIHNsdWl0ZW5cbmZ1bmN0aW9uIGNsb3NlTWVudUl0ZW1zKCkge1xuXG4gIGNvbnNvbGUubG9nKCdjbG9zZU1lbnVJdGVtcycpO1xuXG4gIHZhciB3aWR0aCA9IHdpbmRvdy5pbm5lcldpZHRoO1xuICB2YXIgbGlzdGl0ZW1zID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChcIi5tZW51LWl0ZW0taGFzLWNoaWxkcmVuXCIpO1xuXG4gIEFycmF5LnByb3RvdHlwZS5mb3JFYWNoLmNhbGwobWVudUl0ZW1zLCBmdW5jdGlvbiAoZWwsIGkpIHtcbiAgICBlbC5jbGFzc0xpc3QucmVtb3ZlKFwib3BlblwiKTtcbiAgICBlbC5xdWVyeVNlbGVjdG9yKCdhJykuc2V0QXR0cmlidXRlKCdhcmlhLWV4cGFuZGVkJywgXCJmYWxzZVwiKTtcblxuICAgIGlmICh3aWR0aCA+IGJyZWFrcG9pbnRtZW51KSB7XG5cbiAgICAgIHZhciBidXR0b25FeGlzdHMgPSBlbC5xdWVyeVNlbGVjdG9yKCdidXR0b24nKTtcbiAgICAgIHZhciBzdWJtZW51ID0gZWwucXVlcnlTZWxlY3RvcigndWwuc3ViLW1lbnUnKTtcblxuICAgICAgaWYgKGJ1dHRvbkV4aXN0cyAmJiB0eXBlb2YgYnV0dG9uRXhpc3RzICE9ICd1bmRlZmluZWQnKSB7XG4gICAgICAgIGJ1dHRvbkV4aXN0cy5zZXRBdHRyaWJ1dGUoJ2FyaWEtZXhwYW5kZWQnLCBcImZhbHNlXCIpO1xuICAgICAgICBidXR0b25FeGlzdHMuY2xhc3NMaXN0LnJlbW92ZSgnb3Blbi1saXN0Jyk7XG4gICAgICB9XG4gICAgICBlbC5xdWVyeVNlbGVjdG9yKCd1bC5zdWItbWVudScpLmNsYXNzTGlzdC5hZGQoJ3Zpc3VhbGx5aGlkZGVuJyk7XG4gICAgICBlbC5xdWVyeVNlbGVjdG9yKCd1bC5zdWItbWVudScpLnNldEF0dHJpYnV0ZSgnYXJpYS1oaWRkZW4nLCAndHJ1ZScpO1xuXG4gICAgfVxuXG4gIH0pO1xufVxuXG4vLyBmdW5jdGllIG9tIHRlIGNoZWNrZW4gb2YgYmlubmVuIG9mIGJ1aXRlbiBoZXQgbWVudSBlcmdlbnMgb3AgZ2VrbGlrdCB3b3JkdDtcbi8vIGFscyBlciBidWl0ZW4gaGV0IG1lbnUgZXJnZW5zIG9wIGdla2xpa3Qgd29yZHQsIGRhbiBtb2V0ZW4gYWxsZSBvcGVuZ2VrbGFwdGUgaXRlbXNcbi8vIGluIGhldCBtZW51IHdlZXIgc2x1aXRlblxuZnVuY3Rpb24gaXN0b3RhbE1lbnVFbGVtZW50TWVudShldmVudCkge1xuXG4gIGlmICh0b3RhbE1lbnVFbGVtZW50ICE9PSBldmVudC50YXJnZXQgJiYgIXRvdGFsTWVudUVsZW1lbnQuY29udGFpbnMoZXZlbnQudGFyZ2V0KSkge1xuICAgIGNsb3NlTWVudUl0ZW1zKCk7XG4gICAgY29uc29sZS5sb2coJ0V2ZW50IGlzIEJVSVRFTiB0b3RhbG1lbnUnKTtcbiAgICB0b3RhbE1lbnVFbGVtZW50LmNsYXNzTGlzdC5yZW1vdmUoJ2hhc2ZvY3VzJyk7XG4gIH0gZWxzZSB7XG4gICAgY29uc29sZS5sb2coJ0V2ZW50IGlzIEJJTk5FTiB0b3RhbG1lbnUnKTtcbiAgICB0b3RhbE1lbnVFbGVtZW50LmNsYXNzTGlzdC5hZGQoJ2hhc2ZvY3VzJyk7XG4gIH1cbn1cblxuZG9jdW1lbnQub25rZXlkb3duID0gZnVuY3Rpb24gKGV2dCkge1xuICAvLyBtZW51LWl0ZW1zIG9vayBsYXRlbiBzbHVpdGVuIG1ldCBFU0MtdG9ldHNcbiAgZXZ0ID0gZXZ0IHx8IHdpbmRvdy5ldmVudDtcbiAgaWYgKGV2dC5rZXlDb2RlID09IDI3KSB7XG4gICAgLy8gY2xvc2Ugd2l0aCBFU0NcbiAgICBjbG9zZU1lbnVJdGVtcygpO1xuICB9XG59O1xuZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBpc3RvdGFsTWVudUVsZW1lbnRNZW51KTtcblxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4iXSwiZmlsZSI6ImdjLW1haW4tZGVidWcuanMifQ==
