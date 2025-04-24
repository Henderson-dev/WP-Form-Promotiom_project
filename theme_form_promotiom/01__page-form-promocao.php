<?php
/*
Template name: [2025] Formulário Promoção
*/
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title(); ?></title>
  <link rel='shortcut icon' type='image/x-icon' href='<?php echo TEMPLATE; ?>/assets/images/favicon.png' />
  <?php wp_head(); ?>

  <link
      rel="stylesheet"
      id="style-css-promotion"
      href="<?php echo TEMPLATE; ?>/assets/css/style-promocao.min.css?v=<?php echo time(); ?>"
      type="text/css"
      media="all"
    />
</head>

<body>

<?php the_post(); ?>

<?php 
// Add formulário da promoção
get_template_part('template-part/part','form-promo-page');
?>


  <script>
    const submit = document.getElementById("bto-enviar");
    submit.addEventListener("click", validate);

    function validate(e) {
      e.preventDefault();

      const nome = document.getElementById("nome");
      const email = document.getElementById("email");
      const telefone = document.getElementById("telefone");
      const nascimento = document.getElementById("nascimento");
      const estabelecimento = document.getElementById('estabelecimento');

      if (!nome.value) {
        alert("Atenção, você precisa preencher o campo Nome Completo!");
        return false;
      }

      if (!email.value) {
        alert("Atenção, você precisa preencher um e-mail válido!");
        return false;
      }

      if (!telefone.value) {
        alert("Atenção, você precisa preencher um telefone de contato!");
        return false;
      }

      if (!nascimento.value) {
        alert("Atenção, você precisa preencher sua data de nascimento!");
        return false;
      }

      if (!estabelecimento.value) {
        alert("Atenção, você precisa preencher o nome do estabelecimento!");
        return false;
      }

      const ncpf = document.getElementById("cpf");
      // Valida cpf
      if (!ncpf.value) {
        alert("Atenção, você precisa preencher o campo CPF!");
        return false;
      } else {
        if (validarCPF(ncpf.value) == false) {
          alert("Atenção, você precisa preencher um CPF válido!");
          return false;
        }
      }

      const cidade = document.getElementById("cidade");
      if (!cidade.value) {
        alert(
          "Atenção, você precisa selecionar uma cidade do estado de São Paulo!"
        );
        return false;
      }

      const checkbox = document.getElementById("regulamento");
      if (!checkbox.checked) {
        alert(
          "Atenção, você precisa aceitar o regulamento para participar da promoção!"
        );
        return false;
      }
      const checkbox3 = document.getElementById("privacidade");
      if (!checkbox3.checked) {
        alert(
          "Atenção, você precisa aceitar a politica de privacidade para participar da promoção!"
        );
        return false;
      }
      const checkbox2 = document.getElementById("regulamento2");
      if (!checkbox2.checked) {
        alert(
          "Atenção, você precisa marcar que está ciente de que precisa guardar os cupons fiscais cadastrados!"
        );
        return false;
      }

      const my_file_upload = document.getElementById("my_file_upload");
      if (!my_file_upload.value) {
        alert(
          "Atenção, você precisa inserir uma imagem ou fotografia da nota fiscal da compra dos produtos MesMarca!"
        );
        return false;
      }


      // Codigos de barra

      const arroz_integral = null_or_empty("arroz_integral");
      const qt_arroz_integral = document.getElementById("qt_arroz_integral");

      const arroz_para_risoto = null_or_empty("arroz_para_risoto");
      const qt_arroz_para_risoto = document.getElementById(
        "qt_arroz_para_risoto"
      );

      const arroz_parbolizado = null_or_empty("arroz_parbolizado");
      const qt_arroz_parbolizado = document.getElementById(
        "qt_arroz_parbolizado"
      );

      const arroz_branco_tipo_1 = null_or_empty("arroz_branco_tipo_1");
      const qt_arroz_branco_tipo_1 = document.getElementById(
        "qt_arroz_branco_tipo_1"
      );

      const feijao_preto = null_or_empty("feijao_preto");
      const qt_feijao_preto = document.getElementById("qt_feijao_preto");

      const feijao_bolinha = null_or_empty("feijao_bolinha");
      const qt_feijao_bolinha = document.getElementById("qt_feijao_bolinha");

      const feijao_carioca = null_or_empty("feijao_carioca");
      const qt_feijao_carioca = document.getElementById("qt_feijao_carioca");

      if (arroz_integral && arroz_para_risoto && arroz_parbolizado && arroz_branco_tipo_1 && feijao_preto && feijao_bolinha && feijao_carioca) {
        alert("Atenção, você precisa informar o código de barras e a quantidade de pelo menos um produto!");
        return false;
      }

      // Valida arroz_integral
      if (document.getElementById("arroz_integral").value != "") {
        if (qt_arroz_integral.value == "0") {
          alert(
            "Por favor, tnforme a quantidade de produtos comprados para todos os códigos de barras informados!"
          );
          return false;
        }
      }

      if (qt_arroz_integral.value != "0") {
        if (document.getElementById("arroz_integral").value == "") {
          alert(
            "Por favor, tnforme o código de barras de todos os produtos comprados para todas as quantidades informadas!"
          );
          return false;
        }
      }

      // Valida arroz_para_risoto
      if (document.getElementById("arroz_para_risoto").value != "") {
        if (qt_arroz_para_risoto.value == "0") {
          alert(
            "Por favor, tnforme a quantidade de produtos comprados para todos os códigos de barras informados!"
          );
          return false;
        }
      }

      if (qt_arroz_para_risoto.value != "0") {
        if (document.getElementById("arroz_para_risoto").value == "") {
          alert(
            "Por favor, tnforme o código de barras de todos os produtos comprados para todas as quantidades informadas!"
          );
          return false;
        }
      }

      // Valida arroz_parbolizado
      if (document.getElementById("arroz_parbolizado").value != "") {
        if (qt_arroz_parbolizado.value == "0") {
          alert(
            "Por favor, tnforme a quantidade de produtos comprados para todos os códigos de barras informados!"
          );
          return false;
        }
      }

      if (qt_arroz_parbolizado.value != "0") {
        if (document.getElementById("arroz_parbolizado").value == "") {
          alert(
            "Por favor, tnforme o código de barras de todos os produtos comprados para todas as quantidades informadas!"
          );
          return false;
        }
      }

      // Valida arroz_branco_tipo_1
      if (document.getElementById("arroz_branco_tipo_1").value != "") {
        if (qt_arroz_branco_tipo_1.value == "0") {
          alert(
            "Por favor, tnforme a quantidade de produtos comprados para todos os códigos de barras informados!"
          );
          return false;
        }
      }
      if (qt_arroz_branco_tipo_1.value != "0") {
        if (document.getElementById("arroz_branco_tipo_1").value == "") {
          alert(
            "Por favor, tnforme o código de barras de todos os produtos comprados para todas as quantidades informadas!"
          );
          return false;
        }
      }

      // Valida feijao_preto
      if (document.getElementById("feijao_preto").value != "") {
        if (qt_feijao_preto.value == "0") {
          alert(
            "Por favor, tnforme a quantidade de produtos comprados para todos os códigos de barras informados!"
          );
          return false;
        }
      }
      if (qt_feijao_preto.value != "0") {
        if (document.getElementById("feijao_preto").value == "") {
          alert(
            "Por favor, tnforme o código de barras de todos os produtos comprados para todas as quantidades informadas!"
          );
          return false;
        }
      }

      // Valida feijao_bolinha
      if (document.getElementById("feijao_bolinha").value != "") {
        if (qt_feijao_bolinha.value == "0") {
          alert(
            "Por favor, tnforme a quantidade de produtos comprados para todos os códigos de barras informados!"
          );
          return false;
        }
      }
      if (qt_feijao_bolinha.value != "0") {
        if (document.getElementById("feijao_bolinha").value == "") {
          alert(
            "Por favor, tnforme o código de barras de todos os produtos comprados para todas as quantidades informadas!"
          );
          return false;
        }
      }

      // Valida feijao_carioca
      if (document.getElementById("feijao_carioca").value != "") {
        if (qt_feijao_carioca.value == "0") {
          alert(
            "Por favor, tnforme a quantidade de produtos comprados para todos os códigos de barras informados!"
          );
          return false;
        }
      }
      if (qt_feijao_carioca.value != "0") {
        if (document.getElementById("feijao_carioca").value == "") {
          alert(
            "Por favor, tnforme o código de barras de todos os produtos comprados para todas as quantidades informadas!"
          );
          return false;
        }
      }


      const mensagem = document.querySelector('#mensagem');
      mensagem.style.display = 'flex';

      // cria o elemento da mensagem
      const mensagemElement = document.createElement('div');
      mensagemElement.textContent = 'Realizando cadastro, aguarde...';

      // adiciona a mensagem ao DOM
      mensagem.appendChild(mensagemElement);

      document.getElementById("form_promocao").submit();
      return true;
    }


    function verifica_codigos(codigo, valor) {
      if (!codigo) {
        if (null_or_empty(valor)) {
          alert("Por favor, tnforme a quantidade de produtos comprados para todos os códigos de barras informados!");
          return false;
        }
        if (document.getElementById(valor).value == "0") {
          alert("Por favor, tnforme a quantidade de produtos comprados para todos os códigos de barras informados!");
          return false;
        }
      }
    }


    function null_or_empty(str) {
      var v = document.getElementById(str).value;
      return v == null || v.trim() == "";
    }

    function validarCPF(cpf) {
      cpf = cpf.replace(/[^\d]+/g, "");
      if (cpf == "") return false;
      // Elimina CPFs invalidos conhecidos
      if (
        cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999"
      )
        return false;
      // Valida 1o digito
      add = 0;
      for (i = 0; i < 9; i++) add += parseInt(cpf.charAt(i)) * (10 - i);
      rev = 11 - (add % 11);
      if (rev == 10 || rev == 11) rev = 0;
      if (rev != parseInt(cpf.charAt(9))) return false;
      // Valida 2o digito
      add = 0;
      for (i = 0; i < 10; i++) add += parseInt(cpf.charAt(i)) * (11 - i);
      rev = 11 - (add % 11);
      if (rev == 10 || rev == 11) rev = 0;
      if (rev != parseInt(cpf.charAt(10))) return false;
      return true;
    }
  </script>


<?php wp_footer(); ?>

<!-- Função executada como depenência de desenvolvimento / Autopreenchimento dos campos do formulário -->
<script type="text/javascript" src="<?php echo TEMPLATE; ?>/assets/_dev-dependencies/function-dev-dependence.js?v=<?php echo time(); ?>"></script>

</body>
</html>