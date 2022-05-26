<!DOCTYPE html>
<html lang="<?php language_attributes();?>">
<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BósonPost - Projetos</title>
    <style>
        @import url("<?php echo get_template_directory_uri();?>/assets/css/pages/index.css");
    </style>
</head>
<body>
    <header>
        <img src="assets/images/logotipo-bosonpost.svg" alt="Logotipo BósonPost" width="113">
        <nav class="navegation-main">
            <a href="<?php echo site_url('repertorio');?>" title="Repertório">Repertório</a>
            <a href="<?php echo site_url('projetos');?>" title="Projetos">Projetos</a>
            <a href="<?php echo site_url('vfx');?>" title="VFX">VFX</a>
            <a href="<?php echo site_url('sobre-nos');?>" title="Sobre-nos">Sobre nós</a>
            <a href="<?php echo site_url('Contato');?>" title="Contato">Contato</a>
        </nav>
        <nav class="languages">
            <a href="<?php echo site_url();?>/en" title="English">
                <img src="assets/images/flag-eng.svg" alt="Flag of English" width="32px">
            </a>
            <a href="<?php echo site_url('home');?>" title="Português">
                <img src="assets/images/flag-brazil.svg" alt="Flag of Brasil" width="32px">
            </a>
        </nav>
    </header>
    
    <div class="slider">
        <!-- Loop -->
        <figure>
            <img src="" alt="">
            <figcaption>
                <h2>Nome do Projeto</h2>
            </figcaption>
        </figure>
    </div>