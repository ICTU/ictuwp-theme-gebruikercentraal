!function(a,e,n){a(".form-item--filter label").click(function(){var e=a(this).parent();e.find("input:checked").length?e.removeClass("is-active"):e.addClass("is-active")});a(".site-header");var t=e.querySelector(".nav-primary");function i(e){e.matches?(a(".btn--toggle-menu").length&&a(".btn--toggle-menu").remove(),a(".nav-primary .menu-item-has-children").each(function(){a(this).find("a:first").attr("aria-expanded",!0),a(this).find("a:first").after('<button class="icon icon--arrow icon--small" aria-expanded="false" data-ol-has-click-handler aria-expanded="false"><span class="visuallyhidden">Open submenu '+a(this).find("a:first span").text()+"</span></button>"),a(this).find(".sub-menu").attr("aria-hidden",!0)}),a(".menu-primary > li.menu-item-has-children > a").mouseenter(function(){a(this).hasClass("open")||(a(".menu-primary").find(".open").removeClass("open"),a(".menu-primary").find('ul[aria-hidden="false"]').attr("aria-hidden","true"),a(this).parent().addClass("open").find(".sub-menu").attr("aria-hidden","false"),a(this).find("a:first-child").attr("aria-expanded","true"))}),a(".menu-primary > li.menu-item-has-children .sub-menu").mouseleave(function(){a(this).parent().removeClass("open"),a(this).attr("aria-hidden","true"),a(this).parent().find("a:first-child").attr("aria-expanded","false")}),a(".nav-primary .menu-item-has-children > button").click(function(){var e=a(this).parent(),n=a(".nav-primary .menu-item.open");e.hasClass("open")?e.hasClass("open")&&(a(this).attr("aria-expanded",!1).find("span").text("Open "+e.find("a:first span").text()),e.removeClass("open").find(".sub-menu").attr("aria-hidden",!0)):(n.length&&(n.removeClass("open").find(".sub-menu").attr("aria-hidden",!0),n.find("button").attr("aria-expanded",!1)),a(this).attr("aria-expanded",!0).find("span").text("Sluit "+e.find("a:first span").text()),e.addClass("open").find(".sub-menu").attr("aria-hidden",!1))})):function(){const e=a(".btn--toggle-menu");a("button.icon").length&&a("button.icon").remove(),a(".nav-primary .menu-item-has-children").each(function(){a(this).find(".sub-menu").removeAttr("aria-hidden")}),e.length||a(".site-header > .wrap").append('<button class="btn btn--toggle-menu" aria-haspopup="true" aria-controls="menu-primary" aria-expanded="false" aria-label="Open menu"><i>&#x2261;</i><span class="btn__text">Menu</span></button>'),a(".btn--toggle-menu").click(function(){a(this).hasClass("active")?a(this).find("i").html("&#x2261;"):a(this).find("i").html("&times;"),a("body").toggleClass("menu-open"),a(".nav-primary").toggleClass("show"),a(this).toggleClass("active")})}()}if(matchMedia&&t){var s=n.matchMedia("(min-width: 900px)");s.addListener(i),i(s)}}(jQuery,document,window);
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImdjLW1haW4uanMiXSwibmFtZXMiOlsiJCIsImRvY3VtZW50Iiwid2luZG93IiwiY2xpY2siLCJmb3JtSXRlbSIsInRoaXMiLCJwYXJlbnQiLCJmaW5kIiwibGVuZ3RoIiwicmVtb3ZlQ2xhc3MiLCJhZGRDbGFzcyIsIm1haW5NZW51IiwicXVlcnlTZWxlY3RvciIsIldpZHRoQ2hhbmdlIiwibXEiLCJtYXRjaGVzIiwicmVtb3ZlIiwiZWFjaCIsImF0dHIiLCJhZnRlciIsInRleHQiLCJtb3VzZWVudGVyIiwiaGFzQ2xhc3MiLCJtb3VzZWxlYXZlIiwibWVudUl0ZW0iLCJjdXJyZW50QWN0aXZlIiwibWVudUJ0biIsInJlbW92ZUF0dHIiLCJhcHBlbmQiLCJodG1sIiwidG9nZ2xlQ2xhc3MiLCJuYXZNb2JpbGUiLCJtYXRjaE1lZGlhIiwiYWRkTGlzdGVuZXIiLCJqUXVlcnkiXSwibWFwcGluZ3MiOiJDQUFBLFNBQVdBLEVBQUdDLEVBQVVDLEdBYU5GLEVBQUUsNEJBRVJHLE1BQU0sV0FFZCxJQUFJQyxFQUFXSixFQUFFSyxNQUFNQyxTQUVuQkYsRUFBU0csS0FBSyxpQkFBaUJDLE9BQy9CSixFQUFTSyxZQUFZLGFBRXJCTCxFQUFTTSxTQUFTLGVBc0JiVixFQUFFLGdCQUFmLElBQ0VXLEVBQVdWLEVBQVNXLGNBQWMsZ0JBK0dwQyxTQUFTQyxFQUFZQyxHQUVmQSxFQUFHQyxTQTNHSmYsRUFBRSxxQkFBcUJRLFFBQ3hCUixFQUFFLHFCQUFxQmdCLFNBSXpCaEIsRUFBRSx3Q0FBd0NpQixLQUFLLFdBRTdDakIsRUFBRUssTUFBTUUsS0FBSyxXQUFXVyxLQUFLLGlCQUFpQixHQUc5Q2xCLEVBQUVLLE1BQU1FLEtBQUssV0FBV1ksTUFBTSxnS0FDbUJuQixFQUFFSyxNQUFNRSxLQUFLLGdCQUFnQmEsT0FBUyxvQkFHdkZwQixFQUFFSyxNQUFNRSxLQUFLLGFBQWFXLEtBQUssZUFBZSxLQUloRGxCLEVBQUUsaURBQWlEcUIsV0FBVyxXQUN0RHJCLEVBQUVLLE1BQU1pQixTQUFTLFVBRXJCdEIsRUFBRSxpQkFBaUJPLEtBQUssU0FBU0UsWUFBWSxRQUM3Q1QsRUFBRSxpQkFBaUJPLEtBQUssMkJBQTJCVyxLQUFLLGNBQWUsUUFHdkVsQixFQUFFSyxNQUFNQyxTQUFTSSxTQUFTLFFBQVFILEtBQUssYUFBYVcsS0FBSyxjQUFlLFNBQ3hFbEIsRUFBRUssTUFBTUUsS0FBSyxpQkFBaUJXLEtBQUssZ0JBQWlCLFdBS3hEbEIsRUFBRSx1REFBdUR1QixXQUFXLFdBRWxFdkIsRUFBRUssTUFBTUMsU0FBU0csWUFBWSxRQUM3QlQsRUFBRUssTUFBTWEsS0FBSyxjQUFlLFFBQzVCbEIsRUFBRUssTUFBTUMsU0FBU0MsS0FBSyxpQkFBaUJXLEtBQUssZ0JBQWlCLFdBSS9EbEIsRUFBRSxpREFBaURHLE1BQU0sV0FDdkQsSUFBSXFCLEVBQVd4QixFQUFFSyxNQUFNQyxTQUNuQm1CLEVBQWdCekIsRUFBRSxnQ0FFaEJ3QixFQUFTRixTQUFTLFFBV2JFLEVBQVNGLFNBQVMsVUFFM0J0QixFQUFFSyxNQUFNYSxLQUFLLGlCQUFpQixHQUFPWCxLQUFLLFFBQVFhLEtBQUssUUFBVUksRUFBU2pCLEtBQUssZ0JBQWdCYSxRQUMvRkksRUFBU2YsWUFBWSxRQUFRRixLQUFLLGFBQWFXLEtBQUssZUFBZSxLQVpoRU8sRUFBY2pCLFNBRWZpQixFQUFjaEIsWUFBWSxRQUFRRixLQUFLLGFBQWFXLEtBQUssZUFBZSxHQUN4RU8sRUFBY2xCLEtBQUssVUFBVVcsS0FBSyxpQkFBaUIsSUFHckRsQixFQUFFSyxNQUFNYSxLQUFLLGlCQUFpQixHQUFNWCxLQUFLLFFBQVFhLEtBQUssU0FBV0ksRUFBU2pCLEtBQUssZ0JBQWdCYSxRQUMvRkksRUFBU2QsU0FBUyxRQUFRSCxLQUFLLGFBQWFXLEtBQUssZUFBZSxPQVl0RSxXQUVFLE1BQU1RLEVBQVUxQixFQUFFLHFCQUdmQSxFQUFFLGVBQWVRLFFBQ2xCUixFQUFFLGVBQWVnQixTQUduQmhCLEVBQUUsd0NBQXdDaUIsS0FBSyxXQUM3Q2pCLEVBQUVLLE1BQU1FLEtBQUssYUFBYW9CLFdBQVcsaUJBVWxDRCxFQUFjLFFBQ2pCMUIsRUFBRSx3QkFBd0I0QixPQU4xQixtTUFTRjVCLEVBQUUscUJBQXFCRyxNQUFNLFdBQ3hCSCxFQUFFSyxNQUFNaUIsU0FBUyxVQUNsQnRCLEVBQUVLLE1BQU1FLEtBQUssS0FBS3NCLEtBQUssWUFFdkI3QixFQUFFSyxNQUFNRSxLQUFLLEtBQUtzQixLQUFLLFdBRXpCN0IsRUFBRSxRQUFROEIsWUFBWSxhQUN0QjlCLEVBQUUsZ0JBQWdCOEIsWUFBWSxRQUM5QjlCLEVBQUVLLE1BQU15QixZQUFZLFlBbUJwQkMsR0FTSixHQUFJQyxZQUFjckIsRUFBVSxDQUMxQixJQUFJRyxFQUFLWixFQUFPOEIsV0FBVyxzQkFDM0JsQixFQUFHbUIsWUFBWXBCLEdBQ2ZBLEVBQVlDLElBbExkLENBdUxHb0IsT0FBUWpDLFNBQVVDIiwic291cmNlc0NvbnRlbnQiOlsiLy9cbi8vIEdlYnJ1aWtlciBDZW50cmFhbCAtIGZpbHRlcnMuanNcbi8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbi8vIEZ1bmN0aW9uYWxpdGVpdCB2b29yIGhldCB0b2V2b2VnZW4gdmFuIGVlbiBhY3RpdmUgY2xhc3MgYWFuIGZpbHRlcnNcbi8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbi8vIEBwYWNrYWdlIGdlYnJ1aWtlci1jZW50cmFhbFxuLy8gQGF1dGhvciAgVGFtYXJhIGRlIEhhYXNcbi8vIEBsaWNlbnNlIEdQTC0yLjArXG4vLyBAdmVyc2lvbiAzLjE1Ljlcbi8vIEBsaW5rICAgIGh0dHBzOi8vZ2l0aHViLmNvbS9JQ1RVL2dlYnJ1aWtlci1jZW50cmFhbC13b3JkcHJlc3MtdGhlbWVcblxuXG52YXIgZmlsdGVyTGFiZWwgPSAkKCcuZm9ybS1pdGVtLS1maWx0ZXIgbGFiZWwnKTtcblxuZmlsdGVyTGFiZWwuY2xpY2soZnVuY3Rpb24gKCkge1xuXG4gICAgdmFyIGZvcm1JdGVtID0gJCh0aGlzKS5wYXJlbnQoKTtcblxuICAgIGlmIChmb3JtSXRlbS5maW5kKCdpbnB1dDpjaGVja2VkJykubGVuZ3RoKSB7XG4gICAgICAgIGZvcm1JdGVtLnJlbW92ZUNsYXNzKCdpcy1hY3RpdmUnKTtcbiAgICB9IGVsc2Uge1xuICAgICAgICBmb3JtSXRlbS5hZGRDbGFzcygnaXMtYWN0aXZlJyk7XG4gICAgfVxuXG59KTtcblxuXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cblxuLy9cbi8vIEdlYnJ1aWtlciBDZW50cmFhbCAtIG1lbnUuanNcbi8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbi8vIEZ1bmN0aW9uYWxpdGVpdCB2b29yIHRvbmVuIC8gdmVyYmVyZ2VuIG1vYmllbCBtZW51XG4vLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4vLyBAcGFja2FnZSBnZWJydWlrZXItY2VudHJhYWxcbi8vIEBhdXRob3IgIFRhbWFyYSBkZSBIYWFzLCBQYXVsIHZhbiBCdXVyZW5cbi8vIEBsaWNlbnNlIEdQTC0yLjArXG4vLyBAdmVyc2lvbiAzLjE1Ljlcbi8vIEBkZXNjLiAgIENUQS1rbGV1cmVuLCBhMTF5IGdyb2VuLCBzaGFyaW5nIGJ1dHRvbnMgb3B0aW9uYWwsIGJlZWxkYmFuayBDUFQgY29kZSBzZXBhcmF0aW9uLlxuLy8gQGxpbmsgICAgaHR0cHM6Ly9naXRodWIuY29tL0lDVFUvZ2VicnVpa2VyLWNlbnRyYWFsLXdvcmRwcmVzcy10aGVtZVxuXG5cbi8vIFZhcnNcbnZhciBoZWFkZXIgPSAkKCcuc2l0ZS1oZWFkZXInKSxcbiAgbWFpbk1lbnUgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcubmF2LXByaW1hcnknKTtcblxuXG5mdW5jdGlvbiBuYXZEZXNrdG9wKCkge1xuXG4gIC8vIFJlbW92ZSBtZW51IGJ1dHRvbiBpZiB0aGVyZVxuICBpZigkKCcuYnRuLS10b2dnbGUtbWVudScpLmxlbmd0aCl7XG4gICAgJCgnLmJ0bi0tdG9nZ2xlLW1lbnUnKS5yZW1vdmUoKTtcbiAgfVxuXG4gIC8vIEFkZCBidXR0b25zXG4gICQoJy5uYXYtcHJpbWFyeSAubWVudS1pdGVtLWhhcy1jaGlsZHJlbicpLmVhY2goZnVuY3Rpb24gKCkge1xuXG4gICAgJCh0aGlzKS5maW5kKCdhOmZpcnN0JykuYXR0cignYXJpYS1leHBhbmRlZCcsIHRydWUpO1xuXG4gICAgLy8gQWRkIGEgYnV0dG9uIHRvIGVhY2ggbGluayB3aXRoIGEgc3VibWVudVxuICAgICQodGhpcykuZmluZCgnYTpmaXJzdCcpLmFmdGVyKCc8YnV0dG9uIGNsYXNzPVwiaWNvbiBpY29uLS1hcnJvdyBpY29uLS1zbWFsbFwiIGFyaWEtZXhwYW5kZWQ9XCJmYWxzZVwiIGRhdGEtb2wtaGFzLWNsaWNrLWhhbmRsZXIgYXJpYS1leHBhbmRlZD1cImZhbHNlXCI+JyArXG4gICAgICAnPHNwYW4gY2xhc3M9XCJ2aXN1YWxseWhpZGRlblwiPk9wZW4gc3VibWVudSAnICsgJCh0aGlzKS5maW5kKCdhOmZpcnN0IHNwYW4nKS50ZXh0KCkgKyAnPC9zcGFuPicgK1xuICAgICAgJzwvYnV0dG9uPicpO1xuXG4gICAgJCh0aGlzKS5maW5kKCcuc3ViLW1lbnUnKS5hdHRyKCdhcmlhLWhpZGRlbicsIHRydWUpO1xuICB9KTtcblxuICAvLyBBZGQgY2xhc3Mgb24gbW91c2UgZW50ZXJcbiAgJCgnLm1lbnUtcHJpbWFyeSA+IGxpLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4gPiBhJykubW91c2VlbnRlcihmdW5jdGlvbiAoKSB7XG4gICAgaWYgKCEoJCh0aGlzKS5oYXNDbGFzcygnb3BlbicpKSkge1xuICAgICAgLy8gVW5zZXQgb3RoZXIgYWN0aXZlIGlmIHRoZXJlXG4gICAgICAkKCcubWVudS1wcmltYXJ5JykuZmluZCgnLm9wZW4nKS5yZW1vdmVDbGFzcygnb3BlbicpO1xuICAgICAgJCgnLm1lbnUtcHJpbWFyeScpLmZpbmQoJ3VsW2FyaWEtaGlkZGVuPVwiZmFsc2VcIl0nKS5hdHRyKCdhcmlhLWhpZGRlbicsICd0cnVlJyk7XG5cbiAgICAgIC8vIEFkZCBhdHRyaWJ1dGVzIHRvIGN1cnJlbnQgbWVudVxuICAgICAgJCh0aGlzKS5wYXJlbnQoKS5hZGRDbGFzcygnb3BlbicpLmZpbmQoJy5zdWItbWVudScpLmF0dHIoJ2FyaWEtaGlkZGVuJywgJ2ZhbHNlJyk7XG4gICAgICAkKHRoaXMpLmZpbmQoJ2E6Zmlyc3QtY2hpbGQnKS5hdHRyKCdhcmlhLWV4cGFuZGVkJywgJ3RydWUnKTtcbiAgICB9XG4gIH0pO1xuXG4gIC8vIEFuZCByZW1vdmUgYWdhaW4gb24gbW91c2VsZWF2ZVxuICAkKCcubWVudS1wcmltYXJ5ID4gbGkubWVudS1pdGVtLWhhcy1jaGlsZHJlbiAuc3ViLW1lbnUnKS5tb3VzZWxlYXZlKGZ1bmN0aW9uICgpIHtcbiAgICAvLyBBZGQgYXR0cmlidXRlcyB0byBjdXJyZW50IG1lbnVcbiAgICAkKHRoaXMpLnBhcmVudCgpLnJlbW92ZUNsYXNzKCdvcGVuJyk7XG4gICAgJCh0aGlzKS5hdHRyKCdhcmlhLWhpZGRlbicsICd0cnVlJyk7XG4gICAgJCh0aGlzKS5wYXJlbnQoKS5maW5kKCdhOmZpcnN0LWNoaWxkJykuYXR0cignYXJpYS1leHBhbmRlZCcsICdmYWxzZScpO1xuICB9KTtcblxuICAvLyBBZGQgdG9nZ2xlIGJlaGF2aW91ciBvbiBjbGlja1xuICAkKCcubmF2LXByaW1hcnkgLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4gPiBidXR0b24nKS5jbGljayhmdW5jdGlvbiAoKSB7XG4gICAgdmFyIG1lbnVJdGVtID0gJCh0aGlzKS5wYXJlbnQoKTtcbiAgICB2YXIgY3VycmVudEFjdGl2ZSA9ICQoJy5uYXYtcHJpbWFyeSAubWVudS1pdGVtLm9wZW4nKTtcblxuICAgIGlmICghKG1lbnVJdGVtLmhhc0NsYXNzKCdvcGVuJykpKSB7XG4gICAgICAvL1N1Ym1lbnUgaXMgY2xvc2VkLCBoYXMgdG8gb3BlblxuICAgICAgaWYoY3VycmVudEFjdGl2ZS5sZW5ndGgpe1xuICAgICAgICAvL0lmIHRoZXJlIGlzIGFub3RoZXIgaXRlbSBvcGVuIHJlbW92ZSBpdFxuICAgICAgICBjdXJyZW50QWN0aXZlLnJlbW92ZUNsYXNzKCdvcGVuJykuZmluZCgnLnN1Yi1tZW51JykuYXR0cignYXJpYS1oaWRkZW4nLCB0cnVlKTtcbiAgICAgICAgY3VycmVudEFjdGl2ZS5maW5kKCdidXR0b24nKS5hdHRyKCdhcmlhLWV4cGFuZGVkJywgZmFsc2UpO1xuICAgICAgfVxuXG4gICAgICAkKHRoaXMpLmF0dHIoJ2FyaWEtZXhwYW5kZWQnLCB0cnVlKS5maW5kKCdzcGFuJykudGV4dCgnU2x1aXQgJyArIG1lbnVJdGVtLmZpbmQoJ2E6Zmlyc3Qgc3BhbicpLnRleHQoKSk7XG4gICAgICBtZW51SXRlbS5hZGRDbGFzcygnb3BlbicpLmZpbmQoJy5zdWItbWVudScpLmF0dHIoJ2FyaWEtaGlkZGVuJywgZmFsc2UpO1xuXG4gICAgfSBlbHNlIGlmIChtZW51SXRlbS5oYXNDbGFzcygnb3BlbicpKSB7XG4gICAgICAvLyBTdWJtZW51IGlzIG9wZW4sIGhhcyB0byBjbG9zZVxuICAgICAgJCh0aGlzKS5hdHRyKCdhcmlhLWV4cGFuZGVkJywgZmFsc2UpLmZpbmQoJ3NwYW4nKS50ZXh0KCdPcGVuICcgKyBtZW51SXRlbS5maW5kKCdhOmZpcnN0IHNwYW4nKS50ZXh0KCkpO1xuICAgICAgbWVudUl0ZW0ucmVtb3ZlQ2xhc3MoJ29wZW4nKS5maW5kKCcuc3ViLW1lbnUnKS5hdHRyKCdhcmlhLWhpZGRlbicsIHRydWUpO1xuICAgIH1cbiAgfSk7XG5cbiAgLy9SZW1vdmUgb3BlblxufVxuXG5mdW5jdGlvbiBuYXZNb2JpbGUoKSB7XG5cbiAgY29uc3QgbWVudUJ0biA9ICQoJy5idG4tLXRvZ2dsZS1tZW51Jyk7XG5cbiAgLy8gVW5zZXQgZGVza3RvcCB0aGluZ3NcbiAgaWYoJCgnYnV0dG9uLmljb24nKS5sZW5ndGgpe1xuICAgICQoJ2J1dHRvbi5pY29uJykucmVtb3ZlKCk7XG4gIH1cblxuICAkKCcubmF2LXByaW1hcnkgLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4nKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICAkKHRoaXMpLmZpbmQoJy5zdWItbWVudScpLnJlbW92ZUF0dHIoJ2FyaWEtaGlkZGVuJyk7XG4gIH0pO1xuXG5cbiAgY29uc3QgbWVudUJ0bkh0bWwgPVxuICAgICc8YnV0dG9uIGNsYXNzPVwiYnRuIGJ0bi0tdG9nZ2xlLW1lbnVcIiAnICtcbiAgICAnYXJpYS1oYXNwb3B1cD1cInRydWVcIiBhcmlhLWNvbnRyb2xzPVwibWVudS1wcmltYXJ5XCIgYXJpYS1leHBhbmRlZD1cImZhbHNlXCIgYXJpYS1sYWJlbD1cIk9wZW4gbWVudVwiPicgK1xuICAgICc8aT4mI3gyMjYxOzwvaT48c3BhbiBjbGFzcz1cImJ0bl9fdGV4dFwiPk1lbnU8L3NwYW4+JyArXG4gICAgJzwvYnV0dG9uPic7XG5cbiAgaWYoIShtZW51QnRuLmxlbmd0aCkpIHtcbiAgICAkKCcuc2l0ZS1oZWFkZXIgPiAud3JhcCcpLmFwcGVuZChtZW51QnRuSHRtbCk7XG4gIH1cblxuICAkKCcuYnRuLS10b2dnbGUtbWVudScpLmNsaWNrKGZ1bmN0aW9uKCl7XG4gICAgaWYoJCh0aGlzKS5oYXNDbGFzcygnYWN0aXZlJykpe1xuICAgICAgJCh0aGlzKS5maW5kKCdpJykuaHRtbCgnJiN4MjI2MTsnKTtcbiAgICB9IGVsc2Uge1xuICAgICAgJCh0aGlzKS5maW5kKCdpJykuaHRtbCgnJnRpbWVzOycpO1xuICAgIH1cbiAgICAkKCdib2R5JykudG9nZ2xlQ2xhc3MoJ21lbnUtb3BlbicpO1xuICAgICQoJy5uYXYtcHJpbWFyeScpLnRvZ2dsZUNsYXNzKCdzaG93Jyk7XG4gICAgJCh0aGlzKS50b2dnbGVDbGFzcygnYWN0aXZlJyk7XG4gIH0pO1xuXG5cbn1cblxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG5cbi8vIG1lZGlhIHF1ZXJ5IGNoYW5nZVxuZnVuY3Rpb24gV2lkdGhDaGFuZ2UobXEpIHtcblxuICBpZiAobXEubWF0Y2hlcykge1xuICAgIC8vIHdpbmRvdyB3aWR0aCBpcyBhdCBsZWFzdCA4MzBweFxuICAgIC8vIGRvbid0IHNob3cgbWVudSBidXR0b25cbiAgICBuYXZEZXNrdG9wKGRvY3VtZW50LCB3aW5kb3cpO1xuICB9XG4gIGVsc2Uge1xuICAgIC8vIHdpbmRvdyB3aWR0aCBpcyBsZXNzIHRoYW4gODMwcHhcbiAgICAvLyBETyBzaG93IG1lbnUgYnV0dG9uXG4gICAgbmF2TW9iaWxlKGRvY3VtZW50LCB3aW5kb3cpO1xuXG4gIH1cblxufVxuXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cblxuLy8gbWVkaWEgcXVlcnkgZXZlbnQgaGFuZGxlclxuaWYgKG1hdGNoTWVkaWEgJiYgbWFpbk1lbnUpIHtcbiAgdmFyIG1xID0gd2luZG93Lm1hdGNoTWVkaWEoJyhtaW4td2lkdGg6IDkwMHB4KScpO1xuICBtcS5hZGRMaXN0ZW5lcihXaWR0aENoYW5nZSk7XG4gIFdpZHRoQ2hhbmdlKG1xKTtcbn1cblxuXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiJdLCJmaWxlIjoiZ2MtbWFpbi1taW4uanMifQ==
