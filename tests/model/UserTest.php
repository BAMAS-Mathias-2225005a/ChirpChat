<?php

use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{

    private $userWithoutDesc;
    private $userWithDesc;

    public function setUp() : void {
        $this->userWithoutDesc = new \ChirpChat\Model\User("651841813ee15", "testutilisateur", "user@gmail.com", "pseudoTEST123", null);
        $this->userWithDesc = new \ChirpChat\Model\User("651841813ee20", "toto", "toto@gmail.com", "supertoto", "test Description.");
    }

    public function testClassConstructor(): void {
        $this->assertSame("651841813ee15", $this->userWithoutDesc->getUserID());
        $this->assertSame("testutilisateur", $this->userWithoutDesc->getUsername());
        $this->assertSame("user@gmail.com", $this->userWithoutDesc->getEmail());
        $this->assertSame("pseudoTEST123", $this->userWithoutDesc->getPseudo());
        $this->assertEmpty($this->userWithoutDesc->getDescription());
    }

    public function testGetUserId(): void {
        $this->assertIsString($this->userWithoutDesc->getUserID());
        $this->assertSame("651841813ee15", $this->userWithoutDesc->getUserID());
    }

    public function testGetUsername(): void {
        $this->assertIsString($this->userWithoutDesc->getUsername());
        $this->assertSame("testutilisateur", $this->userWithoutDesc->getUsername());
    }

    public function testGetEmail(): void {
        $this->assertIsString($this->userWithoutDesc->getEmail());
        $this->assertSame("user@gmail.com", $this->userWithoutDesc->getEmail());
    }

    public function testGetPseudo(): void {
        $this->assertIsString($this->userWithoutDesc->getPseudo());
        $this->assertSame("pseudoTEST123", $this->userWithoutDesc->getPseudo());
    }

    public function testGetDescription(): void {
        $this->assertIsString($this->userWithDesc->getDescription());
        $this->assertSame("test Description.", $this->userWithDesc->getDescription());
    }

    public function testGetProfilPicPath(): void {
        $this->assertIsString($this->userWithoutDesc->getProfilPicPath());
        $this->assertSame("_assets/images/user_pic/default.png", $this->userWithoutDesc->getProfilPicPath());
    }

}