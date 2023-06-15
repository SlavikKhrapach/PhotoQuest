<?php

namespace classes;

class PostedPhoto
{
    private $_questName;
    private $_votes;
    private $_photoPath;
    private $_username;

    function __construct($questName = "", $votes = "", $photoPath = "", $username = "")
    {
        $this->_questName = $questName;
        $this->_votes = $votes;
        $this->_photoPath = $photoPath;
        $this->_username = $username;
    }

    function setQuestName($questName)
    {
        $this->_questName = $questName;
    }

    function getQuestName()
    {
        return $this->_questName;
    }

    function getUsername()
    {
        return$this->_username;
    }

    function setVotes($votes)
    {
        $this->_votes = $votes;
    }

    function getVotes()
    {
        return $this->_votes;
    }


}