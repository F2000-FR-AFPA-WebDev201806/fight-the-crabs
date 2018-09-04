<?php

namespace AppBundle\Model;

class Board {

    const PLAYER_CROSS = 1;
    const PLAYER_CIRCLE = 2;

    public $grid = [];
    public $currentPlayer = self::PLAYER_CROSS;

    public function __construct() {

    }

    public function play($x, $y) {
        // Est-ce que la case vide ?
        if (empty($this->grid[$y][$x])) {
            // Mettre le pion correspondant au joueur actuelle
            switch ($this->currentPlayer) {
                case Board::PLAYER_CROSS:
                    $this->grid[$y][$x] = 'fas fa-times';
                    break;

                case Board::PLAYER_CIRCLE:
                    $this->grid[$y][$x] = 'fas fa-circle';
                    break;
            }

            return true;
        }

        return false;
    }

    public function nextPlayer() {
        // Passer au joueur suivant
        switch ($this->currentPlayer) {
            case Board::PLAYER_CROSS:

                $this->currentPlayer = Board::PLAYER_CIRCLE;
                break;

            case Board::PLAYER_CIRCLE:

                $this->currentPlayer = Board::PLAYER_CROSS;
                break;
        }
    }

    public function isWin() {

    }

}
