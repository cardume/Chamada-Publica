<?php
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
?>

<?php 

require('../../../wp-blog-header.php'); 
require('../../../wp-admin/includes/file.php');
require('../../../wp-includes/pluggable.php');

header("HTTP/1.1 200 OK");

if($_POST['publish'] == 'Y') {

//	require_once('inc/recaptchalib.php');
//	$privatekey = '6Lc0WscSAAAAAIZ_2PFtkN1JWD60nWI3enuHv_eL';
//	$resp = recaptcha_check_answer ($privatekey,
//		                $_SERVER["REMOTE_ADDR"],
//		                $_POST["recaptcha_challenge_field"],
//		                $_POST["recaptcha_response_field"]);

	// if (!$resp->is_valid) die("<p class=\"error\">Você digitou o código errado. Por favor, tente novamente.</p>");

	$nonce = $_POST['_wpnonce'];

	if(!wp_verify_nonce($nonce, 'inscricao')) die('<p class=\"error\">Error de segurança</p>');

	$title			= $_POST['title'];
	$about			= $_POST['about'];
	$url			= $_POST['url'];
	$author			= $_POST['author'];
	$rede			= $_POST['rede'];
	$localizacao		= $_POST['localizacao'];
	$email			= $_POST['email'];
	$telefone		= $_POST['telefone'];
	$participantes		= $_POST['participantes'];
	$infraestrutura		= $_POST['infraestrutura'];
	$image			= $_FILES['image'];
	$passwd			= $_POST['passwd'];
	$post_type		= 'chamada-publica';

	$lang			= $_POST['lang'];

	// Categorias
	$categoria_terms	= $_POST['categoria'];

	if($lang == 'pt') {

		if(!$categoria_terms) die("<p class=\"error\">Você deve selecionar ao menos uma categoria!</p>");

	} elseif($lang == 'en') {

		if(!$categoria_terms) die("<p class=\"error\">You must select at least one category!</p>");

	} elseif($lang == 'es') {

		if(!$categoria_terms) die("<p class=\"error\">You must select at least one category!</p>");

	} elseif($lang == 'fr') {

		if(!$categoria_terms) die("<p class=\"error\">You must select at least one category!</p>");

	}

	// Tags
	$tag_terms		= $_POST['tags'];
	$tag_terms_array	= explode(',', $tag_terms);

	$publish_post = array(

		'post_title'	=> $title,
		'post_content'	=> $about,
		'post_status'	=> 'publish',
		'post_author'	=> 1,
		'post_type'	=> $post_type

	);

	$post_id = wp_insert_post($publish_post);

	if($post_id) {


		// Set custom meta (infos do projeto)

		if($url) update_post_meta($post_id, 'url', $url);

		update_post_meta($post_id, 'autor', $author);
		update_post_meta($post_id, 'email', $email);
		update_post_meta($post_id, 'rede', $rede);
		update_post_meta($post_id, 'localizacao', $localizacao);
		update_post_meta($post_id, 'telefone', $telefone);
		update_post_meta($post_id, 'participantes', $participantes);
		update_post_meta($post_id, 'infraestrutura', $infraestrutura);
		update_post_meta($post_id, 'passwd', md5($passwd));


		// Set category terms

		$update_categories = wp_set_object_terms($post_id, $categoria_terms, 'categoria_de_projeto');

		$update_tags = wp_set_object_terms($post_id, $tag_terms_array, 'tag_de_projeto');


		/// Envia imagem

		if($image) {

			$overrides = array('test_form' => false);
			$file = wp_handle_upload($image, $overrides);

			$filename = $file['file'];

			$filetype = $file['type'];

			$attachment = array(

				'post_mime_type' => $filetype,
				'post_title' => $title,
				'post_content' => '',
				'post_status' => 'inherit',
				'post_parent' => $post_id

			);

			$attach_id = wp_insert_attachment( $attachment, $filename );

			if($attach_id) {

				require_once(ABSPATH . 'wp-admin/includes/image.php');

				$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );

				wp_update_attachment_metadata( $attach_id, $attach_data );

				update_post_meta($post_id, '_thumbnail_id', $attach_id);

			} else {

				echo '<p class="error">Ocorreu um erro no envio da imagem.</p>';

			}

		}

		if($lang == 'pt') {

			echo '<p class="success">Obrigado por se inscrever no Festival CulturaDigital.Br. Até o dia 15 de outubro o resultado será informado por email. </p><p class="success">Seu projeto já está publicado na página de <a href="' . get_bloginfo('url') . '/#!/chamada-publica/projetos-inscritos/" title="Projetos Inscritos">projetos inscritos</a>. Confira e divulgue!</p>';

		} elseif($lang == 'en') {

			echo '<p class="success">Thank you for submitting your project to CulturaDigital.Br Festival. The results will be informed by e-mail until October 15th.</p><p class="success">Your project will be listed on our <a href="' . get_bloginfo('url') . '/en/#!/chamada-publica/projetos-inscritos/" title="Submitted Projects">submitted projects</a> page at CulturaDigital.Br. Check it out and spread the word!</p>';

		} elseif($lang == 'es') {

			echo '<p class="success">Thank you for submitting your project to CulturaDigital.Br Festival. The results will be informed by e-mail until October 15th.</p><p class="success">Your project will be listed on our <a href="' . get_bloginfo('url') . '/en/#!/chamada-publica/projetos-inscritos/" title="Submitted Projects">submitted projects</a> page at CulturaDigital.Br. Check it out and spread the word!</p>';

		} elseif($lang == 'fr') {

			echo '<p class="success">Thank you for submitting your project to CulturaDigital.Br Festival. The results will be informed by e-mail until October 15th.</p><p class="success">Your project will be listed on our <a href="' . get_bloginfo('url') . '/en/#!/chamada-publica/projetos-inscritos/" title="Submitted Projects">submitted projects</a> page at CulturaDigital.Br. Check it out and spread the word!</p>';

		}

	//	echo '<p class="success">A senha para editar as informações do seu projeto é <strong>' . $passwd . '</strong>.<br/>Guarde ela com cuidado!</p>';

	} else {

		if($lang == 'pt') {

			echo '<p class="error">Ocorreu um erro inesperado. Tente novamente ou contate nossa equipe.</p>';

		} elseif($lang == 'en') {

			echo '<p class="error">An unexpected error occurred. Try again or contact our team.</p>';

		} elseif($lang == 'es') {

			echo '<p class="error">An unexpected error occurred. Try again or contact our team.</p>';

		} elseif($lang == 'fr') {

			echo '<p class="error">An unexpected error occurred. Try again or contact our team.</p>';

		}

	}

}

?>
