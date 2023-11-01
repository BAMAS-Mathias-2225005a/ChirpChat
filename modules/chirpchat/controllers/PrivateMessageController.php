<?php

namespace ChirpChat\Controllers;
use Chirpchat\Model\Database;
use \ChirpChat\Model\PrivateMessageRepository;
use ChirpChat\Model\UserRepository;
use ChirpChat\Views\PrivateMessageView;
/**
 * Contrôleur de gestion des messages privés.
 */
class PrivateMessageController{
    /**
     * Affiche la page des messages privés pour un utilisateur donné.
     *
     * Cette méthode affiche la liste des utilisateurs avec lesquels l'utilisateur actuellement connecté
     * a échangé des messages privés. Elle utilise PrivateMessageRepository et PrivateMessageView pour gérer l'affichage.
     *
     * @param string $userID L'identifiant de l'utilisateur pour lequel afficher les messages privés.
     *
     * @return void
     */
    public function displayPrivateMessagePageForUser(string $userID) : void {
        $privateMessageRepo = new PrivateMessageRepository(Database::getInstance()->getConnection());
        $privateMessageView = new PrivateMessageView();

        if(!isset($_SESSION['ID'])) return;
        $userList = $privateMessageRepo->getUsersWhoSendMessageTo($_SESSION['ID']);
        $privateMessageView->displayPrivateMessageList($userList);
    }
    /**
     * Affiche la conversation entre deux utilisateurs.
     *
     * Cette méthode affiche la conversation entre deux utilisateurs, identifiés par leurs identifiants.
     * Elle utilise PrivateMessageRepository, UserRepository et PrivateMessageView pour gérer l'affichage de la conversation.
     *
     * @param string $firstUserID L'identifiant du premier utilisateur dans la conversation.
     * @param string $secondUserID L'identifiant du deuxième utilisateur dans la conversation.
     *
     * @return void
     */
    public function displayConversationBetweenUsers(string $firstUserID, string $secondUserID){
        $userRepo = new UserRepository(Database::getInstance()->getConnection());
        $privateMessageRepo = new PrivateMessageRepository(Database::getInstance()->getConnection());
        $privateMessageView = new PrivateMessageView();

        if(!isset($_SESSION['ID'])) return;

        $messageList = $privateMessageRepo->getPrivateMessageBetweenUsers($firstUserID, $secondUserID);
        $privateMessageView
            ->displayPrivateMessageWithUser($messageList, $userRepo->getUser($secondUserID))
            ->displaySendMessageForm($secondUserID)
            ->displayPrivateMessageView();
    }
    /**
     * Envoie un message privé à un utilisateur.
     *
     * Cette méthode permet à l'utilisateur actuellement connecté d'envoyer un message privé à un autre utilisateur.
     * Elle utilise PrivateMessageRepository pour gérer l'envoi du message privé.
     *
     * @param string $targetID L'identifiant de l'utilisateur destinataire du message privé.
     *
     * @return void
     */
    public function sendMessageTo(string $targetID) : void{
        $privateMessageRepo = new PrivateMessageRepository(Database::getInstance()->getConnection());
        $message = $_POST['message'];
        $privateMessageRepo->sendMessageToUser($_SESSION['ID'], $targetID, $message);

        header('Location:index.php?action=privateMessageWith&id=' . $targetID);
    }
}
