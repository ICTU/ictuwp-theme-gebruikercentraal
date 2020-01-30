(function ($, document, window) { 
//
// Gebruiker Centraal - menu.js
// ----------------------------------------------------------------------------------
// Functionaliteit voor tonen / verbergen mobiel menu
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
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
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJnYy1tYWluLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIi8vXG4vLyBHZWJydWlrZXIgQ2VudHJhYWwgLSBtZW51LmpzXG4vLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4vLyBGdW5jdGlvbmFsaXRlaXQgdm9vciB0b25lbiAvIHZlcmJlcmdlbiBtb2JpZWwgbWVudVxuLy8gLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLVxuLy8gQHBhY2thZ2UgZ2VicnVpa2VyLWNlbnRyYWFsXG4vLyBAYXV0aG9yICBQYXVsIHZhbiBCdXVyZW5cbi8vIEBsaWNlbnNlIEdQTC0yLjArXG4vLyBAdmVyc2lvbiAzLjE1Ljlcbi8vIEBkZXNjLiAgIENUQS1rbGV1cmVuLCBhMTF5IGdyb2VuLCBzaGFyaW5nIGJ1dHRvbnMgb3B0aW9uYWwsIGJlZWxkYmFuayBDUFQgY29kZSBzZXBhcmF0aW9uLlxuLy8gQGxpbmsgICAgaHR0cHM6Ly9naXRodWIuY29tL0lDVFUvZ2VicnVpa2VyLWNlbnRyYWFsLXdvcmRwcmVzcy10aGVtZVxuXG5cbi8vIFZhcnNcbnZhciBoZWFkZXIgPSAkKCcuc2l0ZS1oZWFkZXInKSxcbiAgbWFpbk1lbnUgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcubmF2LXByaW1hcnknKTtcblxuXG5mdW5jdGlvbiBuYXZEZXNrdG9wKCkge1xuXG4gIC8vIFJlbW92ZSBtZW51IGJ1dHRvbiBpZiB0aGVyZVxuICBpZigkKCcuYnRuLS10b2dnbGUtbWVudScpLmxlbmd0aCl7XG4gICAgJCgnLmJ0bi0tdG9nZ2xlLW1lbnUnKS5yZW1vdmUoKTtcbiAgfVxuXG4gIC8vIEFkZCBidXR0b25zXG4gICQoJy5uYXYtcHJpbWFyeSAubWVudS1pdGVtLWhhcy1jaGlsZHJlbicpLmVhY2goZnVuY3Rpb24gKCkge1xuXG4gICAgJCh0aGlzKS5maW5kKCdhOmZpcnN0JykuYXR0cignYXJpYS1leHBhbmRlZCcsIHRydWUpO1xuXG4gICAgLy8gQWRkIGEgYnV0dG9uIHRvIGVhY2ggbGluayB3aXRoIGEgc3VibWVudVxuICAgICQodGhpcykuZmluZCgnYTpmaXJzdCcpLmFmdGVyKCc8YnV0dG9uIGNsYXNzPVwiaWNvbiBpY29uLS1hcnJvdyBpY29uLS1zbWFsbFwiIGFyaWEtZXhwYW5kZWQ9XCJmYWxzZVwiIGRhdGEtb2wtaGFzLWNsaWNrLWhhbmRsZXIgYXJpYS1leHBhbmRlZD1cImZhbHNlXCI+JyArXG4gICAgICAnPHNwYW4gY2xhc3M9XCJ2aXN1YWxseWhpZGRlblwiPk9wZW4gc3VibWVudSAnICsgJCh0aGlzKS5maW5kKCdhOmZpcnN0IHNwYW4nKS50ZXh0KCkgKyAnPC9zcGFuPicgK1xuICAgICAgJzwvYnV0dG9uPicpO1xuXG4gICAgJCh0aGlzKS5maW5kKCcuc3ViLW1lbnUnKS5hdHRyKCdhcmlhLWhpZGRlbicsIHRydWUpO1xuICB9KTtcblxuICAvLyBBZGQgY2xhc3Mgb24gbW91c2UgZW50ZXJcbiAgJCgnLm1lbnUtcHJpbWFyeSA+IGxpLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4gPiBhJykubW91c2VlbnRlcihmdW5jdGlvbiAoKSB7XG4gICAgaWYgKCEoJCh0aGlzKS5oYXNDbGFzcygnb3BlbicpKSkge1xuICAgICAgLy8gVW5zZXQgb3RoZXIgYWN0aXZlIGlmIHRoZXJlXG4gICAgICAkKCcubWVudS1wcmltYXJ5JykuZmluZCgnLm9wZW4nKS5yZW1vdmVDbGFzcygnb3BlbicpO1xuICAgICAgJCgnLm1lbnUtcHJpbWFyeScpLmZpbmQoJ3VsW2FyaWEtaGlkZGVuPVwiZmFsc2VcIl0nKS5hdHRyKCdhcmlhLWhpZGRlbicsICd0cnVlJyk7XG5cbiAgICAgIC8vIEFkZCBhdHRyaWJ1dGVzIHRvIGN1cnJlbnQgbWVudVxuICAgICAgJCh0aGlzKS5wYXJlbnQoKS5hZGRDbGFzcygnb3BlbicpLmZpbmQoJy5zdWItbWVudScpLmF0dHIoJ2FyaWEtaGlkZGVuJywgJ2ZhbHNlJyk7XG4gICAgICAkKHRoaXMpLmZpbmQoJ2E6Zmlyc3QtY2hpbGQnKS5hdHRyKCdhcmlhLWV4cGFuZGVkJywgJ3RydWUnKTtcbiAgICB9XG4gIH0pO1xuXG4gIC8vIEFuZCByZW1vdmUgYWdhaW4gb24gbW91c2VsZWF2ZVxuICAkKCcubWVudS1wcmltYXJ5ID4gbGkubWVudS1pdGVtLWhhcy1jaGlsZHJlbiAuc3ViLW1lbnUnKS5tb3VzZWxlYXZlKGZ1bmN0aW9uICgpIHtcbiAgICAvLyBBZGQgYXR0cmlidXRlcyB0byBjdXJyZW50IG1lbnVcbiAgICAkKHRoaXMpLnBhcmVudCgpLnJlbW92ZUNsYXNzKCdvcGVuJyk7XG4gICAgJCh0aGlzKS5hdHRyKCdhcmlhLWhpZGRlbicsICd0cnVlJyk7XG4gICAgJCh0aGlzKS5wYXJlbnQoKS5maW5kKCdhOmZpcnN0LWNoaWxkJykuYXR0cignYXJpYS1leHBhbmRlZCcsICdmYWxzZScpO1xuICB9KTtcblxuICAvLyBBZGQgdG9nZ2xlIGJlaGF2aW91ciBvbiBjbGlja1xuICAkKCcubmF2LXByaW1hcnkgLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4gPiBidXR0b24nKS5jbGljayhmdW5jdGlvbiAoKSB7XG4gICAgdmFyIG1lbnVJdGVtID0gJCh0aGlzKS5wYXJlbnQoKTtcbiAgICB2YXIgY3VycmVudEFjdGl2ZSA9ICQoJy5uYXYtcHJpbWFyeSAubWVudS1pdGVtLm9wZW4nKTtcblxuICAgIGlmICghKG1lbnVJdGVtLmhhc0NsYXNzKCdvcGVuJykpKSB7XG4gICAgICAvL1N1Ym1lbnUgaXMgY2xvc2VkLCBoYXMgdG8gb3BlblxuICAgICAgaWYoY3VycmVudEFjdGl2ZS5sZW5ndGgpe1xuICAgICAgICAvL0lmIHRoZXJlIGlzIGFub3RoZXIgaXRlbSBvcGVuIHJlbW92ZSBpdFxuICAgICAgICBjdXJyZW50QWN0aXZlLnJlbW92ZUNsYXNzKCdvcGVuJykuZmluZCgnLnN1Yi1tZW51JykuYXR0cignYXJpYS1oaWRkZW4nLCB0cnVlKTtcbiAgICAgICAgY3VycmVudEFjdGl2ZS5maW5kKCdidXR0b24nKS5hdHRyKCdhcmlhLWV4cGFuZGVkJywgZmFsc2UpO1xuICAgICAgfVxuXG4gICAgICAkKHRoaXMpLmF0dHIoJ2FyaWEtZXhwYW5kZWQnLCB0cnVlKS5maW5kKCdzcGFuJykudGV4dCgnU2x1aXQgJyArIG1lbnVJdGVtLmZpbmQoJ2E6Zmlyc3Qgc3BhbicpLnRleHQoKSk7XG4gICAgICBtZW51SXRlbS5hZGRDbGFzcygnb3BlbicpLmZpbmQoJy5zdWItbWVudScpLmF0dHIoJ2FyaWEtaGlkZGVuJywgZmFsc2UpO1xuXG4gICAgfSBlbHNlIGlmIChtZW51SXRlbS5oYXNDbGFzcygnb3BlbicpKSB7XG4gICAgICAvLyBTdWJtZW51IGlzIG9wZW4sIGhhcyB0byBjbG9zZVxuICAgICAgJCh0aGlzKS5hdHRyKCdhcmlhLWV4cGFuZGVkJywgZmFsc2UpLmZpbmQoJ3NwYW4nKS50ZXh0KCdPcGVuICcgKyBtZW51SXRlbS5maW5kKCdhOmZpcnN0IHNwYW4nKS50ZXh0KCkpO1xuICAgICAgbWVudUl0ZW0ucmVtb3ZlQ2xhc3MoJ29wZW4nKS5maW5kKCcuc3ViLW1lbnUnKS5hdHRyKCdhcmlhLWhpZGRlbicsIHRydWUpO1xuICAgIH1cbiAgfSk7XG5cbiAgLy9SZW1vdmUgb3BlblxufVxuXG5mdW5jdGlvbiBuYXZNb2JpbGUoKSB7XG5cbiAgY29uc3QgbWVudUJ0biA9ICQoJy5idG4tLXRvZ2dsZS1tZW51Jyk7XG5cbiAgLy8gVW5zZXQgZGVza3RvcCB0aGluZ3NcbiAgaWYoJCgnYnV0dG9uLmljb24nKS5sZW5ndGgpe1xuICAgICQoJ2J1dHRvbi5pY29uJykucmVtb3ZlKCk7XG4gIH1cblxuICAkKCcubmF2LXByaW1hcnkgLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4nKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICAkKHRoaXMpLmZpbmQoJy5zdWItbWVudScpLnJlbW92ZUF0dHIoJ2FyaWEtaGlkZGVuJyk7XG4gIH0pO1xuXG5cbiAgY29uc3QgbWVudUJ0bkh0bWwgPVxuICAgICc8YnV0dG9uIGNsYXNzPVwiYnRuIGJ0bi0tdG9nZ2xlLW1lbnVcIiAnICtcbiAgICAnYXJpYS1oYXNwb3B1cD1cInRydWVcIiBhcmlhLWNvbnRyb2xzPVwibWVudS1wcmltYXJ5XCIgYXJpYS1leHBhbmRlZD1cImZhbHNlXCIgYXJpYS1sYWJlbD1cIk9wZW4gbWVudVwiPicgK1xuICAgICc8aT4mI3gyMjYxOzwvaT48c3BhbiBjbGFzcz1cImJ0bl9fdGV4dFwiPk1lbnU8L3NwYW4+JyArXG4gICAgJzwvYnV0dG9uPic7XG5cbiAgaWYoIShtZW51QnRuLmxlbmd0aCkpIHtcbiAgICAkKCcuc2l0ZS1oZWFkZXIgPiAud3JhcCcpLmFwcGVuZChtZW51QnRuSHRtbCk7XG4gIH1cblxuICAkKCcuYnRuLS10b2dnbGUtbWVudScpLmNsaWNrKGZ1bmN0aW9uKCl7XG4gICAgaWYoJCh0aGlzKS5oYXNDbGFzcygnYWN0aXZlJykpe1xuICAgICAgJCh0aGlzKS5maW5kKCdpJykuaHRtbCgnJiN4MjI2MTsnKTtcbiAgICB9IGVsc2Uge1xuICAgICAgJCh0aGlzKS5maW5kKCdpJykuaHRtbCgnJnRpbWVzOycpO1xuICAgIH1cbiAgICAkKCdib2R5JykudG9nZ2xlQ2xhc3MoJ21lbnUtb3BlbicpO1xuICAgICQoJy5uYXYtcHJpbWFyeScpLnRvZ2dsZUNsYXNzKCdzaG93Jyk7XG4gICAgJCh0aGlzKS50b2dnbGVDbGFzcygnYWN0aXZlJyk7XG4gIH0pO1xuXG5cbn1cblxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG5cbi8vIG1lZGlhIHF1ZXJ5IGNoYW5nZVxuZnVuY3Rpb24gV2lkdGhDaGFuZ2UobXEpIHtcblxuICBpZiAobXEubWF0Y2hlcykge1xuICAgIC8vIHdpbmRvdyB3aWR0aCBpcyBhdCBsZWFzdCA4MzBweFxuICAgIC8vIGRvbid0IHNob3cgbWVudSBidXR0b25cbiAgICBuYXZEZXNrdG9wKGRvY3VtZW50LCB3aW5kb3cpO1xuICB9XG4gIGVsc2Uge1xuICAgIC8vIHdpbmRvdyB3aWR0aCBpcyBsZXNzIHRoYW4gODMwcHhcbiAgICAvLyBETyBzaG93IG1lbnUgYnV0dG9uXG4gICAgbmF2TW9iaWxlKGRvY3VtZW50LCB3aW5kb3cpO1xuXG4gIH1cblxufVxuXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cblxuLy8gbWVkaWEgcXVlcnkgZXZlbnQgaGFuZGxlclxuaWYgKG1hdGNoTWVkaWEgJiYgbWFpbk1lbnUpIHtcbiAgdmFyIG1xID0gd2luZG93Lm1hdGNoTWVkaWEoJyhtaW4td2lkdGg6IDkwMHB4KScpO1xuICBtcS5hZGRMaXN0ZW5lcihXaWR0aENoYW5nZSk7XG4gIFdpZHRoQ2hhbmdlKG1xKTtcbn1cblxuXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiJdLCJmaWxlIjoiZ2MtbWFpbi1kZWJ1Zy5qcyJ9
