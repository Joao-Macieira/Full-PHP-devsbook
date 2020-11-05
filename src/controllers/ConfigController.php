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
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_ADD_SLASHES);
        $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_ADD_SLASHES);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_ADD_SLASHES);
        $work = filter_input(INPUT_POST, 'work', FILTER_SANITIZE_ADD_SLASHES);
        $pass = filter_input(INPUT_POST, 'pass');
        $pass2 = filter_input(INPUT_POST, 'pass2');

        if($name && $email) {
            $updateFields = [];

            $user = UserHandler::getUser($this->loggedUser->id);

            // E-mail

            if($user->email != $email){
                if(!UserHandler::emailExists($email)) {
                    $updateFields['email'] = $email;
                } else {
                    $_SESSION['flash'] = 'E-mail já existe!';
                    $this->redirect('/config');
                }
            }

            //Birthdate

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
            $updateFields['birthdate'] = $birthdate;

            //Password

            if(!empty($pass) && !empty($pass2)) {
                if($pass === $pass2) {
                    $hash = password_hash($pass, PASSWORD_DEFAULT);
                    $updateFields['password'] = $hash;
                } else {
                    $_SESSION['flash'] = 'As senhas não batem!';
                    $this->redirect('/config');
                }
            }

            //Campos normais

            $updateFields['name'] = $name;
            $updateFields['city'] = $city;
            $updateFields['work'] = $work;

            //Avatar

            if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['tmp_name'])) {
                $newAvatar = $_FILES['avatar'];

                if(in_array($newAvatar['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
                    $avatarName = $this->cutImage($newAvatar, 200, 200, 'media/avatars');
                    $updateFields['avatar'] = $avatarName;
                }
            }


            //Cover

            if(isset($_FILES['cover']) && !empty($_FILES['cover']['tmp_name'])) {
                $newCover = $_FILES['cover'];

                if(in_array($newCover['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
                    $coverName = $this->cutImage($newCover, 850, 310, 'media/covers');
                    $updateFields['cover'] = $coverName;
                }
            }

            UserHandler::updateUser($updateFields, $this->loggedUser->id);
        }

        $this->redirect('/config');
    }

    private function cutImage($file, $w, $h, $folder) {
        list($widthOrig, $heightOrig) = getimagesize($file['tmp_name']);
        $ratio = $widthOrig / $heightOrig;

        // Image size
        $newWidth = $w;
        $newHeight = $newWidth / $ratio;

        if($newHeight < $h) {
            $newHeight = $h;
            $newWidth = $newHeight * $ratio;
        }

        // Image Position
        $x = $w - $newWidth;
        $y = $h - $newHeight;
        $x = $x < 0 ? $x/2 : $x;
        $y = $y < 0 ? $y/2 : $y;

        // Image result
        $finalImage = imagecreatetruecolor($w, $h);
        switch($file['type']) {
            case 'image/jpeg':
            case 'image/jpg':
                $image = imagecreatefromjpeg($file['tmp_name']);
            break;
            case 'image/png':
                $image = imagecreatefrompng($file['tmp_name']);
            break;
        }

        imagecopyresampled(
            $finalImage, $image, //Final Image
            $x, $y, 0, 0,   // New positions
            $newWidth, $newHeight, $widthOrig, $heightOrig //new sizes / old sizes
        );

        $fileName = md5(time().rand(0, 9999)).'.jpg';

        imagejpeg($finalImage, $folder.'/'.$fileName);

        return $fileName;

    }
}