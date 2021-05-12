<?php


namespace App\Models;


class ArtistsModel extends GeneralModel
{

    public function __construct() {
        parent::__construct();
    }

    /* Actor */

    // Requête SQL pour chercher tous les films de la table
    public function getOneActor($id) {
        $sql = 'SELECT * FROM artists WHERE id = :id';
        $req = $this->pdo->prepare($sql);
        $req->execute([":id" => $id]);
        return $req->fetch();
    }

    public function getfilmByActor($id): array
    {
        $sql = 'SELECT movies.id, movies.title 
                FROM movies
                LEFT JOIN actor_film on movies.id = actor_film.id_film
                WHERE actor_film.id_artist = :id';
        $req = $this->pdo->prepare($sql);
        $req->execute([":id" => $id]);
        return $req->fetchAll();
    }

    /* Actors */

    //Requête SQL
    public function getAllActors(): array{
        $sql = 'SELECT * FROM artists WHERE id_role=0';
        $req = $this->pdo->prepare($sql);
        $req->execute();
        return $req-> fetchAll();

    }

    public function getActorsFromMovie($id){
        $sql = 'SELECT artists.* FROM artists, actor_film, movies WHERE movies.id=? AND actor_film.id_film=movies.id AND actor_film.id_artist=artists.id';
        $req = $this->pdo->prepare($sql);
        $req->execute();
        return $req-> fetchAll();
    }

    /* Author */

    // Requête SQL pour chercher l'auteur d'un films de la table
    public function getOneAuthor($id) {
        $sql = 'SELECT * FROM artists WHERE id = :id';
        $req = $this->pdo->prepare($sql);
        $req->execute([":id" => $id]);
        return $req->fetch();
    }

    public function getFilmByAuthor($id): array
    {
        $sql = 'SELECT movies.id, movies.title 
                FROM movies
                LEFT JOIN film_role on movies.id = film_role.id_film
                WHERE film_role.id_artist = :id';
        $req = $this->pdo->prepare($sql);
        $req->execute([":id" => $id]);
        return $req->fetchAll();
    }

    /* Authors */

    // Requête SQL pour chercher les auteurs des films de la table toutes la table
    public function getAllAuthors() : array {
        $sql = 'SELECT * FROM artists WHERE id_role=1';
        $req = $this->pdo->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

}