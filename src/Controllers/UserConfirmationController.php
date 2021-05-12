<?php


namespace App\Controllers;


use App\Models\UserConfirmationModel;
use App\Models\UsersRegisterModel;
use Config\Config;

class UserConfirmationController extends GeneralController
{

    private array $errors = array();
    private array $success = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function confirm($id, $token): void
    {
        $users = new UsersRegisterModel();
        $user = $users->getUserById($id);
//
        $userConfirmation = new UserConfirmationModel();
        $userToken = $userConfirmation->hasConfirmationToken($id);
//
        if ($user && $userToken['confirmation_token'] === $token) {
            $userConfirmation->confirmAccount($id, $token);
            $this->success['confirmation'] = 'Votre compte a bien été confirmé';
            $_SESSION['flash']['success'] = $this->success;
        } elseif ($userToken['confirmation_token'] === null) {
            $this->errors['confirmation'] = "Il semblerait que votre compte a déjà été confirmé. Veuillez essayer de vous connecter";
            $_SESSION['flash']['errors'] = $this->errors;
            header('Location: ' . $this->baseUrl . '/connexion');
        } else {
            $this->errors['confirmation'] = 'Votre confirmation du compte n\'a pas pu se faire';
            $_SESSION['flash']['errors'] = $this->errors;
            header('Location: ' . $this->baseUrl . '/inscription');
        }
        header('Location: ' . $this->baseUrl . '/connexion');
    }
}