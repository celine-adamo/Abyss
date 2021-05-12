<?php


namespace App\Models;


class CommentsModel extends GeneralModel
{

    public function __construct() {
        parent::__construct();
    }

    /**
     * Requête pour récupérer dans la base de données les infos du commentaire posté par
     * l'utilisateur, sur un certain film
     *
     * @param $id // Récupère l'id du film
     * @return array // Renvoie un tableau des commentaires envoyé par les utilisateurs sur le film en question
     */
    public function getAllComments($id): array
    {
        $sql = 'SELECT comment.id, id_movie, comment.comment, date_comment, id_user, users.id, users.pseudo 
                FROM comment, users 
                WHERE id_user = users.id AND id_movie = :id_movie 
                ORDER BY comment.id DESC LIMIT 5';
        $req = $this->pdo->prepare($sql) or die($this->pdo->errorInfo());
        $req->execute([":id_movie" => $id]);
        return $req->fetchAll();
    }

    /**
     *  Envoie les commentaires écrient par les utilisateur dans la
     *  base de données
     *
     * @param $sessionId // Récupère l'id de le session de l'utilisateur
     * @param $movieId // Récupère l'id du film
     * @param $comment // Récupère le commentaire envoyé en post par l'utilisateur
     */
    public function insertComment($sessionId, $movieId, $comment): void
    {
        $sql = 'INSERT INTO comment (id_user, id_movie, comment, date_comment)  
            VALUES (:id_user, :id_movie, :comment, NOW())';
        $req = $this->pdo->prepare($sql);
        $req->execute([
            ':id_user' => $sessionId,
            ':id_movie' => $movieId,
            ':comment' => $comment,
        ]);
    }

}