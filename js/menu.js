
//
// Gebruiker Centraal - menu.js
// ----------------------------------------------------------------------------------
// Functionaliteit voor tonen / verbergen mobiel menu
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.15.8
// @desc.   Bugfix JS: what if there's no menu?
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme


// Vars
var header			= document.querySelector('.site-header'),
	headerwrap		= document.querySelector('.site-header .wrap'),
	sitecontainer	= document.querySelector('.site-container'),
	menu			= document.querySelector('.nav-primary'),
	thecontent		= document.querySelector('#maincontent'),
	menuButton		= document.querySelector('button.menu-button'),
	menuButton;

// =========================================================================================================

function hideMenuButton(document, window, undefined) {
	
	var ele = document.getElementById("menu-button");
	if (ele) {
		// Remove button from page
		headerwrap.removeChild(ele);
	}
	if ( header ) {
		header.classList.remove('menu-met-js');
	}
	if ( thecontent ) {
		thecontent.classList.remove('menuopen');
	}
	if ( sitecontainer ) {
		sitecontainer.classList.remove('menuopen');
	}
	if ( header ) {
		header.classList.add('geen-menu-button');
	}
	if ( menu ) {
		menu.setAttribute('aria-hidden', 'false');
	}
	
}

// =========================================================================================================

function showMenuButton(document, window, undefined) {
	
	'use strict';
	
	header.classList.add('menu-met-js');
	
	// Menu properties
	menu.setAttribute('aria-hidden', 'true');
	menu.setAttribute('aria-labelledby', 'menu-button');
	
	header.classList.remove('geen-menu-button');
//	console.log('create the button'); 

	menuButton = document.createElement('button');
	
	// Button properties
	menuButton.classList.add('menu-button');
	menuButton.setAttribute('id', 'menu-button');
	menuButton.setAttribute('aria-label', 'Toon menu');
	menuButton.setAttribute('aria-expanded', 'false');
	menuButton.setAttribute('aria-controls', 'menu');
	menuButton.innerHTML = '<i>&#x2261;</i><b>&nbsp;menu</b>';
	
	headerwrap.appendChild(menuButton);

    // Handle 'esc' event
    // Keyboard Tweaks via Scott Vinkle
    var escapeMenu = function (ev) {
    
        if (ev.which === 27) {
            ev.stopPropagation();
            ev.preventDefault();
			if (menu.classList.contains('active')) {
				// only close, not toggle
	            resetMenu();
	        }
        }
    };

    var resetMenu = function (ev) {
		
		// If active...
		if (menu.classList.contains('active')) {
	
			// Hide
			header.classList.remove('active');
			
			thecontent.classList.remove('menuopen');
			sitecontainer.classList.remove('menuopen');
			
			menu.classList.remove('active');
			menu.setAttribute('aria-hidden', 'true');
			menuButton.setAttribute('aria-expanded', 'false');
			menuButton.setAttribute('aria-label', 'Open menu');
			menuButton.innerHTML = '<i>&#x2261;</i><b>&nbsp;menu</b>';
	
		} else {
	
			// Show
			header.classList.add('active');
			
			thecontent.classList.add('menuopen');
			sitecontainer.classList.add('menuopen');
			
			menu.classList.add('active');
			menu.setAttribute('aria-hidden', 'false');
			menuButton.setAttribute('aria-expanded', 'true');
			menuButton.setAttribute('aria-label', 'Sluit menu');
			menuButton.innerHTML = '<i class="close">&times;</i><b>&nbsp;menu</b>';
			
		}
	};
	
	// Handle button click event
	menuButton.addEventListener('click', function () {
        resetMenu();
	}, false);

    menuButton.addEventListener( 'keydown', function( ev ) {
        escapeMenu(ev);
    });

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
if (matchMedia && menu) {
	var mq = window.matchMedia('(min-width: 830px)');
	mq.addListener(WidthChange);
	WidthChange(mq);
}

// =========================================================================================================
