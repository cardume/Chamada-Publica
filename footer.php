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

</div>

<div id="rodape">

	<div class="wrap">

		<div class="realizacao">

			<?php _e('
				<!--:pt--><p>Realização:</p><!--:-->
				<!--:en--><p>Brought by:</p><!--:-->
				<!--:fr--><p>Réalisation:</p><!--:-->
				<!--:es--><p>Realización</p><!--:-->
			'); ?>

			<a href="http://www.casadaculturadigital.com.br/" target="_blank" title="Casa da Cultura Digital"><img src="<?php bloginfo('template_directory'); ?>/img/ccd.png" alt="Casa da Cultura Digital" /></a>

		</div>

		<img src="<?php bloginfo('template_directory'); ?>/img/patrocinio.jpg" class="patrocinio" alt="Patrocínio" />

		<div class="cardume">

			<a href="http://cardume.art.br/" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/img/cardume.jpg" alt="Cardume" /></a>
			<?php _e('
				<!--:pt--><p>site criado pelo<br/><a href="http://cardume.art.br/" target="_blank" title="Cardume">Cardume</a></p><!--:-->
				<!--:en--><p>website by<br/><a href="http://cardume.art.br/" target="_blank" title="Cardume">Cardume</a></p><!--:-->
				<!--:fr--><p>site créé par<br/><a href="http://cardume.art.br/" target="_blank" title="Cardume">Cardume</a></p><!--:-->
				<!--:es--><p>sitio creado por<br/><a href="http://cardume.art.br/" target="_blank" title="Cardume">Cardume</a></p><!--:-->
			'); ?>

		</div>

	</div>

</div>

<?php wp_footer(); ?>
</body>
</html>
