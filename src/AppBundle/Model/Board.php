<?php

namespace AppBundle\Model;

class Board {

    const PLAYER_CROSS = 1;
    const PLAYER_CIRCLE = 2;

    protected $grid = [];
    protected $currentPlayer;

    /**
     * Création du plateau
     */
    public function __construct() {
        $this->grid = [
            ['', '', ''],
            ['', '', ''],
            ['', '', ''],
        ];
        $this->currentPlayer = Board::PLAYER_CROSS;
    }

    /**
     * Jouer
     * @param int $x
     * @param int $y
     * @return boolean
     */
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

    /**
     * Passer au joueur suivant
     */
    public function nextPlayer() {
        switch ($this->currentPlayer) {
            case Board::PLAYER_CROSS:
                $this->currentPlayer = Board::PLAYER_CIRCLE;
                break;

            case Board::PLAYER_CIRCLE:
                $this->currentPlayer = Board::PLAYER_CROSS;
                break;
        }
    }

    /**
     * Est-ce la partie est finie?
     */
    public function isWin() {
        // colonne 1
        if ($this->grid[0][0] == $this->grid[0][1] && $this->grid[0][1] == $this->grid[0][2]) {
            return true;
        }
        if ($this->grid[1][0] == $this->grid[1][1] && $this->grid[1][1] == $this->grid[1][2]) {
            return true;
        }
        if ($this->grid[2][0] == $this->grid[2][1] && $this->grid[2][1] == $this->grid[2][2]) {
            return true;
        }
        if ($this->grid[0][0] == $this->grid[1][0] && $this->grid[1][0] == $this->grid[2][0]) {
            return true;
        }
        if ($this->grid[0][1] == $this->grid[1][1] && $this->grid[1][1] == $this->grid[2][1]) {
            return true;
        }
        if ($this->grid[0][2] == $this->grid[1][2] && $this->grid[1][2] == $this->grid[2][2]) {
            return true;
        }
        if ($this->grid[0][0] == $this->grid[1][1] && $this->grid[1][1] == $this->grid[2][2]) {
            return true;
        }
        if ($this->grid[0][2] == $this->grid[1][1] && $this->grid[1][1] == $this->grid[2][0]) {
            return true;
        }
    }

    public function getGrid() {
        return $this->grid;
    }

    public function getCurrentPlayer() {
        return $this->currentPlayer;
    }

    public function setGrid($grid) {
        $this->grid = $grid;
    }

    public function setCurrentPlayer($currentPlayer) {
        $this->currentPlayer = $currentPlayer;
    }

}
