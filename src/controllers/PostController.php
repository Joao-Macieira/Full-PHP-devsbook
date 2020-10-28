<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;
use \src\handlers\PostHandler;

class PostController extends Controller {

    private $loggedUser;

    public function __construct(){
        $this->loggedUser = LoginHandler::checkLogin();

        if($this->loggedUser === false) {
            $this->redirect('/login');
        }
    }

    public function new() {
        $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_ADD_SLASHES);

        if($body) {
            PostHandler::addPost($this->loggedUser->id, 'text', $body);
        }

        $this->redirect('/');
    }
}