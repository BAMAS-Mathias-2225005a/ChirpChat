<?php

namespace ChirpChat\Model;

class Post{
    public function __construct(public string $postID, ?string $title, public string $message, string $publicationDate, ?array $categories , private $postOwner ){ }

    public function getUser() : User{
        return $this->postOwner;
    }
}