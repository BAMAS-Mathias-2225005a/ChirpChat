<?php

namespace ChirpChat\Views;

use ChirpChat\Model\PrivateMessage;
use \ChirpChat\Model\User;

class PrivateMessageView {

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
    public function displayPrivateMessageWithUser(array $privateMessages) : PrivateMessageView {
        ?><div id="privateMessageList" style="display: flex; flex-direction: column"> <?php
        foreach ($privateMessages as $message){
            echo '<p>' . $message->getMessage() . '</p>';
        }
        ?></div><?php
        return $this;
    }

    public function displaySendMessageForm(string $targetID) : void {
        ?>
        <a href="index.php?action=privateMessage"><input type="button" value="RETOUR"></a>
        <form action="index.php?action=sendMessageTo&id=<?= $targetID ?> " method="post">
            <input type="text" placeholder="Message" name="message" required>
            <input type="submit" value="ENVOYER">
        </form>
        <?php
    }

}
