<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\UserHandler;
use \src\handlers\PostHandler;

class ConfigController extends Controller {
    private $loggedUser;

    public function __construct(){
        $this->loggedUser = UserHandler::checkLogin();

        if($this->loggedUser === false) {
            $this->redirect('/login');
        }
    }

    public function index($atts = []) {
        $user = UserHandler::getUser($this->loggedUser->id);

        
        

        $this->render('config',[
            'loggedUser' => $this->loggedUser,
            'user' => $user
        ]);
    }

    
}