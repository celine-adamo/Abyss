<?php


namespace App\Controllers;


use App\Models\CommentsModel;

class CommentsController extends GeneralController
{
    private array $errors = array();
    private array $success = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function sendComments($id): void
    {
        if (isset($_SESSION['auth'], $_POST['submit'])) {
            if ($_SESSION['auth']['confirmation_token'] !== null) {
                $this->errors['token'] = 'Votre compte n\'a pas encore été confirmé. Vérifiez votre adresse mail.';
                $_SESSION['flash']['errors'] = $this->errors;
            } else if ($_SESSION['auth']['confirmation_token'] === null) {
                if (!empty($_POST['commentaire'])) {
                    $comments = htmlspecialchars($_POST['commentaire']);
                    $sessionId = $_SESSION['auth']['id'];

                    $commentModel = new CommentsModel();
                    $commentModel->insertComment($sessionId, $id, $comments);

                    $this->success['sent'] = 'Votre message a été envoyé';
                    $_SESSION['flash']['success'] = $this->success;
                } else {
                    $this->errors['comment'] = 'Vous n\'avez pas rempli tous les champs nécessaires à 
                    l\'envoie du commentaire';
                    $_SESSION['flash']['errors'] = $this->errors;
                }
            }
        }else {
            $this->errors['error'] = 'Vous devez être connecté pour pouvoir poster un commentaire';
            $_SESSION['flash']['errors'] = $this->errors;
        }
        header('Location: ' . $this->baseUrl . '/film/' . $id);
    }
}