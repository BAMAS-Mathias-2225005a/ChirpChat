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
        foreach ($privateMessages as $message){
            echo $message->getMessage();
        }
        return $this;
    }

    public function displaySendMessageForm(string $targetID) : void {
        ?><form action="index.php?action=sendMessageTo&id=<?= $targetID ?> " method="post">
            <input type="text" placeholder="Message" required>
            <input type="submit" value="ENVOYER">
        </form>
        <?php
    }

}
