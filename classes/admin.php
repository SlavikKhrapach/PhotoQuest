<?php

namespace classes;

class Admin extends User {
    private $questsCreated;

    public function getQuestsCreated() {
        return $this->questsCreated;
    }

    public function setQuestsCreated($questsCreated) {
        $this->questsCreated = $questsCreated;
    }
}