<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Cadastro - Devsbook</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/login.css" />
</head>
<body>
    <header>
        <div class="container">
            <a href=""><img src="<?php echo BASE_URL; ?>assets/images/devsbook_logo.png" /></a>
        </div>
    </header>
    <section class="container main">
        <form method="POST" action='<?php echo BASE_URL; ?>cadastro'>
            <?php if(!empty($flash)): ?>
                <div class="flash"><?php echo $flash; ?></div>
            <?php endif; ?>

            <input placeholder="Digite seu Nome Completo" class="input" type="text" name="name" />

            <input placeholder="Digite seu e-mail" class="input" type="email" name="email" />

            <input placeholder="Digite sua senha" class="input" type="password" name="password" />

            <input placeholder="Digite sua Data de Nascimento" class="input" id="birthdate" type="text" name="birthdate" />

            <input class="button" type="submit" value="Fazer Cadastro" />

            <a href="<?php echo BASE_URL; ?>login">Já tem conta? Faça Login</a>
        </form>
    </section>

    <script src="https://unpkg.com/imask"></script>
    <script>
        IMask(
            document.getElementById('birthdate'),
            {
                mask:"00/00/0000"
            }
        );
    </script>
</body>
</html>