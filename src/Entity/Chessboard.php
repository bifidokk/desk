<?php
/**
 * Created by PhpStorm.
 * User: danilka
 * Date: 10.02.17
 * Time: 15:40
 */

namespace Entity;

use Event\AddChessPieceEvent;
use Event\ChessBoardEvents;
use \Symfony\Component\EventDispatcher\EventDispatcher;

class Chessboard
{
    private $width;

    private $height;

    private $chessPieces = array();

    /**
     * @param int $width
     * @param int $height
     * @throws \Exception
     */
    public function __construct($width = 0, $height = 0)
    {
        if($width <= 0 || $height <= 0) {
            throw new \Exception('Incorrect data');
        }

        $this->width = $width;
        $this->height = $height;

        for($i = 0; $i < $width; $i++) {
            for($j = 0; $j < $height; $j++) {
                $this->chessPieces[$i][$j] = 0;
            }
        }
    }

    /**
     * @param ChessPiece $chessPiece
     * @param $x
     * @param $y
     * @throws \Exception
     */
    public function addChesspiece($chessPiece, $x, $y)
    {
        if(! $chessPiece instanceof ChessPiece) {
            throw new \Exception('Incorrect type');
        }

        if(!isset($this->chessPieces[$x][$y])) {
            throw new \Exception('Incorrect coordinates');
        }

        if($this->chessPieces[$x][$y] != 0) {
            throw new \Exception('The square is busy');
        }

        $this->chessPieces[$x][$y] = $chessPiece;
        $chessPiece->setXcoord($x);
        $chessPiece->setYcoord($y);
    }

    /**
     * @param ChessPiece $chessPiece
     * @param $x
     * @param $y
     * @throws \Exception
     */
    public function moveChesspiece($chessPiece, $x, $y)
    {
        $this->releaseSquare($chessPiece->getXcoord(), $chessPiece->getYcoord());
        $this->addChesspiece($chessPiece, $x, $y);
    }

    public function releaseSquare($x, $y)
    {
        $this->chessPieces[$x][$y] = 0;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->chessPieces;
    }


}