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
     * Placement du pion (+ vérification de la case)
     */
    public function play() {

    }

    /**
     * Joueur suivant
     */
    public function nextPlayer() {

    }

    /**
     * Est-ce la partie est finie?
     */
    public function isWin() {

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
