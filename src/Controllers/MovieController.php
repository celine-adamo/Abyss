<?php


namespace App\Controllers;


use App\Models\CommentsModel;
use App\Models\MovieModel;

class MovieController extends GeneralController
{

    private array $errors = array();
    private array $success = array();

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Permet d'afficher la vue d'un film en particulier ainsi que ses commentaires
     * posté par les utilisateurs
     *
     * @param $id // Récupère l'id du film que l'on veut afficher
     */
    public function film($id): void
    {
        // Instanciation d'un nouvel objet MovieModel
        $movieModel = new MovieModel();
        // Utilise la fonction getOneMovie() de la class MovieModel
        $movie = $movieModel->getOneMovie($id);

        // afficher le/les réalisateurs
        $rea = $movieModel->getFilmakerByMovie($id);

        // afficher la distribution
        $distribution = $movieModel->getDistributionByMovie($id);

        $commentModel = new CommentsModel();
        $comments = $commentModel->getAllComments($id);


        $template = $this->twig->load('film.html.twig');
        echo $template->render([
            "movie" => $movie,
            "rea"=> $rea,
            "distribution"=>$distribution,
            "comments" => $comments,
            "errors" => $this->errors,
            "success" => $this->success,
        ]);
    }
}