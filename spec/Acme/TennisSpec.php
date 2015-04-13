<?php namespace spec\Acme;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Acme\Player;

class TennisSpec extends ObjectBehavior
{
    protected $john;
    protected $jane;

    function let() {
        $this->john = new Player("John Doe", 0);
        $this->jane = new Player("Jane Doe", 0);
        $this->beConstructedWith($this->john, $this->jane);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Tennis');
    }

    function it_scores_a_scoreless_game() {
        $this->score()->shouldReturn('Love-All');
    }

    function it_scores_a_one_to_zero_game() {
        $this->john->earnPoints(1);
        $this->score()->shouldReturn('Fifteen-Love');
    }

    function it_scores_a_two_to_zero_game() {
        $this->john->earnPoints(2);
        $this->score()->shouldReturn('Thirty-Love');
    }

    function it_scores_a_three_to_zero_game() {
        $this->john->earnPoints(3);
        $this->score()->shouldReturn('Forty-Love');
    }

    function it_scores_a_four_to_zero_game() {
        $this->john->earnPoints(4);
        $this->score()->shouldReturn('Win for John Doe');
    }

    function it_scores_a_zero_to_four_game() {
        $this->jane->earnPoints(4);
        $this->score()->shouldReturn('Win for Jane Doe');
    }

    function it_scores_a_four_to_three_game() {
        $this->john->earnPoints(4);
        $this->jane->earnPoints(3);
        $this->score()->shouldReturn('Advantage John Doe');
    }

    function it_scores_a_three_to_four_game() {
        $this->john->earnPoints(3);
        $this->jane->earnPoints(4);
        $this->score()->shouldReturn('Advantage Jane Doe');
    }

    function it_scores_a_deuce_game() {
        $this->john->earnPoints(3);
        $this->jane->earnPoints(3);
        $this->score()->shouldReturn('Deuce');
    }

    function it_scores_a_eight_to_eight_game() {
        $this->john->earnPoints(8);
        $this->jane->earnPoints(8);
        $this->score()->shouldReturn('Deuce');
    }
}
