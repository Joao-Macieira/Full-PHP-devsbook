<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <title>Devsbook</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css" />
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL; ?>assets/images/devsbook_logo.png" /></a>
            </div>
            <div class="head-side">
                <div class="head-side-left">
                    <div class="search-area">
                        <form method="GET" action="<?php echo BASE_URL; ?>pesquisa">
                            <input type="search" placeholder="Pesquisar" name="s" />
                        </form>
                    </div>
                </div>
                <div class="head-side-right">
                    <a href="<?php echo BASE_URL; ?>perfil" class="user-area">
                        <div class="user-area-text"><?php echo $loggedUser->name; ?></div>
                        <div class="user-area-icon">
                            <img src="<?php echo BASE_URL; ?>media/avatars/<?php echo $loggedUser->avatar; ?>" />
                        </div>
                    </a>
                    <a href="<?php echo BASE_URL; ?>sair" class="user-logout">
                        <img src="<?php echo BASE_URL; ?>assets/images/power_white.png" />
                    </a>
                </div>
            </div>
        </div>
</header>