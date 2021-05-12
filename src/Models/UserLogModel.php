<?php

namespace App\Models;

require_once 'functions.php';
class UserLogModel extends GeneralModel{

    public function __construct() {
        parent::__construct();
    }
    
    
    public function userSelected($username){
        // récupération User
        
        $sql = 'SELECT * FROM users WHERE (pseudo = :email OR email = :email)';
        $req =$this->pdo->prepare($sql);
        $req->execute([":email"=>$username]);
        return $req->fetch();
       
    }
    
    public function userConnectedToken($user, $remember_token){        
        $req = $this->pdo->prepare('UPDATE users SET remember_token = ? WHERE id = ?');
        $req->execute([$remember_token, $user['id']]);
        
    }    
}

