<?php
/*
Template name: Page Default
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

<main>
    <?php the_content(); ?>
</main>

<?php wp_footer(); ?>


</body>
</html>