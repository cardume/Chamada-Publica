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

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<?php $url = get_post_meta($post->ID, 'url', TRUE); ?>
<?php $local = get_post_meta($post->ID, 'localizacao', TRUE); ?>

<script language="javascript" type="text/javascript">

	jQuery("document").ready(function() {

		CreateNewLikeButton("<?php bloginfo('url'); ?>/#!/chamada-publica/projetos-inscritos/<?php echo $post->post_name; ?>")

	});

	function CreateNewLikeButton(url) {

		var elem = jQuery(document.createElement("fb:like"));
		elem.attr("href", url);
		elem.attr("colorscheme", "dark");
		elem.attr("font", "arial");
		elem.attr("show_faces", "false");
		jQuery("div#fb").empty().append(elem);
		FB.XFBML.parse(jQuery("div#fb").get(0));

	}

</script>

<div class="projeto-container">

	<div id="fb">
	</div>

	<h2><?php the_title(); ?></h2>

	<div class="meta">

		<?php if($url) echo '<a href="' . $url . '" target="_blank" title="' . get_the_title() . '" class="url">' . $url . '</a>'; ?>

		<?php if($local) echo '<p class="local">' . $local . '</p>'; ?>

	</div>

	<?php the_content(); ?>

</div>

<?php endwhile; endif; ?>
