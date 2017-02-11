<?php
/**
 * Created by PhpStorm.
 * User: danilka
 * Date: 10.02.17
 * Time: 17:34
 */

namespace Storage;

use Entity\Chessboard;
use Entity\ChessPiece;

class RedisStorage implements IStorage
{
    /**
     * @var Chessboard $chessboard
     */
    private $chessboard;

    /**
     * @var \Redis $redis
     */
    private $redis;

    private $fields;

    public function __construct()
    {
        $this->redis = new \Redis();
        $this->redis->connect(\Config::REDIS_HOST, \Config::REDIS_PORT);
        $this->redis->delete(\Config::REDIS_BOARD_KEY);
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
        foreach($this->fields as $key => $value) {
            $this->redis->lPush(\Config::REDIS_BOARD_KEY, serialize($value));
        }

    }

    /**
     * @return array
     * @throws \Exception
     */
    public function load()
    {
        $fields = array();
        $result_fields = $this->redis->lRange(\Config::REDIS_BOARD_KEY, 0, -1);
        foreach($result_fields as $field) {
            $field = unserialize($field);
            $fields[ $field['x'] ][ $field['y'] ] = $field['type'];
        }

        return $fields;
    }
}