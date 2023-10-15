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
     * @param User[] $userList
     * @return void
     */
    public function displayPrivateMessageList(array $userList) : void{
        foreach ($userList as $user){
            echo '<a href="index.php?action=privateMessageWith&id=' . $user->getUserID() . '"> <p>' . $user->getUsername() . '</p></a>';
        }
    }

    /**
     * @param PrivateMessage[] $privateMessages
     * @return void
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

    public function displaySendMessageForm(string $targetID) : PrivateMessageView {
        ob_start();
        ?>
        <a href="index.php?action=privateMessage"><input type="button" value="RETOUR"></a>
        <form id="privateMessageForm" action="index.php?action=sendMessageTo&id=<?= $targetID ?> " method="post">
            <input type="text" placeholder="Message" name="message" required>
            <input type="submit" value="ENVOYER">
        </form>
        <?php
        $this->pageContent .= ob_get_clean();
        return $this;
    }

    public function displayPrivateMessageView() : void{
        (new \ChirpChat\Views\MainLayout('Private message', $this->pageContent))->show(['privateMessage.css']);
    }

}
