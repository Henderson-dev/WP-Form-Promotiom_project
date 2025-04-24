<?php
/*
Template name: [2025] Confirma Cadastro Promoção
*/

// determina data final da promoção
$data_final_promocao = "01/05/2025";

// Define a cor de fundo da página
$bgBody = "#FFF1DF";

// Mensagem personalizada no e-mail
$msgMail = "Você está concorrendo a 2 diárias no <strong>em Gramado, com tudo pago e direito a um acompanhante!</strong>";

$msgSorteio = "Estes mesmos números foram enviados para o e-mail utilizado para o cadastrado.
O sorteio será no dia 01/06/2025 e o resultado será divulgado no site oficial da
promoção, assim como nas redes sociais da marca. Fique ligado!";


// Segurança
// Validação de recaptcha
// require_once dirname(__FILE__) . '/recaptcha/vendor/autoload.php';
// $secret = "6LetigIhAAAAAAkaNllLB-8qKxoOB2puf0La3fzg";
// $recaptcha = new \ReCaptcha\ReCaptcha($secret);

// $remote_ip = $_SERVER["REMOTE_ADDR"];
// $g_recaptcha_response = $_POST["recaptcha_token"];

// $resposta = $recaptcha
//   ->setExpectedHostname('seusite.com.br')
//   ->setExpectedAction('cadastro')
//   ->setScoreThreshold(1.0)
//   ->verify($g_recaptcha_response, $remote_ip);
// if (!$resposta->isSuccess()) {
//   wp_redirect(SITE . '/promo/form-promocao/?e=rec');
//   die();
// }


// ----------------------------------------------------------
// Trava de segurança
// ----------------------------------------------------------
// Limita a quantidade de geração de números da sorte por CPF
$quantidade_cpf_limite = 50;

// Retorna os posts com o CPF cadastrado
$posts = get_posts(
  array(
    'numberposts' => -1,
    'post_type' => 'promocao',
    'meta_key' => 'cpf',
    'meta_value' => $_POST['cpf']
  )
);
extract($_POST);

// Obtem a quantidade de números da sorte por produto
$quantidade_de_numero_da_sorte = array(
  $qt_arroz_integral,
  $qt_arroz_para_risoto,
  $qt_arroz_parbolizado,
  $qt_arroz_branco_tipo_1,
  $qt_feijao_preto,
  $qt_feijao_bolinha,
  $qt_feijao_carioca,
);

$total = 0;
foreach ($quantidade_de_numero_da_sorte as $key => $value) {
  if ($value != 0) {
    $total += $value;
  }
}

// Verifica a quantidade de posts com o CPF já cadastrado
$quantidade_cpf_cadastrado = count($posts);
$quantidade_que_pode_cadastra = $quantidade_cpf_limite - $quantidade_cpf_cadastrado;


// Valida se não atingiu o limite de números da sorte por CPF
$pode_cadastra = '';

if ($quantidade_cpf_cadastrado < $quantidade_cpf_limite) {
  if ($total <= $quantidade_que_pode_cadastra && $total != 0) {
    $pode_cadastra = 'sim';
  } else {
    $pode_cadastra = 'nao';
    if ($total == 0) {
      wp_redirect(SITE . '/home/formulario-promocao/?e=lnds');
      die();
    }
    wp_redirect(SITE . '/home/formulario-promocao/?qt=' . $quantidade_que_pode_cadastra);
    die();
  }

} else {
  $pode_cadastra = 'nao';
  wp_redirect(SITE . '/home/formulario-promocao/?e=lnds');
  die();
}


// Restore original Post Data
wp_reset_postdata();

$pode_cadastra = 'sim';

// Se pode realizar o cadastro, prossegue carregando a página
if ($pode_cadastra == 'sim') {
  ?>
  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <link rel='shortcut icon' type='image/x-icon' href='<?php echo TEMPLATE; ?>/assets/images/favicon.png' />
    <?php wp_head(); ?>


    <link rel="stylesheet" id="style-css-promotion" href="<?php echo TEMPLATE; ?>/assets/css/style-promocao.min.css"
      type="text/css" media="all" />
  
  </head>

  <body>

    <?php

    // Verificar link de segurança: https://felipeelia.com.br/seguranca-no-wordpress-nonces/
    //if ( wp_verify_nonce( $_REQUEST['_wpnonce'], 'cadastrar-estabelecimento' ) ) {
  
    // Recebe dados do formulário
    extract($_POST);
    //print_r($_POST);


    //-----------------------------------------------------------------
    // // faz o upload das imagens
    //-----------------------------------------------------------------
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $uploadTrue = 0;

      // inclui dependencias WP
      require_once (ABSPATH . 'wp-admin/includes/image.php');
      require_once (ABSPATH . 'wp-admin/includes/file.php');
      require_once (ABSPATH . 'wp-admin/includes/media.php');

      $files = $_FILES["my_file_upload"];

      if ($files['name']) {
        $file = array(
          'name' => $files['name'],
          'type' => $files['type'],
          'tmp_name' => $files['tmp_name'],
          'error' => $files['error'],
          'size' => $files['size']
        );
        $_FILES = array("upload_file" => $file);
        $attachment_id = media_handle_upload("upload_file", 0);

        if (is_wp_error($attachment_id)) {
          // There was an error uploading the image.
          // echo "Erro ao adicionar a nota fiscal, tente novamente!!!";
          ?>
          <img class="img-fluid img-form" src="<?php echo TEMPLATE; ?>/assets/images/img-form.jpg" alt="" />
          <main id="form-promo-page">
            <section class="form-promotion">
              <div class="container">
                <div class="row">
                  <div class="col-lg-8 offset-lg-2 d-flex flex-column align-items-center mx-auto">
                    <div class="containerPromo">
                      <div class="mt-5 promoResultadoTexto">
                        <h2>
                          Erro ao adicionar a nota fiscal, tente novamente!!!
                        </h2><br>
                        <span style="font-size: 20px; line-height: 28px;">Selecione apenas um arquivo no formato JPG, PNG ou
                          PDF. Tamanho máximo do arquivo 4MB.</span>
                      </div>
                    </div>
                  </div>
                </div>
            </section>
          </main>

          <?php
        } else {
          // The image was uploaded successfully!
          // echo "File added successfully with ID: " . $attachment_id . "<br>";
          // echo wp_get_attachment_image($attachment_id, array(800, 600)) . "<br>";
          // Pega a URL da imagem para gravar no campo
          $url_attachment = wp_get_attachment_image_src($attachment_id);

          // Valida que o upload ocorreu
          $uploadTrue = 1;
        }
      }
    }


    //-----------------------------------------------------------------
    // Se o upload aconteceu prossegue para geracao dos numeros
    //-----------------------------------------------------------------
    if ($uploadTrue) {

      //echo "ID upload:" . $attachment_id;

      // Geração dos números da sorte
      // Codigos de barra
      $code = array(
        $qt_arroz_integral,
        $qt_arroz_para_risoto,
        $qt_arroz_parbolizado,
        $qt_arroz_branco_tipo_1,
        $qt_feijao_preto,
        $qt_feijao_bolinha,
        $qt_feijao_carioca,
      );
      // Montar um array com os produtos que possuem códigos de barra definidos
  
      // faz no loop no array 
      // Determina a quantidade total de itens de produtos diferente de zero
      $cont = 0;
      foreach ($code as $key => $value) {
        if ($value != 0) {
          $cont += $value;
        }
      }

      // Pega último post de promocao inserido
      $last_title = "";
      $args = array('post_type' => 'promocao', 'orderby' => 'DESC', 'showposts' => 1);
      $q = new WP_Query($args);
      if ($q->have_posts()):
        while ($q->have_posts()):
          $q->the_post();
          $last_title = get_the_title();
        endwhile;
        //wp_reset_query();
        wp_reset_postdata();
      endif;


      // Obter um número de 2 digitos de 00 a 19
      function idCode($id)
      {
        $doisD = (int) $id < 19 ? (string) ($id + 1) : '0';
        return (int) $doisD < 10 ? '0' . $doisD : $doisD;
      }

      // Gera uma quantidade ($bar_code) de números aleatórios no formato XX.YYYYY, onde XX vem de $id e YYYYY é um número aleatório de 5 dígitos.
      function numeroSorte($bar_code, $id)
      {
          $rand = [];
          for ($i = 0; $i < $bar_code; $i++) {
              // str_pad() para garantir 5 dígitos no número gerado
              array_push($rand, $id . '.' . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT));
          }
          return $rand;
      }      


      // -----------------------------------------------------------------------------------------------------------------
      // Essa função tem a responsabilidade de verificar se os números da sorte gerados já existem como posts no WordPress. 
      // Se um número já existir, ele é regenerado até ser único. No final, a função salva os números únicos na variável global $GLOBALS['externVar'].
      // $proc → Um array contendo os números da sorte gerados.
      // $id → Um identificador numérico que será usado para gerar novos números se necessário.

      function validarNumeroSorte($proc, $id)
      {
          $unique_proc = [];

          foreach ($proc as $num) {
              // verifica se um número da sorte já existe como um post no WordPress usando get_page_by_path().
              // Se o número existir, ele é regenerado até ser único.
              while (get_page_by_path(str_replace('.', '-', $num), OBJECT, 'promocao')) {
                  $num = $id . '.' . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
              }
              // Depois que encontramos um número único, ele é adicionado ao array $unique_proc.
              $unique_proc[] = $num;
          }
          $GLOBALS['externVar'] = $unique_proc;
      }
      
      // get_page_by_path() é uma função do WordPress que busca um post pelo seu post_name (slug).
      // O parâmetro passado para a função é str_replace('.', '-', $num), que converte 12.34567 em 12-34567 para corresponder ao formato dos slugs no WordPress.
      // O segundo argumento OBJECT define o formato do retorno.
      // O terceiro argumento 'promocao' informa que queremos buscar dentro do custom post type 'promocao'.
      // Se get_page_by_path() encontrar um post correspondente, significa que o número já foi gerado antes. Nesse caso, entramos no while para gerar um novo número.

      // OBJECT indica que queremos que a função retorne o post como um objeto PHP (WP_Post).
      // Se get_page_by_path() encontrar um post, ele retorna um objeto contendo detalhes do post.
      // Se nenhum post for encontrado, a função retorna NULL.

      // $GLOBALS é um array superglobal do PHP que permite armazenar e acessar variáveis globalmente, fora do escopo da função.
      // $GLOBALS['externVar'] = $unique_proc; armazena o array final de números da sorte dentro da variável global externVar, tornando-o acessível em qualquer parte do código.


      //$numero = idCode(substr($last_title, 0, 2));

      // O identificador (idCode()) é extraído dos dois primeiros caracteres do último título salvo.
      // Gerar os números da sorte com base no número de produtos comprados
      validarNumeroSorte(numeroSorte($cont, idCode(substr($last_title, 0, 2))), idCode(substr($last_title, 0, 2)));


    // ------------------------------------------------------------------------------
    // Faz o loop para inserir os dados por número da sorte gerado
    // ------------------------------------------------------------------------------    
    $retorno = '';

    // Descomentar
    foreach ($externVar as $key => $sorteio) {

        // Cria o novo post de promoção
        $id_post = wp_insert_post(
          array(
            'post_title' => $sorteio . "-" . $nome,
            'post_name' => $sorteio,
            'post_status' => 'Publish',
            'post_type' => 'promocao'
          )
        );

        // Insere dados no novo post
        if (!is_wp_error($id_post)) {

          // Add campos cadastrais
          update_field('nome_completo', $nome, $id_post);
          update_field('email', $email, $id_post);
          update_field('telefone', $telefone, $id_post);
          update_field('cpf', $cpf, $id_post);
          update_field('data_nascimento', $nascimento, $id_post);
          update_field('cidade', $cidade, $id_post);
          update_field('nome_do_estabelecimento', $estabelecimento, $id_post);

          // Add upload files
          update_field('arquivos_cupom_fiscal', $url_attachment[0], $id_post);
          //update_field('imagem', $attachment_id, $id_post);
          update_field('arquivo', $attachment_id, $id_post);

          // Add codigos de barra
          update_field('arroz_integral_group', array('arroz_integral' => $arroz_integral, 'qt_arroz_integral' => $qt_arroz_integral), $id_post);
          update_field('arroz_para_risoto_group', array('arroz_para_risoto' => $arroz_para_risoto, 'qt_arroz_para_risoto' => $qt_arroz_para_risoto), $id_post);
          update_field('arroz_parborizado_group', array('arroz_parbolizado' => $arroz_parbolizado, 'qt_arroz_parbolizado' => $qt_arroz_parbolizado), $id_post);
          update_field('arroz_branco_tipo1_group', array('arroz_branco_tipo_1' => $arroz_branco_tipo_1, 'qt_arroz_branco_tipo_1' => $qt_arroz_branco_tipo_1), $id_post);
          update_field('feijao_preto_group', array('feijao_preto' => $feijao_preto, 'qt_feijao_preto' => $qt_feijao_preto), $id_post);
          update_field('feijao_bolinha_group', array('feijao_bolinha' => $feijao_bolinha, 'qt_feijao_bolinha' => $qt_feijao_bolinha), $id_post);
          update_field('feijao_carioca_group', array('feijao_carioca' => $feijao_carioca, 'qt_feijao_carioca' => $qt_feijao_carioca), $id_post);


          // enviar email para o partipante
  
          $retorno = $retorno . '-' . $sorteio;

          // se deu erro para gerar o custom post, volta para o form 
        } else {
          wp_redirect(SITE . '/promo/form-promocao/?e=erro');
        }

        // fecha o for
      }

      // ------------------------------------------------------------------------------
      // enviar email para o partipante
      // ------------------------------------------------------------------------------
      //$data_envio = date('d/m/Y');
      //$hora_envio = date('H:i:s');
      $logo =   "logo_01.png";
      $logo1 =  "logo_02.png";
      // $body = "<h1>Você está participando</h1>";
      // $body .= "<h2>Olá ".$nome."</h2>";
      // $body .= "<p>Olá ".$email."</p>";
      // $body .= "<p>Telefone: ".$telefone."</p>";
  

      // $text_numeros_sorte = "
      // <b>$v1</b><br>
      // <b>$v2</b><br>
      // <b>$v2</b><br>
      // ";
      $text_numeros_sorte = '';
      foreach ($externVar as $key => $value) {
        $text_numeros_sorte = $text_numeros_sorte . "<b>" . $value . "</b><br>";
      }
      $body = "
      <style type='text/css'>
      body {
      margin: 0;
      font-family:Verdana;
      font-size: 12px;
      color: #000000;
      }
      a{
      color: #666666;
      text-decoration: none;
      }
      </style>
      <html>
          <table width='680' border='0' cellpadding='10' cellspacing='0' bgcolor=''>
              <tr>
                <td>
                  <tr bgcolor='#D38DC7'>
                    <td align='center'><img src='$logo' alt='Empresa Ltda'></td>
                  </tr>
                  <tr bgcolor='#D38DC7'>
                    <td align='center'><img src='$logo1' alt='Empresa Ltda'></td>
                  </tr>
                  <tr bgcolor='#D38DC7'>
                    <td align='center'><h2 style='color:#702283; margin-bottom: 24px;'>Olá $nome,<br>$msgMail</h2></td>
                  </tr>
                  <tr>
                    <td><h2>Parabéns, seu cadastro foi concluído com sucesso.
                    </h2></td>
                  </tr>                  
                  <tr>
                    <td>Seu(s) número(s) da sorte:<br>$text_numeros_sorte</td>
                  </tr>
                  <tr>
                    <td>
                      <p>
                      Agora é cruzar os dedos! Se quiser aumentar suas chances, é só adquirir mais produtos Empresa Ltda e cadastrar no site www.empresa.com/promocao.                      
                      </p>
                      <p>
                      <b>E não se esqueça de guardar as embalagens e o cupom fiscal da sua compra! Sem eles você não poderá resgatar o prêmio.</b>
                      </p>
                      <p><b>Obrigado por participar.</b></p>
                    </td>
                  </tr>
              </td>
            </tr>
          </table>
      </html>";

      $to = $email;
      $subject = 'Cadastro confirmado - Empresa Ltda';
      $headers = array('Content-Type: text/html; charset=UTF-8');

      wp_mail($to, $subject, $body, $headers);


      //-----------------------------------------------------------------
      // Manda para a pagina final com a exibicao dos numeros da sorte
      //-----------------------------------------------------------------
      // wp_redirect(SITE . '/promo/obrigado/?numeros=');
  
      // echo $retorno;
      if ($retorno != "") { ?>
        <img class="img-fluid img-form" src="<?php echo TEMPLATE; ?>/assets/images/bg-line.svg" alt="">
        <main id="form-promo-page" style="background-color: transparent">
          <section class="form-promotion">
            <div class="container">
              <div class="row">
                <div class="col-lg-8 offset-lg-2 d-flex flex-column align-items-center mx-auto">

                  <form name="form_promocao" id="form_promocao" class="containerPromo">
                    <div class="row newnumeros">
                      <h2><strong>Pronto!</strong><br>
                        Este são os seus números,<br>
                        <strong>BOA SORTE!</strong>
                      </h2>

                      <div>
                        <span><?php echo str_replace('-', '<br>', $retorno); ?></span>
                      </div>
                      <p>
                        <?php echo $msgSorteio; ?>
                      </p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </section>
          <!-- // form-promotion -->
        </main>
      <?php }
    } else {
      // Se deu erro no Upload retorno para página anterior
      wp_redirect(SITE . '/promo/form-promocao/?e=erro');
    }

    ?>

  <?php } // endif pode cadastra == sim



// Insere instâncias no rodapé Wordpress
wp_footer();
?>

</body>
</html>