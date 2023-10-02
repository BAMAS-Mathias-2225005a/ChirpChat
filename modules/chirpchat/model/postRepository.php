<?php

namespace ChirpChat\Model;

use ChirpChat\Model\Post;
use Includes\DatabaseConnection;
use \ChirpChat\Model\Post as Comment;

class PostRepository{

    public function __construct(private \PDO $connection){ }

    public function getPostList(){
        $userRepo = new \ChirpChat\Model\UserRepository($this->connection);
        $statement =  $this->connection->prepare("SELECT * FROM Post WHERE PARENT_ID IS NULL");
        $statement->execute();

        $postList = [];

        while ($row = $statement->fetch()){
            $post = new Post($row['id_post'], $row['titre'], $row['message'], $row['date_publi'], $row['categories'], $userRepo->getUser($row['id_utilisateur']), $row['commentAmount'], $row['likeAmount']);
            $postList[] = $post;
        }

        return $postList;
    }

    public function add(?string $titre, string $message, string $userID, string $parent_id=null) : void {
        $statement = $this->connection->prepare("INSERT INTO Post (titre, message, date_publi, categories, id_utilisateur, PARENT_ID)VALUES (?,?,?,NULL,?,?)");
        $statement->execute([$titre, $message,date('D M Y'), $userID, $parent_id]);

        if($parent_id != null){
            $statement = $this->connection->prepare("UPDATE Post SET CommentAmount = CommentAmount + 1 WHERE ID_POST=?");
            $statement->execute([$parent_id]);
        }
    }

    public function getPostComment(string $id) : array {
        $userRepo = new \ChirpChat\Model\UserRepository($this->connection);
        $statement = $this->connection->prepare("SELECT * FROM Post WHERE PARENT_ID=? LIMIT 10");
        $statement->execute([$id]);

        $commentList = [];
        while($row = $statement->fetch()){
            $commentList[] = new Comment($row['id_post'], $row['titre'], $row['message'], $row['date_publi'], $row['categories'], $userRepo->getUser($row['id_utilisateur']), $row['commentAmount'], $row['likeAmount']);
        }
        return $commentList;
    }

    public function getPost(string $postId) : ?Post{
        $userRepo = new \ChirpChat\Model\UserRepository($this->connection);
        $statement = $this->connection->prepare("SELECT * FROM Post WHERE PARENT_ID IS NULL AND ID_POST = ? LIMIT 1");
        $statement->execute([$postId]);

        if($row = $statement->fetch()){
            return new Comment($row['id_post'], $row['titre'], $row['message'], $row['date_publi'], $row['categories'], $userRepo->getUser($row['id_utilisateur']), $row['commentAmount'], $row['likeAmount'], $row['likeAmount']);
        }

        return null;
    }

    public function getComment(string $commentId) : ?Post{
        $userRepo = new \ChirpChat\Model\UserRepository($this->connection);
        $statement = $this->connection->prepare("SELECT * FROM Post WHERE ID_POST = ? LIMIT 1");
        $statement->execute([$commentId]);

        if($row = $statement->fetch()){
            return new Comment($row['id_post'], $row['titre'], $row['message'], $row['date_publi'], $row['categories'], $userRepo->getUser($row['id_utilisateur']), $row['commentAmount'], $row['likeAmount']);
        }

        return null;
    }

    public function isAlreadyLiked(?int $post_id, string $user_id) : bool {
        $statement = $this->connection->prepare("SELECT POST_ID, USER_ID FROM LIKES WHERE POST_ID = ? AND USER_ID = ?");
        $statement->execute([$post_id, $user_id]);
        if($statement->fetch()) return true;
        return false;
    }

    public function addLike(?int $post_id, string $user_id) : void {
        if($this->isAlreadyLiked($post_id, $user_id)){
            $this->removeLike($post_id, $user_id);
        } else {
            $statement = $this->connection->prepare("INSERT INTO LIKES (POST_ID, USER_ID) VALUES (?, ?)");
            $statement->execute([$post_id, $user_id]);
        }
    }

    public function removeLike(?int $post_id, string $user_id) : void {
        $statement = $this->connection->prepare("DELETE FROM LIKES WHERE POST_ID = ? AND USER_ID = ?");
        $statement->execute([$post_id, $user_id]);
    }

    /**
     * @param string $filter
     * @return Post array
     */
    public function searchPost(string $filter) : array{
        $filter = '%' . $filter . '%';
        $userRepo = new \ChirpChat\Model\UserRepository($this->connection);
        $statement = $this->connection->prepare("SELECT * FROM Post WHERE message LIKE ? ");
        $statement->execute([$filter]);

        $postList = [];

        while ($row = $statement->fetch()){
            $post = new Post($row['id_post'], $row['titre'], $row['message'], $row['date_publi'], $row['categories'], $userRepo->getUser($row['id_utilisateur']), $row['commentAmount'], $row['likeAmount']);
            $postList[] = $post;
        }

        return $postList;
    }

}
