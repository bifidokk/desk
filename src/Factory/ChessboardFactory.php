<?php
/**
 * Created by PhpStorm.
 * User: danilka
 * Date: 11.02.17
 * Time: 13:45
 */

namespace Factory;


use Entity\Chessboard;
use Entity\ChessPiece;
use Event\AddChessPieceEvent;
use Event\ChessBoardEvents;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Class ChessboardFactory
 * @package Factory
 */
class ChessboardFactory
{
    /**
     * @var EventDispatcher $dispatcher
     */
    private $dispatcher;

    public function __construct(EventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param int $width
     * @param int $height
     * @param array $fields
     * @return Chessboard
     * @throws \Exception
     */
    public function createChessboard($width = 0, $height = 0, $fields = array())
    {
        $chessBoard = new Chessboard($width, $height);

        if(is_array($fields) && count($fields) > 0) {
            for($i = 0; $i < $width; $i++) {
                for($j = 0; $j < $height; $j++) {
                    if (isset($fields[$i][$j]) && $fields[$i][$j] != 0) {
                        $chessPiece = new ChessPiece($fields[$i][$j]);
                        $chessBoard->addChesspiece($chessPiece, $i, $j);
                        $this->dispatcher->dispatch(ChessBoardEvents::CHESS_PIECE_ADDED, new AddChessPieceEvent($chessPiece));
                    }
                }
            }
        }

        return $chessBoard;
    }
}