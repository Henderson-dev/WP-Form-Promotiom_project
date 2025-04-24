<?php
/* Template Name: Formulário ACF Teste */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <?php 
    wp_head(); 
    acf_form_head();
    ?>
</head>

<style>
    .content-form {
        display: block;
        width: 60%;
        margin: 0 auto;
    }
</style>

<div class="content-form">
    
    <?php

    if (function_exists('acf_form')) {

        // Configurações do formulário ACF
        acf_form(array(
            'post_id'       => 'new_post', // ou use o ID do post que deseja editar
            'new_post'      => array(
                'post_type'   => 'promocao', // Pode ser 'post', 'page' ou qualquer custom post type
                'post_status' => 'publish',
            ),
            'field_groups'  => array(12), // ID do grupo de campos do ACF
            //'post_title' => false,
            //'instruction_placement' => 'label',
            'submit_value'  => 'Enviar',
            'html_submit_spinner' => '<span class="acf-spinner"></span>',
            'updated_message' => 'Formulário enviado com sucesso!',
        ));
    }
    ?>
</div>

<?php wp_footer(); ?>

</body>
</html>