<?php

namespace ChirpChat\Views;

use ChirpChat\Model\PrivateMessage;
use \ChirpChat\Model\User;

class PrivateMessageView {

    private array $userList;
    private array $privateMessageWithUserList;
    private User $targetUser;

    public function setUserList(array $userList) : void{
        $this->userList = $userList;
    }

    public function setPrivateMessageWithUserList(array $messageList) : void{
        $this->privateMessageWithUserList = $messageList;
    }

    public function setTargetUser(User $targetUser) : void {
        $this->targetUser = $targetUser;
    }

    /**
     * @param PrivateMessage[] $privateMessages
     * @return void
     */
    public function displayPrivateMessageWithUser() : PrivateMessageView {
        ?>
        <div id="privateMessagesContainer">
            <h2><?= $this->targetUser->getUsername() ?></h2>
            <div id="privateMessageList"> <?php
            foreach ($this->privateMessageWithUserList as $message){
                if ($message->getAuthor()->getUserID() == $_SESSION['ID']){
                    echo '<div class="privateMessageSent privateMessage"><p>' .  $message->getMessage() . '</p></div>';
                } else{
                    echo '<div class="privateMessageReceived privateMessage"><p>' .  $message->getMessage() . '</p></div>';
                }
            }
            ?></div>
        </div>
        <?php
        return $this;
    }

    public function displayEmptyMessageBox(){
        echo '<div id="privateMessagesContainer"> </div>';
    }

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
     * @param User[] $userList
     * @return void
     */
    public function displayUserList(array $userList) : void{
        ?>
        <div id="all-users-container">
            <?php foreach ($userList as $user){
                ?>
                <a href="index.php?action=privateMessage&id=<?=$user->getUserID()?>">
                    <div class="user-container">
                        <img alt='profile picture' src="<?= $user->getProfilPicPath(); ?>" >
                        <h3><?= $user->getUsername(); ?></h3>
                    </div>
                </a>
            <?php } ?>
        </div>
        <?php
    }


    public function displayPrivateMessageView() : void{
        ob_start();
        echo '<div id="private-message-container">';
        $this->displayUserList($this->userList);
        if(!isset($this->targetUser)){
            $this->displayEmptyMessageBox();
        }else{
            $this->displayPrivateMessageWithUser();
        }
        $pageContent = ob_get_clean();

        (new \ChirpChat\Views\MainLayout('Private message', $pageContent))->show(['privateMessage.css']);
    }

}
