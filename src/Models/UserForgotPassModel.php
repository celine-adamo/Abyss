<?php


namespace App\Models;


class UserForgotPassModel extends GeneralModel
{

    public function __construct() {
        parent::__construct();
    }

    public function passwordUpdate($password, $email): void
    {
        $sql = 'UPDATE users SET password = :password WHERE email = :email';
        $req = $this->pdo->prepare($sql);
        $req->execute([
            ':password' => $password,
            ':email' => $email
        ]);
    }

}