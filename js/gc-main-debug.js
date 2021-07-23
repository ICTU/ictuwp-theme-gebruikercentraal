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
// @version 5.0.32
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme

//menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-972

const breakpointmenu = 900; // op 900px toggle tussen desktop / mobiel, zie ook 'nav': 900px
const totalMenuElement = document.getElementById("menu-primary");
const menuItems = document.querySelectorAll("li.menu-item-has-children");
const toggleMenu = document.querySelectorAll(".btn--toggle-menu");
const divMenuContainer = document.querySelectorAll(".l-header-nav");
const mainMenu =  document.querySelector('.nav-primary');
const body = document.getElementsByTagName("body");

function hoverListItem(theObject, dinges) {

  theObject.querySelector('button').classList.remove('default');

  if (theObject.classList.contains('open')) {
    // dit list-item heeft class: .open, dus status is open; nieuwe status wordt: alles sluiten
    theObject.classList.remove('open');
    theObject.classList.add('closed'); // expliciete class, want klik en mouse-events lopen door elkaar

    theObject.querySelector('a').setAttribute('aria-expanded', "false");
    if (typeof theObject.querySelector('button') != 'undefined') {
      theObject.querySelector('button').setAttribute('aria-expanded', "false");
    }
    theObject.querySelector('ul.sub-menu').classList.add('visuallyhidden');
    theObject.querySelector('ul.sub-menu').setAttribute('aria-expanded', "false");
  } else {
    // heeft GEEN class: .open, dus status is niet open; nieuwe status wordt: alles openen
    theObject.classList.add('open');
    theObject.classList.remove('closed');

    theObject.querySelector('a').setAttribute('aria-expanded', "true");
    if (typeof theObject.querySelector('button') != 'undefined') {
      theObject.querySelector('button').setAttribute('aria-expanded', "true");
    }
    theObject.querySelector('ul.sub-menu').classList.remove('visuallyhidden');
    theObject.querySelector('ul.sub-menu').setAttribute('aria-expanded', "true");
  }

}

function openMenuItems() {

  // alle items openen en eventuele andere classes voor elk list-item verwijderen
  Array.prototype.forEach.call(menuItems, function (el, i) {

    el.classList.add("open");
    var sublist = el.querySelector("ul.sub-menu");
    if (sublist) {
      sublist.classList.remove("visuallyhidden");
      sublist.setAttribute('aria-expanded', "true");
    }

    el.removeEventListener("mouseenter", function (event) {
      hoverListItem(this, 'over');
    });
    el.removeEventListener("mouseleave", function (event) {
      hoverListItem(this, 'out');
    });

  });

}

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
    }

  });
}

function istotalMenuElementMenu(event) {
  if (totalMenuElement !== event.target && !totalMenuElement.contains(event.target)) {
    closeMenuItems();
  }
}

document.onkeydown = function (evt) {
  evt = evt || window.event;
  if (evt.keyCode == 27) {
    // close with ESC
    closeMenuItems();
  }
};
document.addEventListener('click', istotalMenuElementMenu);

// =========================================================================================================


function cleanUpMenu() {
  // verwijder eventueel al aanwezige menu-knoppen van een vorige keer (window resize bby)
  document.querySelectorAll('button.main-menu__open-sub').forEach(function (thisElement) {
    thisElement.remove();
  });

}

// =========================================================================================================


function doNav(width) {


  // Zorgen dat alle eventuele toegevoegde buttons weer weggehaald worden
  cleanUpMenu();

  if (width < breakpointmenu) {

    // classes en attributen weghalen die ervoro zorgen dat submenu-items verborgen worden
    openMenuItems();

    toggleMenu[0].addEventListener("click", function (event) {
      if (this.classList.contains('active')) {
        this.classList.remove('active');
        body[0].classList.remove('show-menu');
      } else {
        this.classList.add('active');
        body[0].classList.add('show-menu');
      }
    });

  } else {
    // Desktop


    Array.prototype.forEach.call(menuItems, function (el, i) {
      var thisListItem = el;

      var currentSubmenus = thisListItem.querySelector('.sub-menu');
      var anchorInListItem = el.querySelector('a');
      var appendButtonAfterAnchor = '<button class="icon icon--arrow icon--small" aria-expanded="false" data-ol-has-click-handler aria-expanded="false"><span class="visuallyhidden">Submenu voor “' + anchorInListItem.text + '”</span></button>';
//      var appendButtonAfterAnchor = '<button class="main-menu__open-sub default"><span><span class="visuallyhidden">Submenu voor “' + anchorInListItem.text + '”</span></span></button>';
      anchorInListItem.insertAdjacentHTML('afterend', appendButtonAfterAnchor);

      // verberg het submenu in dit listitem
      currentSubmenus.classList.add('visuallyhidden');

      el.querySelector('button').addEventListener("click", function (event) {

        this.classList.remove('default');

        // klikken kan:
        // - met toetsenbord, zonder hoveracties (bijv. als je alleen met toetsenbord navigeert)
        // - met muis, dus met hoveracties. In dat geval:
        //      - kan het list-item al open zijn
        //      - kan het list-item al gesloten zijn zijn

        var subList = this.parentNode.querySelector('ul.sub-menu');
        var varExpanded = subList.getAttribute('aria-expanded');
        var isVisible = true;
        var isExpanded = false;
        if ( subList.classList.contains('visuallyhidden') ) {
          isVisible = false;
        }
        if ( varExpanded.toString() !== 'false' ) {
          isExpanded = true;
        }

        if ( isExpanded && isVisible ) {
          // heeft wel class open, dus status is open; nieuwe status wordt: alles sluiten
          this.parentNode.classList.remove('open');
          this.parentNode.querySelector('a').setAttribute('aria-expanded', "false");
          this.parentNode.querySelector('button').setAttribute('aria-expanded', "false");
          this.parentNode.querySelector('button').classList.remove('open-list');
          this.parentNode.querySelector('ul.sub-menu').classList.add('visuallyhidden');
          this.parentNode.querySelector('ul.sub-menu').setAttribute('aria-expanded', "false");
        } else {
          // heeft GEEN class open, dus status is niet open; nieuwe status wordt: alles openen
          this.parentNode.classList.add('open');
          this.parentNode.querySelector('a').setAttribute('aria-expanded', "true");
          this.parentNode.querySelector('button').setAttribute('aria-expanded', "true");
          this.parentNode.querySelector('button').classList.add('open-list');
          this.parentNode.querySelector('ul.sub-menu').classList.remove('visuallyhidden');
          this.parentNode.querySelector('ul.sub-menu').setAttribute('aria-expanded', "true");
        }
        event.preventDefault();
      });
      thisListItem.addEventListener("mouseenter", function (event) {
        hoverListItem(this, 'over');
      });
      thisListItem.addEventListener("mouseleave", function (event) {
        hoverListItem(this, 'out');
      });


    });


  }
}


var isIE11 = !!window.MSInputMethodContext && !!document.documentMode;

if ( isIE11 ) {
  // lalala, niks leuks voor IE11
}
else {

  window.addEventListener('load', function () {
    var windowwidth = window.innerWidth;
    doNav(windowwidth);
  });

  window.addEventListener('resize', function () {
    var windowwidth = window.innerWidth;
    doNav(windowwidth);
  });

}

// =========================================================================================================
})(jQuery, document, window);
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJnYy1tYWluLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIi8vXG4vLyBHZWJydWlrZXIgQ2VudHJhYWwgLSBmaWx0ZXJzLmpzXG4vLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4vLyBGdW5jdGlvbmFsaXRlaXQgdm9vciBoZXQgdG9ldm9lZ2VuIHZhbiBlZW4gYWN0aXZlIGNsYXNzIGFhbiBmaWx0ZXJzXG4vLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4vLyBAcGFja2FnZSBnZWJydWlrZXItY2VudHJhYWxcbi8vIEBhdXRob3IgIFRhbWFyYSBkZSBIYWFzXG4vLyBAbGljZW5zZSBHUEwtMi4wK1xuLy8gQHZlcnNpb24gMy4xNS45XG4vLyBAbGluayAgICBodHRwczovL2dpdGh1Yi5jb20vSUNUVS9pY3R1d3AtdGhlbWUtZ2VicnVpa2VyY2VudHJhYWxcblxuXG52YXIgZmlsdGVyTGFiZWwgPSAkKCcuZm9ybS1pdGVtLS1maWx0ZXIgbGFiZWwnKTtcblxuZmlsdGVyTGFiZWwuY2xpY2soZnVuY3Rpb24gKCkge1xuXG4gICAgdmFyIGZvcm1JdGVtID0gJCh0aGlzKS5wYXJlbnQoKTtcblxuICAgIGlmIChmb3JtSXRlbS5maW5kKCdpbnB1dDpjaGVja2VkJykubGVuZ3RoKSB7XG4gICAgICAgIGZvcm1JdGVtLnJlbW92ZUNsYXNzKCdpcy1hY3RpdmUnKTtcbiAgICB9IGVsc2Uge1xuICAgICAgICBmb3JtSXRlbS5hZGRDbGFzcygnaXMtYWN0aXZlJyk7XG4gICAgfVxuXG59KTtcblxuXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cblxuLy9cbi8vIEdlYnJ1aWtlciBDZW50cmFhbCAtIG1lbnUuanNcbi8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbi8vIEZ1bmN0aW9uYWxpdGVpdCB2b29yIHRvbmVuIC8gdmVyYmVyZ2VuIG1vYmllbCBtZW51XG4vLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4vLyBAcGFja2FnZSBnZWJydWlrZXItY2VudHJhYWxcbi8vIEBhdXRob3IgIFRhbWFyYSBkZSBIYWFzLCBQYXVsIHZhbiBCdXVyZW5cbi8vIEBsaWNlbnNlIEdQTC0yLjArXG4vLyBAdmVyc2lvbiA1LjAuMzJcbi8vIEBsaW5rICAgIGh0dHBzOi8vZ2l0aHViLmNvbS9JQ1RVL2dlYnJ1aWtlci1jZW50cmFhbC13b3JkcHJlc3MtdGhlbWVcblxuLy9tZW51LWl0ZW0gbWVudS1pdGVtLXR5cGUtdGF4b25vbXkgbWVudS1pdGVtLW9iamVjdC1jYXRlZ29yeSBtZW51LWl0ZW0taGFzLWNoaWxkcmVuIG1lbnUtaXRlbS05NzJcblxuY29uc3QgYnJlYWtwb2ludG1lbnUgPSA5MDA7IC8vIG9wIDkwMHB4IHRvZ2dsZSB0dXNzZW4gZGVza3RvcCAvIG1vYmllbCwgemllIG9vayAnbmF2JzogOTAwcHhcbmNvbnN0IHRvdGFsTWVudUVsZW1lbnQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcIm1lbnUtcHJpbWFyeVwiKTtcbmNvbnN0IG1lbnVJdGVtcyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoXCJsaS5tZW51LWl0ZW0taGFzLWNoaWxkcmVuXCIpO1xuY29uc3QgdG9nZ2xlTWVudSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoXCIuYnRuLS10b2dnbGUtbWVudVwiKTtcbmNvbnN0IGRpdk1lbnVDb250YWluZXIgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKFwiLmwtaGVhZGVyLW5hdlwiKTtcbmNvbnN0IG1haW5NZW51ID0gIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5uYXYtcHJpbWFyeScpO1xuY29uc3QgYm9keSA9IGRvY3VtZW50LmdldEVsZW1lbnRzQnlUYWdOYW1lKFwiYm9keVwiKTtcblxuZnVuY3Rpb24gaG92ZXJMaXN0SXRlbSh0aGVPYmplY3QsIGRpbmdlcykge1xuXG4gIHRoZU9iamVjdC5xdWVyeVNlbGVjdG9yKCdidXR0b24nKS5jbGFzc0xpc3QucmVtb3ZlKCdkZWZhdWx0Jyk7XG5cbiAgaWYgKHRoZU9iamVjdC5jbGFzc0xpc3QuY29udGFpbnMoJ29wZW4nKSkge1xuICAgIC8vIGRpdCBsaXN0LWl0ZW0gaGVlZnQgY2xhc3M6IC5vcGVuLCBkdXMgc3RhdHVzIGlzIG9wZW47IG5pZXV3ZSBzdGF0dXMgd29yZHQ6IGFsbGVzIHNsdWl0ZW5cbiAgICB0aGVPYmplY3QuY2xhc3NMaXN0LnJlbW92ZSgnb3BlbicpO1xuICAgIHRoZU9iamVjdC5jbGFzc0xpc3QuYWRkKCdjbG9zZWQnKTsgLy8gZXhwbGljaWV0ZSBjbGFzcywgd2FudCBrbGlrIGVuIG1vdXNlLWV2ZW50cyBsb3BlbiBkb29yIGVsa2FhclxuXG4gICAgdGhlT2JqZWN0LnF1ZXJ5U2VsZWN0b3IoJ2EnKS5zZXRBdHRyaWJ1dGUoJ2FyaWEtZXhwYW5kZWQnLCBcImZhbHNlXCIpO1xuICAgIGlmICh0eXBlb2YgdGhlT2JqZWN0LnF1ZXJ5U2VsZWN0b3IoJ2J1dHRvbicpICE9ICd1bmRlZmluZWQnKSB7XG4gICAgICB0aGVPYmplY3QucXVlcnlTZWxlY3RvcignYnV0dG9uJykuc2V0QXR0cmlidXRlKCdhcmlhLWV4cGFuZGVkJywgXCJmYWxzZVwiKTtcbiAgICB9XG4gICAgdGhlT2JqZWN0LnF1ZXJ5U2VsZWN0b3IoJ3VsLnN1Yi1tZW51JykuY2xhc3NMaXN0LmFkZCgndmlzdWFsbHloaWRkZW4nKTtcbiAgICB0aGVPYmplY3QucXVlcnlTZWxlY3RvcigndWwuc3ViLW1lbnUnKS5zZXRBdHRyaWJ1dGUoJ2FyaWEtZXhwYW5kZWQnLCBcImZhbHNlXCIpO1xuICB9IGVsc2Uge1xuICAgIC8vIGhlZWZ0IEdFRU4gY2xhc3M6IC5vcGVuLCBkdXMgc3RhdHVzIGlzIG5pZXQgb3BlbjsgbmlldXdlIHN0YXR1cyB3b3JkdDogYWxsZXMgb3BlbmVuXG4gICAgdGhlT2JqZWN0LmNsYXNzTGlzdC5hZGQoJ29wZW4nKTtcbiAgICB0aGVPYmplY3QuY2xhc3NMaXN0LnJlbW92ZSgnY2xvc2VkJyk7XG5cbiAgICB0aGVPYmplY3QucXVlcnlTZWxlY3RvcignYScpLnNldEF0dHJpYnV0ZSgnYXJpYS1leHBhbmRlZCcsIFwidHJ1ZVwiKTtcbiAgICBpZiAodHlwZW9mIHRoZU9iamVjdC5xdWVyeVNlbGVjdG9yKCdidXR0b24nKSAhPSAndW5kZWZpbmVkJykge1xuICAgICAgdGhlT2JqZWN0LnF1ZXJ5U2VsZWN0b3IoJ2J1dHRvbicpLnNldEF0dHJpYnV0ZSgnYXJpYS1leHBhbmRlZCcsIFwidHJ1ZVwiKTtcbiAgICB9XG4gICAgdGhlT2JqZWN0LnF1ZXJ5U2VsZWN0b3IoJ3VsLnN1Yi1tZW51JykuY2xhc3NMaXN0LnJlbW92ZSgndmlzdWFsbHloaWRkZW4nKTtcbiAgICB0aGVPYmplY3QucXVlcnlTZWxlY3RvcigndWwuc3ViLW1lbnUnKS5zZXRBdHRyaWJ1dGUoJ2FyaWEtZXhwYW5kZWQnLCBcInRydWVcIik7XG4gIH1cblxufVxuXG5mdW5jdGlvbiBvcGVuTWVudUl0ZW1zKCkge1xuXG4gIC8vIGFsbGUgaXRlbXMgb3BlbmVuIGVuIGV2ZW50dWVsZSBhbmRlcmUgY2xhc3NlcyB2b29yIGVsayBsaXN0LWl0ZW0gdmVyd2lqZGVyZW5cbiAgQXJyYXkucHJvdG90eXBlLmZvckVhY2guY2FsbChtZW51SXRlbXMsIGZ1bmN0aW9uIChlbCwgaSkge1xuXG4gICAgZWwuY2xhc3NMaXN0LmFkZChcIm9wZW5cIik7XG4gICAgdmFyIHN1Ymxpc3QgPSBlbC5xdWVyeVNlbGVjdG9yKFwidWwuc3ViLW1lbnVcIik7XG4gICAgaWYgKHN1Ymxpc3QpIHtcbiAgICAgIHN1Ymxpc3QuY2xhc3NMaXN0LnJlbW92ZShcInZpc3VhbGx5aGlkZGVuXCIpO1xuICAgICAgc3VibGlzdC5zZXRBdHRyaWJ1dGUoJ2FyaWEtZXhwYW5kZWQnLCBcInRydWVcIik7XG4gICAgfVxuXG4gICAgZWwucmVtb3ZlRXZlbnRMaXN0ZW5lcihcIm1vdXNlZW50ZXJcIiwgZnVuY3Rpb24gKGV2ZW50KSB7XG4gICAgICBob3Zlckxpc3RJdGVtKHRoaXMsICdvdmVyJyk7XG4gICAgfSk7XG4gICAgZWwucmVtb3ZlRXZlbnRMaXN0ZW5lcihcIm1vdXNlbGVhdmVcIiwgZnVuY3Rpb24gKGV2ZW50KSB7XG4gICAgICBob3Zlckxpc3RJdGVtKHRoaXMsICdvdXQnKTtcbiAgICB9KTtcblxuICB9KTtcblxufVxuXG5mdW5jdGlvbiBjbG9zZU1lbnVJdGVtcygpIHtcblxuICBjb25zb2xlLmxvZygnY2xvc2VNZW51SXRlbXMnKTtcblxuICB2YXIgd2lkdGggPSB3aW5kb3cuaW5uZXJXaWR0aDtcbiAgdmFyIGxpc3RpdGVtcyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoXCIubWVudS1pdGVtLWhhcy1jaGlsZHJlblwiKTtcblxuICBBcnJheS5wcm90b3R5cGUuZm9yRWFjaC5jYWxsKG1lbnVJdGVtcywgZnVuY3Rpb24gKGVsLCBpKSB7XG4gICAgZWwuY2xhc3NMaXN0LnJlbW92ZShcIm9wZW5cIik7XG4gICAgZWwucXVlcnlTZWxlY3RvcignYScpLnNldEF0dHJpYnV0ZSgnYXJpYS1leHBhbmRlZCcsIFwiZmFsc2VcIik7XG5cbiAgICBpZiAod2lkdGggPiBicmVha3BvaW50bWVudSkge1xuXG4gICAgICB2YXIgYnV0dG9uRXhpc3RzID0gZWwucXVlcnlTZWxlY3RvcignYnV0dG9uJyk7XG4gICAgICB2YXIgc3VibWVudSA9IGVsLnF1ZXJ5U2VsZWN0b3IoJ3VsLnN1Yi1tZW51Jyk7XG5cbiAgICAgIGlmIChidXR0b25FeGlzdHMgJiYgdHlwZW9mIGJ1dHRvbkV4aXN0cyAhPSAndW5kZWZpbmVkJykge1xuICAgICAgICBidXR0b25FeGlzdHMuc2V0QXR0cmlidXRlKCdhcmlhLWV4cGFuZGVkJywgXCJmYWxzZVwiKTtcbiAgICAgICAgYnV0dG9uRXhpc3RzLmNsYXNzTGlzdC5yZW1vdmUoJ29wZW4tbGlzdCcpO1xuICAgICAgfVxuICAgICAgZWwucXVlcnlTZWxlY3RvcigndWwuc3ViLW1lbnUnKS5jbGFzc0xpc3QuYWRkKCd2aXN1YWxseWhpZGRlbicpO1xuICAgIH1cblxuICB9KTtcbn1cblxuZnVuY3Rpb24gaXN0b3RhbE1lbnVFbGVtZW50TWVudShldmVudCkge1xuICBpZiAodG90YWxNZW51RWxlbWVudCAhPT0gZXZlbnQudGFyZ2V0ICYmICF0b3RhbE1lbnVFbGVtZW50LmNvbnRhaW5zKGV2ZW50LnRhcmdldCkpIHtcbiAgICBjbG9zZU1lbnVJdGVtcygpO1xuICB9XG59XG5cbmRvY3VtZW50Lm9ua2V5ZG93biA9IGZ1bmN0aW9uIChldnQpIHtcbiAgZXZ0ID0gZXZ0IHx8IHdpbmRvdy5ldmVudDtcbiAgaWYgKGV2dC5rZXlDb2RlID09IDI3KSB7XG4gICAgLy8gY2xvc2Ugd2l0aCBFU0NcbiAgICBjbG9zZU1lbnVJdGVtcygpO1xuICB9XG59O1xuZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBpc3RvdGFsTWVudUVsZW1lbnRNZW51KTtcblxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG5cblxuZnVuY3Rpb24gY2xlYW5VcE1lbnUoKSB7XG4gIC8vIHZlcndpamRlciBldmVudHVlZWwgYWwgYWFud2V6aWdlIG1lbnUta25vcHBlbiB2YW4gZWVuIHZvcmlnZSBrZWVyICh3aW5kb3cgcmVzaXplIGJieSlcbiAgZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnYnV0dG9uLm1haW4tbWVudV9fb3Blbi1zdWInKS5mb3JFYWNoKGZ1bmN0aW9uICh0aGlzRWxlbWVudCkge1xuICAgIHRoaXNFbGVtZW50LnJlbW92ZSgpO1xuICB9KTtcblxufVxuXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cblxuXG5mdW5jdGlvbiBkb05hdih3aWR0aCkge1xuXG5cbiAgLy8gWm9yZ2VuIGRhdCBhbGxlIGV2ZW50dWVsZSB0b2VnZXZvZWdkZSBidXR0b25zIHdlZXIgd2VnZ2VoYWFsZCB3b3JkZW5cbiAgY2xlYW5VcE1lbnUoKTtcblxuICBpZiAod2lkdGggPCBicmVha3BvaW50bWVudSkge1xuXG4gICAgLy8gY2xhc3NlcyBlbiBhdHRyaWJ1dGVuIHdlZ2hhbGVuIGRpZSBlcnZvcm8gem9yZ2VuIGRhdCBzdWJtZW51LWl0ZW1zIHZlcmJvcmdlbiB3b3JkZW5cbiAgICBvcGVuTWVudUl0ZW1zKCk7XG5cbiAgICB0b2dnbGVNZW51WzBdLmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCBmdW5jdGlvbiAoZXZlbnQpIHtcbiAgICAgIGlmICh0aGlzLmNsYXNzTGlzdC5jb250YWlucygnYWN0aXZlJykpIHtcbiAgICAgICAgdGhpcy5jbGFzc0xpc3QucmVtb3ZlKCdhY3RpdmUnKTtcbiAgICAgICAgYm9keVswXS5jbGFzc0xpc3QucmVtb3ZlKCdzaG93LW1lbnUnKTtcbiAgICAgIH0gZWxzZSB7XG4gICAgICAgIHRoaXMuY2xhc3NMaXN0LmFkZCgnYWN0aXZlJyk7XG4gICAgICAgIGJvZHlbMF0uY2xhc3NMaXN0LmFkZCgnc2hvdy1tZW51Jyk7XG4gICAgICB9XG4gICAgfSk7XG5cbiAgfSBlbHNlIHtcbiAgICAvLyBEZXNrdG9wXG5cblxuICAgIEFycmF5LnByb3RvdHlwZS5mb3JFYWNoLmNhbGwobWVudUl0ZW1zLCBmdW5jdGlvbiAoZWwsIGkpIHtcbiAgICAgIHZhciB0aGlzTGlzdEl0ZW0gPSBlbDtcblxuICAgICAgdmFyIGN1cnJlbnRTdWJtZW51cyA9IHRoaXNMaXN0SXRlbS5xdWVyeVNlbGVjdG9yKCcuc3ViLW1lbnUnKTtcbiAgICAgIHZhciBhbmNob3JJbkxpc3RJdGVtID0gZWwucXVlcnlTZWxlY3RvcignYScpO1xuICAgICAgdmFyIGFwcGVuZEJ1dHRvbkFmdGVyQW5jaG9yID0gJzxidXR0b24gY2xhc3M9XCJpY29uIGljb24tLWFycm93IGljb24tLXNtYWxsXCIgYXJpYS1leHBhbmRlZD1cImZhbHNlXCIgZGF0YS1vbC1oYXMtY2xpY2staGFuZGxlciBhcmlhLWV4cGFuZGVkPVwiZmFsc2VcIj48c3BhbiBjbGFzcz1cInZpc3VhbGx5aGlkZGVuXCI+U3VibWVudSB2b29yIOKAnCcgKyBhbmNob3JJbkxpc3RJdGVtLnRleHQgKyAn4oCdPC9zcGFuPjwvYnV0dG9uPic7XG4vLyAgICAgIHZhciBhcHBlbmRCdXR0b25BZnRlckFuY2hvciA9ICc8YnV0dG9uIGNsYXNzPVwibWFpbi1tZW51X19vcGVuLXN1YiBkZWZhdWx0XCI+PHNwYW4+PHNwYW4gY2xhc3M9XCJ2aXN1YWxseWhpZGRlblwiPlN1Ym1lbnUgdm9vciDigJwnICsgYW5jaG9ySW5MaXN0SXRlbS50ZXh0ICsgJ+KAnTwvc3Bhbj48L3NwYW4+PC9idXR0b24+JztcbiAgICAgIGFuY2hvckluTGlzdEl0ZW0uaW5zZXJ0QWRqYWNlbnRIVE1MKCdhZnRlcmVuZCcsIGFwcGVuZEJ1dHRvbkFmdGVyQW5jaG9yKTtcblxuICAgICAgLy8gdmVyYmVyZyBoZXQgc3VibWVudSBpbiBkaXQgbGlzdGl0ZW1cbiAgICAgIGN1cnJlbnRTdWJtZW51cy5jbGFzc0xpc3QuYWRkKCd2aXN1YWxseWhpZGRlbicpO1xuXG4gICAgICBlbC5xdWVyeVNlbGVjdG9yKCdidXR0b24nKS5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgZnVuY3Rpb24gKGV2ZW50KSB7XG5cbiAgICAgICAgdGhpcy5jbGFzc0xpc3QucmVtb3ZlKCdkZWZhdWx0Jyk7XG5cbiAgICAgICAgLy8ga2xpa2tlbiBrYW46XG4gICAgICAgIC8vIC0gbWV0IHRvZXRzZW5ib3JkLCB6b25kZXIgaG92ZXJhY3RpZXMgKGJpanYuIGFscyBqZSBhbGxlZW4gbWV0IHRvZXRzZW5ib3JkIG5hdmlnZWVydClcbiAgICAgICAgLy8gLSBtZXQgbXVpcywgZHVzIG1ldCBob3ZlcmFjdGllcy4gSW4gZGF0IGdldmFsOlxuICAgICAgICAvLyAgICAgIC0ga2FuIGhldCBsaXN0LWl0ZW0gYWwgb3BlbiB6aWpuXG4gICAgICAgIC8vICAgICAgLSBrYW4gaGV0IGxpc3QtaXRlbSBhbCBnZXNsb3RlbiB6aWpuIHppam5cblxuICAgICAgICB2YXIgc3ViTGlzdCA9IHRoaXMucGFyZW50Tm9kZS5xdWVyeVNlbGVjdG9yKCd1bC5zdWItbWVudScpO1xuICAgICAgICB2YXIgdmFyRXhwYW5kZWQgPSBzdWJMaXN0LmdldEF0dHJpYnV0ZSgnYXJpYS1leHBhbmRlZCcpO1xuICAgICAgICB2YXIgaXNWaXNpYmxlID0gdHJ1ZTtcbiAgICAgICAgdmFyIGlzRXhwYW5kZWQgPSBmYWxzZTtcbiAgICAgICAgaWYgKCBzdWJMaXN0LmNsYXNzTGlzdC5jb250YWlucygndmlzdWFsbHloaWRkZW4nKSApIHtcbiAgICAgICAgICBpc1Zpc2libGUgPSBmYWxzZTtcbiAgICAgICAgfVxuICAgICAgICBpZiAoIHZhckV4cGFuZGVkLnRvU3RyaW5nKCkgIT09ICdmYWxzZScgKSB7XG4gICAgICAgICAgaXNFeHBhbmRlZCA9IHRydWU7XG4gICAgICAgIH1cblxuICAgICAgICBpZiAoIGlzRXhwYW5kZWQgJiYgaXNWaXNpYmxlICkge1xuICAgICAgICAgIC8vIGhlZWZ0IHdlbCBjbGFzcyBvcGVuLCBkdXMgc3RhdHVzIGlzIG9wZW47IG5pZXV3ZSBzdGF0dXMgd29yZHQ6IGFsbGVzIHNsdWl0ZW5cbiAgICAgICAgICB0aGlzLnBhcmVudE5vZGUuY2xhc3NMaXN0LnJlbW92ZSgnb3BlbicpO1xuICAgICAgICAgIHRoaXMucGFyZW50Tm9kZS5xdWVyeVNlbGVjdG9yKCdhJykuc2V0QXR0cmlidXRlKCdhcmlhLWV4cGFuZGVkJywgXCJmYWxzZVwiKTtcbiAgICAgICAgICB0aGlzLnBhcmVudE5vZGUucXVlcnlTZWxlY3RvcignYnV0dG9uJykuc2V0QXR0cmlidXRlKCdhcmlhLWV4cGFuZGVkJywgXCJmYWxzZVwiKTtcbiAgICAgICAgICB0aGlzLnBhcmVudE5vZGUucXVlcnlTZWxlY3RvcignYnV0dG9uJykuY2xhc3NMaXN0LnJlbW92ZSgnb3Blbi1saXN0Jyk7XG4gICAgICAgICAgdGhpcy5wYXJlbnROb2RlLnF1ZXJ5U2VsZWN0b3IoJ3VsLnN1Yi1tZW51JykuY2xhc3NMaXN0LmFkZCgndmlzdWFsbHloaWRkZW4nKTtcbiAgICAgICAgICB0aGlzLnBhcmVudE5vZGUucXVlcnlTZWxlY3RvcigndWwuc3ViLW1lbnUnKS5zZXRBdHRyaWJ1dGUoJ2FyaWEtZXhwYW5kZWQnLCBcImZhbHNlXCIpO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgIC8vIGhlZWZ0IEdFRU4gY2xhc3Mgb3BlbiwgZHVzIHN0YXR1cyBpcyBuaWV0IG9wZW47IG5pZXV3ZSBzdGF0dXMgd29yZHQ6IGFsbGVzIG9wZW5lblxuICAgICAgICAgIHRoaXMucGFyZW50Tm9kZS5jbGFzc0xpc3QuYWRkKCdvcGVuJyk7XG4gICAgICAgICAgdGhpcy5wYXJlbnROb2RlLnF1ZXJ5U2VsZWN0b3IoJ2EnKS5zZXRBdHRyaWJ1dGUoJ2FyaWEtZXhwYW5kZWQnLCBcInRydWVcIik7XG4gICAgICAgICAgdGhpcy5wYXJlbnROb2RlLnF1ZXJ5U2VsZWN0b3IoJ2J1dHRvbicpLnNldEF0dHJpYnV0ZSgnYXJpYS1leHBhbmRlZCcsIFwidHJ1ZVwiKTtcbiAgICAgICAgICB0aGlzLnBhcmVudE5vZGUucXVlcnlTZWxlY3RvcignYnV0dG9uJykuY2xhc3NMaXN0LmFkZCgnb3Blbi1saXN0Jyk7XG4gICAgICAgICAgdGhpcy5wYXJlbnROb2RlLnF1ZXJ5U2VsZWN0b3IoJ3VsLnN1Yi1tZW51JykuY2xhc3NMaXN0LnJlbW92ZSgndmlzdWFsbHloaWRkZW4nKTtcbiAgICAgICAgICB0aGlzLnBhcmVudE5vZGUucXVlcnlTZWxlY3RvcigndWwuc3ViLW1lbnUnKS5zZXRBdHRyaWJ1dGUoJ2FyaWEtZXhwYW5kZWQnLCBcInRydWVcIik7XG4gICAgICAgIH1cbiAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcbiAgICAgIH0pO1xuICAgICAgdGhpc0xpc3RJdGVtLmFkZEV2ZW50TGlzdGVuZXIoXCJtb3VzZWVudGVyXCIsIGZ1bmN0aW9uIChldmVudCkge1xuICAgICAgICBob3Zlckxpc3RJdGVtKHRoaXMsICdvdmVyJyk7XG4gICAgICB9KTtcbiAgICAgIHRoaXNMaXN0SXRlbS5hZGRFdmVudExpc3RlbmVyKFwibW91c2VsZWF2ZVwiLCBmdW5jdGlvbiAoZXZlbnQpIHtcbiAgICAgICAgaG92ZXJMaXN0SXRlbSh0aGlzLCAnb3V0Jyk7XG4gICAgICB9KTtcblxuXG4gICAgfSk7XG5cblxuICB9XG59XG5cblxudmFyIGlzSUUxMSA9ICEhd2luZG93Lk1TSW5wdXRNZXRob2RDb250ZXh0ICYmICEhZG9jdW1lbnQuZG9jdW1lbnRNb2RlO1xuXG5pZiAoIGlzSUUxMSApIHtcbiAgLy8gbGFsYWxhLCBuaWtzIGxldWtzIHZvb3IgSUUxMVxufVxuZWxzZSB7XG5cbiAgd2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ2xvYWQnLCBmdW5jdGlvbiAoKSB7XG4gICAgdmFyIHdpbmRvd3dpZHRoID0gd2luZG93LmlubmVyV2lkdGg7XG4gICAgZG9OYXYod2luZG93d2lkdGgpO1xuICB9KTtcblxuICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcigncmVzaXplJywgZnVuY3Rpb24gKCkge1xuICAgIHZhciB3aW5kb3d3aWR0aCA9IHdpbmRvdy5pbm5lcldpZHRoO1xuICAgIGRvTmF2KHdpbmRvd3dpZHRoKTtcbiAgfSk7XG5cbn1cblxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4iXSwiZmlsZSI6ImdjLW1haW4tZGVidWcuanMifQ==
