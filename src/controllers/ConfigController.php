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

    public function index() {
        $user = UserHandler::getUser($this->loggedUser->id);

         // Pegando avisos
         $flash = '';
         if(!empty($_SESSION['flash'])) {
             $flash = $_SESSION['flash'];
             $_SESSION['flash'] = '';
         }
        

        $this->render('config',[
            'loggedUser' => $this->loggedUser,
            'user' => $user,
            'flash' => $flash
        ]);
    }

    public function updateInfo() { //indexAction
        $user = UserHandler::getUser($this->loggedUser->id);

        // Verify images

        // Verify User data

        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_ADD_SLASHES);
        $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_ADD_SLASHES);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_ADD_SLASHES);
        $work = filter_input(INPUT_POST, 'work', FILTER_SANITIZE_ADD_SLASHES);


        if($name && $birthdate) {
            $birthdate = explode('/', $birthdate);
            if(count($birthdate) != 3) {
                $_SESSION['flash'] = "Data de nascimento inválida";
                $this->redirect('/config');
            }
            $birthdate = $birthdate[2]. '-' .$birthdate[1]. '-' .$birthdate[0];

            if(strtotime($birthdate) === false) {
                $_SESSION['flash'] = "Data de nascimento inválida";
                $this->redirect('/config');
            }

            if($user->email == $email) {
                $_SESSION['flash'] = 'Você já utiliza este E-mail!';
                $this->redirect('/config');
            }

            if(UserHandler::emailExists($email) === true) {
                $_SESSION['flash'] = 'Este E-mail já existe, por favor tente outro!';
                $this->redirect('/config');
            }

            if(!empty($email)) {
                UserHandler::updateUserEmail($this->loggedUser->id, $email);
            }

            if(UserHandler::updateUserData($this->loggedUser->id, $name, $birthdate, $city, $work)){
                $this->redirect('/config');
            }
        }

        // Verify password

        $pass = filter_input(INPUT_POST, 'pass');
        $pass2 = filter_input(INPUT_POST, 'pass2');

        if($pass && $pass2) {
            if($pass == $pass2) {
                UserHandler::updatePass($this->loggedUser->id, $pass);
                $this->redirect('/config');
            } else {
                $_SESSION['flash'] = 'Digite a mesma senha nos dois campos!';
                $this->redirect('/config');
            }
        }


        $this->redirect('/config');
    }
}