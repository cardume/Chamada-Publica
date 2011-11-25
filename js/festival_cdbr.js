/**
 *   This file is part of the WordPress theme Chamada Publica.
 *
 *   Chamada Publica is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   any later version.
 *
 *   Chamada Publica is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with Chamada Publica.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

jQuery(document).ready(function() {

	function setupNavClasses() {

		jQuery("#nav a").each(function() {

			var href = jQuery(this).attr('href').split('/');
			var count = href.length - 2;

			jQuery(this).addClass(href[count]);

		});

	}

	setupNavClasses();

	function setupAjaxLinks() {

		jQuery(".ajax-menu a").click(function() {

			if(jQuery(".loading").hasClass("active")) return false;

			var href = jQuery(this).attr('href').split('/');

			var count = href.length - 2;

			var countparent = false;

			if(jQuery(this).parent().parent().hasClass('child')) {

				var countparent = href.length - 3;

			}

			if(href[count]) {

				if(countparent) {

					window.location.hash = '#!/' + href[countparent] + '/' + href[count];

				} else {

					window.location.hash = '#!/' + href[count];

				}

			} else {

				goHome();

			}

			return false;

		});

	}

	setupAjaxLinks();

	function projetosSetup() {

		jQuery(".filtrar ul li a").click(function() {

			var categoria = jQuery(this).parent().attr('class');

			if(jQuery(this).parent().hasClass('active')) return false;

			jQuery(".filtrar ul li").removeClass('active');
			jQuery(this).parent().addClass('active');

			jQuery("#projetos li").each(function() {

				if(categoria == 'all') {

					jQuery(this).show('fast');

				} else

				if(!(jQuery(this).hasClass(categoria))) {

					jQuery(this).hide('fast');

				} else {

					jQuery(this).show('fast');

				}

			});

			return false;

		});

	}

	function getContent(content) {

		if(jQuery(".content.projetos").length) {

			var content_split = content.split('/');

			if(content_split.length == 3) {

				projeto = content_split[2];

				loadProjeto(projeto);

				return false;

			}

		}

		if(jQuery("#container .content").length) {

			var paginaAtual = jQuery("#container .content").attr('rel');

			if(getHash().indexOf(paginaAtual) != -1) {

				jQuery("#container .slideshow").hide('fast', function() {

					jQuery("#container .slideshow").remove();

					jQuery("#container .content").hide('fast', function() {

						jQuery("#container .content").remove();

						loadSubContent(content);

					});

				});

			} else {

				jQuery("#nav a").removeClass("active");

				jQuery("#container .slideshow").hide('fast', function() {

					jQuery("#container .slideshow").empty();

					jQuery("#container .content").hide('fast', function() {

						jQuery("h2.petrobras").show();

						jQuery("#container .content").empty();

						jQuery("#container .title").hide('fast', function() {

							jQuery("#container").empty();

							loadContent(content);

						});

					});

				});

			}

		} else {

			jQuery("#highlight, h1, h3.data, h3.local, #nav").animate({

				'bottom': '-=316'

			}).css({ 'position' : 'fixed'});

			jQuery("#rodape").hide();

			loadContent(content);

		}

	}

	function setaSubMenu() {

		jQuery("#submenu a").click(function() {

			if(jQuery(".loading").hasClass("active")) return false;

			jQuery("#submenu a").removeClass("active");

			jQuery(this).addClass("active");

		});

		jQuery(".title h2 a").click(function() {

			if(jQuery(".loading").hasClass("active")) return false;

			jQuery("#submenu a").removeClass("active");

		});

	}

	function loadProjeto(projeto) {

		var projeto_url = 'projetos/' + projeto;

		jQuery(".loading")
			.clone()
			.appendTo("#container .slideshow")
			.addClass('inside')
			.show('fast');

		jQuery.post(projeto_url, { ajax : true }, function(data) {

			jQuery("#container .slideshow .loading").hide('fast', function() { jQuery("#container .slideshow .loading").remove() });

			jQuery("#container .slideshow .slideshow-container").empty();

			jQuery("#container .slideshow .slideshow-container").append(data);

			jQuery("#container .slideshow .slideshow-container").scrollbar();

		})
		.error(function() { window.location.reload() });

	}

	function loadSubContent(content) {

		jQuery(".loading").addClass("sub").addClass("active").show('fast');

		var content_split = content.split('/');
		var projeto = false;

		if(content_split.length == 3) {

			content = content_split[0] + '/' + content_split[1];
			projeto = content_split[2];

		}

		jQuery.post(content, { ajax : true, sub : true }, function(data) {

			jQuery("#container").append(data);

			jQuery(".loading").hide('fast', function() { jQuery(".loading").removeClass("sub").removeClass("active"); });

			jQuery("#container .content").addClass("parent").show('fast', function() {

				ajustaThumbs();

				setSizes();

				jQuery("#container .slideshow").show('fast', function() {

					if(projeto) {

						loadProjeto(projeto);

						projetosSetup();

					} else {

						if(jQuery(".slideshow .carousel").length) {

							jQuery(".slideshow .carousel").jCarouselLite({

								btnNext: ".slideshow .next",
								btnPrev: ".slideshow .prev",
								visible: 1

							});

						}

						jQuery(".slideshow").hover(function() {

							jQuery(".slideshow .next, .slideshow .prev").fadeIn('fast');

						}, function() {

							jQuery(".slideshow .next, .slideshow .prev").fadeOut('fast');

						});

						if(jQuery("ul#projetos").length) {

							projetosSetup();

						}

					}

				});

			});

		})
		.error(function() { window.location.reload() });

	}

	function loadContent(content) {

		jQuery(".loading").addClass("active").show('fast');

		jQuery("#nav a." + content).addClass("active");

		var content_split = content.split('/');
		var projeto = false;

		if(content_split.length == 3) {

			content = content_split[0] + '/' + content_split[1];
			projeto = content_split[2];

		}

		jQuery.post(content, { ajax : true }, function(data) {

			jQuery("#container").append(data);

			jQuery(".loading").hide('fast', function() { jQuery(".loading").removeClass("active"); });

			jQuery("#container .title").show('fast', function() {

				setaSubMenu();

				if(!(jQuery("#nav").hasClass("inside"))) {

					jQuery("#nav").hide().addClass("inside").show('fast');

				}

				jQuery("#container .content").show('fast', function() {

					ajustaThumbs();

					setSizes();

					jQuery("h2.petrobras").hide();

					jQuery("#container .slideshow").show('fast', function() { 

						if(projeto) {

							loadProjeto(projeto);

							projetosSetup();

						} else {

							if(jQuery(".slideshow .carousel").length) {

								jQuery(".slideshow .carousel").jCarouselLite({

									btnNext: ".slideshow .next",
									btnPrev: ".slideshow .prev",
									visible: 1

								});

							}

							jQuery(".slideshow").hover(function() {

								jQuery(".slideshow .next, .slideshow .prev").fadeIn('fast');

							}, function() {

								jQuery(".slideshow .next, .slideshow .prev").fadeOut('fast');

							});
						

							if(jQuery("ul#projetos").length) {

								projetosSetup();

							}

							if(!(jQuery("h3.data, h3.local").hasClass("inside"))) {

								jQuery("h3.data, h3.local").hide().addClass("inside").show('fast');

							}

						}

					});

				});

			});

			setupAjaxLinks();

		})
		.error(function() { window.location.reload() });

	}

	function goHome() {

		if(getHash()) {

			if(typeof ativado == 'undefined' || !ativado) {

				ativado = true;

				jQuery("#nav a").removeClass("active");

				jQuery("#container .slideshow").hide('fast', function() {

					jQuery("#container .content").hide('fast', function() {

						jQuery("h2.petrobras").show();

						jQuery("#container .title").hide('fast', function() {

							jQuery("#container").empty();

							jQuery("#highlight, h1, h3.data, h3.local, #nav").css({ 'position' : 'absolute'}).animate({

								'bottom': '+=316'

							});

							jQuery("#rodape").show();

							window.location.hash = '#';

							ativado = false;

						});

						jQuery("#nav").hide('fast').removeClass("inside").show('fast');

						jQuery("h3.local, h3.data").hide('fast').removeClass("inside").show('fast');

					});

				});

			}

		}

	}

	function ajustaThumbs() {

		if(jQuery(".slideshow").length) {

			var adjustWidth = jQuery(window).width() / 2;
			var adjustHeight = jQuery(window).height() - 339;

			jQuery(".slideshow, .slideshow-container").width(adjustWidth).height(adjustHeight);

			jQuery(".slideshow img").each(function() {

				var originalWidth = jQuery(this).width();
				var originalHeight = jQuery(this).height();

				var imgHeight = (originalHeight * adjustWidth) / originalWidth;
				var imgWidth = (originalWidth * adjustHeight) / originalHeight;

				if(imgHeight < adjustHeight) {

					jQuery(this).width(imgWidth).height(adjustHeight);

				} else {

					jQuery(this).width(adjustWidth).height(imgHeight);

				}

			});

			jQuery(".slideshow iframe").each(function() {

				jQuery(this).width(adjustWidth).height(adjustHeight);

			});

		}

	}

	function setSizes() {

		ajustaThumbs();

		var titleSize = jQuery("#container .content").width() - jQuery(window).width();

		jQuery(".title").width(titleSize);

		if(jQuery(window).width() % 2 != 0) {

			jQuery(".title").css({ "right" : "1px" });

		}

		var wrapWidth = (jQuery(window).width() / 2) - 80;

		if(jQuery(".content").hasClass('projetos')) {

			wrapWidth = '400';

		}

		jQuery(".wrap-left").width(wrapWidth);

		var wrapWidth = jQuery(".wrap-left").width();
		var inputWidth = jQuery(".wrap-left").width() - 30;

		jQuery(".wrap-left input[type=text], .wrap-left textarea, .wrap-left input[type=file]").each(function() {

			jQuery(this).width(inputWidth);

		});

		jQuery(".wrap-left iframe, .wrap-left input[type=submit], .wrap-left object, .wrap-left object embed").each(function() {

			jQuery(this).width(wrapWidth);

		});

	}

	jQuery(window).resize(function() {

		setSizes();

	}).resize();

	jQuery("h1 a").click(function() {

		goHome();

		return false;

	});

	jQuery(window).hashchange(function() {

		if(!(window.location.hash)) {

			goHome();

		}

		if(getHash()) {

			getContent(getHash());

		}
	});

	function getHash() {

		var location = window.location.hash;
		var location = location.split('/');

		if(location) {

			if(location[3]) {

				return location[1] + '/' + location[2] + '/' + location[3];

			} else if(location[2]) {

				return location[1] + '/' + location[2];

			} else {

				return location[1];

			}

		} else {

			return false;

		}

	}

	jQuery(window).hashchange();

});
