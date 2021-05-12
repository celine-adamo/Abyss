<?php

namespace App\Controllers;

use App\Models\ActorModel;
use App\Models\ActorsModel;
use App\Models\ArtistsModel;
use App\Models\MovieModel;
use App\Models\MoviesModel;
use App\Models\FilmmakerModel;
use App\Models\FilmmakersModel;
use App\Models\SearchModel;

class PageController extends GeneralController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $moviesModel = new MoviesModel(); // Instanciation de la class MoviesModel
        $movies = $moviesModel->getAllMovies(); // Utilise la fonction getAllMovies() de la classe MoviesModel
        $template = $this->twig->load('index.html.twig');
        echo $template->render(["movies" => $movies]);
    }


    public function film($id): void
    {
        // Instanciation d'un nouvel objet MovieModel
        $movieModel = new MovieModel();
        // Utilise la fonction getOneMovie() de la class MovieModel 
        $movie = $movieModel->getOneMovie($id);
        $template = $this->twig->load('film.html.twig');
        echo $template->render(["movie" => $movie]);
    }

    // fonction error404 avec la vue error404.html.twig
    public function error404(): void
    {
        $template = $this->twig->load('error404.html.twig');
        echo $template->render();
    }

    public function thumbnails(): void{
        $moviesModel = new MoviesModel();
        $movies = $moviesModel->getAllMovies();
        $template = $this->twig->load('thumbnails.html.twig');
       echo $template->render(['movies' => $movies]);
    }
  
    public function search(): void
    {
        // Si $_POST et $_POST['search'] ne sont pas vide.
        if (!empty($_POST) && !empty($_POST['search'])) {

            $searchModel = new SearchModel();
            $searchMovie = $searchModel->searchMovies($_POST['search']);
            $searchArtist = $searchModel->searchArtist($_POST['search']);


            $template = $this->twig->load('searchResult.html.twig');
            echo $template->render(["searchResultMovie" => $searchMovie, "searchResultArtist" => $searchArtist]);
        } else {
            $_SESSION['flash']['errors'][] = 'Vous devez remplir le champs de recherche';
            header('Location: ' . $this->baseUrl);
        }
    }

}
