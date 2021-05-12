<?php

namespace App\Models;


class MovieModel extends GeneralModel {

    public function __construct() {
        parent::__construct();
    }

    // Requête SQL pour chercher tous les films de la table
    public function getOneMovie($id) {
         $sql = 'SELECT * FROM movies WHERE id = :id';
         $req = $this->pdo->prepare($sql);
         $req->execute([":id" => $id]);
         return $req->fetch();
    }

    public function getDistributionByMovie($id){
        $sql = 'SELECT artists.id, artists.firstname, artists.lastname FROM artists 
                LEFT JOIN actor_film ON artists.id=actor_film.id_artist
                WHERE actor_film.id_film = :id';
        $req = $this->pdo->prepare($sql);
        $req->execute([":id" => $id]);
        return $req->fetchAll();
    }

    public function getFilmakerByMovie($id){
        $sql = 'SELECT artists.id, artists.firstname, artists.lastname FROM artists 
        LEFT JOIN film_role ON artists.id=film_role.id_artist
        WHERE film_role.id_film = :id';
        $req = $this->pdo->prepare($sql);
        $req->execute([":id" => $id]);
        return $req->fetchAll();
    }
}