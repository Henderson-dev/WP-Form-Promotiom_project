<?php
/*
Template name: tela promo 2024
*/
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Promoção - MesMarca</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo TEMPLATE; ?>/assets_promo/images/favicon.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo TEMPLATE; ?>/assets_promo/css/style.min.css" type="text/css" media="all" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Georama:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">


</head>

<body style="background-color: #FFF1DF;">
    <link rel="stylesheet" href="<?php echo TEMPLATE; ?>/assets_promo/css/style.min.css" type="text/css" media="all" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Georama:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <style>
    @media (min-width: 1200px) {
        .page-provisoria {
            background-image: url(<?php echo TEMPLATE; ?>/assets_promo/images/wide.svg);
        }
    }


    .page-provisoria {
        position: relative;
        background-image: url(<?php echo TEMPLATE; ?>/assets_promo/images/mobile.svg);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: top center;
    }
    </style>
    </head>

    <body style="background-color: #FFF1DF;">

        <section class="page-provisoria">
            <div class="newborder">
                <div class="myborder">
                    <div class="container">
                        <div class="row">
                            <div class="mycoluns">
                                <div class="col-12">
                                    <img class="img-fluid logo d-none d-md-block"
                                        src="<?php echo TEMPLATE; ?>/assets_promo/images/nnws.png" alt="">
                                    <img class="img-fluid logo d-md-none"
                                        src="<?php echo TEMPLATE; ?>/assets_promo/images/heromb.webp" alt="">
                                </div>
                                <div class="infos">
                                    <div class="col-12 col-lg-6 mydays newsmydays">
                                        <h2>Entre os dias <strong>15 de abril e 31 de maio,</strong> compre qualquer
                                            produto MesMarca, cadastre o cupom fiscal e o código de barra, no
                                            site, e concorra a uma viagem para você e um acompanhante, para 
                                            <strong>Gramado, com tudo pago!</strong>
                                        </h2>

                                        <h2><strong>Promoção válida<br>
                                                de 15.04 a 31.05.24</strong></h2>
                                        <a class="mynewbtns"
                                            href="https://mesmarca.com/promo/form-promocao/"><strong>PARTICIPAR</strong></a>
                                    </div>
                                    <div class="line"></div>
                                    <div class="col-12 col-lg-5">
                                        <div class="concorra">
                                            <div>
                                                <img src="<?php echo TEMPLATE; ?>/assets_promo/images/list.png"
                                                    alt="imagem card">
                                            </div>
                                            <div>
                                                <h3>Cadastre</h3>
                                                <p><strong>Compre qualquer produto MesMarca,</strong> cadastre o
                                                    <strong>cupom fiscal e o código de barra,</strong> no site.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="concorra">
                                            <div>
                                                <img src="<?php echo TEMPLATE; ?>/assets_promo/images/estrela.png"
                                                    alt="imagem card">
                                            </div>
                                            <div>
                                                <h3>E concorra!</h3>
                                                <p><strong>2 dias em Gramado, com tudo pago para 2 pessoas!</strong></p>
                                            </div>
                                        </div>
                                        <div class="dias">
                                            <p>
                                                Faltam <span id="days" style="color: #702283;"></span> dias para o fim
                                                da promoção.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="regulamento">
                <div class="newbordertwo">
                    <div class="myborder">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 info-reg">
                                    <a class="mybtns"
                                        href="<?php echo TEMPLATE; ?>/assets_promo/pdf/RG-Emporio-Sao-Joao-Aprovado.pdf"
                                        target="_blank">Ler Regulamento</a>
                                    <a class="mybtns"
                                        href="<?php echo TEMPLATE; ?>/assets_promo/pdf/POLITICA-GLOBAL-PROTECAO-DADOS.pdf"
                                        target="_blank">Política de
                                        Privacidade</a>
                                    <p>Promoção válida de 15.04 a 31.05.24 Consulte condições de participação,
                                        regulamento
                                        completo e Certificado de Autorização SECAP em <a
                                            href="http://www.mesmarca.com/promo" target="_blank"
                                            rel="noopener noreferrer">www.mesmarca.com/promo</a>. Imagens
                                        ilustrativas. Guarde todas as embalagens participantes.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
        const second = 1000
        const minute = second * 60
        const hour = minute * 60
        const day = hour * 24

        let count_down = new Date('15/04/2024 00:00:00').getTime()
        let x = setInterval(() => countDown(), second)

        function countDown() {
            let now = new Date(Date.now()).getTime()
            let diff = count_down - now

            document.getElementById('days').innerText =
                Math.floor(diff / day) < 0 ? 0 : Math.floor(diff / day)
            document.getElementById('hours').innerText =
                Math.floor((diff % day) / hour) < 0 ?
                0 :
                Math.floor((diff % day) / hour)
            document.getElementById('minutes').innerText =
                Math.floor((diff % hour) / minute) < 0 ?
                0 :
                Math.floor((diff % hour) / minute)
            document.getElementById('seconds').innerText =
                Math.floor((diff % minute) / second) < 0 ?
                0 :
                Math.floor((diff % minute) / second)
        }

        function resetCountdown() {
            clearInterval(x)
            // document.form_main.date_end.value;
            let date_end = '2024-06-01'
            console.log(date_end)
            count_down = new Date(`${date_end} 00:00:00`).getTime()
            x = setInterval(() => countDown(), second)
        }
        resetCountdown()
        </script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
        </script>
    </body>

</html>