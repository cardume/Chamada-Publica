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

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">

<?php getMeta(); ?>
<meta name="description" content="O Festival CulturaDigital.Br acontece de 2 a 4 de dezembro, no Rio de Janeiro. O MAM-Rio e o Cine Odeon serão ocupados por palestras, debates, encontros, atividades mão na massa, exibições e performances artísticas." />
<meta name="fragment" content="!">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/estilo.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/scrollbar.css" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // wp_enqueue_script('jquery'); ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.js"></script>
<?php wp_head(); ?>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.form.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/js/shadowbox/shadowbox.css" />

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.ba-hashchange.min.js"></script>

<link href="http://fonts.googleapis.com/css?family=Marvel:400,700" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jcarousellite_1.0.1.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.scroll.js"></script>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/festival_cdbr.js"></script>

<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>

</head>
<body>

<div class="loading"><img src="<?php bloginfo('template_directory'); ?>/img/loading.gif" alt="Carregando..." /></div>

<div class="wrap"><div class="bg"></div></div>

<div id="header">

	<div class="wrap">

		<div class="social">

			<a href="http://www.facebook.com/pages/Festival-CulturaDigitalBr/268252773194259?ref=ts" target="_blank" id="fb">Facebook</a>

			<a href="http://twitter.com/#!/culturadigital" target="_blank" id="tw">Twitter</a>

		</div>

		<?php if(function_exists('qtrans_getLanguage')) { ?>

			<div class="language">
				<?php echo qtrans_generateLanguageSelectCode('both'); ?>
			</div>

		<?php } ?>

		<?php _e('
			<!--:pt--><h2 class="petrobras">Petrobrás apresenta:</h2><!--:-->
			<!--:fr--><h2 class="petrobras">Petrobrás apresenta:</h2><!--:-->
			<!--:es--><h2 class="petrobras">Petrobrás apresenta:</h2><!--:-->
			<!--:en--><h2 class="petrobras en">Petrobrás presents:</h2><!--:-->
		'); ?>

		<h1>Festival Internacional CulturaDigital.Br<a href="#" title="Ir para a página inicial"></a></h1>

		<?php _e('
			<!--:en--><h3 class="data">December 2-4</h3><!--:-->
			<!--:fr--><h3 class="data">du 2 au 4 décembre</h3><!--:-->
			<!--:es--><h3 class="data">del 2 al 4 de Diciembre</h3><!--:-->
			<!--:pt--><h3 class="data">2 a 4 de dezembro</h3><!--:-->
		'); ?>


		<h3 class="local">Rio de Janeiro</h3>
	</div>
</div>

<div id="nav" class="ajax-menu">
	<div class="wrap">
		<?php wp_nav_menu(); ?>
	</div>
</div>

<div id="highlight">

	<div class="wrap">

		<div class="first">
			<?php _e('
				<!--:en-->
					<h2>Registration is closed!</h2>
				<!--:-->
				<!--:fr-->
					<h2 class="fr">L\'<a href="#!/chamada-publica/"><strong>Appel Public</strong></a> des projets est terminé!</h2>
				<!--:-->
				<!--:es-->
					<h2 class="es">¡Se cierra la <a href="#!/chamada-publica/"><strong>convocatoria pública</strong></a> para proyectos!</h2>
				<!--:-->
				<!--:pt-->
					<h2>Inscrições encerradas para a <a href="#!/chamada-publica/"><strong>chamada pública</strong></a> de atividades!</h2>
				<!--:-->
			'); ?>
		</div>

		<div class="sec">

			<?php _e('
				<!--:pt-->
					<p class="faltam">Faltam</p>
					<script type="text/javascript">

						TargetDate = "12/02/2011 0:00 AM";
						CountActive = false;
						CountStepper = -1;
						BackColor = "#111111";
						ForeColor = "#FFFFFF";
						LeadingZero = true;
						FinishMessage = "ê!";
						DisplayFormat = "%%D%% dias";

					</script>
					<script src="' . get_bloginfo('template_directory') . '/js/countdown.js"></script>
					<p class="fest">Para o Festival</p>
				<!--:-->
				<!--:en-->
					<div class="en">
					<script type="text/javascript">

						TargetDate = "12/02/2011 0:00 AM";
						CountActive = false;
						CountStepper = -1;
						BackColor = "#111111";
						ForeColor = "#FFFFFF";
						LeadingZero = true;
						FinishMessage = "ê!";
						DisplayFormat = "%%D%% days";

					</script>
					<script src="' .  get_bloginfo('template_directory') . '/js/countdown.js"></script>
					<p class="fest">until the festival</p>
					</div>
				<!--:-->
				<!--:es-->
					<p class="faltam">Faltan</p>
					<script type="text/javascript">

						TargetDate = "12/02/2011 0:00 AM";
						CountActive = false;
						CountStepper = -1;
						BackColor = "#111111";
						ForeColor = "#FFFFFF";
						LeadingZero = true;
						FinishMessage = "ê!";
						DisplayFormat = "%%D%% dias";

					</script>
					<script src="' . get_bloginfo('template_directory') . '/js/countdown.js"></script>
					<p class="fest">Para el Festival</p>
				<!--:-->
				<!--:fr-->
					<div class="fr">
					<script type="text/javascript">

						TargetDate = "12/02/2011 0:00 AM";
						CountActive = false;
						CountStepper = -1;
						BackColor = "#111111";
						ForeColor = "#FFFFFF";
						LeadingZero = true;
						FinishMessage = "ê!";
						DisplayFormat = "%%D%% jours";

					</script>
					<script src="' .  get_bloginfo('template_directory') . '/js/countdown.js"></script>
					<p class="fest">pour le festival</p>
					</div>
				<!--:-->
			'); ?>

		</div>

	</div>

</div>


<div id="container">
