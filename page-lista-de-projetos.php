<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.min.js" > </script> 
<script type="text/javascript" src="http://www.kunalbabre.com/projects/table2CSV.js" > </script>

<style>

table {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}

table tr td, table tr th {
	padding: 10px;
	border: 1px solid #ccc;
}

</style>

<?php

$projetos_args = array(
	'post_type'	=> 'chamada-publica',
	'numberposts'	=> -1,
);

$projetos = get_posts($projetos_args);

if($projetos) {

?>

	<a href="#" class="exportar">Exportar tabela para formato CSV (excel)</a>

	<script type="text/javascript">

		$("a.exportar").click(function() {

			$('table').table2CSV();
			return false;

		});

	</script>

	<table id="projetos">

		<tr>

			<th>Categorias</th>
			<th>Nome do projeto</th>
			<th>Descrição da proposta</th>
			<th>Responsável</th>
			<th>Rede ou instituição pertencente</th>
			<th>Localização</th>
			<th>E-mail do responsável</th>
			<th>Telefone(s) para contato</th>
			<th>Participante(s)</th>
			<th>Infraestrutura</th>
			<th>Tags</th>
			<th>Link para imagem do projeto</th>
			<th>Data de inscrição</th>
			<th>Votos</th>
			<th>Link para o projeto</th>
			<th>Link inserido no projeto</th>

		</tr>

		<?php foreach($projetos as $projeto) {

			$categorias = wp_get_post_terms($projeto->ID, 'categoria_de_projeto');

			$categorias_name = array();

			if($categorias) {

				foreach($categorias as $categoria) {

					$categorias_name[] = $categoria->name;

				}

				$categorias_name = implode(', ', $categorias_name);

			}

			$tags = wp_get_post_terms($projeto->ID, 'tag_de_projeto');

			$tags_name = array();

			if($tags) {

				foreach($tags as $tag) {

					$tags_name[] = $tag->name;

				}

				$tags_name = implode(', ', $tags_name);

			}

			$autor = get_post_meta($projeto->ID, 'autor', TRUE);
			$email = get_post_meta($projeto->ID, 'email', TRUE);
			$localizacao = get_post_meta($projeto->ID, 'localizacao', TRUE);
			$telefone = get_post_meta($projeto->ID, 'telefone', TRUE);
			$participantes = get_post_meta($projeto->ID, 'participantes', TRUE);
			$infraestrutura = get_post_meta($projeto->ID, 'infraestrutura', TRUE);
			$rede = get_post_meta($projeto->ID, 'rede', TRUE);

			$thumb_id = get_post_thumbnail_id($projeto->ID);
			$thumb_url = wp_get_attachment_url($thumb_id);

			$link = get_post_meta($projeto->ID, 'url', TRUE);

			$projeto_data = get_post($projeto);

			?>

			<tr>

				<td valign="top"><?php echo $categorias_name; ?></td>
				<td valign="top"><?php echo get_the_title($projeto->ID); ?></td>
				<td valign="top"><?php echo $projeto->post_content; ?></td>
				<td valign="top"><?php echo $autor; ?></td>
				<td valign="top"><?php echo $rede; ?></td>
				<td valign="top"><?php echo $localizacao; ?></td>
				<td valign="top"><?php echo $email; ?></td>
				<td valign="top"><?php echo $telefone; ?></td>
				<td valign="top"><?php echo $participantes; ?></td>
				<td valign="top"><?php echo $infraestrutura; ?></td>
				<td valign="top"><?php echo $tags_name; ?></td>
				<td valign="top"><a href="<?php echo $thumb_url; ?>"><?php echo $thumb_url; ?></a></td>
				<td valign="top"><?php echo $projeto_data->post_date; ?></td>
				<td valign="top"><?php echo GetVotes($projeto->ID); ?> votos</td>
				<td valign="top"><a href="http://culturadigital.org.br/#!/chamada-publica/projetos-inscritos/<?php echo $projeto_data->post_name; ?>">http://culturadigital.org.br/#!/chamada-publica/projetos-inscritos/<?php echo $projeto_data->post_name; ?></a></td>
				<td valign="top"><a href="<?php echo $link; ?>"><?php echo $link; ?></a></td>

			</tr>

		<?php } ?>

<?php } ?>

<?php endwhile; endif; ?>
