<?php $render('header', ['loggedUser' => $loggedUser]); ?>

<section class="container main">
    <?php $render('sidebar', ['activeMenu'=>'search']); ?> 

    <section class="feed mt-10">

        <div class="row">
            <div class="column pr-5">

                <h1>Configurações</h1>
                
                <div class="form-avatar-cover">
                    <form action="<?=$base;?>/config/figures" method="post" enctype="multipart/form-data">
                        <div class="form-avatar">
                            Novo Avatar: <br>
                            <input type="file" name="avatar">
                        </div>
                        <div class="form-cover">
                            Nova Capa: <br>
                            <input type="file" name="avatar">
                        </div>

                        <input type="submit" value="Enviar">
                    </form>
                </div>

                <div class="form-config-data">
                    <form action="<?=$base;?>/config/data" method="post">
                        <div class="form-config-name">
                            Nome Completo: <br>
                            <input type="text" name="name">
                        </div>
                        <div class="form-config-birthdate">
                            Data de nascimento: <br>
                            <input type="text" name="birthdate" id="birthdate">
                        </div>
                        <div class="form-config-email">
                            E-mail: <br>
                            <input type="text" name="email">
                        </div>
                        <div class="form-config-city">
                            Cidade: <br>
                            <input type="text" name="city">
                        </div>
                        <div class="form-config-work">
                            Trabalho: <br>
                            <input type="text" name="work">
                        </div>
                        
                        <input type="submit" value="Enviar">
                    </form> 
                </div>
                
                <div class="form-config-pass">
                    <form action="<?=$base;?>/config/pass" method="post">

                    <div class="form-config-new-pass">
                        Nova Senha: <br>
                        <input type="password" name="pass">
                    </div>
                    <div class="form-config-conf-new-pass">
                        Confirmar Nova Senha: <br>
                        <input type="password" name="confirmpass">
                    </div>
                    <input type="submit" value="Enviar">
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