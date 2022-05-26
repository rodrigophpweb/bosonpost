<?php

/** 
 * Arquivo mágico do tema. Não é um arquivo obrigatório, mas é essencial para a
 * organização do código, para ativar funcionalidades no tema como menus, thumbnails,
 * novos tamanhos de imagem, entre outros. Funciona basicamente como um plugin
 * dentro do tema, e é carregado primeiro, antes de qualquer template do tema.
 * 
 * @since Essential
 */

	/**
	 * Função de segurança para evitar que o arquivo seja lido diretamente no 
	 * navegador, o que pode expor o caminho físico do arquivo no servidor. Insira
	 * esse trecho de código em todos os arquivos do tema.
	 * 
	 * @since Standard
	 */
	if ( ! function_exists( 'add_action' ) ) {
		exit;
	}

/**
 * Hook de ação do WordPress executado sempre que uma página é carregada logo após
 * o tema ser inicializado. Utilize-o para organizar melhor seu arquivo functions.
 * 
 * @since Standard
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
 */
add_action( 'after_setup_theme', 'bosonpost_setup_theme' );

/**
 * bosonpost Setup Theme
 * 
 * Função de setup do tema, inicializa todos os hooks do tema, e realiza a chamada
 * para funções que criam algumas "features" do tema.
 * 
 * Chamada no hook after_setup_theme
 * 
 * @return void
 * @since Standard
 */
function bosonpost_setup_theme(){
	/**
	 * Crie funções que façam somente um procedimento, tenham somente uma lógica, 
	 * para facilitar futuras manutenções no código.
	 * 
	 * Sempre utilize prefixos nas funções criadas para evitar conflitos com outras
	 * funções já existentes.
	 * 
	 * @since Standard
	 */
	bosonpost_theme_supports();
	bosonpost_nav_menus();

	/**
	 * Assinatura de todos os hooks do WordPress. Os hooks (ganchos) são a maneira 
	 * que temos de personalizar/modificar algum comportamento padrão do WordPress
	 * sem precisar alterar seu código fonte. Existem dois tipos de hooks, os de 
	 * ação e os de filtro. Para os hooks de ação sempre utilizamos add_action() e 
	 * para os filtros utilizamos add_filter().
	 * 
	 * @since Standard
	 * @link https://codex.wordpress.org/Function_Reference/add_action
	 * @link https://codex.wordpress.org/Function_Reference/add_filter
	 */
	add_action( 'the_generator', '__return_false' ); 
	// Segurança: Remove a meta tag generator do cabeçalho
	
	//include('inc/style-scripts.php');     
	// Call Functions CSS and JS



	add_action( 'wp_ajax_more_posts', 'bosonpost_more_posts_ajax' ); 
	// Captura uma requisição ajax para usuários logados 
	
	add_action( 'wp_ajax_nopriv_more_posts', 'bosonpost_more_posts_ajax' ); 
	// Captura uma requisição ajax para usuários não logados

	load_theme_textdomain( 'bosonpost', get_template_directory() . '/languages' );
	//Carrega o arquivo .mo que contém as traduções das strings internacionalizadas dentro do tema.
}

function bosonpost_theme_supports(){
	$logo = [
        'height'               => 117,
        'width'                => 68,
        'flex-height'          => true,
        'flex-width'           => true,
	];
	/**
	 * Adiciona ao tema suporte à imagem destacadas
	 * 
	 * @since Essential
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support
	 */
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', $logo );
    add_theme_support( 'title-tag' );

	/**
	 * Adiciona ao tema suporte à tags html5
	 * 
	 * @since Essential
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support
	 */
	add_theme_support( 'html5', 
		[ 
			'comment-list', 
			'comment-form', 
			'search-form', 
			'gallery', 
			'caption',
			'style',
			'script'
        ] 
	);
	boson_image_sizes();
}

function boson_image_sizes()
{
	/**
	 * Adiciona os tamanhos de imagem do tema. Define-se um nome para o tamanho, 
	 * width (largura), height (altura) e se o WordPress irá realizar o crop da imagem
	 * 
	 * @since Essential
	 * @link http://codex.wordpress.org/Function_Reference/add_image_size
	 */
	//add_image_size( 'card_front', 285, 160, true );
	//add_image_size( 'hero', 1920, 700, true );
}

/**
 * bosonpost Nav Menus
 * 
 * Função do tema criada para registrar as áreas de menu. Não é chamada por nenhum
 * hook, mas pela função de setup do tema.
 * 
 * @since Standard
 */
function bosonpost_nav_menus(){
	/**
	 * Adiciona ao tema áreas de menu que podem ser configuradas via administração
	 * 
	 * @since Essential
	 * @link http://codex.wordpress.org/Function_Reference/register_nav_menu
	 */
	register_nav_menu( 'header', 'Menu do cabeçalho.' );
}


//Remover Versão do WordPress
function remove_version() {
	return '';
}
add_filter('the_generator', 'remove_version');

//Function wp_body_open
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}


//Disable function REST API
add_filter('rest_enabled', '__return_false');
add_filter('rest_jsonp_enabled', '__return_false');
remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'template_redirect', 'rest_output_link_header', 11 );

//Removendo os comentários
add_action( 'init', 'remove_custom_post_comment' );
function remove_custom_post_comment() {
    remove_post_type_support( 'book', 'comments' );
} 

function codeless_remove_type_attr($tag) {
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}

/**
 * Responsive Image Helper Function
 *
 * @param string $image_id the id of the image (from ACF or similar)
 * @param string $image_size the size of the thumbnail image or custom image size
 * @param string $max_width the max width this image will be shown to build the sizes attribute 
 */

// Options themes
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Opções de Tema',
		'menu_title'	=> 'Opções de Tema',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Configurações em Header',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Configurações em Footer',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Configurações em Rodapé',
		'menu_title'	=> 'Páginas Internas',
		'parent_slug'	=> 'theme-general-settings',
	));
}

//Remove emoji do WordPress

/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	
	// Remove from TinyMCE
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

