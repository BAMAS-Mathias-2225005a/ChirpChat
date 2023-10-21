<?php

namespace ChirpChat\Views;

class PostView{

    /**
     * @param \ChirpChat\Model\Post $post
     */
    public function __construct(private \ChirpChat\Model\Post $post) {}


    public function show() : void{
        ob_start();
        ?>
            <div class="post">
                <a href="index.php?action=profile&id=<?= $this->post->getUser()->getUserID() ?>"><img alt="author profile picture" id="profilePicture" src="https://cdn-icons-png.flaticon.com/512/436/436299.png" /></a>
                    <div id="mainPostContainer">
                        <div id="postHeader">
                                <div id="authorInfo">
                                    <?php
                                    echo '<h2>' . $this->post->getUser()->getPseudo() . '</h2>';
                                    echo '<h3>' . $this->getDatePublicString($this->post->getDatePubli()) . '</h3>';
                                    ?>
                                </div>
                                <?php if(isset($_SESSION['ID']) &&$this->post->getUser()->getUserID() === $_SESSION['ID']){ ?>
                                <div id="postSettings" onclick="openCloseUserMenu(this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <div id="postSettingsMenu" class="menuClose">
                                        <ul>
                                            <li>
                                                <a>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                    </svg>
                                                    <p>Modifier</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="deletePost" href="index.php?action=deletepost&id=<?php echo $this->post->idPost?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                    <p>Supprimer</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <?php } ?>
                        </div>
                        <a href="index.php?action=comment&id=<?=$this->post->idPost?>">
                            <div id="postContent">
                                <h3><?php if($this->post->getTitre() != null) echo $this->post->getTitre() ?> </h3>
                                <p>
                                    <?php echo $this->post->message?>
                                </p>
                            </div>
                            <div id="postFooter">
                                <div>
                                    <form action="index.php?action=like&id=<?php echo $this->post->idPost?>" method="post">
                                        <button id="likeButton" type="submit">
                                            <?= $this->getLikeButton() ?>
                                        </button>
                                    </form>
                                    <p><?php echo $this->post->likeAmount ?></p>
                                </div>
                                <div><img alt="comment image" src="https://icon-library.com/images/speech-bubble-icon/speech-bubble-icon-13.jpg"/>
                                    <p><?php echo $this->post->commentAmount ?></p>
                                </div>
                            </div>
                            <div id="postCategories">
                                <?php foreach ($this->post->getCategories() as $cat){
                                    echo '<p class="category">#' . strtoupper($cat->getLibelle()) . '</p>';
                                }?>
                            </div>
                        </a>
                    </div>

            </div>
        <?php

        echo ob_get_clean();
    }

    /** Return the like button with the correct image depending on the likes of the user
     * @return string
     */
    public function getLikeButton() : string{
        // User not connected or hasn't liked
        if(isset($_SESSION['ID']) && $this->post->isLikedByUser($_SESSION['ID'])){
            return '<img alt="like icon" src="https://cdn-icons-png.flaticon.com/512/753/753252.png">';
        }else{
            return '<img alt="like icon" src="https://cdn-icons-png.flaticon.com/512/159/159774.png">';
        }
    }

    public function getDatePublicString(string $date) : string{
        $todayDate = strtotime(date('Y-m-d H:i:s'));
        $timeSincePostUpload = $todayDate - strtotime($date);
        if($timeSincePostUpload < 60){
            return 'Il y a ' .  $timeSincePostUpload . ' secondes';
        }
        if($timeSincePostUpload < 3600){
            return 'Il y a ' . (round($timeSincePostUpload/60)) . ' minutes';
        }
        if($timeSincePostUpload < 86400){
            return 'Il y a ' . (round($timeSincePostUpload/60/24)) . ' heures';
        }
        else{
            return explode(' ', $date)[0];
        }
    }
}
