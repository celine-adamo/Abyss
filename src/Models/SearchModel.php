<?php

namespace App\Models;

class SearchModel extends GeneralModel{

    public function __construct()
    {
        parent::__construct();
    }

    public function searchMovies($search){
        // recherche des films
        $search ="%".$search."%";
        $sql = 'SELECT * FROM movies WHERE title LIKE :search ';
        $req = $this->pdo->prepare($sql);
        $req->execute([":search"=>$search]);
        return $req->fetchAll(); 
    }

    public function searchArtist($search){
        // recherche des artists
        $search ="%".$search."%";
        $sql = 'SELECT * FROM artists WHERE (firstname LIKE :search OR lastname LIKE :search) OR (CONCAT(firstname, " ",lastname)LIKE :search) OR (CONCAT(lastname, " ",firstname) LIKE :search)'; 
        $req = $this->pdo->prepare($sql);
        $req->execute([":search"=>$search]);
        return $req->fetchAll(); 

    }


}
