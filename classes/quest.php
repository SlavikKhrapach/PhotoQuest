<?php

namespace classes;

class Quest
{
    private $_questName;
    private $_description;
    private $_prize;

    function __construct($questName = "", $description = "", $prize = "")
    {
        $this->_questName = $questName;
        $this->_description = $description;
        $this->_prize = $prize;
    }

    function setQuestName($questName)
    {
        $this->_questName = $questName;
    }

    function getQuestName()
    {
        return $this->_questName;
    }

    function setPrize($prize)
    {
        $this->_prize = $prize;
    }

    function getPrize()
    {
        return $this->_prize;
    }
}