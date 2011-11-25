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

<?php if(!($_POST['ajax']) && !is_paged()) {

	$blog_url = get_bloginfo('url');

	$redirect = ereg_replace($blog_url, '', curPageUrl());

	header('Location: ' . $blog_url . '#!' . $redirect);

} ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

	<?php include( TEMPLATEPATH . '/slideshow.php'); ?>

	<?php include( TEMPLATEPATH . '/inside-title.php'); ?>

	<div class="content projetos" rel="<?php if(!$post->post_parent) echo $post->post_name; else echo get_post($post->post_parent)->post_name; ?>">

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

			<div class="filtrar">

				<?php _e('
					<!--:pt--><h3>Selecione por categoria:</h3><!--:-->
					<!--:en--><h3>Select by category:</h3><!--:-->
					<!--:fr--><h3>Sélection par catégorie:</h3><!--:-->
					<!--:es--><h3>Seleccione por categoría:</h3><!--:-->
				'); ?>

				<ul>

					<?php _e('
						<!--:pt--><li class="all active"><a href="#">Todos os projetos</a></li><!--:-->
						<!--:en--><li class="all active"><a href="#">All projects</a></li><!--:-->
						<!--:fr--><li class="all active"><a href="#">Tous les projets</a></li><!--:-->
						<!--:es--><li class="all active"><a href="#">Todos los proyectos</a></li><!--:-->
					'); ?>

					<?php $categorias = get_terms('categoria_de_projeto', array('orderby' => 'name', 'hide_empty' => 1)); ?>

					<?php foreach($categorias as $categoria) { ?>

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

						<li class="<?php echo $categoria->slug; ?>"><a href="#"><?php echo $categoria->name; ?></a></li>

					<?php } ?>

				</ul>

			</div>

			<?php $paged = get_query_var('paged') ? get_query_var('paged') : 1; ?>

			<?php $projetos_args = array(
				'post_type'		=> 'chamada-publica',
				'post_status'		=> 'publish',
				'posts_per_page'	=> 10,
				'paged'			=> $paged
			); ?>

			<?php query_posts($projetos_args); ?>

			<?php if(have_posts()) : ?>

				<ul id="projetos">

					<?php while(have_posts()) : the_post(); ?>

						<?php $post_categories = wp_get_post_terms($post->ID, 'categoria_de_projeto'); ?>

						<?php

						$post_categories_slug = array();

						foreach($post_categories as $post_category) $post_categories_slug[] = $post_category->slug;
						$post_categories_slug = implode(' ', $post_categories_slug);

						?>

						<li class="<?php echo $post_categories_slug; ?>">

							<?php

							$projeto_link = get_bloginfo('url') .'/#!/chamada-publica/projetos-inscritos/' . $post->post_name;

							if(qtrans_getLanguage() == 'en') $projeto_link = get_bloginfo('url') .'/en/#!/chamada-publica/projetos-inscritos/' . $post->post_name;

							if(qtrans_getLanguage() == 'es') $projeto_link = get_bloginfo('url') .'/es/#!/chamada-publica/projetos-inscritos/' . $post->post_name;

							if(qtrans_getLanguage() == 'fr') $projeto_link = get_bloginfo('url') .'/fr/#!/chamada-publica/projetos-inscritos/' . $post->post_name;


							?>

							<?php if(has_post_thumbnail()) { ?>

								<a class="ajax full" href="<?php echo $projeto_link; ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('chamada-publica-thumb'); ?></a>

							<?php } else { ?>

								<a class="ajax full" href="<?php echo $projeto_link; ?>" title="<?php the_title(); ?>"></a>

							<?php } ?>

							<h2><a class="ajax" href="<?php echo $projeto_link; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

						</li>

					<?php endwhile; ?>

				</ul>

			<?php endif; ?>

			<?php $numpages = $wp_query->max_num_pages; ?>

			<div class="navigation">

				<?php

				$loadmore_label = 'Carregar mais';

				if(qtrans_getLanguage() == 'en') $loadmore_label = 'Load more';

				if(qtrans_getLanguage() == 'es') $loadmore_label = 'Más proyectos';

				if(qtrans_getLanguage() == 'fr') $loadmore_label = 'Charger plus';

				?>

				<span class="next"><?php next_posts_link($loadmore_label); ?></span>

			</div>

			<script type="text/javascript">

				jQuery(document).ready(function() {

					var page = 1;

					var clicavel = true;

					jQuery(".navigation .next a").click(function() {

						if(clicavel) {

							var previous_page = page;

							page = page + 1;

							if(jQuery(".page-" + previous_page).length) {

								jQuery("ul#projetos.page-" + previous_page).after('<ul id="projetos" class="page-' + page +'"></ul>');

							} else {

								jQuery("ul#projetos").after('<ul id="projetos" class="page-' + page + '"></ul>');

							}

							var nextpostslink = jQuery(this).attr('href');

							jQuery("ul#projetos.page-" + page).load(nextpostslink + ' ul#projetos li', function() {

								clicavel = true

								jQuery(".navigation .next a").removeClass("carregando").text('<?php echo $loadmore_label; ?>');

							});

							var nextpostslink = nextpostslink.split('/');
							var currentpage_splitCount = nextpostslink.length - 2;
							var currentpage = nextpostslink[currentpage_splitCount];
							var nextpage = parseInt(currentpage) + 1;

							if(currentpage == <?php echo $numpages; ?>) {

								jQuery(this).remove();
								return false;

							}

							var new_link = jQuery(this).attr('href').replace(currentpage, nextpage);

							jQuery(this).attr('href', new_link);

						}

						clicavel = false;

						jQuery(this).addClass("carregando").text('...');

						return false;

					});

				});

			</script>


			<?php wp_reset_query(); ?>

		</div>

	</div>

<?php endwhile; endif; ?>
