<?php
/**
 *   This file is part of the WordPress theme Chamada Publica.
 *
 *   Foobar is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   Foobar is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
?>

<?php if(!($_POST['ajax'])) {

	$blog_url = get_bloginfo('url');

	$redirect = ereg_replace($blog_url, '', curPageUrl());

	header('Location: ' . $blog_url . '#!' . $redirect);

} ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

	<?php include( TEMPLATEPATH . '/slideshow.php'); ?>

	<?php include( TEMPLATEPATH . '/inside-title.php'); ?>

	<div class="content" rel="<?php if(!$post->post_parent) echo $post->post_name; else echo get_post($post->post_parent)->post_name; ?>">

		<div class="wrap-left">

			<?php

			$blog_url = get_bloginfo('url');

			$redirect = ereg_replace($blog_url, '', curPageUrl());

			$url_pt = $blog_url . '#!' . $redirect;
			$url_en = $blog_url . '/en/#!' . $redirect;
			$url_es = $blog_url . '/es/#!' . $redirect;
			$url_fr = $blog_url . '/fr/#!' . $redirect;

			?>

			<?php if(qtrans_getLanguage() == 'pt') { ?>

				<a href="<?php echo $url_en; ?>" class="lang">English</a> <a href="<?php echo $url_es; ?>" class="lang">Español</a> <a href="<?php echo $url_fr; ?>" class="lang">Française</a>

			<?php } elseif(qtrans_getLanguage() == 'en') { ?>

				<a href="<?php echo $url_pt; ?>" class="lang">Português</a> <a href="<?php echo $url_es; ?>" class="lang">Español</a> <a href="<?php echo $url_fr; ?>" class="lang">Française</a>

			<?php } elseif(qtrans_getLanguage() == 'es') { ?>

				<a href="<?php echo $url_pt; ?>" class="lang">Português</a> <a href="<?php echo $url_en; ?>" class="lang">English</a> <a href="<?php echo $url_fr; ?>" class="lang">Française</a>

			<?php } elseif(qtrans_getLanguage() == 'fr') { ?>

				<a href="<?php echo $url_pt; ?>" class="lang">Português</a> <a href="<?php echo $url_en; ?>" class="lang">English</a> <a href="<?php echo $url_es; ?>" class="lang">Español</a>

			<?php } ?>

			<?php the_content(); ?>

			<?php $desativa_form = false; ?>


			<?php if(!$desativa_form) { ?>

			<?php

			// Traducao dos campos

			$inscricao['formulario']	= 'Formulário de inscrição';
			$inscricao['categorias']	= 'Categorias *';
			$inscricao['title']		= 'Nome do projeto *';
			$inscricao['about']		= 'Descreva a sua proposta *';
			$inscricao['about_label']	= '(inclua objetivo, descrição do projeto, dados e links relevantes para avaliação de sua proposta)';
			$inscricao['url']		= 'Site do projeto (se houver)';
			$inscricao['author']		= 'Responsável pela inscrição (pessoa física)';
			$inscricao['rede']		= 'Pertence a alguma rede ou instituição? (Citar qual/quais)';
			$inscricao['localizacao']	= 'Localização (cidade, estado e país)';
			$inscricao['email']		= 'E-mail do responsável';
			$inscricao['telefone']		= 'Telefone(s) para contato';
			$inscricao['participantes']	= 'Participante(s) no evento';
			$inscricao['participantes_label'] = '(oficineiro, apresentador ou articulador de rede)';
			$inscricao['infraestrutura']	= 'Infraestrutura complementar necessária';
			$inscricao['imagem']		= 'Imagem do projeto (apenas em formato jpg, png, gif ou bmp)';
			$inscricao['tags']		= 'Palavras-chave que definem o projeto (separadas por vírgula)';
			$inscricao['enviar']		= 'Enviar';

			if(qtrans_getLanguage() == 'en') {

				$inscricao['formulario']	= 'Apply';
				$inscricao['categorias']	= 'Categories *';
				$inscricao['title']		= 'Project Name *';
				$inscricao['about']		= 'Describe your project *';
				$inscricao['about_label']	= '(include your goals and a short project description with information and links you find relevant for the judging of your proposal)';
				$inscricao['url']		= 'Website (if any)';
				$inscricao['author']		= 'The responsible for the submission (natural person)';
				$inscricao['rede']		= 'Do the project belong to any network or institution? (list their names, links)';
				$inscricao['localizacao']	= 'Localization (city, state and country)';
				$inscricao['email']		= 'E-mail for contact';
				$inscricao['telefone']		= 'Phone number for contact';
				$inscricao['participantes']	= 'List of intended participants';
				$inscricao['participantes_label']	= false;
				$inscricao['infraestrutura']	= 'Complementary equipment needed';
				$inscricao['imagem']		= 'Upload a photo (only jpg, png, gif or bmp extensions are allowed)';
				$inscricao['tags']		= 'Keywords of the project (comma separated)';
				$inscricao['enviar']		= 'Submit';

			} elseif(qtrans_getLanguage() == 'es') {

				$inscricao['formulario']	= 'Formulario de inscripción';
				$inscricao['categorias']	= 'Categorias *';
				$inscricao['title']		= 'Nome del proyecto *';
				$inscricao['about']		= 'Descripción de la propuesta *';
				$inscricao['about_label']	= '(incluye el objetivo, descripción, dados y links relevantes para la evaluación de su propuesta)';
				$inscricao['url']		= 'Website del proyecto (si disponible)';
				$inscricao['author']		= 'Responsable por la inscripción (no puede ser una institución)';
				$inscricao['rede']		= 'Es usted parte de una red o una institución? (en caso afirmativo, cuál/cuáles)';
				$inscricao['localizacao']	= 'Ubicación (ciudad, estado, país)';
				$inscricao['email']		= 'E-mail del responsable';
				$inscricao['telefone']		= 'Teléfono(s) de contacto';
				$inscricao['participantes']	= 'Participante(s) del Festival';
				$inscricao['participantes_label']	= '(participante del taller, presentador o facilitador de la red)';
				$inscricao['infraestrutura']	= 'Equipo adicional necesario';
				$inscricao['imagem']		= 'Imagen del proyecto (los formatos aceptados: JPG, PNG, GIF o BMP)';
				$inscricao['tags']		= 'Las palabras clave que definen el proyecto (separados por comas)';
				$inscricao['enviar']		= 'Enviar';

			} elseif(qtrans_getLanguage() == 'fr') {

				$inscricao['formulario']	= 'Formulaire d’inscription';
				$inscricao['categorias']	= 'Catégories *';
				$inscricao['title']		= 'Nom du projet *';
				$inscricao['about']		= 'Description de la proposition *';
				$inscricao['about_label']	= '(Il faut comprendre le but, la description du projet, des donnés, aussi que des liens pertinents pour l’évaluation de votre proposition.)';
				$inscricao['url']		= 'Site du projet (si disponible)';
				$inscricao['author']		= 'Responsable pour l’inscription (ne peut pas être une institution)';
				$inscricao['rede']		= 'Faites-vous partie d’un réseau ou d’une institution ? (Si oui, indiquez lequel/lesquels)';
				$inscricao['localizacao']	= 'Localisation (ville, département, pays)';
				$inscricao['email']		= 'Adresse e-mail du responsable';
				$inscricao['telefone']		= 'Téléphone(s) pour vous joindre';
				$inscricao['participantes']	= 'Participant(s) du festival';
				$inscricao['participantes_label']	= '(Participant des ateliers, présentateur ou facilitateur de réseau)';
				$inscricao['infraestrutura']	= 'Équipements complémentaires nécessaires';
				$inscricao['imagem']		= 'Image du projet (formats acceptés: JPG, PNG, GIF ou BMP)';
				$inscricao['tags']		= 'Mots-clés qui définissent le projet (séparés par virgule)';
				$inscricao['enviar']		= 'Envoyer';

			}


			?>

			<div id="inscricao">

				<h2><?php echo $inscricao['formulario']; ?></h2>

				<form method="POST" action="<?php echo get_bloginfo('template_directory'); ?>/submit-post.php">

					<h3><?php echo $inscricao['categorias']; ?></h3>
					<ul class="categorias">

						<?php $categorias = get_terms('categoria_de_projeto', array('orderby' => 'name', 'hide_empty' => 0)); ?>

						<?php foreach($categorias as $categoria) { ?>

							<li>

								<?php

								if(qtrans_getLanguage() == 'en') {

									if($categoria->slug == 'oficinas') $categoria->name = 'Workshop';
									if($categoria->slug == 'mostra-de-experiencias') $categoria->name = 'Experience Sharing';
									if($categoria->slug == 'encontro-de-redes') $categoria->name = 'Network Meet-ups';
									if($categoria->slug == 'visualidades') $categoria->name = 'Visualities';
									if($categoria->slug == 'outros') $categoria->name = 'Others';

								} elseif(qtrans_getLanguage() == 'fr') {

									if($categoria->slug == 'oficinas') $categoria->name = 'Ateliers';
									if($categoria->slug == 'mostra-de-experiencias') $categoria->name = 'Exhibition d\'expériences';
									if($categoria->slug == 'encontro-de-redes') $categoria->name = 'Rencontre des réseaux';
									if($categoria->slug == 'visualidades') $categoria->name = 'Visuels';
									if($categoria->slug == 'outros') $categoria->name = 'Autres';

								} elseif(qtrans_getLanguage() == 'es') {

									if($categoria->slug == 'oficinas') $categoria->name = 'Talleres';
									if($categoria->slug == 'mostra-de-experiencias') $categoria->name = 'Experiencias';
									if($categoria->slug == 'encontro-de-redes') $categoria->name = 'Encuentros de Redes';
									if($categoria->slug == 'visualidades') $categoria->name = 'Visualidad';
									if($categoria->slug == 'outros') $categoria->name = 'Demás';

								}

								?>

								<input type="checkbox" name="categoria[]" id="<?php echo $categoria->slug; ?>" value="<?php echo $categoria->slug; ?>" /><label for="<?php echo $categoria->slug; ?>"><?php echo $categoria->name; ?></label>

							</li>

						<?php } ?>

					</ul>

					<input id="title" type="text" name="title" placeholder="<?php echo $inscricao['title']; ?>" class="required" />

					<textarea name="about" placeholder="<?php echo $inscricao['about']; ?>" rows="10" class="required"></textarea>
					<p class="label"><?php echo $inscricao['about_label']; ?></p>

					<input id="url" type="text" name="url" placeholder="<?php echo $inscricao['url']; ?>" />

					<input id="author" type="text" name="author" placeholder="<?php echo $inscricao['author']; ?>" class="required" />

					<input id="rede" type="text" name="rede" placeholder="<?php echo $inscricao['rede']; ?>" class="required" />

					<input id="localizacao" type="text" name="localizacao" placeholder="<?php echo $inscricao['localizacao']; ?>" class="required" />

					<input id="email" type="text" name="email" placeholder="<?php echo $inscricao['email']; ?>" class="required" />

					<input id="telefone" type="text" name="telefone" placeholder="<?php echo $inscricao['telefone']; ?>" class="required" />

					<textarea name="participantes" placeholder="<?php echo $inscricao['participantes']; ?>" rows="10" class="required"></textarea>
					<?php if($inscricao['participantes_label']) { ?>
					<p class="label"><?php echo $inscricao['participantes_label']; ?></p>
					<?php } ?>

					<textarea name="infraestrutura" placeholder="<?php echo $inscricao['infraestrutura']; ?>" rows="10" class="required"></textarea>

					<label for="image" class="file"><?php echo $inscricao['imagem']; ?></label><input type="file" id="image" name="image" />

					<input type="text" name="tags" id="tags" placeholder="<?php echo $inscricao['tags']; ?>" />

					<input type="hidden" name="publish" value="Y" />

					<input type="hidden" name="passwd" value="" id="passwd" />

					<input type="hidden" name="lang" value="<?php echo qtrans_getLanguage(); ?>" id="lang" />

					<?php $nonce = wp_create_nonce('inscricao'); ?>

					<input type="hidden" name="_wpnonce" value="<?php echo $nonce; ?>" />

					<input type="submit" value="<?php echo $inscricao['enviar']; ?>" />

				</form>

			</div>


			<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/placeholder.js"></script>
			<script type="text/javascript">

				jQuery('input[placeholder], textarea[placeholder]').placeholder();

			</script>

			<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/chamadapublica.js"></script>

			<?php } ?>

		</div>

	</div>

<?php endwhile; endif; ?>
