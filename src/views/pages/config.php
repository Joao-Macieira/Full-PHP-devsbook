<?php $render('header', ['loggedUser' => $loggedUser]); ?>

<section class="container main">
    <?php $render('sidebar', ['activeMenu'=>'search']); ?> 

    <section class="feed mt-10">

        <div class="row">
            <div class="column pr-5">

                <h1>Configurações</h1>
                
                <div class="form-config">
                    <form action="<?=$base;?>/config/upateInfo" method="post" enctype="multipart/form-data">
                        <?php if(!empty($flash)): ?>
                            <div class="flash"><?php echo $flash; ?></div>
                        <?php endif; ?>
                        <!-- Avatar/Cover image -->
                        <div class="form-config-avatar">
                            Novo Avatar: <br>
                            <input type="file" name="avatar">
                        </div>
                        <div class="form-config-cover">
                            Nova Capa: <br>
                            <input type="file" name="avatar">
                        </div>
                        <hr>

                        <!-- User data -->

                        <div class="form-config-name">
                            Nome Completo: <br>
                            <input type="text" name="name" value="<?=$user->name;?>">
                        </div>
                        <div class="form-config-birthdate">
                            Data de nascimento: <br>
                            <input type="text" name="birthdate" id="birthdate" value="<?=date('d/m/Y', strtotime($user->birthdate));?>">
                        </div>
                        <div class="form-config-email">
                            E-mail: <br>
                            <input type="text" name="email" placeholder="<?=$user->email;?>">
                        </div>
                        <div class="form-config-city">
                            Cidade: <br>
                            <input type="text" name="city" value="<?=$user->city;?>">
                        </div>
                        <div class="form-config-work">
                            Trabalho: <br>
                            <input type="text" name="work" value="<?=$user->work;?>">
                        </div>
                        <hr>

                        <!-- Password -->

                        <div class="form-config-new-pass">
                            Nova Senha: <br>
                            <input type="password" name="pass">
                        </div>
                        <div class="form-config-conf-new-pass">
                            Confirmar Nova Senha: <br>
                            <input type="password" name="pass2">
                        </div>
                        <input type="submit" value="Enviar" class="button">

                    </form>
                </div>

            </div>
        </div>
    </section>

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

<?php $render('footer'); ?>