<?php

namespace Acme;

class Tennis
{
    protected $player1;
    protected $player2;
    protected $lookup = [
        0 => 'Love',
        1 => 'Fifteen',
        2 => 'Thirty',
        3 => 'Forty'
    ];

    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    public function score() {
        if($this->hasWinner()) {
            return 'Win for ' . $this->winner()->name;
        }

        if($this->hasAdvantage()) {
            return 'Advantage ' . $this->winner()->name;
        }

        if($this->inDeuce()) {
            return 'Deuce';
        }

        if($this->tied()) {
            return $this->lookup[$this->player1->points] . '-All';
        } else {
            return $this->lookup[$this->player1->points] . '-' . $this->lookup[$this->player2->points];
        }
    }

    /**
     * @return bool
     */
    private function tied()
    {
        return $this->player1->points == $this->player2->points;
    }

    /**
     * @return bool
     */
    private function hasWinner()
    {
        return ($this->winThresholdCleared() &&
            $this->leadingByTwo());
    }

    /**
     * @return Player
     */
    private function winner()
    {
        return $this->player1->points > $this->player2->points
            ? $this->player1
            : $this->player2;
    }

    /**
     * @return bool
     */
    private function hasAdvantage()
    {
        return ($this->winThresholdCleared() &&
            abs($this->player1->points - $this->player2->points) == 1);
    }

    /**
     * @return bool
     */
    private function inDeuce()
    {
        return ($this->player1->points >= 3 && $this->player2->points >= 3 && $this->tied());
    }

    /**
     * @return bool
     */
    private function winThresholdCleared()
    {
        return max([$this->player1->points, $this->player2->points]) >= 4;
    }

    /**
     * @return bool
     */
    private function leadingByTwo()
    {
        return abs($this->player1->points - $this->player2->points) >= 2;
    }
}
