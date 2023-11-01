<?php

namespace ChirpChat\Controllers;

use Chirpchat\Model\Database;
use \ChirpChat\Model\PrivateMessageRepository;
use ChirpChat\Model\UserRepository;
use ChirpChat\Views\PrivateMessageView;

class PrivateMessageController{

    public function displayPrivateMessagePage(string $userID) : void {
        if(!isset($_SESSION['ID'])) return;

        $userRepo = new UserRepository(Database::getInstance()->getConnection());
        $firstUser = $userRepo->getUser($_SESSION['ID']);
        $privateMessageRepo = new PrivateMessageRepository(Database::getInstance()->getConnection());
        $privateMessageView = new PrivateMessageView();
        $userList = $privateMessageRepo->getUsersWhoSendMessageTo($_SESSION['ID']);

        if(isset($_GET['id'])){
            $messageList = $privateMessageRepo->getPrivateMessageBetweenUsers($firstUser->getUserID(), $_GET['id']);
            $privateMessageView->setTargetUser($userRepo->getUser($_GET['id']));
            $privateMessageView->setPrivateMessageWithUserList($messageList);
        }

        $privateMessageView->setUserList($userList);
        $privateMessageView->displayPrivateMessageView();
    }

    public function displayConversationBetweenUsers(string $firstUserID, string $secondUserID){
        $privateMessageRepo = new PrivateMessageRepository(Database::getInstance()->getConnection());
        $privateMessageView = new PrivateMessageView();

        if(!isset($_SESSION['ID'])) return;

        $messageList = $privateMessageRepo->getPrivateMessageBetweenUsers($firstUserID, $secondUserID);
        $privateMessageView
            ->displayPrivateMessageWithUser($messageList, $userRepo->getUser($secondUserID))
            ->displaySendMessageForm($secondUserID)
            ->displayPrivateMessageView();
    }

    public function sendMessageTo(string $targetID) : void{
        $privateMessageRepo = new PrivateMessageRepository(Database::getInstance()->getConnection());
        $message = $_POST['message'];
        $privateMessageRepo->sendMessageToUser($_SESSION['ID'], $targetID, $message);

        header('Location:index.php?action=privateMessageWith&id=' . $targetID);
    }
}
