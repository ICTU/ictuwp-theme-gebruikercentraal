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

    } else if (menuItem.hasClass('open')) {
      // Submenu is open, has to close
      $(this).attr('aria-expanded', false).find('span').text( menustrings.showsubmenu + ' ' + menuItem.find('a:first span').text());
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
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJnYy1tYWluLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIi8vXG4vLyBHZWJydWlrZXIgQ2VudHJhYWwgLSBmaWx0ZXJzLmpzXG4vLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4vLyBGdW5jdGlvbmFsaXRlaXQgdm9vciBoZXQgdG9ldm9lZ2VuIHZhbiBlZW4gYWN0aXZlIGNsYXNzIGFhbiBmaWx0ZXJzXG4vLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4vLyBAcGFja2FnZSBnZWJydWlrZXItY2VudHJhYWxcbi8vIEBhdXRob3IgIFRhbWFyYSBkZSBIYWFzXG4vLyBAbGljZW5zZSBHUEwtMi4wK1xuLy8gQHZlcnNpb24gMy4xNS45XG4vLyBAbGluayAgICBodHRwczovL2dpdGh1Yi5jb20vSUNUVS9nZWJydWlrZXItY2VudHJhYWwtd29yZHByZXNzLXRoZW1lXG5cblxudmFyIGZpbHRlckxhYmVsID0gJCgnLmZvcm0taXRlbS0tZmlsdGVyIGxhYmVsJyk7XG5cbmZpbHRlckxhYmVsLmNsaWNrKGZ1bmN0aW9uICgpIHtcblxuICAgIHZhciBmb3JtSXRlbSA9ICQodGhpcykucGFyZW50KCk7XG5cbiAgICBpZiAoZm9ybUl0ZW0uZmluZCgnaW5wdXQ6Y2hlY2tlZCcpLmxlbmd0aCkge1xuICAgICAgICBmb3JtSXRlbS5yZW1vdmVDbGFzcygnaXMtYWN0aXZlJyk7XG4gICAgfSBlbHNlIHtcbiAgICAgICAgZm9ybUl0ZW0uYWRkQ2xhc3MoJ2lzLWFjdGl2ZScpO1xuICAgIH1cblxufSk7XG5cblxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG5cbi8vXG4vLyBHZWJydWlrZXIgQ2VudHJhYWwgLSBtZW51LmpzXG4vLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4vLyBGdW5jdGlvbmFsaXRlaXQgdm9vciB0b25lbiAvIHZlcmJlcmdlbiBtb2JpZWwgbWVudVxuLy8gLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLVxuLy8gQHBhY2thZ2UgZ2VicnVpa2VyLWNlbnRyYWFsXG4vLyBAYXV0aG9yICBUYW1hcmEgZGUgSGFhcywgUGF1bCB2YW4gQnV1cmVuXG4vLyBAbGljZW5zZSBHUEwtMi4wK1xuLy8gQHZlcnNpb24gMy4xNS45XG4vLyBAZGVzYy4gICBDVEEta2xldXJlbiwgYTExeSBncm9lbiwgc2hhcmluZyBidXR0b25zIG9wdGlvbmFsLCBiZWVsZGJhbmsgQ1BUIGNvZGUgc2VwYXJhdGlvbi5cbi8vIEBsaW5rICAgIGh0dHBzOi8vZ2l0aHViLmNvbS9JQ1RVL2dlYnJ1aWtlci1jZW50cmFhbC13b3JkcHJlc3MtdGhlbWVcblxuXG4vLyBWYXJzXG52YXIgaGVhZGVyID0gJCgnLnNpdGUtaGVhZGVyJyksXG4gIG1haW5NZW51ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLm5hdi1wcmltYXJ5Jyk7XG5cbmZ1bmN0aW9uIG5hdkRlc2t0b3AoKSB7XG5cbiAgLy8gUmVtb3ZlIG1lbnUgYnV0dG9uIGlmIHRoZXJlXG4gIGlmKCQoJy5idG4tLXRvZ2dsZS1tZW51JykubGVuZ3RoKXtcbiAgICAkKCcuYnRuLS10b2dnbGUtbWVudScpLnJlbW92ZSgpO1xuICB9XG5cbiAgLy8gQWRkIGJ1dHRvbnNcbiAgJCgnLm5hdi1wcmltYXJ5IC5tZW51LWl0ZW0taGFzLWNoaWxkcmVuJykuZWFjaChmdW5jdGlvbiAoKSB7XG5cbiAgICAkKHRoaXMpLmZpbmQoJ2E6Zmlyc3QnKS5hdHRyKCdhcmlhLWV4cGFuZGVkJywgdHJ1ZSk7XG5cbiAgICAvLyBBZGQgYSBidXR0b24gdG8gZWFjaCBsaW5rIHdpdGggYSBzdWJtZW51XG4gICAgJCh0aGlzKS5maW5kKCdhOmZpcnN0JykuYWZ0ZXIoJzxidXR0b24gY2xhc3M9XCJpY29uIGljb24tLWFycm93IGljb24tLXNtYWxsXCIgYXJpYS1leHBhbmRlZD1cImZhbHNlXCIgZGF0YS1vbC1oYXMtY2xpY2staGFuZGxlciBhcmlhLWV4cGFuZGVkPVwiZmFsc2VcIj4nICtcbiAgICAgICc8c3BhbiBjbGFzcz1cInZpc3VhbGx5aGlkZGVuXCI+JyArIG1lbnVzdHJpbmdzLnNob3dzdWJtZW51ICsgJyAnICsgJCh0aGlzKS5maW5kKCdhOmZpcnN0IHNwYW4nKS50ZXh0KCkgKyAnPC9zcGFuPicgK1xuICAgICAgJzwvYnV0dG9uPicpO1xuXG4gICAgJCh0aGlzKS5maW5kKCcuc3ViLW1lbnUnKS5hdHRyKCdhcmlhLWhpZGRlbicsIHRydWUpO1xuICB9KTtcblxuICAvLyBBZGQgY2xhc3Mgb24gbW91c2UgZW50ZXJcbiAgJCgnLm1lbnUtcHJpbWFyeSA+IGxpLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4gPiBhJykubW91c2VlbnRlcihmdW5jdGlvbiAoKSB7XG4gICAgaWYgKCEoJCh0aGlzKS5oYXNDbGFzcygnb3BlbicpKSkge1xuICAgICAgLy8gVW5zZXQgb3RoZXIgYWN0aXZlIGlmIHRoZXJlXG4gICAgICAkKCcubWVudS1wcmltYXJ5JykuZmluZCgnLm9wZW4nKS5yZW1vdmVDbGFzcygnb3BlbicpO1xuICAgICAgJCgnLm1lbnUtcHJpbWFyeScpLmZpbmQoJ3VsW2FyaWEtaGlkZGVuPVwiZmFsc2VcIl0nKS5hdHRyKCdhcmlhLWhpZGRlbicsICd0cnVlJyk7XG5cbiAgICAgIC8vIEFkZCBhdHRyaWJ1dGVzIHRvIGN1cnJlbnQgbWVudVxuICAgICAgJCh0aGlzKS5wYXJlbnQoKS5hZGRDbGFzcygnb3BlbicpLmZpbmQoJy5zdWItbWVudScpLmF0dHIoJ2FyaWEtaGlkZGVuJywgJ2ZhbHNlJyk7XG4gICAgICAkKHRoaXMpLmZpbmQoJ2E6Zmlyc3QtY2hpbGQnKS5hdHRyKCdhcmlhLWV4cGFuZGVkJywgJ3RydWUnKTtcbiAgICB9XG4gIH0pO1xuXG4gIC8vIEFuZCByZW1vdmUgYWdhaW4gb24gbW91c2VsZWF2ZVxuICAkKCcubWVudS1wcmltYXJ5ID4gbGkubWVudS1pdGVtLWhhcy1jaGlsZHJlbiAuc3ViLW1lbnUnKS5tb3VzZWxlYXZlKGZ1bmN0aW9uICgpIHtcbiAgICAvLyBBZGQgYXR0cmlidXRlcyB0byBjdXJyZW50IG1lbnVcbiAgICAkKHRoaXMpLnBhcmVudCgpLnJlbW92ZUNsYXNzKCdvcGVuJyk7XG4gICAgJCh0aGlzKS5hdHRyKCdhcmlhLWhpZGRlbicsICd0cnVlJyk7XG4gICAgJCh0aGlzKS5wYXJlbnQoKS5maW5kKCdhOmZpcnN0LWNoaWxkJykuYXR0cignYXJpYS1leHBhbmRlZCcsICdmYWxzZScpO1xuICB9KTtcblxuICAvLyBBZGQgdG9nZ2xlIGJlaGF2aW91ciBvbiBjbGlja1xuICAkKCcubmF2LXByaW1hcnkgLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4gPiBidXR0b24nKS5jbGljayhmdW5jdGlvbiAoKSB7XG4gICAgdmFyIG1lbnVJdGVtID0gJCh0aGlzKS5wYXJlbnQoKTtcbiAgICB2YXIgY3VycmVudEFjdGl2ZSA9ICQoJy5uYXYtcHJpbWFyeSAubWVudS1pdGVtLm9wZW4nKTtcblxuICAgIGlmICghKG1lbnVJdGVtLmhhc0NsYXNzKCdvcGVuJykpKSB7XG4gICAgICAvL1N1Ym1lbnUgaXMgY2xvc2VkLCBoYXMgdG8gb3BlblxuICAgICAgaWYoY3VycmVudEFjdGl2ZS5sZW5ndGgpe1xuICAgICAgICAvL0lmIHRoZXJlIGlzIGFub3RoZXIgaXRlbSBvcGVuIHJlbW92ZSBpdFxuICAgICAgICBjdXJyZW50QWN0aXZlLnJlbW92ZUNsYXNzKCdvcGVuJykuZmluZCgnLnN1Yi1tZW51JykuYXR0cignYXJpYS1oaWRkZW4nLCB0cnVlKTtcbiAgICAgICAgY3VycmVudEFjdGl2ZS5maW5kKCdidXR0b24nKS5hdHRyKCdhcmlhLWV4cGFuZGVkJywgZmFsc2UpO1xuICAgICAgfVxuXG4gICAgICAkKHRoaXMpLmF0dHIoJ2FyaWEtZXhwYW5kZWQnLCB0cnVlKS5maW5kKCdzcGFuJykudGV4dCggbWVudXN0cmluZ3MuY2xvc2VzdWJtZW51ICsgJyAnICsgbWVudUl0ZW0uZmluZCgnYTpmaXJzdCBzcGFuJykudGV4dCgpKTtcbiAgICAgIG1lbnVJdGVtLmFkZENsYXNzKCdvcGVuJykuZmluZCgnLnN1Yi1tZW51JykuYXR0cignYXJpYS1oaWRkZW4nLCBmYWxzZSk7XG5cbiAgICB9IGVsc2UgaWYgKG1lbnVJdGVtLmhhc0NsYXNzKCdvcGVuJykpIHtcbiAgICAgIC8vIFN1Ym1lbnUgaXMgb3BlbiwgaGFzIHRvIGNsb3NlXG4gICAgICAkKHRoaXMpLmF0dHIoJ2FyaWEtZXhwYW5kZWQnLCBmYWxzZSkuZmluZCgnc3BhbicpLnRleHQoIG1lbnVzdHJpbmdzLnNob3dzdWJtZW51ICsgJyAnICsgbWVudUl0ZW0uZmluZCgnYTpmaXJzdCBzcGFuJykudGV4dCgpKTtcbiAgICAgIG1lbnVJdGVtLnJlbW92ZUNsYXNzKCdvcGVuJykuZmluZCgnLnN1Yi1tZW51JykuYXR0cignYXJpYS1oaWRkZW4nLCB0cnVlKTtcbiAgICB9XG4gIH0pO1xuXG4gIC8vUmVtb3ZlIG9wZW5cbn1cblxuZnVuY3Rpb24gbmF2TW9iaWxlKCkge1xuXG4gIGNvbnN0IG1lbnVCdG4gPSAkKCcuYnRuLS10b2dnbGUtbWVudScpO1xuXG4gIC8vIFVuc2V0IGRlc2t0b3AgdGhpbmdzXG4gIGlmKCQoJ2J1dHRvbi5pY29uJykubGVuZ3RoKXtcbiAgICAkKCdidXR0b24uaWNvbicpLnJlbW92ZSgpO1xuICB9XG5cbiAgJCgnLm5hdi1wcmltYXJ5IC5tZW51LWl0ZW0taGFzLWNoaWxkcmVuJykuZWFjaChmdW5jdGlvbiAoKSB7XG4gICAgJCh0aGlzKS5maW5kKCcuc3ViLW1lbnUnKS5yZW1vdmVBdHRyKCdhcmlhLWhpZGRlbicpO1xuICB9KTtcblxuXG4gIGNvbnN0IG1lbnVCdG5IdG1sID1cbiAgICAnPGJ1dHRvbiBjbGFzcz1cImJ0biBidG4tLXRvZ2dsZS1tZW51XCIgJyArXG4gICAgJ2FyaWEtaGFzcG9wdXA9XCJ0cnVlXCIgYXJpYS1jb250cm9scz1cIm1lbnUtcHJpbWFyeVwiIGFyaWEtZXhwYW5kZWQ9XCJmYWxzZVwiIGFyaWEtbGFiZWw9XCJPcGVuIG1lbnVcIj4nICtcbiAgICAnPGk+JiN4MjI2MTs8L2k+PHNwYW4gY2xhc3M9XCJidG5fX3RleHRcIj5NZW51PC9zcGFuPicgK1xuICAgICc8L2J1dHRvbj4nO1xuXG4gIGlmKCEobWVudUJ0bi5sZW5ndGgpKSB7XG4gICAgJCgnLnNpdGUtaGVhZGVyID4gLndyYXAnKS5hcHBlbmQobWVudUJ0bkh0bWwpO1xuICB9XG5cbiAgJCgnLmJ0bi0tdG9nZ2xlLW1lbnUnKS5jbGljayhmdW5jdGlvbigpe1xuICAgIGlmKCQodGhpcykuaGFzQ2xhc3MoJ2FjdGl2ZScpKXtcbiAgICAgICQodGhpcykuZmluZCgnaScpLmh0bWwoJyYjeDIyNjE7Jyk7XG4gICAgfSBlbHNlIHtcbiAgICAgICQodGhpcykuZmluZCgnaScpLmh0bWwoJyZ0aW1lczsnKTtcbiAgICB9XG4gICAgJCgnYm9keScpLnRvZ2dsZUNsYXNzKCdtZW51LW9wZW4nKTtcbiAgICAkKCcubmF2LXByaW1hcnknKS50b2dnbGVDbGFzcygnc2hvdycpO1xuICAgICQodGhpcykudG9nZ2xlQ2xhc3MoJ2FjdGl2ZScpO1xuICB9KTtcblxuXG59XG5cbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuXG4vLyBtZWRpYSBxdWVyeSBjaGFuZ2VcbmZ1bmN0aW9uIFdpZHRoQ2hhbmdlKG1xKSB7XG5cbiAgaWYgKG1xLm1hdGNoZXMpIHtcbiAgICAvLyB3aW5kb3cgd2lkdGggaXMgYXQgbGVhc3QgODMwcHhcbiAgICAvLyBkb24ndCBzaG93IG1lbnUgYnV0dG9uXG4gICAgbmF2RGVza3RvcChkb2N1bWVudCwgd2luZG93KTtcbiAgfVxuICBlbHNlIHtcbiAgICAvLyB3aW5kb3cgd2lkdGggaXMgbGVzcyB0aGFuIDgzMHB4XG4gICAgLy8gRE8gc2hvdyBtZW51IGJ1dHRvblxuICAgIG5hdk1vYmlsZShkb2N1bWVudCwgd2luZG93KTtcblxuICB9XG5cbn1cblxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG5cbi8vIG1lZGlhIHF1ZXJ5IGV2ZW50IGhhbmRsZXJcbmlmIChtYXRjaE1lZGlhICYmIG1haW5NZW51KSB7XG4gIHZhciBtcSA9IHdpbmRvdy5tYXRjaE1lZGlhKCcobWluLXdpZHRoOiA5MDBweCknKTtcbiAgbXEuYWRkTGlzdGVuZXIoV2lkdGhDaGFuZ2UpO1xuICBXaWR0aENoYW5nZShtcSk7XG59XG5cblxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4iXSwiZmlsZSI6ImdjLW1haW4tZGVidWcuanMifQ==
