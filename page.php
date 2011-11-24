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

		</div>

	</div>

<?php endwhile; endif; ?>
