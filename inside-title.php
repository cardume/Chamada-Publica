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

<?php if(!$_POST['sub']) { ?>

<div class="title">

	<div class="wrap-right">

		<p class="breadcrumb ajax-menu">

			<?php _e('
				<!--:pt--><a href="#">página inicial</a> //<!--:-->
				<!--:en--><a href="#">main page</a> //<!--:-->
			'); ?>

		</p>

		<?php if(!$post->post_parent) { ?>

			<h2 class="ajax-menu"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

		<?php } else { ?>

			<h2 class="ajax-menu"><a href="<?php echo get_permalink($post->post_parent); ?>" title="<?php echo get_the_title($post->post_parent); ?>"><?php echo get_the_title($post->post_parent); ?></a></h2>

		<?php } ?>

		<?php

		$childpages_args = array(
			'post_type'	=> 'page',
			'post_parent'	=> $post->ID,
			'numberposts'	=> -1
		);

		$childpages = get_posts($childpages_args);

		$projetos_inscritos = get_posts(array('post_type' => 'chamada-publica', 'numberposts' => -1, 'post_status' => 'publish'));

		if($childpages) {

			echo '<ul id="submenu" class="child ajax-menu">';

			foreach($childpages as $childpage) {

			//	if($childpage->post_name == 'projetos-inscritos' && !$projetos_inscritos) continue;
			//	if($childpage->post_name == 'inscreva-se') continue;

				echo '<li>';
				echo '<a class="' . $childpage->post_name . '" href="' . get_permalink($childpage->ID) . '" title="' . get_the_title($childpage->ID) . '">' . get_the_title($childpage->ID) . '</a>';
				echo '</li>';

			}

			echo '</ul>';

		} elseif($post->post_parent) {

			$childpages_args['post_parent'] = $post->post_parent;

			$brotherpages = get_posts($childpages_args);

			if($brotherpages) {

				echo '<ul id="submenu" class="child ajax-menu">';

				foreach($brotherpages as $brotherpage) {

					$class = '';

					if($brotherpage->ID == $post->ID) $class = 'class="active"';

				//	if($brotherpage->post_name == 'projetos-inscritos' && !$projetos_inscritos) continue;
				//	if($brotherpage->post_name == 'inscreva-se') continue;

					echo '<li>';
					echo '<a ' . $class . ' href="' . get_permalink($brotherpage->ID) . '" title="' . get_the_title($brotherpage->ID). '">' . get_the_title($brotherpage->ID) . '</a>';
					echo '</li>';

				}

				echo '</ul>';

			}

		}

		?>

	</div>

</div>

<?php } ?>
