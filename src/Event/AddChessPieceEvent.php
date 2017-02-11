<?php
/**
 * Created by PhpStorm.
 * User: danilka
 * Date: 10.02.17
 * Time: 18:30
 */

namespace Event;

use Entity\ChessPiece;
use Symfony\Component\EventDispatcher\Event;

class AddChessPieceEvent extends Event
{
    /**
     * @var ChessPiece
     */
    private $chessPiece;

    /**
     * @param ChessPiece $chessPiece
     */
    public function __construct(ChessPiece $chessPiece)
    {
        $this->chessPiece = $chessPiece;
    }

    /**
     * @return ChessPiece
     */
    public function getChessPiece()
    {
        return $this->chessPiece;
    }
}