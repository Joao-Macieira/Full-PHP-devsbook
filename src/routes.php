<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/login', 'LoginController@signin'); // Logar
$router->post('/login', 'LoginController@signinAction'); // Ação para receber o login

$router->get('/cadastro', 'LoginController@signup'); //Cadastrar
$router->post('/cadastro', 'LoginController@signupAction'); // Ação para receber dados cadastrais

$router->post('/post/new', 'PostController@new');

//$router->get('/pesquisa');
//$router->get('/perfil');
//$router->get('/sair');
//$router->get('/amigos');
//$router->get('/fotos');
//$router->get('/config');