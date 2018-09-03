<?php

namespace AppBundle\Model;

class Board {

    const PLAYER_CROSS = 1;
    const PLAYER_CIRCLE = 2;

    public $grid = [];
    public $currentPlayer = self::PLAYER_CROSS;

    public function __construct() {

    }

    public function play() {

    }

    public function nexPlayer() {

    }

    public function isWin() {

    }

}
