<?php
/*
Template name: Confirma cadastro promocao dia maes 2023
*/

// determina data final da promoção
$data_final_promocao = "05/06/2023";


// Define a cor de fundo da página
$bgBody = "#D38DC7";

// Mensagem personalizada no e-mail
$msgMail = "Você está concorrendo a 2 diárias em Gramado, com tudo pago e direito a um acompanhante! ";

$msgSorteio = "Seus número foram enviados também para o email cadastrado. Fique ligado, o sorteio será no dia 03/06 e no dia 05/06 anunciaremos o vencedor nas redes sociais da MesMarca.";


// Validação de recaptcha
// require_once dirname(__FILE__) . '/recaptcha/vendor/autoload.php';
// $secret = "6LetigIhAAAAAAkaNllLB-8qKxoOB2puf0La3fzg";
// $recaptcha = new \ReCaptcha\ReCaptcha($secret);

// $remote_ip = $_SERVER["REMOTE_ADDR"];
// $g_recaptcha_response = $_POST["recaptcha_token"];

// $resposta = $recaptcha
//   ->setExpectedHostname('mesmarca.com')
//   ->setExpectedAction('cadastro')
//   ->setScoreThreshold(1.0)
//   ->verify($g_recaptcha_response, $remote_ip);
// if (!$resposta->isSuccess()) {
//   wp_redirect(SITE . '/promo/form-promocao/?e=rec');
//   die();
// }
// trava para o usuário que chegar ao limite de números da sorte ser barrado dali pra frente.
$quantidade_cpf_limite = 50;
$posts = get_posts(array(
  'numberposts'  => -1,
  'post_type'    => 'promocao',
  'meta_key'    => 'cpf',
  'meta_value'  => $_POST['cpf']
));
extract($_POST);
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
$quantidade_cpf_cadastrado =  count($posts);
$quantidade_que_pode_cadastra = $quantidade_cpf_limite - $quantidade_cpf_cadastrado;

$pode_cadastra = '';
if ($quantidade_cpf_cadastrado  < $quantidade_cpf_limite) {
  if($total <= $quantidade_que_pode_cadastra && $total != 0 ){
    $pode_cadastra = 'sim';
  }else{
    $pode_cadastra = 'nao';
    if($total == 0){
      wp_redirect(SITE . '/promo/form-promocao/?e=lnds');
      die();
    }
    wp_redirect(SITE . '/promo/form-promocao/?qt='.$quantidade_que_pode_cadastra);
    die();
  }
  
} else {
  $pode_cadastra = 'nao';
  wp_redirect(SITE . '/promo/form-promocao/?e=lnds');
  die();
}
/* Restore original Post Data */
wp_reset_postdata();

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

    <!-- Google Tag Manager 17/05/2023 -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-N5C6L4B');</script>
    <!-- End Google Tag Manager -->
    
    <link
      rel="stylesheet"
      id="style-css-promotion"
      href="<?php echo TEMPLATE; ?>/assets/css/style-promocao.min.css"
      type="text/css"
      media="all"
    />
  </head>

  <body style="background-color: <?php echo $bgBody; ?>">

  <!-- Google Tag Manager (noscript) 17/05/2023  -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N5C6L4B"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <script async src="https://www.googletagmanager.com/gtag/js?id=AW-392719536"></script>
  <script>
    // Add sctipts 02/05/2023
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'AW-392719536');
  </script>

  <script>
  // Add sctipts 02/05/2023
  function gtag_report_conversion(url) {
    var callback = function () {
      if (typeof(url) != 'undefined') {
        window.location = url;
      }
    };
    gtag('event', 'conversion', {
        'send_to': 'AW-392719536/t7ZzCIq6oZsYELDZobsB',
        'event_callback': callback
    });
    return false;
  }
  </script>

  <!-- Meta Pixel Code -->
  <script>
    // Add sctipts 02/05/2023
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '2185706708290437');
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=2185706708290437&ev=PageView&noscript=1"
  /></noscript>
  <!-- End Meta Pixel Code -->


    <?php
    // DOCUEMNTAÇAO E DETALHES DAS REGRAS DE NEGOCIO

    // Regras de negócio

    // - Cada código de barra gera um número da sorte

    // Campos de cadastro que vão ser cadastrados no custom post promocao:
    // nome completo
    // email
    // CPF (tem que ter um validador simples em JS)
    // telefone com ddd
    // celular com ddd
    // data de nascimento
    // Lista de cidades de SP (Arrumar uma lista de cidades de SP em ordem alfabética em um elemento select)
    // UF será sempre SP
    // Aceitar os termos do regulamento
    // Aceitar a Política de Privacidade
    // Campo para upload da imagem fotografada com o código de barras dos produtos


    // Gerar o número da sorte

    // • 2 algarismos de 00 a 19, gerados de forma sequencial
    // • ponto
    // • 5 algarismos de 00001 a 99999 , gerados de forma aleatória

    // Exemplos:
    // 00.00000
    // 01.38747
    // 05.47294
    // 19.69205

    // Ou seja:
    // Se eu me cadastrei na promoção, vou receber o número 00.92494 , onde o 00 é na ordem, e o 92494 é aleatório;
    // Depois, a próxima pessoa a se cadastrar vai receber 01.52493 , onde o 01 é seguindo a ordem, e o 52493 é aleatório;
    // A próxima pessoa recebe um 02. e assim por diante, até o 19. Depois do 19, volta pra 00.

    // Se eu cadastrei vários produtos no mesmo cupom, eu recebo a quantidade de números da sorte iguais ao número de produtos que eu disse que comprei, todos com o mesmo 00, e vários aleatórios.
    // Se comprei 5 produtos, receberei os números:

    // 00.47493
    // 00.47395
    // 00.85730
    // 00.18547
    // 00.48603


    // Para cada produto comprado o participante deve inserir o código de barra do produto
    // Se comprar 3 produtos iguais vai ter que informar 3 códigos de barra, mesmo sendo o mesmo produto
    // Será gerado um número da sorte para cada produto comprado, ou seja, será gerado um número da sorte para cada código
    // O participante precisa adicionar a foto do cupom fiscal com os produtos

    // Após o cadastro enviar um e-mail para o participante da promoção com os seus números da sorte

    ?>
 
    <?php

    // Verificar link de segurança: https://felipeelia.com.br/seguranca-no-wordpress-nonces/
    //if ( wp_verify_nonce( $_REQUEST['_wpnonce'], 'cadastrar-estabelecimento' ) ) {

    extract($_POST);

    // Testa se um telefone ou Whatsapp foi informado
    // if( $telefone == '' and $whatsapp == ''){
    // 	echo '<script>alert("Por favor informe um telefone ou Whatsapp."); history.back(-1);</script>';
    // 	exit;
    // }


    // Upload da imagem
    // https://developer.wordpress.org/reference/functions/media_handle_upload/

    // Upload de varios arquivos, funciona
    // https://911wordpress.info/questions/1389/upload-de-varios-arquivos-com-media-handle-upload

    //-----------------------------------------------------------------
    // // faz o upload das imagens
    //-----------------------------------------------------------------
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $uploadTrue = 0;

      // inclui dependencias WP
      require_once(ABSPATH . 'wp-admin/includes/image.php');
      require_once(ABSPATH . 'wp-admin/includes/file.php');
      require_once(ABSPATH . 'wp-admin/includes/media.php');

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
                  <img src="" class=" logo" />
                  <div class="containerPromo">
                    <div class="mt-5 promoResultadoTexto">
                      <h2>
                        Erro ao adicionar a nota fiscal, tente novamente!!!
                      </h2><br>
                      <span style="font-size: 20px; line-height: 28px;">Selecione apenas um arquivo no formato JPG, PNG ou PDF. Tamanho máximo do arquivo 4MB.</span>
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


      // momento de gerar os numeros da sorte
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
      // Montar um array com as 7 varias que tiver dado

      // faz no loop no array 
      // dentro do loop precisa inserir post no Word, no campo post_title recebe o número da sorte
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
      if ($q->have_posts()) :
        while ($q->have_posts()) : $q->the_post();
          $last_title = get_the_title();
        endwhile;
        wp_reset_query();
      endif;


      function idCode($id)
      {
        $doisD = (int)$id < 19 ? (string)($id + 1) : '0';
        return (int)$doisD < 10 ? '0' . $doisD : $doisD;
      }

      function numeroSorte($bar_code, $id)
      {
        $rand = [];
        for ($i = 0; $i < $bar_code; $i++) {
          array_push($rand, $id . '.' . rand(00000, 99999));
        }
        return $rand;
      }

      function validarUrl($proc, $id)
      {
        // Funcao para verificar se existe um numero da sorte já cadastrado
        for ($i = 0; $i < count($proc); $i++) {

          $compare = get_page_by_path(str_replace('.', '-', $proc[$i]), OBJECT, 'promocao');
          if (is_object($compare)) {
            $proc = numeroSorte(count($proc), $id);

            validarUrl($proc, $id);
          }
        }
        $GLOBALS['externVar'] = $proc;
      }

      validarUrl(numeroSorte($cont, idCode(substr($last_title, 0, 2))), idCode(substr($last_title, 0, 2)));



      // ------------------------------------------------------------------------------
      // Faz o loop para inserir os dados por numero gerado
      // ------------------------------------------------------------------------------    
      $retorno = '';
      foreach ($externVar as $key => $sorteio) {

        // Insere o novo post
        $id_post = wp_insert_post(
          array(
            'post_title' => $sorteio . "-" . $nome,
            'post_name' => $sorteio,
            'post_status' => 'Publish',
            'post_type'  => 'promocao'
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
      $logo = "logo_01.png";

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
                  <tr bgcolor='#84372A'>
                    <td align='center'><img src='$logo' alt='MesMarca'></td>
                  </tr>
                  <tr bgcolor='#84372A'>
                    <td align='center'><h2 style='color:#ffffff; margin-bottom: 24px;'>Olá $nome,<br>$msgMail</h2></td>
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
                      Agora é cruzar os dedos! Se quiser aumentar suas chances, é só adquirir mais produtos MesMarca e cadastrar no site www.mesmarca/promo.                      
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
      $subject = 'Cadastro confirmado - MesMarca';
      $headers = array('Content-Type: text/html; charset=UTF-8');

      wp_mail($to, $subject, $body, $headers);


      //-----------------------------------------------------------------
      // Manda para a pagina final com a exibicao dos numeros da sorte
      //-----------------------------------------------------------------
      // wp_redirect(SITE . '/promo/obrigado/?numeros=');

      // echo $retorno;
      if ($retorno != "") { ?>

        <img class="img-fluid img-form" src="<?php echo TEMPLATE; ?>/assets/images/img-form.jpg" alt="" />
        <main id="form-promo-page">
          <section class="form-promotion">
            <div class="container">
              <div class="row">
                <div
                  class="col-lg-8 offset-lg-2 d-flex flex-column align-items-center mx-auto"
                >
                  <img src="<?php echo TEMPLATE; ?>/assets/images/Marca.png" class="logo" />
                  <div class="containerPromo finish">
                    <div class="promoResultadoTexto">
                      <h2>Pronto!</h2>
                      <p>Este são os seus números,</p>
                      <h2>BOA SORTE!</h2>
                    </div>
                    <div class="row promoResultadoNumero">
                      <!-- // fazer um loop para exibir os números da sorte capturados da URL -->
                      <div class="col-12 col-sm-6 col-md-4 text-center">
                        <?php echo str_replace('-', '<br>', $retorno); ?>
                      </div>
                      <!-- // fim do loop -->
                    </div>
                    <div class="promoResultadoTexto2">
                      <p>
                       <?php echo $msgSorteio; ?>
                      </p>
                      <p>
                        E não se esqueça de guardar as embalagens e o cupom fiscal
                        da sua compra! Sem eles você não poderá resgatar o prêmio.
                      </p>
                    </div>
                  </div>
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
  ?>
  <?php
  wp_footer();
  ?>
  </body>

  </html>