<?php


namespace App\Models;


class MoviesModel extends GeneralModel {

    public function __construct() {
        parent::__construct();
    }

    // Requête SQL pour chercher tous les films de la table
    public function getAllMovies(): array {
        $sql = 'SELECT * FROM movies';
        $req = $this->pdo->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}