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

<div class="slideshow">

	<div class="slideshow-container">
	<?php

	$video_id = get_post_meta($post->ID, 'video_id', TRUE);
	$video_srv = get_post_meta($post->ID, 'video_srv', TRUE);

	if($video_id) {

		if($video_srv == 'Vimeo') {

			$video_url = "http://player.vimeo.com/video/$video_id?title=0&amp;byline=0&amp;portrait=0";

		} elseif ($video_srv == 'YouTube') {

			$video_url = "http://www.youtube.com/embed/rjFaenf1T-Y?rel=0&wmode=opaque";

		}

	}

	$attachment_args = array(
		'post_type'	=> 'attachment',
		'numberposts'	=> -1,
		'post_status'	=> null,
		'post_parent'	=> $post->ID,
		'orderby'	=> 'menu_order ID',
		'order'		=> 'ASC'
	);

	$attachments = get_posts($attachment_args);

	if($attachments) { ?>

		<?php if(count($attachments) > 1) { ?>

			<?php if($post->post_name == 'patrocine_bkp') { ?>

				<div class="apresentacao">

					<?php echo wp_get_attachment_image($attachments[0]->ID, 'slideshow-thumb'); ?>

					<?php foreach($attachments as $attachment) { ?>

						<?php if($attachment == $attachments[0]) { ?>

							<div class="capa">

								<a href="<?php echo wp_get_attachment_url($attachment->ID); ?>" rel="shadowbox[patrocine]">Veja nossa apresentação</a>

							</div>
						<?php }	else { ?>

							<a href="<?php echo wp_get_attachment_url($attachment->ID); ?>" rel="shadowbox[patrocine]" <?php echo $class; ?>><?php echo $text; ?></a>

						<?php } ?>

					<?php } ?>

				</div>

			<?php } else { ?>

			<div class="prev">Anterior</div>

			<div class="next">Próxima</div>

			<div class="carousel">

				<ul>

					<?php if($video_id) { ?>

						<li><iframe src="<?php echo $video_url; ?>" frameborder="0"></iframe></li>

					<?php } ?>

					<?php foreach($attachments as $attachment) { ?>

						<li><?php echo wp_get_attachment_image($attachment->ID, 'slideshow-thumb'); ?></li>

					<?php } ?>

				</ul>

			</div>

			<?php } ?>

		<?php } else { ?>

			<?php $attachment = array_shift($attachments); ?>

			<?php echo wp_get_attachment_image($attachment->ID, 'slideshow-thumb'); ?>				

		<?php } ?>

	<?php } else { ?>

		<?php if($video_id) { ?>

			<iframe src="<?php echo $video_url; ?>" frameborder="0"></iframe>

		<?php } ?>

	<?php } ?>

	</div>

</div>
