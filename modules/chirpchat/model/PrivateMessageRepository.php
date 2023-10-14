<?php

namespace ChirpChat\Model;
use ChirpChat\Model\PrivateMessage;

class PrivateMessageRepository{

    public function __construct(private \PDO $connection){ }

    /** Return all the private messages between two users
     * @param string $firstUserID
     * @param string $secondUserID
     * @return PrivateMessage[]
     */
    public function getPrivateMessageBetweenUsers(string $firstUserID, string $secondUserID) : array{
        $privateMessageList = [];
        $userRepo = new UserRepository($this->connection);
        $statement = $this->connection->prepare("SELECT * FROM PrivateMessage WHERE target IN (:target,:sender) AND sender IN (:target,:sender) ORDER BY creationDate DESC");
        $statement->bindValue(':target', $firstUserID);
        $statement->bindValue(':sender', $secondUserID);
        $statement->execute();

        while($row = $statement->fetch()){
            $privateMessageList[] = new PrivateMessage($userRepo->getUser($row['sender']), $userRepo->getUser($row['target']), $row['message']);
        }

        return $privateMessageList;
    }

    public function getUsersWhoSendMessageTo(string $userID) : array{
        $userRepo = new \ChirpChat\Model\UserRepository($this->connection);
        $statement = $this->connection->prepare("SELECT DISTINCT sender FROM PrivateMessage WHERE target = :userID 
                                           UNION SELECT target FROM PrivateMessage WHERE sender = :userID AND sender NOT IN 
                                           (SELECT DISTINCT  sender FROM PrivateMessage WHERE target = :userID)");

        $statement->bindParam(':userID', $userID);
        $statement->execute();

        $usersList = [];

        while($row = $statement->fetch()){
            $usersList[] = $userRepo->getUser($row['sender']);
        }

        return $usersList;
    }

    public function sendMessageToUser(string $senderID, string $targetID, string $message){
        $statement = $this->connection->prepare('INSERT INTO PrivateMessage (sender,target,message,creationDate) VALUES (?,?,?,?)');
        $statement->execute([$senderID, $targetID, $message, date("DD-MM-YYYY")]);
    }

}
