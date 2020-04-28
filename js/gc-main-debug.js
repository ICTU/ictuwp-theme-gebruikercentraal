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
})(jQuery, document, window);
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJnYy1tYWluLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIi8vXG4vLyBHZWJydWlrZXIgQ2VudHJhYWwgLSBmaWx0ZXJzLmpzXG4vLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4vLyBGdW5jdGlvbmFsaXRlaXQgdm9vciBoZXQgdG9ldm9lZ2VuIHZhbiBlZW4gYWN0aXZlIGNsYXNzIGFhbiBmaWx0ZXJzXG4vLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4vLyBAcGFja2FnZSBnZWJydWlrZXItY2VudHJhYWxcbi8vIEBhdXRob3IgIFRhbWFyYSBkZSBIYWFzXG4vLyBAbGljZW5zZSBHUEwtMi4wK1xuLy8gQHZlcnNpb24gMy4xNS45XG4vLyBAbGluayAgICBodHRwczovL2dpdGh1Yi5jb20vSUNUVS9nZWJydWlrZXItY2VudHJhYWwtd29yZHByZXNzLXRoZW1lXG5cblxudmFyIGZpbHRlckxhYmVsID0gJCgnLmZvcm0taXRlbS0tZmlsdGVyIGxhYmVsJyk7XG5cbmZpbHRlckxhYmVsLmNsaWNrKGZ1bmN0aW9uICgpIHtcblxuICAgIHZhciBmb3JtSXRlbSA9ICQodGhpcykucGFyZW50KCk7XG5cbiAgICBpZiAoZm9ybUl0ZW0uZmluZCgnaW5wdXQ6Y2hlY2tlZCcpLmxlbmd0aCkge1xuICAgICAgICBmb3JtSXRlbS5yZW1vdmVDbGFzcygnaXMtYWN0aXZlJyk7XG4gICAgfSBlbHNlIHtcbiAgICAgICAgZm9ybUl0ZW0uYWRkQ2xhc3MoJ2lzLWFjdGl2ZScpO1xuICAgIH1cblxufSk7XG5cblxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG5cbi8vXG4vLyBHZWJydWlrZXIgQ2VudHJhYWwgLSBtZW51LmpzXG4vLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4vLyBGdW5jdGlvbmFsaXRlaXQgdm9vciB0b25lbiAvIHZlcmJlcmdlbiBtb2JpZWwgbWVudVxuLy8gLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLVxuLy8gQHBhY2thZ2UgZ2VicnVpa2VyLWNlbnRyYWFsXG4vLyBAYXV0aG9yICBUYW1hcmEgZGUgSGFhcywgUGF1bCB2YW4gQnV1cmVuXG4vLyBAbGljZW5zZSBHUEwtMi4wK1xuLy8gQHZlcnNpb24gMy4xNS45XG4vLyBAZGVzYy4gICBDVEEta2xldXJlbiwgYTExeSBncm9lbiwgc2hhcmluZyBidXR0b25zIG9wdGlvbmFsLCBiZWVsZGJhbmsgQ1BUIGNvZGUgc2VwYXJhdGlvbi5cbi8vIEBsaW5rICAgIGh0dHBzOi8vZ2l0aHViLmNvbS9JQ1RVL2dlYnJ1aWtlci1jZW50cmFhbC13b3JkcHJlc3MtdGhlbWVcblxuXG4vLyBWYXJzXG52YXIgaGVhZGVyID0gJCgnLnNpdGUtaGVhZGVyJyksXG4gIG1haW5NZW51ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLm5hdi1wcmltYXJ5Jyk7XG5cblxuZnVuY3Rpb24gbmF2RGVza3RvcCgpIHtcblxuICAvLyBSZW1vdmUgbWVudSBidXR0b24gaWYgdGhlcmVcbiAgaWYoJCgnLmJ0bi0tdG9nZ2xlLW1lbnUnKS5sZW5ndGgpe1xuICAgICQoJy5idG4tLXRvZ2dsZS1tZW51JykucmVtb3ZlKCk7XG4gIH1cblxuICAvLyBBZGQgYnV0dG9uc1xuICAkKCcubmF2LXByaW1hcnkgLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4nKS5lYWNoKGZ1bmN0aW9uICgpIHtcblxuICAgICQodGhpcykuZmluZCgnYTpmaXJzdCcpLmF0dHIoJ2FyaWEtZXhwYW5kZWQnLCB0cnVlKTtcblxuICAgIC8vIEFkZCBhIGJ1dHRvbiB0byBlYWNoIGxpbmsgd2l0aCBhIHN1Ym1lbnVcbiAgICAkKHRoaXMpLmZpbmQoJ2E6Zmlyc3QnKS5hZnRlcignPGJ1dHRvbiBjbGFzcz1cImljb24gaWNvbi0tYXJyb3cgaWNvbi0tc21hbGxcIiBhcmlhLWV4cGFuZGVkPVwiZmFsc2VcIiBkYXRhLW9sLWhhcy1jbGljay1oYW5kbGVyIGFyaWEtZXhwYW5kZWQ9XCJmYWxzZVwiPicgK1xuICAgICAgJzxzcGFuIGNsYXNzPVwidmlzdWFsbHloaWRkZW5cIj5PcGVuIHN1Ym1lbnUgJyArICQodGhpcykuZmluZCgnYTpmaXJzdCBzcGFuJykudGV4dCgpICsgJzwvc3Bhbj4nICtcbiAgICAgICc8L2J1dHRvbj4nKTtcblxuICAgICQodGhpcykuZmluZCgnLnN1Yi1tZW51JykuYXR0cignYXJpYS1oaWRkZW4nLCB0cnVlKTtcbiAgfSk7XG5cbiAgLy8gQWRkIGNsYXNzIG9uIG1vdXNlIGVudGVyXG4gICQoJy5tZW51LXByaW1hcnkgPiBsaS5tZW51LWl0ZW0taGFzLWNoaWxkcmVuID4gYScpLm1vdXNlZW50ZXIoZnVuY3Rpb24gKCkge1xuICAgIGlmICghKCQodGhpcykuaGFzQ2xhc3MoJ29wZW4nKSkpIHtcbiAgICAgIC8vIFVuc2V0IG90aGVyIGFjdGl2ZSBpZiB0aGVyZVxuICAgICAgJCgnLm1lbnUtcHJpbWFyeScpLmZpbmQoJy5vcGVuJykucmVtb3ZlQ2xhc3MoJ29wZW4nKTtcbiAgICAgICQoJy5tZW51LXByaW1hcnknKS5maW5kKCd1bFthcmlhLWhpZGRlbj1cImZhbHNlXCJdJykuYXR0cignYXJpYS1oaWRkZW4nLCAndHJ1ZScpO1xuXG4gICAgICAvLyBBZGQgYXR0cmlidXRlcyB0byBjdXJyZW50IG1lbnVcbiAgICAgICQodGhpcykucGFyZW50KCkuYWRkQ2xhc3MoJ29wZW4nKS5maW5kKCcuc3ViLW1lbnUnKS5hdHRyKCdhcmlhLWhpZGRlbicsICdmYWxzZScpO1xuICAgICAgJCh0aGlzKS5maW5kKCdhOmZpcnN0LWNoaWxkJykuYXR0cignYXJpYS1leHBhbmRlZCcsICd0cnVlJyk7XG4gICAgfVxuICB9KTtcblxuICAvLyBBbmQgcmVtb3ZlIGFnYWluIG9uIG1vdXNlbGVhdmVcbiAgJCgnLm1lbnUtcHJpbWFyeSA+IGxpLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4gLnN1Yi1tZW51JykubW91c2VsZWF2ZShmdW5jdGlvbiAoKSB7XG4gICAgLy8gQWRkIGF0dHJpYnV0ZXMgdG8gY3VycmVudCBtZW51XG4gICAgJCh0aGlzKS5wYXJlbnQoKS5yZW1vdmVDbGFzcygnb3BlbicpO1xuICAgICQodGhpcykuYXR0cignYXJpYS1oaWRkZW4nLCAndHJ1ZScpO1xuICAgICQodGhpcykucGFyZW50KCkuZmluZCgnYTpmaXJzdC1jaGlsZCcpLmF0dHIoJ2FyaWEtZXhwYW5kZWQnLCAnZmFsc2UnKTtcbiAgfSk7XG5cbiAgLy8gQWRkIHRvZ2dsZSBiZWhhdmlvdXIgb24gY2xpY2tcbiAgJCgnLm5hdi1wcmltYXJ5IC5tZW51LWl0ZW0taGFzLWNoaWxkcmVuID4gYnV0dG9uJykuY2xpY2soZnVuY3Rpb24gKCkge1xuICAgIHZhciBtZW51SXRlbSA9ICQodGhpcykucGFyZW50KCk7XG4gICAgdmFyIGN1cnJlbnRBY3RpdmUgPSAkKCcubmF2LXByaW1hcnkgLm1lbnUtaXRlbS5vcGVuJyk7XG5cbiAgICBpZiAoIShtZW51SXRlbS5oYXNDbGFzcygnb3BlbicpKSkge1xuICAgICAgLy9TdWJtZW51IGlzIGNsb3NlZCwgaGFzIHRvIG9wZW5cbiAgICAgIGlmKGN1cnJlbnRBY3RpdmUubGVuZ3RoKXtcbiAgICAgICAgLy9JZiB0aGVyZSBpcyBhbm90aGVyIGl0ZW0gb3BlbiByZW1vdmUgaXRcbiAgICAgICAgY3VycmVudEFjdGl2ZS5yZW1vdmVDbGFzcygnb3BlbicpLmZpbmQoJy5zdWItbWVudScpLmF0dHIoJ2FyaWEtaGlkZGVuJywgdHJ1ZSk7XG4gICAgICAgIGN1cnJlbnRBY3RpdmUuZmluZCgnYnV0dG9uJykuYXR0cignYXJpYS1leHBhbmRlZCcsIGZhbHNlKTtcbiAgICAgIH1cblxuICAgICAgJCh0aGlzKS5hdHRyKCdhcmlhLWV4cGFuZGVkJywgdHJ1ZSkuZmluZCgnc3BhbicpLnRleHQoJ1NsdWl0ICcgKyBtZW51SXRlbS5maW5kKCdhOmZpcnN0IHNwYW4nKS50ZXh0KCkpO1xuICAgICAgbWVudUl0ZW0uYWRkQ2xhc3MoJ29wZW4nKS5maW5kKCcuc3ViLW1lbnUnKS5hdHRyKCdhcmlhLWhpZGRlbicsIGZhbHNlKTtcblxuICAgIH0gZWxzZSBpZiAobWVudUl0ZW0uaGFzQ2xhc3MoJ29wZW4nKSkge1xuICAgICAgLy8gU3VibWVudSBpcyBvcGVuLCBoYXMgdG8gY2xvc2VcbiAgICAgICQodGhpcykuYXR0cignYXJpYS1leHBhbmRlZCcsIGZhbHNlKS5maW5kKCdzcGFuJykudGV4dCgnT3BlbiAnICsgbWVudUl0ZW0uZmluZCgnYTpmaXJzdCBzcGFuJykudGV4dCgpKTtcbiAgICAgIG1lbnVJdGVtLnJlbW92ZUNsYXNzKCdvcGVuJykuZmluZCgnLnN1Yi1tZW51JykuYXR0cignYXJpYS1oaWRkZW4nLCB0cnVlKTtcbiAgICB9XG4gIH0pO1xuXG4gIC8vUmVtb3ZlIG9wZW5cbn1cblxuZnVuY3Rpb24gbmF2TW9iaWxlKCkge1xuXG4gIGNvbnN0IG1lbnVCdG4gPSAkKCcuYnRuLS10b2dnbGUtbWVudScpO1xuXG4gIC8vIFVuc2V0IGRlc2t0b3AgdGhpbmdzXG4gIGlmKCQoJ2J1dHRvbi5pY29uJykubGVuZ3RoKXtcbiAgICAkKCdidXR0b24uaWNvbicpLnJlbW92ZSgpO1xuICB9XG5cbiAgJCgnLm5hdi1wcmltYXJ5IC5tZW51LWl0ZW0taGFzLWNoaWxkcmVuJykuZWFjaChmdW5jdGlvbiAoKSB7XG4gICAgJCh0aGlzKS5maW5kKCcuc3ViLW1lbnUnKS5yZW1vdmVBdHRyKCdhcmlhLWhpZGRlbicpO1xuICB9KTtcblxuXG4gIGNvbnN0IG1lbnVCdG5IdG1sID1cbiAgICAnPGJ1dHRvbiBjbGFzcz1cImJ0biBidG4tLXRvZ2dsZS1tZW51XCIgJyArXG4gICAgJ2FyaWEtaGFzcG9wdXA9XCJ0cnVlXCIgYXJpYS1jb250cm9scz1cIm1lbnUtcHJpbWFyeVwiIGFyaWEtZXhwYW5kZWQ9XCJmYWxzZVwiIGFyaWEtbGFiZWw9XCJPcGVuIG1lbnVcIj4nICtcbiAgICAnPGk+JiN4MjI2MTs8L2k+PHNwYW4gY2xhc3M9XCJidG5fX3RleHRcIj5NZW51PC9zcGFuPicgK1xuICAgICc8L2J1dHRvbj4nO1xuXG4gIGlmKCEobWVudUJ0bi5sZW5ndGgpKSB7XG4gICAgJCgnLnNpdGUtaGVhZGVyID4gLndyYXAnKS5hcHBlbmQobWVudUJ0bkh0bWwpO1xuICB9XG5cbiAgJCgnLmJ0bi0tdG9nZ2xlLW1lbnUnKS5jbGljayhmdW5jdGlvbigpe1xuICAgIGlmKCQodGhpcykuaGFzQ2xhc3MoJ2FjdGl2ZScpKXtcbiAgICAgICQodGhpcykuZmluZCgnaScpLmh0bWwoJyYjeDIyNjE7Jyk7XG4gICAgfSBlbHNlIHtcbiAgICAgICQodGhpcykuZmluZCgnaScpLmh0bWwoJyZ0aW1lczsnKTtcbiAgICB9XG4gICAgJCgnYm9keScpLnRvZ2dsZUNsYXNzKCdtZW51LW9wZW4nKTtcbiAgICAkKCcubmF2LXByaW1hcnknKS50b2dnbGVDbGFzcygnc2hvdycpO1xuICAgICQodGhpcykudG9nZ2xlQ2xhc3MoJ2FjdGl2ZScpO1xuICB9KTtcblxuXG59XG5cbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuXG4vLyBtZWRpYSBxdWVyeSBjaGFuZ2VcbmZ1bmN0aW9uIFdpZHRoQ2hhbmdlKG1xKSB7XG5cbiAgaWYgKG1xLm1hdGNoZXMpIHtcbiAgICAvLyB3aW5kb3cgd2lkdGggaXMgYXQgbGVhc3QgODMwcHhcbiAgICAvLyBkb24ndCBzaG93IG1lbnUgYnV0dG9uXG4gICAgbmF2RGVza3RvcChkb2N1bWVudCwgd2luZG93KTtcbiAgfVxuICBlbHNlIHtcbiAgICAvLyB3aW5kb3cgd2lkdGggaXMgbGVzcyB0aGFuIDgzMHB4XG4gICAgLy8gRE8gc2hvdyBtZW51IGJ1dHRvblxuICAgIG5hdk1vYmlsZShkb2N1bWVudCwgd2luZG93KTtcblxuICB9XG5cbn1cblxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG5cbi8vIG1lZGlhIHF1ZXJ5IGV2ZW50IGhhbmRsZXJcbmlmIChtYXRjaE1lZGlhICYmIG1haW5NZW51KSB7XG4gIHZhciBtcSA9IHdpbmRvdy5tYXRjaE1lZGlhKCcobWluLXdpZHRoOiA5MDBweCknKTtcbiAgbXEuYWRkTGlzdGVuZXIoV2lkdGhDaGFuZ2UpO1xuICBXaWR0aENoYW5nZShtcSk7XG59XG5cblxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4iXSwiZmlsZSI6ImdjLW1haW4tZGVidWcuanMifQ==
