<?php


namespace App\Controllers;


use App\Models\ArtistsModel;

class ArtistsController extends GeneralController
{

    public function __construct() {
        parent::__construct();
    }

    public function actors(): void
    {
        $actorsModel = new ArtistsModel();

        $actors = $actorsModel->getAllActors();

        $template = $this->twig->load('actors.html.twig');
        echo $template->render(["actors" => $actors]);
    }

    public function authors(): void
    {
        $filmmakersModel = new ArtistsModel(); // Instanciation de la class FilmakersModel
        $filmmakers = $filmmakersModel->getAllAuthors(); // Utilise la fonction getAllFilmmakers() de la classe FilmmakersModel
        $template = $this->twig->load('filmmakers.html.twig');
        echo $template->render(["filmmakers" => $filmmakers]);
    }

    /**
     * Récupère les informations d'un acteur dans la base de données
     *
     * @param $id
     */
    public function actor($id): void
    {
        $actorModel = new ArtistsModel();
        $actor = $actorModel->getOneActor($id);

        $films = $actorModel->getfilmByActor($id);

        $template = $this->twig->load('actor.html.twig');
        echo $template->render([
            "actor" => $actor,
            "films" => $films
        ]);
    }

    public function author($id): void
    {
        $authorModel = new ArtistsModel();
        $author = $authorModel->getOneAuthor($id);

        $films = $authorModel->getFilmByAuthor($id);

        $template = $this->twig->load('filmmaker.html.twig');
        echo $template->render([
            "author" => $author,
            "films" => $films
        ]);
    }

}