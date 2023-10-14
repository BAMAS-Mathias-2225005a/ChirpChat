<?php

namespace ChirpChat\Model;

use ChirpChat\Model\User;

class PrivateMessage{

    public function __construct(private readonly User $author, private readonly User $target, private readonly string $message){ }

    public function getAuthor(): \ChirpChat\Model\User
    {
        return $this->author;
    }

    public function getTarget(): \ChirpChat\Model\User
    {
        return $this->target;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

}
