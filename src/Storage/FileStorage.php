<?php
/**
 * Created by PhpStorm.
 * User: danilka
 * Date: 10.02.17
 * Time: 17:14
 */

namespace Storage;

use Entity\Chessboard;
use Entity\ChessPiece;

class FileStorage implements IStorage
{
    /**
     * @var Chessboard $chessboard
     */
    private $chessboard;

    private $fields;

    public function __construct()
    {

    }

    /**
     * @param Chessboard $chessboard
     * @return $this
     */
    public function prepare(Chessboard $chessboard)
    {
        $this->chessboard = $chessboard;

        foreach($this->chessboard->getData() as $x => $row) {
            foreach($row as $y => $chessPiece) {
                $this->fields[$x][$y] = ($chessPiece instanceof ChessPiece) ? $chessPiece->getType() : 0;
            }
        }

        return $this;
    }

    public function save()
    {
        file_put_contents(\Config::SAVE_FILEPATH, serialize($this->fields));
    }

    /**
     * @return array
     */
    public function load()
    {
        $fields = unserialize(file_get_contents(\Config::SAVE_FILEPATH));

        return $fields;
    }
}