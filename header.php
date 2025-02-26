<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ポートフォリオ掲載サイト">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/logo.png" type="image/png">
    <?php wp_head(); ?>
</head>
<body>
    <header id="top">
        <div class="logo">
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="ロゴ">

        </div>
        <h1>My portfolio</h1>
        <nav>
            <ul class="container">
                <li><a href="<?php esc_url( bloginfo('url') ) ;?>">HOME</a></li>
                <li><a href="<?php esc_url( home_url() ) ;?>/profile">PROFILE</a></li>
                <li><a href="<?php esc_url( home_url() ) ;?>/work">WORK</a></li>
                <li><a href="<?php esc_url( home_url() ) ;?>/contact">CONTACT</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
