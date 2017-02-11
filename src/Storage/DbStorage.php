<?php
/**
 * Created by PhpStorm.
 * User: danilka
 * Date: 10.02.17
 * Time: 16:05
 */

namespace Storage;

use Entity\Chessboard;
use Entity\ChessPiece;

class DbStorage implements IStorage
{
    /**
     * @var Chessboard $chessboard
     */
    private $chessboard;

    /**
     * @var \mysqli
     */
    private $mysqli;

    private $fields;


    public function __construct()
    {
        $this->mysqli = new \mysqli(
            \Config::DB_HOST,
            \Config::DB_USER,
            \Config::DB_PASSWORD,
            \Config::DB_NAME
        );

        if($this->mysqli->connect_errno) {
            throw new \Exception($this->mysqli->error);
        }

        $this->mysqli->query("TRUNCATE TABLE chessboard");

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
                $this->fields[] = array(
                    'x' => $x,
                    'y' => $y,
                    'type' => ($chessPiece instanceof ChessPiece) ? $chessPiece->getType() : 0
                );
            }
        }

        return $this;
    }

    public function save()
    {
        foreach($this->fields as $field) {
            $this->mysqli->query("INSERT INTO chessboard (x, y, type)
                                  VALUES('".$field['x']."', '".$field['y']."', '".$field['type']."')");
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function load()
    {
        $fields = array();
        $result = $this->mysqli->query("SELECT * FROM chessboard ORDER BY id");
        while($row = $result->fetch_assoc()) {
            $fields[ $row['x'] ][ $row['y'] ] = $row['type'];
        }

        return $fields;
    }
}