<?php

namespace ChirpChat\Views;

use ChirpChat\Model\PrivateMessage;
use \ChirpChat\Model\User;

class PrivateMessageView {

    private string $pageContent;

    public function __construct(){
        $this->pageContent = "";
    }

    /**
     * Affiche la liste des utilisateurs pour les messages privés.
     *
     * @param User[] $userList Un tableau d'utilisateurs.
     * @return void
     */
    public function displayPrivateMessageList(array $userList) : void{
        foreach ($userList as $user){
            echo '<a href="index.php?action=privateMessageWith&id=' . $user->getUserID() . '"> <p>' . $user->getUsername() . '</p></a>';
        }
    }

    /**
     * Affiche la conversation de messages privés avec un utilisateur spécifique.
     *
     * @param PrivateMessage[] $privateMessages Un tableau de messages privés.
     * @param User $userTarget L'utilisateur avec lequel se déroule la conversation.
     * @return PrivateMessageView
     */
    public function displayPrivateMessageWithUser(array $privateMessages,User $userTarget) : PrivateMessageView {
        ob_start();
        ?>
        <main id="privateMessagesContainer">
            <h2><?= $userTarget->getUsername() ?></h2>
            <div id="privateMessageList"> <?php
            foreach ($privateMessages as $message){
                if ($message->getAuthor()->getUserID() == $_SESSION['ID']){
                    echo '<div class="privateMessageSent privateMessage"><p>' .  $message->getMessage() . '</p></div>';
                } else{
                    echo '<div class="privateMessageReceived privateMessage"><p>' .  $message->getMessage() . '</p></div>';
                }
            }
            ?></div>
        </main>
        <?php
        $this->pageContent .= ob_get_clean();
        return $this;
    }

    /**
     * Affiche le formulaire d'envoi de message privé.
     *
     * @param string $targetID L'ID de l'utilisateur destinataire.
     * @return PrivateMessageView
     */
    public function displaySendMessageForm(string $targetID) : PrivateMessageView {
        ob_start();
        ?>
        <a href="index.php?action=privateMessage"><input type="button" id="retour" value="RETOUR"></a>
        <form id="privateMessageForm" action="index.php?action=sendMessageTo&id=<?= $targetID ?> " method="post">
            <input type="text" placeholder="Message" name="message" required>
            <input type="submit" value="ENVOYER">
        </form>
        <?php
        $this->pageContent .= ob_get_clean();
        return $this;
    }
    /**
     * Affiche la vue des messages privés.
     *
     * @return void
     */
    public function displayPrivateMessageView() : void{
        (new \ChirpChat\Views\MainLayout('Private message', $this->pageContent))->show(['privateMessage.css']);
    }

}
