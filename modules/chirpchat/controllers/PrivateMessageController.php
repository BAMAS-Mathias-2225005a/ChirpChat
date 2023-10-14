<?php

namespace ChirpChat\Controllers;
use Chirpchat\Model\Database;
use \ChirpChat\Model\PrivateMessageRepository;
use ChirpChat\Views\PrivateMessageView;

class PrivateMessageController{

    public function displayPrivateMessagePageForUser(string $userID) : void {
        $privateMessageRepo = new PrivateMessageRepository(Database::getInstance()->getConnection());
        $privateMessageView = new PrivateMessageView();

        if(!isset($_SESSION['ID'])) return;
        $userList = $privateMessageRepo->getUsersWhoSendMessageTo($_SESSION['ID']);
        $privateMessageView->displayPrivateMessageList($userList);
    }

    public function displayConversationBetweenUsers(string $firstUserID, string $secondUserID){
        $privateMessageRepo = new PrivateMessageRepository(Database::getInstance()->getConnection());
        $privateMessageView = new PrivateMessageView();

        if(!isset($_SESSION['ID'])) return;

        $messageList = $privateMessageRepo->getPrivateMessageBetweenUsers($firstUserID, $secondUserID);
        $privateMessageView
            ->displayPrivateMessageWithUser($messageList)
            ->displaySendMessageForm($secondUserID);
    }

    public function sendMessageTo(string $targetID) : void{
        $privateMessageRepo = new PrivateMessageRepository(Database::getInstance()->getConnection());
        $message = $_POST['message'];
        $privateMessageRepo->sendMessageToUser($_SESSION['ID'], $targetID, $message);

        header('Location:index.php?action=privateMessageWith&id=' . $targetID);
    }
}
