<?php

add_image_size( 'slideshow-thumb', 1000, 600, true );

add_image_size( 'chamada-publica-thumb', 400, 225, true );

add_theme_support( 'post-thumbnails' );

if ( function_exists( 'register_nav_menu' ) ) {

	register_nav_menu( 'main-nav', 'Navegação principal' );

}

function curPageURL() {

	$pageURL = 'http';

	if ($_SERVER["HTTPS"] == "on") $pageURL .= "s";

	$pageURL .= "://";

	if ($_SERVER["SERVER_PORT"] != "80") {

		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

	} else {

		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

	}

	return $pageURL;
}

function getMeta() {

	$escapedfragment = $_GET['_escaped_fragment_'];

	$post_inArray = explode('/', $escapedfragment);

	if(strstr($escapedfragment, 'projetos-inscritos') && count($post_inArray) == 4) {

		$post = end($post_inArray);

		$post = get_page_by_path($post, 'OBJECT', 'chamada-publica');

	} else {
		
		$post = get_page_by_path($escapedfragment);

	}

	if($post) {

		echo '<title>' . get_the_title($post->ID) . ' | ' . get_bloginfo('name') . '</title>';

		if(has_post_thumbnail($post->ID)) :

			$thumbnail_id = get_post_thumbnail_id($post->ID);

			echo '<link rel="image_src" href="' . wp_get_attachment_url($thumbnail_id) . '" />';

		else :

			echo '<link rel="image_src" href="http://culturadigital.org.br/wp-content/uploads/2011/09/avatar_face.jpg" />';

		endif;

		echo '<meta name="keywords" content="cultura digital, festival cultura digital, chamada pública, open call, digital culture" />';

	} else {

		echo '<title>' . get_bloginfo('name') . '</title>';
		echo '<link rel="image_src" href="http://culturadigital.org.br/wp-content/uploads/2011/09/avatar_face.jpg" />';
		echo '<meta name="keywords" content="cultura digital, festival cultura digital, chamada pública, open call, digital culture" />';

	}

}



// Registra post type

add_action( 'init', 'register_cpt_chamada_publica' );

function register_cpt_chamada_publica() {

    $labels = array( 
        'name' => _x( 'Candidatos', 'chamada-publica' ),
        'singular_name' => _x( 'Chamada Publica', 'chamada-publica' ),
        'add_new' => _x( 'Adicionar novo', 'chamada-publica' ),
        'add_new_item' => _x( 'Adicionar novo projeto', 'chamada-publica' ),
        'edit_item' => _x( 'Editar projeto', 'chamada-publica' ),
        'new_item' => _x( 'Novo projeto', 'chamada-publica' ),
        'view_item' => _x( 'Ver projeto', 'chamada-publica' ),
        'search_items' => _x( 'Buscar projetos', 'chamada-publica' ),
        'not_found' => _x( 'Nenhum projeto foi encontrado', 'chamada-publica' ),
        'not_found_in_trash' => _x( 'Nenhum projeto foi encontrado na lixeira', 'chamada-publica' ),
        'parent_item_colon' => _x( 'Parent Chamada Publica:', 'chamada-publica' ),
        'menu_name' => _x( 'Chamada Pública', 'chamada-publica' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Candidatos da Chamada Pública',
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
        'taxonomies' => array( 'categoria_de_projeto', 'tag_de_projeto' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'chamada-publica', $args );
}



// Registra taxonomies

add_action( 'init', 'register_taxonomy_categoria_de_projeto' );

function register_taxonomy_categoria_de_projeto() {

    $labels = array( 
        'name' => _x( 'Categorias de Projeto', 'categoria de projeto' ),
        'singular_name' => _x( 'Categoria de Projeto', 'categoria de projeto' ),
        'search_items' => _x( 'Buscar categorias de projeto', 'categoria de projeto' ),
        'popular_items' => _x( 'Categorias de projeto populares', 'categoria de projeto' ),
        'all_items' => _x( 'Todas as categorias de projeto', 'categoria de projeto' ),
        'parent_item' => _x( 'Categorias de projeto pai', 'categoria de projeto' ),
        'parent_item_colon' => _x( 'Categorias de projeto pai:', 'categoria de projeto' ),
        'edit_item' => _x( 'Editar categoria de projeto', 'categoria de projeto' ),
        'update_item' => _x( 'Atualizar categoria de projeto', 'categoria de projeto' ),
        'add_new_item' => _x( 'Adicionar nova categoria de projeto', 'categoria de projeto' ),
        'new_item_name' => _x( 'Nova categoria de projeto', 'categoria de projeto' ),
        'separate_items_with_commas' => _x( 'Separar categorias de projeto com vírgula', 'categoria de projeto' ),
        'add_or_remove_items' => _x( 'Add or remove categorias de projeto', 'categoria de projeto' ),
        'choose_from_most_used' => _x( 'Choose from the most used categorias de projeto', 'categoria de projeto' ),
        'menu_name' => _x( 'Categorias de Projeto', 'categoria de projeto' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,

        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'categoria_de_projeto', array('chamada-publica'), $args );
}

add_action( 'init', 'register_taxonomy_tag_de_projeto' );

function register_taxonomy_tag_de_projeto() {

    $labels = array( 
        'name' => _x( 'Tags de Projeto', 'tag de projeto' ),
        'singular_name' => _x( 'Tag de Projeto', 'categoria de projeto' ),
        'search_items' => _x( 'Buscar tags de projeto', 'tag de projeto' ),
        'popular_items' => _x( 'Tags de projeto populares', 'tag de projeto' ),
        'all_items' => _x( 'Todas as tags de projeto', 'tag de projeto' ),
        'parent_item' => _x( 'Tags de projeto pai', 'tag de projeto' ),
        'parent_item_colon' => _x( 'Tags de projeto pai:', 'tag de projeto' ),
        'edit_item' => _x( 'Editar tag de projeto', 'tag de projeto' ),
        'update_item' => _x( 'Atualizar tag de projeto', 'tag de projeto' ),
        'add_new_item' => _x( 'Adicionar nova tag de projeto', 'tag de projeto' ),
        'new_item_name' => _x( 'Nova tag de projeto', 'tag de projeto' ),
        'separate_items_with_commas' => _x( 'Separar tags de projeto com vírgula', 'tag de projeto' ),
        'add_or_remove_items' => _x( 'Add or remove tags de projeto', 'tag de projeto' ),
        'choose_from_most_used' => _x( 'Choose from the most used tags de projeto', 'tag de projeto' ),
        'menu_name' => _x( 'Tags de Projeto', 'tag de projeto' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => false,

        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'tag_de_projeto', array('chamada-publica'), $args );
}

?>
