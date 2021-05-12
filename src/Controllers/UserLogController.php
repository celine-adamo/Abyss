<?php

namespace App\Controllers;

use App\Models\UserLogModel;
use Config\Config;

class UserLogController extends GeneralController
{

    private array $success = array();
    private array $errors = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function connexion()
    {
        if(!empty($_SESSION['auth'])){
            header('Location: ' . $this->baseUrl);
        }
        $template = $this->twig->load('connexion.html.twig');
        echo $template->render([
            'success' => $this->success,
            'errors' => $this->errors
            ]);
    }

    public function connect(): void
    {
        if(!empty($_SESSION['auth'])){
            header('Location: ' . $this->baseUrl);
        }


        if (!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password'])) {
            $usersModel = new UserLogModel();
            $user = $usersModel->userSelected($_POST['email']);

            // si j'ai un utilisateur
            if ($user) {
                $userPassword = $user['password'];

                // génération de la clé de connection persistante. 

                // $_POST['password'] et le mot de passe de la BDD sont les même, alors je démare la sessuion utilisateur.
                if (password_verify($_POST['password'], $userPassword)) {
                    $_SESSION['auth'] = $user;
                    $_SESSION['flash']['success'] = 'vous êtes maintenant connecté';
                    if ($_POST['remember']) {
                        $remember_token = strRandom(250);
                        $usersModel->userConnectedToken($user, $remember_token);
                        setcookie('remember', $user['id'] . '==' . $remember_token . sha1($user['id'] . 'kraken'), time() + 60 * 60 * 24 * 7);
                    }
                    header('Location: ' . $this->baseUrl);
                } else {
                    $_SESSION['flash']['errors'][] = 'Mot de passe incorrect';
                    header('Location: ' . $this->baseUrl . '/connexion');
                }
            }else {
                $_SESSION['flash']['errors'][] = 'Identifiant incorrect';
                header('Location: ' . $this->baseUrl . '/connexion');
            }
        } else {
            $_SESSION['flash']['errors'][] = 'Vous devez remplir tous les champs du formulaire';
            header('Location: ' . $this->baseUrl . '/connexion');
        }
    }

    public function logOut(): void {
        setcookie('remember', NULL, -1);
        unset($_SESSION['auth']);
        $this->success['logout'] = 'Vous êtes maintenant déconnecté';
        $_SESSION['flash']['success'] = $this->success;
        header('Location: ' . $this->baseUrl . '/connexion');
    }
}
