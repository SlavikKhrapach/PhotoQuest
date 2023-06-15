<?php

namespace classes;

class User {
    private $username;
    private $email;
    private $password;
    private $questsTaken;
    private $questsWon;

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getQuestsTaken() {
        return $this->questsTaken;
    }

    public function setQuestsTaken($questsTaken) {
        $this->questsTaken = $questsTaken;
    }

    public function getQuestsWon() {
        return $this->questsWon;
    }

    public function setQuestsWon($questsWon) {
        $this->questsWon = $questsWon;
    }
}