<?php


namespace App\Controllers;


use App\Models\UserForgotPassModel;

class UserForgotPassController extends GeneralController
{

    private array $errors = array();
    private array $success = array();

    public function __construct() {
        parent::__construct();
    }

    public function forgot(): void
    {
        $template = $this->twig->load('forgotten.html.twig');
        echo $template->render();
    }

    public function forgotten(): void
    {
        $email = htmlspecialchars($_POST['email']);
        $newPassword = htmlspecialchars($_POST['password']);
        $newPasswordConfirm = htmlspecialchars($_POST['passwordConfirm']);

        if (!empty($_POST['submit'])) {
            if (empty($email) || empty($newPassword) || (empty($email) && empty($newPassword))) {
                $this->errors['empty'] = 'Certains champs n\'ont pas été remplies';
                $_SESSION['flash']['errors'] = $this->errors;
            } elseif ($newPassword !== $newPasswordConfirm) {
                $this->errors['confirmPassword'] = 'Les mots de passe entrés ne sont pas identiques';
                $_SESSION['flash']['errors'] = $this->errors;
            } else {
                $password = password_hash($newPassword, PASSWORD_BCRYPT);

                $user = new UserForgotPassModel();
                $user->passwordUpdate($password, $email);

                $this->success['changePassword'] = 'Votre mot de passe a bien été modifié';
                $_SESSION['flash']['success'] = $this->success;
                header('Location: ' . $this->baseUrl . '/connexion');
            }
        }
    }
}