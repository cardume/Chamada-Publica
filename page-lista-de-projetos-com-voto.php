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

			<th>Nome do projeto</th>
			<th>Data de inscrição</th>
			<th>Número de votos</th>

		</tr>

		<?php foreach($projetos as $projeto) { ?>

			<?php $projeto_data = get_post($projeto); ?>

			<tr>

				<td valign="top"><?php echo get_the_title($projeto->ID); ?></td>
				<td valign="top"><?php echo $projeto_data->post_date; ?></td>
				<td valign="top"><?php echo GetVotes($projeto->ID); ?></td>

			</tr>

		<?php } ?>

<?php } ?>

<?php endwhile; endif; ?>
