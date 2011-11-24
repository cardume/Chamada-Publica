jQuery(document).ready(function() {

	function isUrl(s) {

		var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
		return regexp.test(s);

	}

	function randomPassword(length) {
		chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		pass = "";

		for(x=0;x<length;x++) {
			i = Math.floor(Math.random() * 62);
			pass += chars.charAt(i);
		}

		return pass;
	}

	jQuery("input#passwd").attr("value", randomPassword(8));

	jQuery('#inscricao form').submit(function(event) {

		jQuery('input[type=submit]', this).attr('disabled', 'disabled');

		event.preventDefault();

		var retorna = false;

		jQuery("input,textarea").css({
			'border-color': '#dfdfdf'
		});

		jQuery(".required").each(function() {

			var item = jQuery(this);

			if(!(jQuery(this).attr("value"))) {

				jQuery(item).css({
					'border-color': '#ff0000'
				});

				retorna = true;
			}
		});

		var url = jQuery("input#url").attr("value");

		if(url) {

			var retorna_url = true;

			if(isUrl(url)) {

				retorna_url = false;

			} else {

				jQuery("input#url").css({ borderColor : "#ff0000" });

				retorna_url = true;

				jQuery("input[type=submit]").after("<p class=\"error\">A url inserida não é válida</p>");

			}

		}

		var image = jQuery("input#image").attr("value");

		if(image) {

			var valid_extensions = new Array('jpg','jpeg','png','gif','bmp');

			var upload_length = image.length;

			var pos = image.lastIndexOf('.') + 1;

			var upload_ext = image.substring(pos, upload_length);

			var retorna_image = true;

			jQuery("input#image").css({
				'border-color': '#ff0000'
			});

			for(i = 0; i < valid_extensions.length; i++) {

				if(valid_extensions[i] == upload_ext) {

					jQuery("input#image").css({
						'border-color': '#dfdfdf'
					});

					retorna_image = false;

				}
			}

		}

		if(retorna_url) {

			jQuery("#inscricao input[type=submit]").removeAttr("disabled");
			return false;

		}

		if(retorna) { 

			jQuery("#inscricao input[type=submit]").removeAttr("disabled");
			return false;

		}

		if(retorna_image) {

			jQuery("#inscricao input[type=submit]").removeAttr("disabled");
			return false;

		}

		jQuery(this).ajaxSubmit(
			function(data) {
				jQuery("#inscricao p.error").remove();
				jQuery("#inscricao form").hide("fast");
				jQuery("#inscricao form").before(data);

				if(jQuery("#inscricao p.error").length) {

					jQuery("#inscricao form").show("fast");

					jQuery("#inscricao input[type=submit]").removeAttr("disabled");

				}
			}
		);

	});
});
