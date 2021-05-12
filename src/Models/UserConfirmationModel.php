<?php


namespace App\Models;


class UserConfirmationModel extends GeneralModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function hasConfirmationToken($id) {
        $sql = 'SELECT confirmation_token FROM users WHERE id = ?';
        $req = $this->pdo->prepare($sql);
        $req->execute([$id]);
        return $req->fetch();
    }

    public function confirmAccount($id, $token): void
    {
        $sql = 'UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = :id';
        $req = $this->pdo->prepare($sql);
        $req->execute([":id" => $id]);
    }

}