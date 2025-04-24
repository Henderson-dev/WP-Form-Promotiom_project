<?php

/**
 * WORDPRESS SUPERFUNCTIONS
 *
 * O WPSF é um conjunto das principais funcionalidades necessárias à maioria dos projetos
 * desenvolvidos em Wordpress. Ele foi criado com o objetivo de agilizar o trabalho do
 * programador, reunindo funções que são utilizadas com pouca ou nenhuma modificação
 * em projetos diferentes.
 *
 * As funcionalidades incluem tanto aspectos de segurança e customização da Área Adminsitrativa
 * como recursos específicos do tema. 
 *
 * Sinta-se a vontade para alterar, acrescentar ou remover itens de acordo com as característcas
 * de seu projeto.
 *
 * Caso vá trabalhar com temas filhos, você pode sobrescrever algumas funções, aquelas contidas 
 * pelo function_exists(), apenas definido-as novamente no functions.php do tema filho.
 * Isso ocorre porque ele é executado antes do functions.php do tema pai.
 *
 * Para mais informações:
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Todos os recursos foram testados até a versão 4.3 do Worpdress
 *
 * @package Wordpress
 * @subpackage WPSF
 * @version 1.0
 * @author Leandro Hindu | leandrohindu@gmail.com
 * @copyright GNU General Public License v2 or later
 */


/**
 * Lista de Funcionalidades
 *
 * 1 - Definição de Constantes
 * 2 - Iniciar Sessão PHP
 * 3 - Colocar o site em modo de manutenção
 * 4 - Alterar URL de login
 * 5 - Alterar mensagem de erro do login
 * 6 - Customizar tela de login
 * 7 - Customizar rodapé da Área Administrativa
 * 8 - Remover widgets do Dashboard
 * 9 - Criar widget de Boas-vindas
 * 10 - Customizar Área Administrativa
 * 11 - Desabilitar edição de temas e plugins
 * 12 - Link para WP-Options
 * 13 - Remover barra do Administrador
 * 14 - Remover/Adicionar itens na barra do Administrador
 * 15 - Remover metadados do Header
 * 16 - Ativar suporte a post thumbnails
 * 17 - Adicionar a opção de crop aos tamanhos de imagem medium e large
 * 18 - Paginação
 * 19 - Adicionar excerpt à páginas
 * 20 - Contar as visualizações dos posts
 * 21 - Adicionar a thumb do post na página de lista da Área Administrativa
 * 22 - Carregar jQuery do Google CDN
 * 23 - Incluir arquivos JS e CSS
 * 24 - Incluir arquivos específicos para IE
 * 25 - Remover a versão do WP dos arquivos JS e CSS incluídos
 * 26 - Alterar o Gravatar padrão
 * 27 - Criar as Opções do Tema
 * 28 - Definir os post types que aparecerão nos resultados de busca
 * 29 - Registrar Menus
 * 30 - Registrar Sidebars
 */
 
 
 

/**
 * 1 - DEFINIÇÃO DE CONSTANTES
 *
 * A cada chamada da função get_bloginfo ou bloginfo uma consulta é realizada ao Banco de Dados.
 * Para evitar sobrecargas ao servidor e melhorar o carregamento da página o ideal é a definição 
 * de constantes com os valores mais usados em seu projeto.
 *
 * @uses echo NOME_DA_CONSTANTE
 *
 * Para mais informações:
 * @link https://codex.wordpress.org/Function_Reference/bloginfo
 */
if ( ! defined( 'SITE' ) ) define( 'SITE', get_bloginfo( 'url' ) );
if ( ! defined( 'SITE_NAME' ) ) define( 'SITE_NAME', get_bloginfo( 'name' ) );
if ( ! defined( 'TEMPLATE' ) ) define( 'TEMPLATE', get_bloginfo( 'template_directory' ) );
if ( ! defined( 'TEMPLATE_STYLE' ) ) define( 'TEMPLATE_STYLE', get_stylesheet_directory_uri() );




/**
 * 2 - INICIAR SESSÃO PHP
 *
 * Inicializa a sessão PHP para ser utilizada em qualquer página do tema.
 * A sessão é criada logo na inicialização e a prioridade 1 força que a função seja executada antes de
 * outros processos.
 */
if ( ! function_exists('wpsf_php_session') ) :

	function wpsf_php_session(){
		
		if(!session_id()) {
			session_start();
		}	
	}
	
	add_action('init', 'wpsf_php_session', 1);
endif; 




/**
 * 3 - COLOCAR O SITE EM MODO DE MANUTENÇÃO
 *
 * As vezes é necessário bloquear o acesso dos usuários ao site para a realização de alguma manutenção.
 * Esta função bloqueia a visualização das páginas para todos os usuários que não estejam logados.
 * Para os usuários logados o funcionamento continua normal.
 */
// if ( ! function_exists('wpsf_maintenance_mode') ) :

// 	function wpsf_maintenance_mode() { 
	 
// 		if ( !is_user_logged_in() ) { 
// 			echo '<h1>Site em desenvolvimento</h1>'; // Coloque aqui o HTML que será exibido na página
		
// 			exit; 
// 		} 
// 	} 

// 	add_action('get_header', 'wpsf_maintenance_mode');

// endif;




/**
 * 4 - ALTERAR URL DE LOGIN
 *
 * Cria uma URL amigável para acessar a página de login.
 *  
 * Mais informações:
 * @link: https://codex.wordpress.org/Rewrite_API/add_rewrite_rule
 */
if ( ! function_exists( 'wpsf_custom_login_url' ) ) :
	
	function wpsf_custom_login_url() {
		
		add_rewrite_rule( 'login/?$', 'wp-login.php', 'top' );	//O endereço amigável será http://www.seu_site.com/login
	}

	add_action( 'init', 'wpsf_custom_login_url' );
	
endif;




/**
 * 5 - ALTERAR MENSAGEM DE ERRO DO LOGIN
 *
 * Altera a mensagem de erro da página de login para evitar que eventuais invasores
 * descubram dados sobre os nomes de usuários do site.
 *
 * Mais informações:
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/login_errors
 */
if ( ! function_exists( 'wpsf_login_error_msg' ) ) :
	
	function wpsf_login_error_msg(){ 
	
		return '<strong>Usuário ou senha incorretos!</strong> Tente novamente.';
	}

	add_filter( 'login_errors', 'wpsf_login_error_msg' );

endif;




/**
 * 6 - CUSTOMIZAR TELA DE LOGIN
 *
 * Substitui a imagem, título e o link da logo da tela de login.
 *
 * Por padrão a tela de login exibe a logo do Wordpress, com um link para o Wordpress.org. 
 * O ideal é trocá-la pela logo de seu projeto e pelo link para a Home do site.
 *
 * Mais informações:
 * @link https://codex.wordpress.org/Customizing_the_Login_Form
 */

if( ! function_exists( 'wpsf_login_header_url' ) ) : 

	function wpsf_login_header_url() {
		
		return SITE;	// Substitui a URL pelo link da Home do site
	}
	
	add_filter( 'login_headerurl', 'wpsf_login_header_url' );

endif;




if( ! function_exists( 'wpsf_login_header_title' ) ) : 

	function wpsf_login_header_title() {
		
		return SITE_NAME;	// Substitui o título da imagem pelo nome do site
	}
	
	add_filter( 'login_headertext', 'wpsf_login_header_title' );

endif;




if( ! function_exists( 'wpsf_login_header_logo' ) ) : 

	function wpsf_login_header_logo() {
		
		/**
			Para customizar outros elementos da página, adicione seu CSS entre as tags style abaixo
			ou utilize um arquivo externo
			Ajuste os valores das propriedades CSS de acordo com o tamanho de sua imagem.
		*/
		echo '<style type="text/css">
				body.login div#login h1 a {
					background-image: url(' . TEMPLATE_STYLE . '/assets/images/logo-emporio-sao-joao-alimentos.png);
					background-size: 170px 116px;
					width: 170px;
					height: 116px;
				}
			  </style>';
	}
	
	add_action( 'login_enqueue_scripts', 'wpsf_login_header_logo' );

endif;




/**
 * 7 - CUSTOMIZAR RODAPÉ DA ÁREA ADMINISTRATIVA
 *
 * Substitui a frase padrão exibida no rodapé da Área Administrativa por um texto customizado.
 */

if ( ! function_exists( 'wpsf_custom_admin_footer' ) ) :
  
	function wpsf_custom_admin_footer() {
		
		echo 'Criado com <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Desenvolvido por <a href="http://www.leandrohindu.com.br" target="_blank">Leandro Hindu</a>';
	}
	
	add_filter( 'admin_footer_text', 'wpsf_custom_admin_footer' );

endif;




/**
 * 8 - REMOVER WIDGETS DO DASHBOARD
 *
 * Por padrão o Dashboard do Wordpress vem com uma série de widgets que, de acordo com seu projeto, 
 * podem não ter utilidade para os usuários. Removê-los é uma boa forma de tornar o Dashboard
 * mais amigável.
 *
 * Para mais informações:
 * @link https://codex.wordpress.org/Dashboard_Widgets_API
 *  
 */ 
if ( ! function_exists( 'wpsf_remove_dashboard_widgets' ) ) :

	function wpsf_remove_dashboard_widgets() {
		
        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
	}

	add_action( 'admin_init', 'wpsf_remove_dashboard_widgets' );

endif;




/**
 * 9 - CRIAR WIDGET DE BOAS-VINDAS
 *
 * O Welcome Panel padrão do Wordpress pode ser de pouca utilidade dependendo do tipo do seu projeto.
 * 
 * Criar um widget customizado torna o Dashboard mais amigável, principalmente para usuários leigos.
 * Ele pode ser utilizado como um acesso rápido às principais páginas da área administrativa, por exemplo.
 *
 * Para mais informações:
 * @link https://codex.wordpress.org/Dashboard_Widgets_API
 */
if ( ! function_exists( 'wpsf_custom_dashboard' ) ) :
	
	function wpsf_custom_dashboard() {
 	
		//Remove o Welcome Panel padrão
		remove_action( 'welcome_panel', 'wp_welcome_panel' ); 
		
		//Adiciona o widget de boas vindas customizado			
		wp_add_dashboard_widget('custom_welcome_widget', 'Bem-vindo à sua Área Administrativa!', 'wpsf_custom_welcome_widget');
	}

	add_action( 'wp_dashboard_setup', 'wpsf_custom_dashboard' ); 
	
	
	//Callback de criação do widget
	function wpsf_custom_welcome_widget() {
?>

	<p class="welcome-intro">
    	Aqui você pode atualizar informações, postar conteúdos e gerenciar quase tudo que se refere à estrutura do seu site. 
        <br />
        Para isto, utilize o menu à esquerda da tela. Ele se divide em 3 partes principais:
    </p> 
    
    <div class="welcome-box welcome-box-esquerda">
    	<strong>Painel</strong>
        
        <p>É o primeiro bloco do menu. Ele tem um link de volta para esta página inicial e avisos sobre atualizações de plugins.</p>
    </div>
    
    <div class="welcome-box welcome-box-centro">
    	<strong>Conteúdo</strong>
        
        <p>Este é o bloco mais importante e que será utilizado com mais frequência. Ele reúne os links para todas as áreas de contéudo do site, onde você pode cadastrar, editar ou excluir informações.</p>
    </div>
    
    <div class="welcome-box welcome-box-direita">
    	<strong>Configurações</strong>
        
        <p>Neste bloco ficam as opções que controlam o funcionamento de plugins, scripts e do próprio site de forma geral. Tenha cuidado ao fazer alguma mudança e em caso de dúvida entre em contato com o programador responsável.</p>
    </div>
    
    <br clear="all" />

    <div class="acesso-rapido">
    	<strong class="titulo">Acesso Rápido</strong>
        <br />
        
    	<ul>
        	<li>
            	<a href="edit.php?post_type=produto" target="_blank">Ver todos os Produto</a>
            </li> 
            <li>
            	<a href="post-new.php?post_type=produto" target="_blank">Adicionar novo Produto</a>
            </li>           
        	<li>
            	<a href="edit.php?post_type=receita" target="_blank">Ver todas as Receitas</a>
            </li>
            <li>
            	<a href="post-new.php?post_type=receita" target="_blank">Adicionar nova Receita</a>
            </li>
            <li>
            	<a href="edit.php?post_type=unidade" target="_blank">Ver todas as Unidades</a>
            </li>
            <li>
            	<a href="post-new.php?post_type=unidade" target="_blank">Adicionar nova Unidade</a>
            </li>
        </ul>
        <ul>
            
            <li>
            	<a href="edit.php?post_type=faq" target="_blank">Ver todas as Perguntas Frequentes</a>
            </li>
            <li>
            	<a href="post-new.php?post_type=faq" target="_blank">Adicionar nova pergunta</a>
            </li>
            <li>
            	<a href="post.php?post=21&action=edit" target="_blank">Editar a Home</a>
            </li>
            <li>
            	<a href="admin.php?page=theme-general-settings" target="_blank">Editar as Opções do Tema</a>
            </li>
        </ul>                       
    </div>
        
	<style>
		#wpbody-content #dashboard-widgets #postbox-container-1{width:100%}
		.postbox{padding: 15px;}
		.postbox .handlediv{display:none;}
		.meta-box-sortables.ui-sortable .hndle{font-size: 24px; font-weight: normal; border: none; color:#0074a2;}
		.welcome-intro{color:#666; font-size:16px; line-height: 180%;}
		.welcome-box{float:left; width:30%; margin-right:5%; padding: 20px; box-sizing: border-box; border-left: 1px solid #0074a2; margin-top: 20px;}
		.welcome-box-direita{margin-right:0;}
		.welcome-box strong{font-size:20px;font-weight: 400; color: #666;}
		.welcome-box-esquerda strong:before{content: "\f226";font-family: dashicons; color: #666; float: left; margin-right: 5px;}
		.welcome-box-centro strong:before{content: "\f109";font-family: dashicons; color: #666; float: left; margin-right: 5px;}
		.welcome-box-direita strong:before{content: "\f111";font-family: dashicons; color: #666; float: left; margin-right: 5px;}
		
		.acesso-rapido{margin:40px 0 0;}
		.acesso-rapido .titulo{font-size:20px; color:#666; font-weight:normal;margin-bottom: 10px; display: inline-block;}
		.acesso-rapido ul{display: inline-block; vertical-align: top; margin-right: 50px; list-style: initial; margin-left: 20px;}
		.acesso-rapido a{font-size: 14px; margin-bottom: 8px; display: inline-block; text-decoration: underline !important; font-weight: bold;}

		@media(max-width: 768px){
			.welcome-box{float:none; width:100%; margin-right:0; border-top: 1px solid #0074a2; border-left:none;}	
		}
    </style>

<?php
		
	}

endif;




/**
 * 10 - CUSTOMIZAR ÁREA ADMINISTRATIVA
 *
 * Adiciona seus próprios estilos CSS à Área Administrativa
 */
if ( ! function_exists( 'wpsf_admin_styles' ) ) :

	function wpsf_admin_styles() {
		
		//Altere a tag de acordo com o nome de seu arquivo	
		echo '<style type="text/css">
           #adminmenu div.separator{background: #fff; margin-top: 10px;}
         </style>';		
	}

	add_action( 'admin_head', 'wpsf_admin_styles' );

endif;




/**
 * 11 - DESABILITAR EDIÇÃO DE TEMAS E PLUGINS
 *
 * O Wordpress permite que os usuários acessem os arquivos fontes dos temas e plugins e façam alterações, 
 * através da Área Administrativa. Do ponto de vista da segurança, isto representa um perigo.
 * 
 * Definir a constante DISALLOW_FILE_EDIT como TRUE desabilita este recurso. 
 * Se preferir, esta constante também pode ser definida no arquivo wp-config.php.
 */
define('DISALLOW_FILE_EDIT', true);




/**
 * 12 - LINK PARA WP_OPTIONS
 *
 * Cria dentro do menu Configurações um link a página options.php, 
 * que contem um formulário para edição dos itens da tabela wp_options.
 * Esta é a tabela que contem todas as configurações gerais da instalação do Wordpress.
 *
 * O link será visível apenas para usuários com perfil de Administrador
 */
if ( ! function_exists( 'wpsf_page_options' ) ) :

	function wpsf_page_options() {
		
   		add_options_page('WP Options', 'WP Options', 'administrator', 'options.php');
   	}
	
	add_action('admin_menu', 'wpsf_page_options'); 

endif;




/**
 * 13 - REMOVER BARRA DO ADMINISTRADOR
 *
 * Quando se está logado, durante a navegação pelo site é exibida a barra de administração no topo da página. 
 * Isto as vezes é desnecessário e atrapalha o teste e a visualização de alguns elementos do layout.
 * Você pode removê-la desabilitando esta opção na página de edição do usuário no menu Usuários.
 * Se preferir utilize o código abaixo. 
 * 
 */ 
add_filter( 'show_admin_bar', '__return_false' );




/**
 * 14 - REMOVER/ADICIONAR ITENS NA BARRA DO ADMINISTRADOR
 *
 * A barra de Administração do Wordpress contem vários menus de acesso rápido a recursos do site.
 * De acordo com o tipo do seu projeto, alguns deles podem ser desnecessários. E a criação de
 * outros pode ser útil para os usuários.
 *
 * Esta função remove alguns menus padrão e adiciona um menu e submenu customizado.
 *
 * Mais informações:
 * @link https://codex.wordpress.org/Class_Reference/WP_Admin_Bar
 */
if ( ! function_exists( 'wpsf_clear_toolbar' ) ) :
 
	function wpsf_clear_toolbar() {
		
		global $wp_admin_bar;
	
		// Remove os menus
		$wp_admin_bar->remove_menu( 'wp-logo' );
		$wp_admin_bar->remove_menu( 'updates' );
		$wp_admin_bar->remove_menu( 'new-content' );
		$wp_admin_bar->remove_menu( 'comments' );
				
	}
	
	add_action('admin_bar_menu', 'wpsf_clear_toolbar', 500);

endif;




/**
 * 15 - REMOVER METADADOS DO HEADER
 *
 * Por padrão, a função wp_head exibe algumas informações desnessárias, como links para o Feed,
 * ou potencialmente perigosas, como a versão do Wordpress.
 * O código abaixo corrige isto removendo estes dados. 
 *
 * Para mais informações:
 * @link https://codex.wordpress.org/Function_Reference/wp_head 
 */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'feed_links' );
remove_action( 'wp_head', 'feed_links_extra' ); 
remove_action( 'wp_head', 'rsd_link' ); 
remove_action( 'wp_head', 'wlwmanifest_link' ); 




/**
 * 16 - ADICIONAR SUPORTE A POST THUMBNAILS
 *
 * Ativa o suporte à post thumbnails no tema. 
 * Para cada imagem inserida, o Wordpress irá gerar automaticamente 4 tamanhos: 
 * thumbnail, medium, large e full (que é a imagem original). 
 *
 * As dimensões destes tamanhos podem ser setadas no menu Configurações > Mídia.
 *
 * Caso seu projeto necessite de outros tamanhos de imagens, utilize a função add_image_size,
 * como no exemplo abaixo.
 *
 * Para mais informações:
 * @link https://codex.wordpress.org/Post_Thumbnails
 */
add_theme_support( 'post-thumbnails' );
	
add_image_size( 'receita', 248, 248, true );




/**
 * 17 - ADICIONAR A OPÇÃO DE CROP AOS TAMANHOS DE IMAGENS MEDIUM E LARGE
 *
 * Por padrão os tamanhos Mediun e Large são recortados apenas proporcionalmente.
 * O código abaixo faz com eles sejam recortados nas dimensões exatas, como ocorre com a Thumbnail.
 */
update_option("medium_crop", "1");
update_option("large_crop", "1");




/**
 * 18 - PAGINAÇÃO
 *
 * Usa a função paginate_links() para gerar a paginação dos posts. 
 *
 * @param WP_Query 	$query 	A query a ser paginada, no caso de loops secundários
 * @param int 		$pagina	A página atual, no caso de loops secundários
 *
 * @uses <?php if (function_exists (wpsf_pagination)) wpsf_pagination(); ?>
 *
 * Mais informações:
 * @link https://codex.wordpress.org/Function_Reference/paginate_links
 */
if ( ! function_exists( 'wpsf_pagination' ) ) :
	
	function wpsf_pagination($query = '', $pag = '') {
		
		global $wp_query;
	
		$big = 999999999; // Use um número inteiro com valor absurdo
		
		//Testa se uma query foi informada. Se não pega a query ativa
		if(!empty($query)){
			$max = $query->max_num_pages;
		}
		else{
			$max = $wp_query->max_num_pages;
		}
		
		//Testa se uma página foi informada. Se não pega a página ativa	
		if(!empty($pag)){
			$current = $pag;	
		}
		else{
			$current = max( 1, get_query_var('paged') );
		}
		
  
		$pags = paginate_links( 
					array(
						'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
						'current' => $current,
						'total' => $max,
						'mid_size' => 5
					) 
				);
	
		// Testa se a paginação é necessária
		if ( $pags ) {
			
			echo '<div class="paginacao">'; // Cria uma div para conter os resultados
			echo $pags;
			echo '</div>';
		}
	}
endif;




/**
 * 19 - ADICIONAR EXCERPT À PAGINAS
 * 
 * Adiciona suporte ao campo excerpt(resumo) à paginas.
 * Por padrão, ele está disponível apenas em posts. 
 *
 * O método add_post_type_support serve também para adicionar à qualquer post type
 * suporte à qualquer recurso padrão dos posts do Wordpress.
 *
 * Mais informações:
 * @link: https://codex.wordpress.org/Function_Reference/add_post_type_support
 *
 */
if ( ! function_exists( 'wpsf_page_excerpt' ) ) :
 
	function wpsf_page_excerpt() {
		
		add_post_type_support('page', array('excerpt'));
	}

	add_action('init', 'wpsf_page_excerpt');
	
endif;




/**
 * 20 - CONTAR AS VISUALIZAÇÕES DOS POSTS
 *
 * Em blogs é muito comum haver uma lista com os posts mais lidos. 
 * Esta função cria uma post meta para contabilizar as visualizações.
 */
if ( ! function_exists( 'wpsf_count_views' ) ) :
    
    function wpsf_count_views () {	
    	
		global $post;
		
		// Testa se está na single e se não há uma sessão para este post
        if ( is_single() and empty( $_SESSION[ 'wpsf_counter_' . $post->ID ] ) ) {
        
            // Seta a sessão
            $_SESSION[ 'wpsf_counter_' . $post->ID ] = 1;
            
            // Pega o número de visualizações do post
            $views = get_post_meta( $post->ID, 'post_views', true );
                
            // Se a chave estiver vazia, o valor será 1
            if ( $views == '' ) $views = 1;                    
			else $views++;
            
			//Atualiza no banco    
			update_post_meta( $post->ID, 'post_views', $views );
                
        } 
    }
	
    add_action( 'get_header', 'wpsf_count_views' );

endif;




/**
 * 21 - ADICIONAR A THUMB DO POST NA PÁGINA DE LISTA DO ADMIN
 *
 * Cria uma coluna na página de listagem dos posts para exibir a thumbnail.
 * Esta é uma forma de tornar a Área Adminsitrativa mais amigável para o usuário.
 *
 * A primeira função adiciona ao array de títulos das colunas o nome da nova coluna.
 *
 * A segunda função pega o caminho da thumbnail do post e exibe a imagem.
 */
if ( ! function_exists( 'wpsf_thumb_column_title' ) ) :

	function wpsf_thumb_column_title($defaults){
		
		$defaults['post_thumb'] = 'Thumbnail'; // Seta o título da coluna
		$defaults['post_views'] = 'Visualizações'; // Seta o título da coluna
		
		return $defaults;
	}
	
	add_filter('manage_post_posts_columns', 'wpsf_thumb_column_title', 10, 1); 

endif;


if ( ! function_exists( 'wpsf_thumb_column_value' ) ) :
	
	function wpsf_thumb_column_value($column_name, $id){
		
		global $post;
		
		if($column_name == 'post_thumb'){
			
			//Pega o caminho da imagem
			$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail' );
			
			if($thumb != ""){
				echo '<img src="'.$thumb[0].'"  height="80" width="auto">';	
			}
		}
		
		if($column_name == 'post_views'){
			
			echo get_post_meta( $post->ID, 'post_views', true );
		}
	}
	
	add_action('manage_post_posts_custom_column', 'wpsf_thumb_column_value', 10, 2);

endif;




/**
 * 22 - CARREGAR JQUERY DO GOOGLE CDN
 * 23 - INCLUIR OS SCRIPTS E CSS
 * 24 - INCLUIR ESTILOS ESPECÍFICOS PARA INTERNET EXPLORER
 *
 * Utiliza no tema o jQuery do Google CDN no lugar do jQuery que já vem incluído na instalação do Wordpress.
 * Isso diminui o consumo de banda do site e agiliza o carragamento da biblioteca.
 *
 * Inclui os arquivos javascript do tema, definindo que eles devem ser incluidos no footer.
 *
 * Inclui os arquivos CSS gerais e o CSS específico para o Internet Explorer, que é setado com
 * a tag condicional apropriada.
 */
if ( ! function_exists( 'wpsf_enqueue_assets' ) ) :
 
	function wpsf_enqueue_assets() {
		
		// Verifica se a página não é da área administrativa
		if(!is_admin()) :
			
			//Carrega o Jquery do Google CDN
			wp_deregister_script('jquery');
			wp_register_script('jquery', "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js", false, null, true);
			wp_enqueue_script('jquery');
			
		endif;
		
		//Inclui os JS
		wp_enqueue_script('popper', '//cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', array('jquery'), '', true);
		wp_enqueue_script('bootstrap', '//cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js', array('jquery'), '', true);

		if( is_page('home')){

			wp_enqueue_script('swiper', '//unpkg.com/swiper/swiper-bundle.min.js', array('jquery'), '', true);
			wp_enqueue_script('lity', TEMPLATE . '/assets/js/lity.js', array('jquery'), '', true);
		}

		wp_enqueue_script('scripts', TEMPLATE . '/assets/js/scripts.js', array('jquery'), '', true);


		//Inclui os CSS 
		//wp_enqueue_style( 'fonts', '//fonts.googleapis.com/css2?family=DM+Serif+Display&family=Work+Sans:wght@400;600&display=swap' );

		if( is_page('home')){
			wp_enqueue_style( 'lity', TEMPLATE . '/assets/css/lity.css' );
		}

		wp_enqueue_style( 'style', TEMPLATE . '/assets/css/style.min.css' );	
	}
	
	add_action("wp_enqueue_scripts", "wpsf_enqueue_assets");

endif;




/**
 * 25 - REMOVER A VERSÃO DO WP DOS CSS E JS INCLUÍDOS
 *
 * Ao incluir os arquivo CSS ou JS, você pode setar um parâmetro com a versão do arquivo.
 * Se este parâmetro não for definido, o Wordpress seta automaticamente com a versão da plataforma.
 *
 * Esta função corrige este problema, evitando que a versão do Wordpress seja exposta.
 *
 * @param $src string Nome do arquivo a ser incluído
 * @return string Nome do arquivo corrigido   
 */ 
if ( ! function_exists( 'wpsf_remove_version' ) ) : 

	function wpsf_remove_version( $src ) {
		
		if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) ){
			
			$src = remove_query_arg( 'ver', $src );
		}
		
		return $src;
	}
	
	add_filter( 'style_loader_src', 'wpsf_remove_version' );
	add_filter( 'script_loader_src', 'wpsf_remove_version' );

endif;




/**
 * 26 - ALTERAR GRAVATAR PADRÃO
 *
 * Nos comentários em posts e páginas, o Wordpress utiliza a imagem do usuário cadastrada no http://gravatar.com.
 * Caso o usuário não possua um cadastro no Gravatar, é exibida uma imagem padrão.
 * O Wordpress já possui algumas opções pré-definidas, disponíveis em Configurações >> Discussão.
 *
 * Esta função permite adicionar uma imagem personalizada com, por exemplo, a logo do site.
 *
 * @param array $avatar_defaults Contém os avatares padrão do Wordpress
 * @return array Acrescido do novo avatar
 */
/*if ( ! function_exists( 'wpsf_custom_gravatar' ) ) :

	function wpsf_custom_gravatar( $avatar_defaults ) {
		
		//Caminho para a imagem do avatar
		$myavatar =  TEMPLATE . '/images/avatar-exemplo.png';
		
		//Nome do novo avatar
		$avatar_defaults[$myavatar] = "Avatar Exemplo";
		
		return $avatar_defaults;
	}
	
	add_filter( 'avatar_defaults', 'wpsf_custom_gravatar' );
	
endif;*/




/**
 * 27 - CRIAR OPÇÕES DO TEMA 
 *
 */
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Opções do Tema',
		'menu_title'	=> 'Opções do Tema',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}




/**
 * 28 - DEFINIR OS POST TYPES QUE APARECERÃO NOS RESULTADOS DE BUSCA
 *
 * Ao colocar um campo de busca no site, dependendo das características do projeto, apenas alguns post types 
 * deverão ser listados nos resultados.
 * Para aproveitar a query padrão que é executada na página search.php, é possível utilizar o filtro 
 * pre_get_posts para definir quais serão estes post types.
 *
 * @param objeto $query O paramentro é passado por referência, não é necessário retornar o valor.
 *
 * Mais informações
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
 */
if ( ! function_exists( 'wpsf_search_filter' ) ) :
 
	function wpsf_search_filter($query) {
		
		//Testa se não é uma página do Admin e se é a query principal
		if ( !is_admin() && $query->is_main_query() ) {
			
			//Testa se é uma query de busca
			if ($query->is_search) {
				
				//Seta os post-types que devem ser pesquisados
				$query->set('post_type', array( 'receita' ) );
			}
		}
	}
	
	add_action('pre_get_posts','wpsf_search_filter');

endif;






/**
 * 29 - REGISTRAR MENUS
 *
 * Cria um menu de navegação gerenciável pela Área Administrativa para ser usado no tema.
 *
 * Mais informações:
 * @link https://codex.wordpress.org/Function_Reference/register_nav_menu
 */
/*if ( ! function_exists( 'wpsf_menus' ) ) : 

	function wpsf_menus(){
	
		register_nav_menu( 'principal', 'Menu Principal' );
	}
	
	add_action( 'after_setup_theme', 'wpsf_menus' );
endif;*/




/**
 * 30 - REGISTRAR SIDEBARS
 *
 * Cria uma sidebar para ser usada no tema. As sidebars podem ser preenchidas com widgets 
 * adicionados através da Área Administrativa.
 *
 * Mais informações:
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 *
if ( ! function_exists( 'wpsf_sidebars' ) ) :

	function wpsf_sidebars(){
		
		$args = array(
				'name'          => 'Sidebar Blog',
				'id'            => 'sidebar-1',
				'description'   => 'Exibida nas páginas do blog',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">', //Usa sprintf para setar o ID e a classe de acordo com o widget selecionado
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			 );
		
		register_sidebar( $args );
	}
	
	add_action( 'widgets_init', 'wpsf_sidebars' );

endif; */


/** 
  Limita o tamanho do excerpt
 */
function tn_custom_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'tn_custom_excerpt_length', 999 );




/**
 *	Limpar espaços e carateres de campos dos telefones
 */
function limpaTel($valor){

 $valor = trim($valor);
 $valor = str_replace(".", "", $valor);
 $valor = str_replace(" ", "", $valor);
 $valor = str_replace("-", "", $valor);
 $valor = str_replace("/", "", $valor);
 $valor = str_replace("+", "", $valor);
 $valor = str_replace(")", "", $valor);
 $valor = str_replace("(", "", $valor);

 return $valor;
}


// Os certificados que os domínios da São João Alimentos usa são da Let's Encrypt auto assinados, e por segurança o PHP barra o uso desse tipo de certificado para evitar o uso indevido do e-mail.

// Para solucionar esse problema é necessário adicionar o seguinte trecho de código no arquivo functions.php na pasta do tema do Wordpress:

add_filter('wp_mail_smtp_custom_options', function( $phpmailer ) {
	$phpmailer->SMTPOptions = array(
		 'ssl' => array(
			'verify_peer'       => false,
			'verify_peer_name'  => false,
			'allow_self_signed' => true
	 )
);
return $phpmailer;
} );


?>