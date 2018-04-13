<?php

use TennisScoring\Game;
use TennisScoring\Player;

class TennisScoringTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Game
     */
    private $game;

    /**
     * @var Player
     */
    private $firstPlayer;

    /**
     * @var Player
     */
    private $secondPlayer;

    public function setUp()
    {
        $this->firstPlayer = new Player('First Player', 0);
        $this->secondPlayer = new Player('Second Player', 0);

        $this->game = new Game($this->firstPlayer, $this->secondPlayer);
    }

    public function testScorelessGameReturnsLoveAll()
    {
        $this->assertEquals('Love-All', $this->game->score());
    }

    public function testScoreOneZeroGameReturnsFifteenLove()
    {
        $this->firstPlayer->earnPoints(1);

        $this->assertEquals('Fifteen-Love', $this->game->score());
    }

    public function testScoreTwoZeroGameReturnsThirtyLove()
    {
        $this->firstPlayer->earnPoints(2);

        $this->assertEquals('Thirty-Love', $this->game->score());
    }

    public function testScoreThreeZeroGameReturnsFortyLove()
    {
        $this->firstPlayer->earnPoints(3);

        $this->assertEquals('Forty-Love', $this->game->score());
    }

    public function testScoreFourZeroGameReturnsWin()
    {
        $this->firstPlayer->earnPoints(4);

        $this->assertEquals('Win for First Player', $this->game->score());
    }

    public function testScoreZeroFourGameReturnsWin()
    {
        $this->secondPlayer->earnPoints(4);

        $this->assertEquals('Win for Second Player', $this->game->score());
    }

    public function testScoreFourThreeGameReturnsAdvantage()
    {
        $this->firstPlayer->earnPoints(4);
        $this->secondPlayer->earnPoints(3);

        $this->assertEquals('Advantage First Player', $this->game->score());
    }

    public function testScoreThreeFourGameReturnsAdvantage()
    {
        $this->firstPlayer->earnPoints(3);
        $this->secondPlayer->earnPoints(4);

        $this->assertEquals('Advantage Second Player', $this->game->score());
    }

    public function testScoreFourFourGameReturnsDeuce()
    {
        $this->firstPlayer->earnPoints(4);
        $this->secondPlayer->earnPoints(4);

        $this->assertEquals('Deuce', $this->game->score());
    }

    public function testScoreEightEightGameReturnsDeuce()
    {
        $this->firstPlayer->earnPoints(8);
        $this->secondPlayer->earnPoints(8);

        $this->assertEquals('Deuce', $this->game->score());
    }

    public function testScoreEightNineGameReturnsAdvantage()
    {
        $this->firstPlayer->earnPoints(8);
        $this->secondPlayer->earnPoints(9);

        $this->assertEquals('Advantage Second Player', $this->game->score());
    }

    public function testScoreEightTenGameReturnsWin()
    {
        $this->firstPlayer->earnPoints(8);
        $this->secondPlayer->earnPoints(10);

        $this->assertEquals('Win for Second Player', $this->game->score());
    }
}